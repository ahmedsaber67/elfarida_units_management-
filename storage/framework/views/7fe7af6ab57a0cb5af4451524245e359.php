

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-6">

    

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

        <form method="GET" action="<?php echo e(route('units.index')); ?>" class="space-y-4">
            <!-- Search by name or floor -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الاسم / الدور</label>
                <input type="text" name="search" placeholder="ابحث باسم أو دور..."
                       value="<?php echo e(request('search')); ?>"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الحالة</label>
                <select name="status"
                        class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm bg-white">
                    <option value="">كل الحالات</option>
                    <option value="available" <?php echo e(request('status') == 'available' ? 'selected' : ''); ?>>متاح</option>
                    <option value="reserved" <?php echo e(request('status') == 'reserved' ? 'selected' : ''); ?>>محجوز</option>
                    <option value="reserved_downpayment" <?php echo e(request('status') == 'reserved_downpayment' ? 'selected' : ''); ?>>محجوز بمقدم</option>
                    <option value="sold" <?php echo e(request('status') == 'sold' ? 'selected' : ''); ?>>مباع</option>
                </select>
            </div>

            <!-- Floor -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الدور</label>
                <select name="floor"
                        class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm bg-white">
                    <option value="">كل الأدوار</option>
                   <option value="first" <?php echo e(request('floor') == 'first' ? 'selected' : ''); ?>>الارضي</option>
                    <option value="second" <?php echo e(request('floor') == 'second' ? 'selected' : ''); ?>>الاول</option>
                    <option value="third" <?php echo e(request('floor') == 'third' ? 'selected' : ''); ?>>الثاني</option>
                    <option value="fourth" <?php echo e(request('floor') == 'fourth' ? 'selected' : ''); ?>>الثالث</option>
                    <option value="fifth" <?php echo e(request('floor') == 'fifth' ? 'selected' : ''); ?>>الرابع</option>
                    <option value="sixth" <?php echo e(request('floor') == 'sixth' ? 'selected' : ''); ?>>الخامس</option>
                </select>
            </div>

            <!-- Wing -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">الجناح</label>
                <select name="wing"
                        class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm bg-white">
                    <option value="">كل الأجنحة</option>
                    <option value="right" <?php echo e(request('wing') == 'right' ? 'selected' : ''); ?>>الأيمن</option>
                    <option value="middle" <?php echo e(request('wing') == 'middle' ? 'selected' : ''); ?>>الأوسط</option>
                    <option value="left" <?php echo e(request('wing') == 'left' ? 'selected' : ''); ?>>الأيسر</option>
                </select>
            </div>

            <!-- Area Min -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">المساحة وانت طالع (م²)</label>
                <input type="number" name="area_min" value="<?php echo e(request('area_min')); ?>" placeholder="مثلا 100 وانت طالع"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Area Max -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">المساحة وانت نازل (م²)</label>
                <input type="number" name="area_max" value="<?php echo e(request('area_max')); ?>" placeholder="مثلا 100 وانت نازل"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Price Min -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">السعر وانت طالع</label>
                <input type="number" name="price_min" value="<?php echo e(request('price_min')); ?>" placeholder="150000 أو أغلي"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Price Max -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">السعر وانت نازل</label>
                <input type="number" name="price_max" value="<?php echo e(request('price_max')); ?>" placeholder="300000 أو أرخص"
                       class="w-full px-4 py-2 border border-[#d4c9bc] rounded-xl shadow-sm">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between pt-4">
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-[#6f4e37] to-[#a67c52] text-white font-bold rounded-xl shadow-md hover:scale-105 transition">
                   🔎 بحث
                </button>
                <a href="<?php echo e(route('units.index')); ?>" 
                   class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium border border-gray-300 shadow hover:bg-gray-200 transition">
                    ♻️ إعادة ضبط
                </a>
            </div>
        </form>
    </div>

    
    
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
                    <th class="px-16 py-4 text-right">السجل</th>
                    <th class="px-6 py-4 text-right">المكتب</th>
                </tr>
            </thead>
            <tbody id="unitsTable" class="divide-y divide-gray-200">
                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'bg-green-50' => $unit->status == 'available',
                        'bg-yellow-50' => $unit->status == 'reserved',
                        'bg-orange-50' => $unit->status == 'reserved_downpayment',
                        'bg-red-50' => $unit->status == 'sold',
                    ]); ?>">
                        <td class="px-6 py-4 text-gray-600"><?php echo e($loop->iteration); ?></td>
                        <td class="px-6 py-4 font-semibold uppercase"><?php echo e($unit->name); ?></td>
                        <td class="px-6 py-4"><?php echo e(number_format($unit->price)); ?> ج.م</td>
                        <td class="px-6 py-4">
                            <?php if($unit->status == 'available'): ?>
                                <span class="px-3 py-2 text-sm bg-green-100 text-green-800 font-bold rounded-lg shadow-sm">متاح</span>
                            <?php elseif($unit->status == 'reserved'): ?>
                                <span class="px-3 py-2 text-sm bg-yellow-100 text-yellow-800 font-bold rounded-lg shadow-sm">محجوز</span>
                            <?php elseif($unit->status == 'reserved_downpayment'): ?>
                                <span class="px-3 py-2 text-sm bg-orange-100 text-orange-800 font-bold rounded-lg shadow-sm">محجوز بمقدم</span>
                            <?php else: ?>
                                <span class="px-3 py-2 text-sm bg-red-100 text-red-800 font-bold rounded-lg shadow-sm">مباع</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 font-semibold"><?php echo e(number_format($unit->area)); ?> م² </td>
                        <td class="px-6 py-4 font-semibold">
                            <?php switch($unit->floor):
                                case ('first'): ?> الدور الارضي <?php break; ?>
                                <?php case ('second'): ?> الدور الاول <?php break; ?>
                                <?php case ('third'): ?> الدور الثاني <?php break; ?>
                                <?php case ('fourth'): ?> الدور الثالث <?php break; ?>
                                <?php case ('fifth'): ?> الدور الرابع <?php break; ?>
                                <?php case ('sixth'): ?> الدور الخامس <?php break; ?>
                                <?php default: ?> -
                            <?php endswitch; ?>
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            <?php switch($unit->wing):
                                case ('right'): ?> الأيمن <?php break; ?>
                                <?php case ('middle'): ?> الأوسط <?php break; ?>
                                <?php case ('left'): ?> الأيسر <?php break; ?>
                                <?php default: ?> -
                            <?php endswitch; ?>
                        </td>
                         <td class="px-6 py-4 text-center">
                        <a href="<?php echo e(route('units.edit', $unit->id)); ?>"
       class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
       تعديل
    </a>
                    </td>
                      <td class="border border-gray-300 px-4 py-2">
                       <?php echo e($unit->office ?? '-'); ?>

</td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6 flex justify-center">
        <?php echo e($units->appends(request()->query())->links('vendor.pagination.custom')); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Elfarida_online\resources\views/units/index.blade.php ENDPATH**/ ?>