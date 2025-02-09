<?php if (isset($component)) { $__componentOriginalb1cfbe1e9d23a21913b92721c7c5480f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1cfbe1e9d23a21913b92721c7c5480f = $attributes; } ?>
<?php $component = App\View\Components\CustomerLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('customer-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CustomerLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h2>

                    <?php if($orders && $orders->isEmpty()): ?>
                        <div class="text-center py-8 border rounded-lg bg-gray-50">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h1l1 2h13l1-2h1m-1 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6m16 0H3"></path>
                            </svg>
                            <div class="text-gray-500 mb-3">No orders found</div>
                        </div>
                    <?php elseif($orders): ?>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border rounded-lg p-4 hover:border-[#0f172a] transition-all duration-300">
                                    <div class="font-medium text-gray-800 mb-2">Order #<?php echo e($order->order_number); ?></div>
                                    <div class="text-sm text-gray-600 mb-2">Total: Rp
                                        <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></div>
                                    <div class="text-sm text-gray-600 mb-2">Status: <?php echo e(ucfirst($order->status)); ?></div>
                                    <div class="text-sm text-gray-600 mb-2">Payment Status:
                                        <?php echo e(ucfirst($order->payment_status)); ?></div>
                                    <div class="text-sm text-gray-600 mb-2">Items:</div>
                                    <ul class="list-disc list-inside text-sm text-gray-600">
                                        <?php if($order->orderItems): ?>
                                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($item->product->name); ?> (<?php echo e($item->quantity); ?> x Rp
                                                    <?php echo e(number_format($item->price, 0, ',', '.')); ?>)</li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1cfbe1e9d23a21913b92721c7c5480f)): ?>
<?php $attributes = $__attributesOriginalb1cfbe1e9d23a21913b92721c7c5480f; ?>
<?php unset($__attributesOriginalb1cfbe1e9d23a21913b92721c7c5480f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1cfbe1e9d23a21913b92721c7c5480f)): ?>
<?php $component = $__componentOriginalb1cfbe1e9d23a21913b92721c7c5480f; ?>
<?php unset($__componentOriginalb1cfbe1e9d23a21913b92721c7c5480f); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\uas_pti\resources\views/customer/orders/index.blade.php ENDPATH**/ ?>