3. Trigger to Automate the Updates (Optional)
To ensure that your avg_rating and num_ratings are always up-to-date without needing to manually run the update query, you can create a trigger in MySQL. A trigger will automatically update the avg_rating and num_ratings whenever a review is added or deleted.

Here’s an example of how you can create an AFTER INSERT trigger that updates the products table after a new review is added:

DELIMITER $$
CREATE TRIGGER update_product_rating_after_insert
AFTER INSERT ON product_reviews
FOR EACH ROW
BEGIN
    UPDATE products
    SET 
        avg_rating = (SELECT AVG(rating) FROM product_reviews WHERE prod_id = NEW.prod_id),
        num_ratings = (SELECT COUNT(*) FROM product_reviews WHERE prod_id = NEW.prod_id)
    WHERE prod_id = NEW.prod_id;
END$$
DELIMITER ;


This trigger will automatically update the avg_rating and num_ratings whenever a new review is inserted into the product_reviews table.




You could also create AFTER UPDATE and AFTER DELETE triggers to handle modifications or deletions of reviews, ensuring that your product ratings are always up-to-date.

Example of an AFTER DELETE Trigger:

DELIMITER $$
CREATE TRIGGER update_product_rating_after_delete
AFTER DELETE ON product_reviews
FOR EACH ROW
BEGIN
    UPDATE products
    SET 
        avg_rating = (SELECT AVG(rating) FROM product_reviews WHERE prod_id = OLD.prod_id),
        num_ratings = (SELECT COUNT(*) FROM product_reviews WHERE prod_id = OLD.prod_id)
    WHERE prod_id = OLD.prod_id;
END$$
DELIMITER ;


This trigger will update the products table whenever a review is deleted, ensuring that the avg_rating and num_ratings remain correct.




shopping-website/
│
├── admin/
│   ├── index.php            # Admin dashboard
│   ├── login.php            # Admin login page
│   ├── products/
│   │   ├── add.php
│   │   ├── edit.php
│   │   └── list.php
│   ├── orders/
│   ├── users/
│   └── assets/              # Admin-specific CSS/JS/images