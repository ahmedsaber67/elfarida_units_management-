

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📊 الإحصائيات</h2>

    <!-- جدول مبيعات المكاتب -->
    <div class="mb-8">
        <h3 class="text-sm font-semibold mb-3">مبيعات المكاتب</h3>
        <table class="w-full border-collapse bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-1 py-1 text-right">المكتب</th>
                    <th class="px-1 py-1 text-right">عدد الوحدات المباعة</th>
                    <th class="px-1 py-1 text-right">إجمالي المبيعات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $officeSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?php echo e($sale['office']); ?></td>
                        <td class="px-4 py-2"><?php echo e($sale['count']); ?></td>
                        <td class="px-4 py-2"><?php echo e(number_format($sale['total'], 2)); ?> جنيه</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

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
                        "<?php echo e($statusCounts['available'] ?? 0); ?>",
                        "<?php echo e($statusCounts['reserved'] ?? 0); ?>",
                        "<?php echo e($statusCounts['reserved_downpayment'] ?? 0); ?>",
                        "<?php echo e($statusCounts['sold'] ?? 0); ?>",
                    ],
                    backgroundColor: ['#34d399','#fbbf24','#fb923c','#f87171'],
                }]
            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Elfarida_online\resources\views/statistics/index.blade.php ENDPATH**/ ?>