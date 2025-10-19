@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">📜 سجل التغييرات للوحدة: {{ $unit->name }}</h2>

    @if(!empty($logs))
        <table class="table-auto w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">بواسطة</th>
                    <th class="px-4 py-2 border">التاريخ</th>
                    <th class="px-4 py-2 border">الإجراء</th>
                    <th class="px-4 py-2 border">القيمة القديمة</th>
                    <th class="px-4 py-2 border">القيمة الجديدة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>    
                        <td class="px-4 py-2 border">{{ $log['user'] ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $log['timestamp'] ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $log['action'] ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $log['old'] ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $log['new'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">لا يوجد تغييرات مسجلة.</p>
    @endif
</div>
@endsection
