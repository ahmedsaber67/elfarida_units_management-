<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination" class="flex items-center gap-2 text-sm font-medium">
        
        
        <?php if($paginator->onFirstPage()): ?>
            <span class="px-3 py-1 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">السابق</span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" 
               class="px-3 py-1 rounded-lg bg-white border shadow-sm hover:bg-gray-100 transition">
                السابق
            </a>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <span class="px-3 py-1 text-gray-500"><?php echo e($element); ?></span>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <span class="px-3 py-1 rounded-lg bg-gradient-to-r from-[#6f4e37] to-[#a67c52] text-white shadow">
                            <?php echo e($page); ?>

                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($url); ?>" 
                           class="px-3 py-1 rounded-lg bg-white border shadow-sm hover:bg-gray-100 transition">
                            <?php echo e($page); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" 
               class="px-3 py-1 rounded-lg bg-white border shadow-sm hover:bg-gray-100 transition">
                التالي
            </a>
        <?php else: ?>
            <span class="px-3 py-1 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">التالي</span>
        <?php endif; ?>
    </nav>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Elfarida_online\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>