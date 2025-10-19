<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Unit;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // إجمالي مبيعات كل مكتب
        $officeSales = Office::with(['transactions.unit'])
            ->get()
            ->map(function ($office) {
                $soldUnits = $office->transactions->where('status', 'sold')->pluck('unit');
                return [
                    'office' => $office->name,
                    'count' => $soldUnits->count(),
                    'total' => $soldUnits->sum('price'),
                ];
            });

        // توزيع الحالات (available, reserved, reserved_downpayment, sold)
        $statusCounts = Unit::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('statistics.index', compact('officeSales', 'statusCounts'));
    }
}
