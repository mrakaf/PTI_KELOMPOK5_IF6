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
            <h2 class="text-2xl font-bold mb-6 px-4 sm:px-0">Shopping Cart</h2>

            <?php if($carts->count() > 0): ?>
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Cart Items -->
                    <div class="lg:w-2/3">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-6 space-y-6">
                                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="flex flex-col sm:flex-row items-start sm:items-center gap-4 pb-6 border-b">
                                        <!-- Product Image -->
                                        <img src="<?php echo e(Storage::url($cart->product->image)); ?>"
                                            alt="<?php echo e($cart->product->name); ?>" class="w-24 h-24 object-cover rounded-lg"
                                            onerror="this.src='<?php echo e(asset('images/placeholder.jpg')); ?>'">

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900 text-lg"><?php echo e($cart->product->name); ?>

                                            </h3>
                                            <p class="text-gray-500 text-sm mt-1">SKU: <?php echo e($cart->product->id); ?></p>
                                            <div class="mt-2 text-gray-900 font-medium">
                                                Rp <?php echo e(number_format($cart->product->price, 0, ',', '.')); ?>

                                            </div>
                                        </div>

                                        <!-- Quantity Control -->
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center border rounded-lg">
                                                <button onclick="updateQuantity(<?php echo e($cart->id); ?>, -1)"
                                                    class="px-3 py-1 hover:bg-gray-100">
                                                    -
                                                </button>
                                                <input type="number" value="<?php echo e($cart->quantity); ?>" min="1"
                                                    class="w-16 p-1 text-center border-x"
                                                    data-cart-id="<?php echo e($cart->id); ?>"
                                                    onchange="updateQuantity(<?php echo e($cart->id); ?>, this.value)">
                                                <button onclick="updateQuantity(<?php echo e($cart->id); ?>, 1)"
                                                    class="px-3 py-1 hover:bg-gray-100">
                                                    +
                                                </button>
                                            </div>

                                            <button onclick="removeFromCart(<?php echo e($cart->id); ?>)"
                                                class="text-red-500 hover:text-red-700 p-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>

                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600"
                                                data-cart-id="<?php echo e($cart->id); ?>"
                                                data-price="<?php echo e($cart->product->price); ?>"
                                                data-quantity="<?php echo e($cart->quantity); ?>"
                                                <?php echo e($cart->selected ? 'checked' : ''); ?>

                                                onchange="toggleSelection(<?php echo e($cart->id); ?>, this)">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:w-1/3">
                        <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>

                            <!-- Selected Items Count -->
                            <div class="mb-4">
                                <span id="selectedItemCount" class="text-sm text-gray-600">
                                    Selected <?php echo e($carts->where('selected', true)->count()); ?>

                                    <?php echo e($carts->where('selected', true)->count() === 1 ? 'item' : 'items'); ?>

                                </span>
                            </div>

                            <!-- Subtotal -->
                            <div class="flex justify-between py-2 text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span id="subtotalAmount">
                                    Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                                </span>
                            </div>

                            <!-- Shipping -->
                            <div class="flex justify-between py-2 text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-gray-800">Free</span>
                            </div>

                            <!-- Total -->
                            <div class="flex justify-between items-center pt-4 border-t mt-4">
                                <span class="text-base font-medium text-gray-900">Total</span>
                                <span id="totalAmount" class="text-lg font-bold text-gray-900">
                                    Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                                </span>
                            </div>

                            <!-- Checkout Button -->
                            <button onclick="proceedToCheckout()"
                                class="w-full mt-6 bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                                Proceed to Checkout
                            </button>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-4 text-xs text-gray-500 space-y-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span>Secure checkout</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Money-back guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                        <p class="mt-1 text-sm text-gray-500">Start adding some items to your cart!</p>
                        <div class="mt-6">
                            <a href="<?php echo e(route('customer.index')); ?>"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-[#0f172a] to-[#334155] hover:opacity-90">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            function updateQuantity(cartId, change) {
                const input = document.querySelector(`input[data-cart-id="${cartId}"]`);
                let newQuantity;

                if (typeof change === 'number') {
                    // Jika menggunakan tombol + atau -
                    newQuantity = parseInt(input.value) + change;
                } else {
                    // Jika input langsung dari field
                    newQuantity = parseInt(change);
                }

                // Validasi minimum quantity
                if (newQuantity < 1) {
                    newQuantity = 1;
                    input.value = 1;
                    return;
                }

                // Debug
                console.log('Updating cart:', cartId, 'to quantity:', newQuantity);

                fetch(`/customer/cart/update/${cartId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            quantity: newQuantity
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Update quantity di input
                            input.value = newQuantity;

                            // Update subtotal dan total
                            const subtotalElement = document.querySelector('[data-subtotal]');
                            const totalElement = document.querySelector('[data-total]');

                            if (subtotalElement && totalElement) {
                                const formattedTotal = new Intl.NumberFormat('id-ID').format(data.cartTotal);
                                subtotalElement.textContent = `Rp ${formattedTotal}`;
                                totalElement.textContent = `Rp ${formattedTotal}`;
                            }

                            // Update cart counter di navbar
                            const cartCounter = document.querySelector('.cart-counter');
                            if (cartCounter) {
                                cartCounter.textContent = data.cartCount;
                            }

                            // Success notification
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: 'Cart quantity updated successfully',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to update cart quantity',
                            confirmButtonColor: '#4F46E5'
                        });
                    });
            }

            function removeFromCart(cartId) {
                // Debug
                console.log('Removing cart item:', cartId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This item will be removed from your cart",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/customer/cart/remove/${cartId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    // Remove the cart item element
                                    const cartItem = document.querySelector(`input[data-cart-id="${cartId}"]`)
                                        .closest('.flex.flex-col.sm\\:flex-row');
                                    cartItem.remove();

                                    // Update subtotal dan total
                                    const subtotalElement = document.querySelector('[data-subtotal]');
                                    const totalElement = document.querySelector('[data-total]');

                                    if (subtotalElement && totalElement) {
                                        const formattedTotal = new Intl.NumberFormat('id-ID').format(data
                                        .cartTotal);
                                        subtotalElement.textContent = `Rp ${formattedTotal}`;
                                        totalElement.textContent = `Rp ${formattedTotal}`;
                                    }

                                    // Update cart counter
                                    const cartCounter = document.querySelector('.cart-counter');
                                    if (cartCounter) {
                                        cartCounter.textContent = data.cartCount;
                                    }

                                    // If cart is empty, reload page
                                    if (data.cartCount === 0) {
                                        window.location.reload();
                                        return;
                                    }

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Removed!',
                                        text: 'Item has been removed from cart',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Failed to remove item from cart',
                                    confirmButtonColor: '#4F46E5'
                                });
                            });
                    }
                });
            }

            function proceedToCheckout() {
                const selectedItems = document.querySelectorAll('input[type="checkbox"]:checked').length;

                if (selectedItems === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Items Selected',
                        text: 'Please select at least one item to checkout',
                        confirmButtonColor: '#4F46E5'
                    });
                    return;
                }

                window.location.href = '<?php echo e(route('customer.checkout')); ?>';
            }

            function toggleSelection(cartId, checkbox) {
                const isChecked = checkbox.checked;

                // Tambahkan log untuk debugging
                console.log('Toggling selection for cart ID:', cartId);

                fetch(`/customer/cart/toggle/${cartId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        // Log response
                        console.log('Raw response:', response);
                        return response.json();
                    })
                    .then(data => {
                        // Log data yang diterima
                        console.log('Received data:', data);

                        if (data.success) {
                            // Format currency
                            const formattedTotal = new Intl.NumberFormat('id-ID').format(data.selectedTotal);
                            console.log('Formatted total:', formattedTotal);

                            // Update subtotal dan total
                            const subtotalElement = document.getElementById('subtotalAmount');
                            const totalElement = document.getElementById('totalAmount');
                            const countElement = document.getElementById('selectedItemCount');

                            console.log('Elements:', {
                                subtotal: subtotalElement,
                                total: totalElement,
                                count: countElement
                            });

                            if (subtotalElement) subtotalElement.textContent = `Rp ${formattedTotal}`;
                            if (totalElement) totalElement.textContent = `Rp ${formattedTotal}`;

                            // Update selected items count
                            const itemText = data.selectedCount === 1 ? 'item' : 'items';
                            if (countElement) {
                                countElement.textContent = `Selected ${data.selectedCount} ${itemText}`;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        checkbox.checked = !isChecked;

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to update selection',
                            confirmButtonColor: '#4F46E5'
                        });
                    });
            }
        </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\laragon\www\uas_pti\resources\views/customer/cart/index.blade.php ENDPATH**/ ?>