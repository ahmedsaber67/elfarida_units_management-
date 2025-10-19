

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">📜 سجل التغييرات للوحدة: <?php echo e($unit->name); ?></h2>

    <?php if(!empty($logs)): ?>
        <table class="table-auto w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">التاريخ</th>
                    <th class="px-4 py-2 border">الإجراء</th>
                    <th class="px-4 py-2 border">القيمة القديمة</th>
                    <th class="px-4 py-2 border">القيمة الجديدة</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-4 py-2 border"><?php echo e($log['timestamp'] ?? '-'); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($log['action'] ?? '-'); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($log['old'] ?? '-'); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($log['new'] ?? '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-gray-500">لا يوجد تغييرات مسجلة.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Elfarida_online\resources\views/units/logs.blade.php ENDPATH**/ ?>