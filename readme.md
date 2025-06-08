# Funshine – Party Supplies E-commerce

**Live Demo:** _coming soon_  
**Tech Stack:** PHP, MySQL, JavaScript, HTML/CSS

## 🛍 Features
- Dynamic product showcase (Best Sellers, New Arrivals)
- Product detail pages
- Add to Cart (no checkout yet)
- Admin panel:
  - Add/Edit/Delete products & categories
  - Visual stats (optional future)
- Category system (many-to-many)
- Ratings & Reviews (per user per product)

## 🗂 Database Schema
- `products`: prod_id, name, img, desc, price, stock, created_at, rating, ...
- `categories`: category_id, name
- `product_categories`: many-to-many link
- `reviews`: user_id, prod_id, rating, text, date
- `users`: id, name, email, phone, password (hashed)
- `cart`: user_id, prod_id, quantity
- `orders`: order_id, customer_id, products, status, payment

## 🚀 Setup
1. Clone repo
2. Import SQL file into MySQL
3. Configure `/config/db_connect.php`
4. Run server (`php -S localhost:8000`)

## 📈 To-Do
- [ ] Implement login system
- [ ] Improve cart logic per user
- [ ] Create checkout (dummy) flow
- [ ] Add filtering, search, and product tags
- [ ] Add charts for admin insights

---

Let me know if you want help with:
- Admin dashboard charts
- Login/auth system
- Better cart UI
- Product filters
- Full DB design diagram (ERD)

Want me to help build any of these next features?
