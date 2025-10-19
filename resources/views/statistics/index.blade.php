@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📊 الإحصائيات</h2>

   

    <!-- توزيع الحالات -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-3">توزيع الحالات</h3>
        <canvas id="statusChart"></canvas>
    </div>
</div>

<!-- حمّل Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('statusChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['متاح', 'محجوز', 'محجوز بمقدم', 'مباع'],
                datasets: [{
                    data: [
                        "{{ $statusCounts['available'] ?? 0 }}",
                        "{{ $statusCounts['reserved'] ?? 0 }}",
                        "{{ $statusCounts['reserved_downpayment'] ?? 0 }}",
                        "{{ $statusCounts['sold'] ?? 0 }}",
                    ],
                    backgroundColor: ['#34d399','#fbbf24','#fb923c','#f87171'],
                }]
            }
        });
    }
});
</script>
@endsection
