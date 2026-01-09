document.addEventListener('click', async function(e) {
    if (e.target.classList.contains('add-to-cart')) {
        const button = e.target;
        const productId = button.dataset.id;

        button.disabled = true;
        button.textContent = 'Добавляем...';

        try {
            const response = await fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();

                const cartCountEl = document.getElementById('cart-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.cart_count;
                }

                const totalEl = document.querySelector('.total-price');
                if (totalEl) {
                    totalEl.textContent = `Итого: ${data.total_price} р.`;
                }

                button.textContent = 'В корзине ✓';
                button.style.backgroundColor = '#5b6559';
                button.classList.remove('add-to-cart');
                button.classList.add('in-cart');
            } else {
                button.disabled = false;
                button.textContent = 'Ошибка';
            }
        } catch (error) {
            console.error('Ошибка:', error);
            button.disabled = false;
        }
    }
});

document.addEventListener('click', async function(e) {
    if (e.target.classList.contains('remove-from-cart')) {
        const productId = e.target.dataset.id;
        const button = e.target;
        const cartItem = button.closest('.cart-item');

        button.disabled = true;

        try {
            const response = await fetch(`/cart/remove/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();

                cartItem.remove();

                const cartCountEl = document.getElementById('cart-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.cart_count;
                }

                const totalEl = document.querySelector('.total-price');
                if (totalEl) {
                    totalEl.textContent = `Итого: ${data.total_price} р.`;
                }

                if (data.cart_count === 0) {
                    location.reload();
                }
            }
        } catch (error) {
            console.error('Ошибка удаления:', error);
            button.disabled = false;
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('toggle-orders');
    const content = document.getElementById('orders-content');
    const arrow = header?.querySelector('.arrow');

    if (header) {
        header.addEventListener('click', function() {

            if (content.style.display === "none") {
                content.style.display = "block";
                arrow.textContent = "▲";
            } else {
                content.style.display = "none";
                arrow.textContent = "▼";
            }
        });
    }
});
