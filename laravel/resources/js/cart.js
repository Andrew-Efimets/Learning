document.addEventListener('click', async function(e) {
    if (e.target.classList.contains('add-to-cart')) {
        const productId = e.target.dataset.id;
        const button = e.target;

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

                button.textContent = 'В корзине ✓';
                button.style.backgroundColor = '#5b6559';
            }
        } catch (error) {
            console.error('Ошибка:', error);
        } finally {
            button.disabled = false;
        }
    }
});
