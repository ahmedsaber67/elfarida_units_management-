<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    // 📋 عرض كل الوحدات (قراءة فقط)
    public function index(Request $request)
    {
        $query = Unit::with('transactions.office');

        // 🟢 البحث العام
        $floorsMap = [
            'الدور الاول' => 'first','الاول' => 'first','الطابق الاول' => 'first',
            'الدور الثاني' => 'second','الثاني' => 'second',
            'الدور الثالث' => 'third','الثالث' => 'third',
            'الدور الرابع' => 'fourth','الرابع' => 'fourth',
            'الدور الخامس' => 'fifth','الخامس' => 'fifth',
            'الدور السادس' => 'sixth','السادس' => 'sixth',
        ];

        if ($request->filled('search')) {
            $search = trim($request->search);
            $floor  = $floorsMap[$search] ?? null;

            $query->where(function($q) use ($search, $floor) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%");

                if ($floor) {
                    $q->orWhere('floor', $floor);
                }
            });
        }

        // 🟢 فلترة بالحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // 🟢 فلترة بالدور
        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }
        // 🟢 فلترة بالجناح
        if ($request->filled('wing')) {
            $query->where('wing', $request->wing);
        }
        // 📐 فلترة بالمساحة
        if ($request->filled('area_min')) {
            $query->where('area', '>=', (float)$request->area_min);
        }
        if ($request->filled('area_max')) {
            $query->where('area', '<=', (float)$request->area_max);
        }
        // 💰 فلترة بالسعر
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float)$request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float)$request->price_max);
        }

        $units = $query->latest()->paginate(10)->withQueryString();

        return view('units.index', compact('units'));
    }

    // ➕ فورم إضافة وحدة
    public function create()
    {
        return view('units.create');
    }

    // 💾 حفظ الوحدة
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'area'   => 'required|numeric|min:0',
            'price'  => 'required|numeric|min:0',
            'floor'  => 'required|in:first,second,third,fourth,fifth,sixth',
            'status' => 'required|in:available,reserved,reserved_downpayment,sold',
            'wing'   => 'required|in:left,right,middle',
        ]);

        Unit::create($request->only(['name','area','price','floor','status','wing']));

        return redirect()->route('units.index')->with('success', 'تم إضافة الوحدة بنجاح ✅');
    }

    // ✏️ تعديل الوحدة (مش هنستخدمه بعد كده)
    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    // 💾 تحديث الوحدة (مش هنستخدمه بعد كده)
    public function update(Request $request, Unit $unit)
{
    $request->validate([
        'name'   => 'string|max:255',
        'area'   => 'numeric|min:0',
        'price'  => 'numeric|min:0',
        'floor'  => 'in:first,second,third,fourth,fifth,sixth',
        'status' => 'required|in:available,reserved,reserved_downpayment,sold',
        'office' => 'required|string|max:255|nullable',
        'wing'   => 'in:left,right,middle',
    ]);

    // جيب المكتب بتاع اليوزر الحالي
    $user = new User();
        

  
    // حدّث باقي بيانات الوحدة
    $unit->update($request->only(['name','area','price','floor','status','wing','history', 'office']));

    return redirect()->route('units.index')->with('success', 'تم تحديث بيانات الوحدة بنجاح ✅');
}

    // 📝 صفحة التحكم (العروض + الخصومات + تعديل جماعي)
   public function bulk()
{
    $query = Unit::query();

    // تطبيق نفس الفلاتر زي index
    if (request('search')) {
        $query->where(function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%')
              ->orWhere('floor', 'like', '%' . request('search') . '%');
        });
    }

    if (request('status')) {
        $query->where('status', request('status'));
    }

    if (request('floor')) {
        $query->where('floor', request('floor'));
    }

    if (request('wing')) {
        $query->where('wing', request('wing'));
    }

    if (request('area_min')) {
        $query->where('area', '>=', request('area_min'));
    }

    if (request('area_max')) {
        $query->where('area', '<=', request('area_max'));
    }

    if (request('price_min')) {
        $query->where('price', '>=', request('price_min'));
    }

    if (request('price_max')) {
        $query->where('price', '<=', request('price_max'));
    }

    $units = $query->paginate(10);

    return view('units.bulk', compact('units'));
}

public function bulkUpdate(Request $request)
{
    $request->validate([
        'action' => 'required|in:set,increase,decrease,increase_percent,decrease_percent',
        'amount' => 'required|numeric',
    ]);

    $query = Unit::query();

    // ✅ إعادة تطبيق الفلاتر
    if ($request->filled('search')) {
        $floorsMap = [
            'الدور الاول' => 'first','الاول' => 'first','الطابق الاول' => 'first',
            'الدور الثاني' => 'second','الثاني' => 'second',
            'الدور الثالث' => 'third','الثالث' => 'third',
            'الدور الرابع' => 'fourth','الرابع' => 'fourth',
            'الدور الخامس' => 'fifth','الخامس' => 'fifth',
            'الدور السادس' => 'sixth','السادس' => 'sixth',
        ];
        $search = trim($request->search);
        $floor  = $floorsMap[$search] ?? null;

        $query->where(function($q) use ($search, $floor) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('price', 'like', "%{$search}%");

            if ($floor) {
                $q->orWhere('floor', $floor);
            }
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('floor')) {
        $query->where('floor', $request->floor);
    }
    if ($request->filled('wing')) {
        $query->where('wing', $request->wing);
    }
    if ($request->filled('area_min')) {
        $query->where('area', '>=', (float)$request->area_min);
    }
    if ($request->filled('area_max')) {
        $query->where('area', '<=', (float)$request->area_max);
    }
    if ($request->filled('price_min')) {
        $query->where('price', '>=', (float)$request->price_min);
    }
    if ($request->filled('price_max')) {
        $query->where('price', '<=', (float)$request->price_max);
    }

    $units = $query->get();

    $actionsMap = [
        'set'             => 'تعيين السعر',
        'increase'        => 'زيادة السعر بمبلغ',
        'decrease'        => 'نقص السعر بمبلغ',
        'increase_percent'=> 'زيادة السعر بنسبة',
        'decrease_percent'=> 'نقص السعر بنسبة',
    ];

    foreach ($units as $unit) {
        $oldPrice = $unit->price;

        // ✅ تنفيذ التعديلات
        switch ($request->action) {
            case 'set':
                $unit->price = $request->amount;
                break;
            case 'increase':
                $unit->price += $request->amount;
                break;
            case 'decrease':
                $unit->price -= $request->amount;
                break;
            case 'increase_percent':
                $unit->price *= (1 + $request->amount / 100);
                break;
            case 'decrease_percent':
                $unit->price *= (1 - $request->amount / 100);
                break;
        }

        if ($unit->price < 0) {
            $unit->price = 0;
        }

        $unit->save();

        // ✅ تسجيل العملية في السجل
        $history = $unit->history ? json_decode($unit->history, true) : [];
        $history[] = [
            'field'     => 'السعر',
            'old'       => $oldPrice,
            'new'       => $unit->price,
            'action'    => $actionsMap[$request->action] . " ({$request->amount})",
            'user'      => auth()->user->name ?? 'system',
            'timestamp' => now()->toDateTimeString(),
        ];

        $unit->history = json_encode($history, JSON_UNESCAPED_UNICODE);
        $unit->save();
    }

    return redirect()->route('units.bulk')->with('success', 'تم تطبيق التعديل الجماعي بنجاح ✅');
}



public function changeStatus(Request $request, Unit $unit)
{
    // authorize via middleware role:supervisor,admin in routes
    $request->validate([
        'status' => 'required|in:available,reserved,reserved_downpayment,sold',
    ]);

    $old = $unit->status;
    $unit->status = $request->status;
    $unit->save();

        
    // سجل التغيير history إذا عايز (مثال حافظة history JSON)
    $history = $unit->history ? json_decode($unit->history, true) : [];
    $history[] = [
        'action' => 'تغيير الحالة',
        'old' => $old,
        'new' => $unit->status,
        'at' => now()->toDateTimeString(),
    ];
    $unit->history = json_encode($history, JSON_UNESCAPED_UNICODE);
    $unit->save();

    return back()->with('success', 'تم تحديث حالة الوحدة.');
}


    // 📝 عرض السجلات
    public function logs(Unit $unit)
    {
        $logs = $unit->history ? json_decode($unit->history, true) : [];
        return view('units.logs', compact('unit', 'logs'));
    }

   public function export(Request $request)
{
    $filename = "units_export_" . now()->format('Ymd_His') . ".csv";

    return response()->stream(function () use ($request) {
        $handle = fopen('php://output', 'w');

        // BOM للـ UTF-8
        fwrite($handle, "\xEF\xBB\xBF");

        // عناوين الأعمدة
        fputcsv($handle, ['ID', 'اسم الوحدة', 'السعر', 'المساحة', 'الدور', 'الجناح', 'الحالة', 'آخر تحديث']);

        // نفس فلترة index
        $floorsMap = [
            'الدور الاول' => 'first','الاول' => 'first','الطابق الاول' => 'first',
            'الدور الثاني' => 'second','الثاني' => 'second',
            'الدور الثالث' => 'third','الثالث' => 'third',
            'الدور الرابع' => 'fourth','الرابع' => 'fourth',
            'الدور الخامس' => 'fifth','الخامس' => 'fifth',
            'الدور السادس' => 'sixth','السادس' => 'sixth',
        ];

        $query = Unit::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $floor  = $floorsMap[$search] ?? null;

            $query->where(function($q) use ($search, $floor) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%");

                if ($floor) {
                    $q->orWhere('floor', $floor);
                }
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }
        if ($request->filled('wing')) {
            $query->where('wing', $request->wing);
        }
        if ($request->filled('area_min')) {
            $query->where('area', '>=', (float)$request->area_min);
        }
        if ($request->filled('area_max')) {
            $query->where('area', '<=', (float)$request->area_max);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float)$request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float)$request->price_max);
        }

        foreach ($query->cursor() as $unit) {
            fputcsv($handle, [
                $unit->id,
                $unit->name,
                $unit->price,
                $unit->area,
                $unit->floor,
                $unit->wing,
                $unit->status,
                $unit->updated_at,
            ]);
        }

        fclose($handle);
    }, 200, [
        "Content-Type" => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=\"$filename\"",
    ]);
}


    // 🗑️ حذف الوحدة
    public function destroy(Unit $unit)
    {
        if ($unit->transactions()->count() > 0) {
            return redirect()->route('units.index')->with('error', 'لا يمكن حذف الوحدة لأنها مرتبطة بعمليات.');
        }

        $unit->delete();
        return redirect()->route('units.index')->with('success', 'تم حذف الوحدة بنجاح ✅');
    }
}
