document.addEventListener("DOMContentLoaded", function () {
    function loadProducts(categoryName) {
        const productList = document.getElementById('product-list');
        productList.innerHTML = '';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get-products.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                productList.innerHTML = xhr.responseText;
                attachAddToCartEvents();
            } else {
                console.error('Error loading products');
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
        };
        xhr.send("category_name=" + encodeURIComponent(categoryName));
    }

    function attachAddToCartEvents() {
        document.querySelectorAll('.btn-add-cart').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const productName = this.getAttribute('data-name');
                const productPrice = parseFloat(this.getAttribute('data-price'));
                addToCart(productId, productName, productPrice);
            });
        });
    }

    const customerPayInput = document.getElementById('customer-pay');
    const changeAmountDisplay = document.getElementById('change-amount');

    customerPayInput.addEventListener('input', function () {
        const totalAmount = parseFloat(document.getElementById('total-amount').textContent.replace('₱', ''));
        const customerPay = parseFloat(this.value);

        if (!isNaN(customerPay) && customerPay >= 0) {
            const change = customerPay - totalAmount;
            changeAmountDisplay.textContent = `₱${(change >= 0 ? change.toFixed(2) : '0.00')}`;
        } else {
            changeAmountDisplay.textContent = '₱0.00';
        }
    });

    let cart = {};

    function addToCart(productId, productName, productPrice) {
        if (cart[productId]) {
            cart[productId].quantity++;
        } else {
            cart[productId] = {
                name: productName,
                price: productPrice,
                quantity: 1
            };
        }
        updateCartUI();
    }

    function updateCartUI() {
        const cartTable = document.getElementById('cart-items');
        cartTable.innerHTML = '';
        let totalAmount = 0;

        Object.keys(cart).forEach(productId => {
            const product = cart[productId];
            totalAmount += product.price * product.quantity;

            cartTable.innerHTML += `
            <tr class="text-center">
                <td>${product.name}</td>
                <td>
                    <button class="btn btn-sm btn-dark btn-minus" data-id="${productId}">-</button>
                    <span class="ml-2 mr-2"> ${product.quantity} </span>
                    <button class="btn btn-sm btn-dark btn-plus" data-id="${productId}">+</button>
                </td>
                <td>₱${(product.price * product.quantity).toFixed(2)}</td>
                <td><button class="btn btn-sm btn-danger btn-delete" data-id="${productId}">Delete</button></td>
            </tr>
        `;
        });

        document.getElementById('total-amount').textContent = `₱${totalAmount.toFixed(2)}`;
        attachCartEvents();
    }

    function attachCartEvents() {
        document.querySelectorAll('.btn-minus').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                if (cart[productId].quantity > 1) {
                    cart[productId].quantity--;
                } else {
                    delete cart[productId];
                }
                updateCartUI();
            });
        });

        document.querySelectorAll('.btn-plus').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                cart[productId].quantity++;
                updateCartUI();
            });
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                delete cart[productId];
                updateCartUI();
            });
        });
    }

    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function () {
            const categoryName = this.getAttribute('data-category');
            loadProducts(categoryName);
        });
    });

    const firstCategoryTab = document.querySelector('.nav-link');
    if (firstCategoryTab) {
        loadProducts(firstCategoryTab.getAttribute('data-category'));
    }

    document.querySelector('.btn-confirm').addEventListener('click', function () {
        const paymentMethod = document.getElementById('payment-method').value;
        const totalAmount = parseFloat(document.getElementById('total-amount').textContent.replace('₱', ''));
        const customerPay = parseFloat(document.getElementById('customer-pay').value);
        const change = customerPay - totalAmount;

        if (totalAmount > 0 && customerPay >= totalAmount) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "save-order.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Order confirmed!');
                    cart = {};
                    updateCartUI();
                }
            };
            xhr.send(JSON.stringify({
                cart: cart,
                payment_method: paymentMethod,
                total_amount: totalAmount,
                customer_pay: customerPay,
                change: change
            }));
        } else {
            alert('Please ensure total amount is covered by customer payment.');
        }
    });
});