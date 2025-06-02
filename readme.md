<!-- E-Commerce Website: Party Supply Store -->



<!-- DATABASES -->
<!-- Product Database -->
- Product ID, Name, Photo, Description
- Price, Stock
- Date Created(Added): To know newly added products
- Categories (from categoris database)
- Ratings, Number of Ratings, Reviews, with customer ID (from Review Database)

<!-- Review Database -->
Product_Reviews: review_id, product_id, user_id, rating, review_text, review_date

<!-- Category Database -->
<!-- Not necessarily needed -->
-category id, category name
<!-- product catgeories -->
- product id, category id
- many to many
- Product name, categories in it
<!--  -->
- And some visualization(statistics) for categories

<!-- Orders -->
- Order ID
- Customer ID
- Products ID, Quantities Purchased for each product
- Order date
- Delivery Date, Delivery Status
- Payment Status, Payment Method

<!-- Users -->
- User ID, name, phone number, email, password(hashed)
- Ongoing Orders, Past Orders(And rating, reviews of it) (Get from Orders database)
- Cart List: cartID, [productID, price(from products table)], quantity

<!-- Cart List -->
