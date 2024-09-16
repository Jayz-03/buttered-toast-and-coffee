
document.addEventListener("DOMContentLoaded", function () {
    const cartItems = {};
    const cartItemsContainer = document.getElementById("cart-items");
    const totalAmountElement = document.getElementById("total-amount");

    function updateCart() {
        cartItemsContainer.innerHTML = "";
        let totalAmount = 0;

        for (let id in cartItems) {
            const item = cartItems[id];
            const itemTotal = item.price * item.quantity;
            totalAmount += itemTotal;

            const cartItem = document.createElement("div");
            cartItem.className = "order-item";
            cartItem.innerHTML = `
        <span>${item.name}</span>
        <input type="number" value="${item.quantity}" data-id="${id}" class="quantity-input">
        <span>₱${itemTotal.toFixed(2)}</span>
        <button class="remove-item" data-id="${id}">&times;</button>
    `;
            cartItemsContainer.appendChild(cartItem);
        }

        totalAmountElement.textContent = `₱${totalAmount.toFixed(2)}`;
    }

    function addToCart(event) {
        const button = event.target;
        const id = button.getAttribute("data-id");
        const name = button.getAttribute("data-name");
        const price = parseFloat(button.getAttribute("data-price"));

        if (cartItems[id]) {
            cartItems[id].quantity += 1;
        } else {
            cartItems[id] = { name: name, price: price, quantity: 1 };
        }

        updateCart();
    }

    function updateQuantity(event) {
        const input = event.target;
        const id = input.getAttribute("data-id");
        const newQuantity = parseInt(input.value);

        if (newQuantity > 0) {
            cartItems[id].quantity = newQuantity;
        } else {
            delete cartItems[id];
        }

        updateCart();
    }

    function removeFromCart(event) {
        const button = event.target;
        const id = button.getAttribute("data-id");

        delete cartItems[id];
        updateCart();
    }

    // Event listeners
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", addToCart);
    });

    cartItemsContainer.addEventListener("input", function (event) {
        if (event.target.classList.contains("quantity-input")) {
            updateQuantity(event);
        }
    });

    cartItemsContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-item")) {
            removeFromCart(event);
        }
    });
});