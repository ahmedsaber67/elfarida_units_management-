

<?php $__env->startSection('content'); ?>
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">تعديل الوحدة</h2>

    
    
    <form action="<?php echo e(route('units.update', $unit->id)); ?>" method="POST" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">اسم الوحدة</label>
            <input type="text" name="name" value="<?php echo e(old('name', $unit->name)); ?>"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 uppercase disabled"
                    readonly <?php if($unit->user && $unit->user->role == 'admin'): ?> required <?php endif; ?>>
        </div>

        
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">السعر</label>
            <input type="number" step="0.01" name="price" value="<?php echo e(old('price', $unit->price)); ?>"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"
                    readonly <?php if($unit->user && $unit->user->role == 'admin'): ?> required <?php endif; ?>>
        </div>

        
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">الطابق</label>
            <select name="floor" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"  readonly <?php if($unit->user && $unit->user->role == 'admin'): ?> required <?php endif; ?>>
                <option value="first" <?php echo e(old('floor', $unit->floor) == 'first' ? 'selected' : ''); ?>>الدور الارضي</option>
                <option value="second" <?php echo e(old('floor', $unit->floor) == 'second' ? 'selected' : ''); ?>>الدور الاول</option>
                <option value="third" <?php echo e(old('floor', $unit->floor) == 'third' ? 'selected' : ''); ?>>الدور الثاني</option>
                <option value="fourth" <?php echo e(old('floor', $unit->floor) == 'fourth' ? 'selected' : ''); ?>>الدور الثالث</option>
                <option value="fifth" <?php echo e(old('floor', $unit->floor) == 'fifth' ? 'selected' : ''); ?>>الدور الرابع</option>
                <option value="sixth" <?php echo e(old('floor', $unit->floor) == 'sixth' ? 'selected' : ''); ?>>الدور الخامس</option>
            </select>
        </div>
        
<div>
    <label class="block mb-2 text-gray-700 font-semibold">الجناح</label>
    <select name="wing" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"  readonly <?php if($unit->user && $unit->user->role == 'admin'): ?> required <?php endif; ?>>
        <option value="right" <?php echo e(old('wing', $unit->wing) == 'right' ? 'selected' : ''); ?>>الجناح الأيمن</option>
        <option value="middle" <?php echo e(old('wing', $unit->wing) == 'middle' ? 'selected' : ''); ?>>الجناح الأوسط</option>
        <option value="left" <?php echo e(old('wing', $unit->wing) == 'left' ? 'selected' : ''); ?>>الجناح الأيسر</option>
    </select>
</div>


        
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">المساحة (م²)</label>
            <input type="number" step="0.01" name="area" value="<?php echo e(old('area', $unit->area)); ?>"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"
                    readonly <?php if($unit->user && $unit->user->role == 'admin'): ?> required <?php endif; ?>>
        </div>

        
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">الحالة</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                <option value="available" <?php echo e(old('status', $unit->status) == 'available' ? 'selected' : ''); ?>>متاح</option>
                <option value="reserved" <?php echo e(old('status', $unit->status) == 'reserved' ? 'selected' : ''); ?>>محجوز</option>
                <option value="reserved_downpayment" <?php echo e(old('status', $unit->status) == 'reserved_downpayment' ? 'selected' : ''); ?>>محجوز بمقدم</option>
                <option value="sold" <?php echo e(old('status', $unit->status) == 'sold' ? 'selected' : ''); ?>>مباع</option>
            </select>
        </div>
        
        <div>
            <label class="block mb-2 text-gray-700 font-semibold">المكتب</label>
            <input type="text" name="office" value="<?php echo e(old('office', $unit->office)); ?>"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400"
                   >
        </div>

        
        <div class="flex justify-end space-x-3 rtl:space-x-reverse">
            <a href="<?php echo e(route('units.index')); ?>" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">رجوع</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">تحديث</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Elfarida_online\resources\views/units/edit.blade.php ENDPATH**/ ?>