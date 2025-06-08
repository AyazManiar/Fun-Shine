# Funshine – Party Supplies E-commerce
 
**Tech Stack:** PHP, MySQL, JavaScript, HTML/CSS

## 🛍 Features
- Dynamic product showcase (Best Sellers, New Arrivals)
- Product detail pages
- Add to Cart
- Admin panel:
  - Add/Edit/Delete products & categories
- Category system (many-to-many)
- Ratings & Reviews (per user per product)

## 🗂 Database Schema
- `products`: prod_id, name, img, desc, price, stock, created_at, rating
- `categories`: category_id, name
- `product_categories`: many-to-many link
- `reviews`: user_id, prod_id, rating, text, date
- `users`: id, name, email, phone, password (hashed)
- `cart`: user_id, prod_id, quantity
- `orders`: order_id, customer_id, products, status, payment

## 📸 Screenshots
![image](https://github.com/user-attachments/assets/316a38bd-f976-415f-b0f6-28abba46f34d)
![image](https://github.com/user-attachments/assets/67e6b939-fdff-46ca-b938-eb19710e75c4)
![image](https://github.com/user-attachments/assets/00564ef9-3f69-4e17-a142-5808d0f07ddd)
![image](https://github.com/user-attachments/assets/c369cd13-b05e-4197-aad8-c659e76dd9c2)
![image](https://github.com/user-attachments/assets/3115b289-c64d-410e-b63b-34034ab9da40)


