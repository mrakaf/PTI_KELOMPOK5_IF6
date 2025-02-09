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
                    <h2 class="text-2xl font-semibold mb-6">Profile Settings</h2>

                    <?php if(session('success')): ?>
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('customer.profile.update')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Basic Information</h3>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" 
                                       value="<?php echo e(old('name', $user->name)); ?>"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" 
                                       value="<?php echo e(old('email', $user->email)); ?>"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone" 
                                       value="<?php echo e(old('phone', $user->phone)); ?>"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Active Address -->
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-sm font-medium text-gray-700">Active Address</h4>
                                    <a href="<?php echo e(route('customer.addresses.index')); ?>" 
                                       class="text-sm text-[#0f172a] hover:underline">
                                        Manage Addresses
                                    </a>
                                </div>
                                
                                <?php if($user->addresses()->where('is_primary', true)->first()): ?>
                                    <?php
                                        $primaryAddress = $user->addresses()->where('is_primary', true)->first();
                                    ?>
                                    <div class="space-y-1">
                                        <div class="text-sm font-medium text-gray-800">
                                            <?php echo e($primaryAddress->recipient_name); ?>

                                            <?php if($primaryAddress->label): ?>
                                                <span class="text-gray-500">(<?php echo e($primaryAddress->label); ?>)</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-sm text-gray-600"><?php echo e($primaryAddress->phone_number); ?></div>
                                        <div class="text-sm text-gray-600">
                                            <?php echo e($primaryAddress->address); ?>,
                                            <?php echo e($primaryAddress->city); ?>,
                                            <?php echo e($primaryAddress->postal_code); ?>

                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="text-sm text-gray-500 italic">
                                        No primary address set. 
                                        <a href="<?php echo e(route('customer.addresses.create')); ?>" 
                                           class="text-[#0f172a] hover:underline">
                                            Add an address
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div class="space-y-4 pt-6 border-t">
                            <h3 class="text-lg font-medium">Change Password</h3>
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <input type="password" name="current_password" id="current_password" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                                <input type="password" name="new_password" id="new_password" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-end pt-6">
                            <button type="submit" 
                                    class="bg-gradient-to-r from-[#0f172a] to-[#334155] text-white py-2 px-4 rounded-lg hover:opacity-90">
                                Update Profile
                            </button>
                        </div>
                    </form>
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
<?php endif; ?> <?php /**PATH C:\laragon\www\uas_pti\resources\views/customer/profile/index.blade.php ENDPATH**/ ?>