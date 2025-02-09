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
            <!-- Back Button -->
            <div class="mb-6">
                <a href="<?php echo e(route('customer.cart')); ?>"
                    class="inline-flex items-center text-gray-600 hover:text-[#0f172a] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Cart
                </a>
            </div>

            <!-- Checkout Container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center mb-8">
                        <svg class="w-8 h-8 text-[#0f172a] mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Checkout</h2>
                    </div>

                    <?php if(session('error')): ?>
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('customer.checkout.process')); ?>" method="POST" id="checkoutForm">
                        <?php echo csrf_field(); ?>

                        <!-- Shipping Address -->
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-[#0f172a] mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-800">Shipping Address</h3>
                            </div>

                            <?php if($addresses->count() > 0): ?>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="relative border rounded-lg p-4 hover:border-[#0f172a] transition-all duration-300 
                                                    <?php if($address->is_primary): ?> border-[#0f172a] bg-gray-50 <?php endif; ?>">
                                            <input type="radio" name="address_id" value="<?php echo e($address->id); ?>"
                                                <?php if($address->is_primary): ?> checked <?php endif; ?>
                                                class="absolute top-4 right-4 h-4 w-4 text-[#0f172a] focus:ring-[#0f172a]">

                                            <div class="pr-8">
                                                <div class="font-medium text-gray-800">
                                                    <?php echo e($address->recipient_name); ?>

                                                    <?php if($address->label): ?>
                                                        <span
                                                            class="ml-2 px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">
                                                            <?php echo e($address->label); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="text-sm text-gray-600 mt-1"><?php echo e($address->phone_number); ?>

                                                </div>
                                                <div class="text-sm text-gray-600 mt-1">
                                                    <?php echo e($address->address); ?>,
                                                    <?php echo e($address->city); ?>,
                                                    <?php echo e($address->postal_code); ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-8 border rounded-lg bg-gray-50">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div class="text-gray-500 mb-3">No shipping address found</div>
                                    <a href="<?php echo e(route('customer.addresses.create')); ?>"
                                        class="inline-flex items-center text-[#0f172a] hover:text-[#334155] transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add New Address
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php $__errorArgs = ['address_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="mt-2 text-red-600 text-sm">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Order Summary -->
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-[#0f172a] mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-800">Order Summary</h3>
                            </div>

                            <div class="border rounded-lg divide-y">
                                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="p-4 flex items-center space-x-4 hover:bg-gray-50 transition-colors">
                                        <img src="<?php echo e(Storage::url($cart->product->image)); ?>"
                                            alt="<?php echo e($cart->product->name); ?>"
                                            class="w-20 h-20 object-cover rounded-lg shadow">

                                        <div class="flex-1">
                                            <div class="font-medium text-gray-800"><?php echo e($cart->product->name); ?></div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                <?php echo e($cart->quantity); ?> x Rp
                                                <?php echo e(number_format($cart->product->price, 0, ',', '.')); ?>

                                            </div>
                                        </div>

                                        <div class="font-medium text-gray-800">
                                            Rp
                                            <?php echo e(number_format($cart->product->price * $cart->quantity, 0, ',', '.')); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="p-4 bg-gray-50">
                                    <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                                        <span>Subtotal</span>
                                        <span>Rp <?php echo e(number_format($total ?? 0, 0, ',', '.')); ?></span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm text-gray-600 mb-3">
                                        <span>Shipping</span>
                                        <span>Free</span>
                                    </div>
                                    <div class="h-px bg-gray-200 my-2"></div>
                                    <div class="flex justify-between items-center font-medium text-gray-800">
                                        <span>Total</span>
                                        <span class="text-lg">Rp <?php echo e(number_format($total ?? 0, 0, ',', '.')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <div class="flex justify-end">
                            <button type="submit" id="placeOrderBtn"
                                class="bg-gradient-to-r from-[#0f172a] to-[#334155] text-white px-8 py-3 rounded-lg 
                                       hover:opacity-90 transition-all duration-300 transform hover:scale-105
                                       inline-flex items-center space-x-2 shadow-lg"
                                onclick="submitForm(event)">
                                <span class="font-medium" id="buttonText">Place Order</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    id="buttonIcon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                                <svg class="hidden w-5 h-5 animate-spin" id="loadingIcon"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <input type="hidden" name="payment_token" id="paymentToken">
                        <input type="hidden" name="payment_type" id="paymentType">
                        <input type="hidden" name="transaction_id" id="transactionId">
                        <input type="hidden" name="transaction_status" id="transactionStatus">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo e(config('services.midtrans.client_key')); ?>"></script>
    <script>
        function submitForm(e) {
            e.preventDefault();

            const form = document.getElementById('checkoutForm');
            const button = document.getElementById('placeOrderBtn');
            const buttonText = document.getElementById('buttonText');
            const buttonIcon = document.getElementById('buttonIcon');
            const loadingIcon = document.getElementById('loadingIcon');

            // Check if address is selected
            const selectedAddress = form.querySelector('input[name="address_id"]:checked');
            if (!selectedAddress) {
                alert('Please select a shipping address');
                return;
            }

            // Disable button and show loading state
            button.disabled = true;
            buttonText.textContent = 'Processing...';
            buttonIcon.classList.add('hidden');
            loadingIcon.classList.remove('hidden');

            // Get Snap token and show payment popup
            snap.pay('<?php echo e($snapToken); ?>', {
                onSuccess: function(result) {
                    console.log('Payment success:', result);

                    // Set payment details to hidden inputs
                    document.getElementById('paymentToken').value = result.payment_token || '';
                    document.getElementById('paymentType').value = result.payment_type || '';
                    document.getElementById('transactionId').value = result.transaction_id || '';
                    document.getElementById('transactionStatus').value = result.transaction_status || '';

                    // Submit the form
                    form.submit();
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);

                    // Set payment details to hidden inputs
                    document.getElementById('paymentToken').value = result.payment_token || '';
                    document.getElementById('paymentType').value = result.payment_type || '';
                    document.getElementById('transactionId').value = result.transaction_id || '';
                    document.getElementById('transactionStatus').value = 'pending';

                    // Submit the form
                    form.submit();
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert('Payment failed! Please try again.');

                    // Reset button state
                    button.disabled = false;
                    buttonText.textContent = 'Place Order';
                    buttonIcon.classList.remove('hidden');
                    loadingIcon.classList.add('hidden');
                },
                onClose: function() {
                    console.log('Payment popup closed without finishing the payment');

                    // Reset button state
                    button.disabled = false;
                    buttonText.textContent = 'Place Order';
                    buttonIcon.classList.remove('hidden');
                    loadingIcon.classList.add('hidden');
                }
            });
        }
    </script>
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
<?php /**PATH C:\laragon\www\uas_pti\resources\views/customer/checkout/index.blade.php ENDPATH**/ ?>