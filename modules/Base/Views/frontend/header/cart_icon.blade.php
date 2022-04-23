<div class="position-relative">
    <a href="{{ route('get.cart.cartBox') }}" id="cart-icon" class="cart-icon">
        <img class="user-icon" src="{{ asset('storage/upload/Home/shopping_bag.svg') }}" alt="Icon bag">
        <div class="quantity text-white quantity-cart-icon" id="quantity-cart-icon">
            @php($cart = request()->session()->get('cart'))
            {{ $cart['quantity'] ?? 0 }}
        </div>
    </a>
</div>
