const stripe = Stripe(window.stripePublicKey);
const elements = stripe.elements({
    locale: 'ru'
});

const card = elements.create('card');
card.mount('#card-element');

const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const {token, error} = await stripe.createToken(card);

    if (error) {
        document.getElementById('card-errors').textContent = error.message;
    } else {
        stripeTokenHandler(token);
    }
});

function stripeTokenHandler(token) {
    const form = document.getElementById('payment-form');
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
}
