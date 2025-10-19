@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

{{-- زر إضافة --}}
    <div class="flex justify-end mb-6">
        <a href="{{ route('units.create') }}"
           class="px-5 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
            + إضافة وحدة
        </a>
    </div>
    
     <!-- زر فتح/إغلاق البحث -->
    <div class="mb-6">
        <button type="button" 
                onclick="document.getElementById('searchBox').classList.toggle('hidden')"
                class="px-6 py-3 bg-gradient-to-r from-[#6f4e37] to-[#a67c52] text-white font-bold rounded-xl shadow hover:scale-105 transition">
            🔎 فلاتر البحث
        </button>
    </div>

    <!-- Search Box -->
    <div id="searchBox" class="bg-white border border-[#e5ded1] rounded-2xl shadow-xl p-6 mb-8 hidden">
        <div class="flex items-center mb-4">
            <span class="text-xl mr-2">🔎</span>
            <h3 class="text-xl font-bold text-[#6f4e37]">بحث متقدم</h3>
        </div>

        <form method="GET" action="{{ route('units.bulk') }}" class="space-y-4">
            <!-- Search by name or floor -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الاسم / الدور</label>
                <input type="text" name="search" placeholder="ابحث باسم أو دور..."
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الحالة</label>
                <select name="status"
                        class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm bg-white">
                    <option value="">كل الحالات</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>متاح</option>
                    <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>محجوز</option>
                    <option value="reserved_downpayment" {{ request('status') == 'reserved_downpayment' ? 'selected' : '' }}>محجوز بمقدم</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>مباع</option>
                </select>
            </div>

            <!-- Floor -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الدور</label>
                <select name="floor"
                        class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm bg-white">
                    <option value="">كل الأدوار</option>
                    <option value="first" {{ request('floor') == 'first' ? 'selected' : '' }}>الارضي</option>
                    <option value="second" {{ request('floor') == 'second' ? 'selected' : '' }}>الاول</option>
                    <option value="third" {{ request('floor') == 'third' ? 'selected' : '' }}>الثاني</option>
                    <option value="fourth" {{ request('floor') == 'fourth' ? 'selected' : '' }}>الثالث</option>
                    <option value="fifth" {{ request('floor') == 'fifth' ? 'selected' : '' }}>الرابع</option>
                    <option value="sixth" {{ request('floor') == 'sixth' ? 'selected' : '' }}>الخامس</option>
                </select>
            </div>

            <!-- Wing -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الجناح</label>
                <select name="wing"
                        class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm bg-white">
                    <option value="">كل الأجنحة</option>
                    <option value="right" {{ request('wing') == 'right' ? 'selected' : '' }}>الأيمن</option>
                    <option value="middle" {{ request('wing') == 'middle' ? 'selected' : '' }}>الأوسط</option>
                    <option value="left" {{ request('wing') == 'left' ? 'selected' : '' }}>الأيسر</option>
                </select>
            </div>

            <!-- Area Min -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">المساحة وانت طالع (م²)</label>
                <input type="number" name="area_min" value="{{ request('area_min') }}" placeholder="مثلا 100 وانت طالع"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Area Max -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">المساحة وانت نازل (م²)</label>
                <input type="number" name="area_max" value="{{ request('area_max') }}" placeholder="مثلا 100 وانت نازل"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Price Min -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">السعر وانت طالع</label>
                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="150000 أو أغلي"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Price Max -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">السعر وانت نازل</label>
                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="300000 أو أرخص"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between pt-4">
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-[#6f4e37] to-[#a67c52] text-white font-bold rounded-xl shadow-md hover:scale-105 transition">
                   🔎 بحث
                </button>
                <a href="{{ route('units.bulk') }}" 
                   class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium border border-gray-300 shadow hover:bg-gray-200 transition">
                    ♻️ إعادة ضبط
                </a>
            </div>
        </form>
    </div>

    <button type="button" 
                onclick="document.getElementById('bulkEdit').classList.toggle('hidden')"
                class="px-6 py-3 bg-gradient-to-r from-[#6f4e37] to-[#a67c52] text-white font-bold rounded-xl shadow hover:scale-105 transition">
            ⚙️ تعديل جماعي للأسعار
            </button>
    {{-- ⚙️ فورم التحكم الجماعي --}}
    <div id="bulkEdit" class="mb-8 bg-gray-50 border border-gray-200 rounded-xl p-6 shadow hidden">
        <h3 class="text-lg font-bold text-blue-700 mb-4">⚙️ التحكم الجماعي في الأسعار</h3>
        <form action="{{ route('units.bulk.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">العملية</label>
                <select name="action" required class="w-full px-4 py-2 border rounded-xl bg-white">
                    <option value="set">تعيين سعر ثابت</option>
                    <option value="increase">زيادة بمبلغ</option>
                    <option value="decrease">نقص بمبلغ</option>
                    <option value="increase_percent">زيادة بنسبة %</option>
                    <option value="decrease_percent">نقص بنسبة %</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">القيمة</label>
                <input type="number" step="0.01" name="amount" required 
                       class="w-full px-4 py-2 border rounded-xl">
            </div>

            <div class="flex items-end">
                <button type="submit"
                        class="w-full px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    ✔️ تطبيق
                </button>
            </div>

            {{-- 🔴 هيدن لنقل الفلاتر --}}
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="floor" value="{{ request('floor') }}">
            <input type="hidden" name="wing" value="{{ request('wing') }}">
            <input type="hidden" name="area_min" value="{{ request('area_min') }}">
            <input type="hidden" name="area_max" value="{{ request('area_max') }}">
            <input type="hidden" name="price_min" value="{{ request('price_min') }}">
            <input type="hidden" name="price_max" value="{{ request('price_max') }}">
        </form>
    </div>

    {{-- 📋 جدول الوحدات --}}
    <div class="overflow-x-auto rounded-xl shadow-lg bg-white border border-gray-200">
        <table class="w-full text-base text-gray-800">
            <thead class="bg-gradient-to-r from-blue-700 to-blue-500 text-white text-lg">
                <tr>
                    <th class="px-6 py-4 text-right">#</th>
                    <th class="px-6 py-4 text-right">اسم الوحدة</th>
                    <th class="px-6 py-4 text-right">السعر</th>
                    <th class="px-6 py-4 text-right">الحالة</th>
                    <th class="px-6 py-4 text-right">المساحة</th>
                    <th class="px-6 py-4 text-right">الدور</th>
                    <th class="px-6 py-4 text-right">الجناح</th>
                    <th class="px-6 py-4 text-right">📜 السجل</th>
                    <th class="px-6 py-4 text-right">المكتب</th>
                </tr>
            </thead>
           <tbody id="unitsTable" class="divide-y divide-gray-200">
                @foreach($units as $unit)
                    <tr @class([
                        'bg-green-50' => $unit->status == 'available',
                        'bg-yellow-50' => $unit->status == 'reserved',
                        'bg-orange-50' => $unit->status == 'reserved_downpayment',
                        'bg-red-50' => $unit->status == 'sold',
                    ])>
                        <td class="px-6 py-4 text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold uppercase">{{ $unit->name }}</td>
                        <td class="px-6 py-4">{{ number_format($unit->price) }} ج.م</td>
                        <td class="px-6 py-4">
                            @if($unit->status == 'available')
                                <span class="px-3 py-2 text-sm bg-green-100 text-green-800 font-bold rounded-lg shadow-sm">متاح</span>
                            @elseif($unit->status == 'reserved')
                                <span class="px-3 py-2 text-sm bg-yellow-100 text-yellow-800 font-bold rounded-lg shadow-sm">محجوز</span>
                            @elseif($unit->status == 'reserved_downpayment')
                                <span class="px-3 py-2 text-sm bg-orange-100 text-orange-800 font-bold rounded-lg shadow-sm">محجوز بمقدم</span>
                            @else
                                <span class="px-3 py-2 text-sm bg-red-100 text-red-800 font-bold rounded-lg shadow-sm">مباع</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ number_format($unit->area) }} م² </td>
                        <td class="px-6 py-4 font-semibold">
                            @switch($unit->floor)
                                @case('first') الدور الأول @break
                                @case('second') الدور الثاني @break
                                @case('third') الدور الثالث @break
                                @case('fourth') الدور الرابع @break
                                @case('fifth') الدور الخامس @break
                                @case('sixth') الدور السادس @break
                                @default -
                            @endswitch
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            @switch($unit->wing)
                                @case('right') الأيمن @break
                                @case('middle') الأوسط @break
                                @case('left') الأيسر @break
                                @default -
                            @endswitch
                        </td>
                         <td class="px-6 py-4 text-center">
                        <a href="{{ route('units.logs', $unit->id) }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                            📜 السجل
                        </a>
                    </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $unit->transactions->first()->office->name ?? '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
    <a href="{{ route('units.export', request()->query()) }}"
   class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
   ⬇️ تحميل CSV (يفتحه Excel)
</a>
</div>


    {{-- Pagination --}}
    <div class="mt-6 flex justify-center">
        {{ $units->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>

</div>
@endsection
