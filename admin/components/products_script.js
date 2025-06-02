const productListTable = document.querySelector('.product-list');

// Delete Product
const deleteIcon = productListTable.querySelectorAll('.delete-icon');
deleteIcon.forEach((icon)=>{
    icon.addEventListener('click', (e)=>{
        const tr = e.currentTarget.closest('tr');
        const prodId = tr.getAttribute('data-id');

        if(confirm('Are you sure you want to delete this product?')){
            fetch(`./components/delete_product.php`,{
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ prod_id: prodId })             
            })
            .then(res => res.text())
            .then(result => {
                if (result === 'success') {
                    tr.remove();
                } else {
                    alert('Delete failed: ' + result);  // Include the response in the alert
                }
            })
            .catch(error => {
                console.error('Error with fetch:', error);
            });
        }
        else{
            window.location.href = "admin.php";
        }
    })
});



// Edit Product: On clicking the row
const allRows = productListTable.querySelectorAll('tr');
const products = Array.from(allRows).slice(1);  // Skips the header row
products.forEach((tr) => {
    tr.addEventListener('click', (e) => {
        // Extract product data
        const prodId = tr.getAttribute('data-id');

        fetch(`./components/edit_product.php?prod_id=${prodId}`)
            .then(res => res.text())
            .then(result => {
                const productsPage = document.querySelector('.products-page');
                productsPage.innerHTML = result;
            })
            .catch(error => {
                console.error('Error fetching product form:', error);
            });
    });
});



// Add Products
const addIcon = document.querySelector('#add-icon');
addIcon.addEventListener('click', ()=>{
    window.location.href = "?page=add_product";
})