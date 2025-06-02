// Slider
document.querySelectorAll('.slider').forEach(slider => {
    const left = slider.querySelector('#left');
    const right = slider.querySelector('#right');
    const grid = slider.querySelector('.card-container');
    let cards = grid.querySelectorAll('.card');
    const size = 4; // Number of cards to display at a time
    let index = size - 1;

    function updateCardVisibility() {
        cards.forEach((card, i) => {
            if (i >= index - size + 1 && i <= index) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        // Hide/show arrows based on the index
        if (index === size - 1) {
            left.style.opacity = 0.3;
        } else {
            left.style.opacity = 1;
        }

        if (index === cards.length - 1) {
            right.style.opacity = 0.3;
        } else {
            right.style.opacity = 1;
        }
    }

    // Initial update
    updateCardVisibility();

    right.addEventListener('click', () => {
        console.log('Right Arrow clicked');
        if (index < cards.length - 1) {
            index++;
            updateCardVisibility();
        }
    });

    left.addEventListener('click', () => {
        console.log('Left Arrow clicked');
        if (index >= size) {
            index--;
            updateCardVisibility();
        }
    });
});



// Open Product Card
const cards = document.querySelectorAll('.card');
cards.forEach((card)=>{
    const prodId = card.getAttribute('data-id');
    const cardInfo = card.querySelector('.card-info');  
    cardInfo.addEventListener('click', () => {
        window.location.href = `./product_details.php?prodId=${prodId}`;
    })
    
})


// Add-to-cart
const addToCartList = document.querySelectorAll('.add-to-cart');
addToCartList.forEach((addToCart)=>{
    const prodId = addToCart.closest('.card').getAttribute('data-id');
    const userId = null;
    addToCart.addEventListener('click', ()=>{
        fetch('./addToCart.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                prodId: prodId,
                userId: userId
            })
        })
        .then(res => res.text())
        .then(result => {
            if(result === 'success'){
                alert('Product added to cart Successfully');
            }
            else{
                alert('Error: '.result);
            }
        })
    })
})
// See cart
const cartIcon = document.querySelector('#cart');
cartIcon.addEventListener('click', ()=>{
    const userId = 1;
    fetch('./cart.php',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.text())
    .then(result => {
        window.location.href = './cart.php';
    })
})