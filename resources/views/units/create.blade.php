@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-gradient-to-br from-[#f5f0e6] to-[#e9dfd0] p-8 rounded-xl shadow-lg border border-[#d6c7b4]">
    <h2 class="text-2xl font-extrabold text-[#4b3832] mb-6 text-center">➕ إضافة وحدة جديدة</h2>

    {{-- رسائل الأخطاء --}}
    @if ($errors->any())
        <div class="mb-4 bg-[#f8e4e1] text-[#7a2c2c] p-4 rounded-lg shadow">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('units.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- اسم الوحدة --}}
        <div>
            <label class="block mb-2 text-[#3e2c23] font-semibold">اسم الوحدة</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-[#cbbba0] rounded-lg p-2 focus:ring focus:ring-[#a68a64] bg-[#fcf9f4]"
                   required>
        </div>

        {{-- المساحة --}}
        <div>
            <label class="block mb-2 text-[#3e2c23] font-semibold">المساحة (م²)</label>
            <input type="number" name="area" value="{{ old('area') }}"
                   class="w-full border border-[#cbbba0] rounded-lg p-2 focus:ring focus:ring-[#a68a64] bg-[#fcf9f4]"
                   required>
        </div>

        {{-- الطابق --}}
        <div>
            <label class="block mb-2 text-[#3e2c23] font-semibold">الدور</label>
            <select name="floor" class="w-full border border-[#cbbba0] rounded-lg p-2 focus:ring focus:ring-[#a68a64] bg-[#fcf9f4]" required>
                <option value="first" {{ old('floor') == 'first' ? 'selected' : '' }}>الارضي</option>
                <option value="second" {{ old('floor') == 'second' ? 'selected' : '' }}>الاول</option>
                <option value="third" {{ old('floor') == 'third' ? 'selected' : '' }}>الثاني</option>
                <option value="fourth" {{ old('floor') == 'fourth' ? 'selected' : '' }}>الثالث</option>
                <option value="fifth" {{ old('floor') == 'fifth' ? 'selected' : '' }}>الرابع</option>
                <option value="sixth" {{ old('floor') == 'sixth' ? 'selected' : '' }}>الخامس</option>
            </select>
        </div>

        {{-- الجناح --}}
        <div>
            <label class="block mb-2 text-[#3e2c23] font-semibold">الجناح</label>
            <select name="wing" class="w-full border border-[#cbbba0] rounded-lg p-2 focus:ring focus:ring-[#a68a64] bg-[#fcf9f4]" required>
                <option value="right" {{ old('wing') == 'right' ? 'selected' : '' }}>الجناح الأيمن</option>
                <option value="middle" {{ old('wing') == 'middle' ? 'selected' : '' }}>الجناح الأوسط</option>
                <option value="left" {{ old('wing') == 'left' ? 'selected' : '' }}>الجناح الأيسر</option>
            </select>
        </div>

        {{-- السعر --}}
        <div>
            <label class="block mb-2 text-[#3e2c23] font-semibold">السعر</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border border-[#cbbba0] rounded-lg p-2 focus:ring focus:ring-[#a68a64] bg-[#fcf9f4]"
                   required>
        </div>

        {{-- الحالة --}}
        <div>
            <label class="block mb-2 text-[#3e2c23] font-semibold">الحالة</label>
            <select name="status" class="w-full border border-[#cbbba0] rounded-lg p-2 focus:ring focus:ring-[#a68a64] bg-[#fcf9f4]" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>متاح</option>
                <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>محجوز</option>
                <option value="reserved_downpayment" {{ old('status') == 'reserved_downpayment' ? 'selected' : '' }}>محجوز بمقدم</option>
                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>مباع</option>
            </select>
        </div>

        {{-- الأزرار --}}
        <div class="flex justify-between">
            <a href="{{ route('units.index') }}" 
               class="px-5 py-2 bg-[#c9b6a9] text-[#3e2c23] font-medium rounded-lg shadow hover:bg-[#b89d8a] transition">
               إلغاء
            </a>
            <button type="submit" 
               class="px-5 py-2 bg-[#6f4e37] text-white font-semibold rounded-lg shadow hover:bg-[#5a3f2c] transition">
               💾 حفظ
            </button>
        </div>
    </form>
</div>
@endsection
