@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">تعديل الوحدة</h2>

    {{-- رسائل الأخطاء --}}
    
    <form action="{{ route('units.update', $unit->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- اسم الوحدة --}}
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">اسم الوحدة</label>
            <input type="text" name="name" value="{{ old('name', $unit->name) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 uppercase disabled"
                    readonly @if($unit->user && $unit->user->role == 'admin') required @endif>
        </div>

        {{-- السعر --}}
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">السعر</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $unit->price) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"
                    readonly @if($unit->user && $unit->user->role == 'admin') required @endif>
        </div>

        {{-- الطابق --}}
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">الطابق</label>
            <select name="floor" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"  readonly @if($unit->user && $unit->user->role == 'admin') required @endif>
                <option value="first" {{ old('floor', $unit->floor) == 'first' ? 'selected' : '' }}>الدور الارضي</option>
                <option value="second" {{ old('floor', $unit->floor) == 'second' ? 'selected' : '' }}>الدور الاول</option>
                <option value="third" {{ old('floor', $unit->floor) == 'third' ? 'selected' : '' }}>الدور الثاني</option>
                <option value="fourth" {{ old('floor', $unit->floor) == 'fourth' ? 'selected' : '' }}>الدور الثالث</option>
                <option value="fifth" {{ old('floor', $unit->floor) == 'fifth' ? 'selected' : '' }}>الدور الرابع</option>
                <option value="sixth" {{ old('floor', $unit->floor) == 'sixth' ? 'selected' : '' }}>الدور الخامس</option>
            </select>
        </div>
        {{-- الجناح --}}
<div>
    <label class="block mb-2 text-gray-700 font-semibold">الجناح</label>
    <select name="wing" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"  readonly @if($unit->user && $unit->user->role == 'admin') required @endif>
        <option value="right" {{ old('wing', $unit->wing) == 'right' ? 'selected' : '' }}>الجناح الأيمن</option>
        <option value="middle" {{ old('wing', $unit->wing) == 'middle' ? 'selected' : '' }}>الجناح الأوسط</option>
        <option value="left" {{ old('wing', $unit->wing) == 'left' ? 'selected' : '' }}>الجناح الأيسر</option>
    </select>
</div>


        {{-- المساحة --}}
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">المساحة (م²)</label>
            <input type="number" step="0.01" name="area" value="{{ old('area', $unit->area) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"
                    readonly @if($unit->user && $unit->user->role == 'admin') required @endif>
        </div>

        {{-- الحالة --}}
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">الحالة</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                <option value="available" {{ old('status', $unit->status) == 'available' ? 'selected' : '' }}>متاح</option>
                <option value="reserved" {{ old('status', $unit->status) == 'reserved' ? 'selected' : '' }}>محجوز</option>
                <option value="reserved_downpayment" {{ old('status', $unit->status) == 'reserved_downpayment' ? 'selected' : '' }}>محجوز بمقدم</option>
                <option value="sold" {{ old('status', $unit->status) == 'sold' ? 'selected' : '' }}>مباع</option>
            </select>
        </div>
        {{-- المكتب --}}
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">المكتب</label>
            <input type="text" name="office" value="{{ old('office', $unit->office) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"
                   >
        </div>

        {{-- الأزرار --}}
        <div class="flex justify-end space-x-3 rtl:space-x-reverse">
            <a href="{{ route('units.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">رجوع</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">تحديث</button>
        </div>
    </form>
</div>
@endsection
