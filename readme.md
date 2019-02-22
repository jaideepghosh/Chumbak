# Chumbak

A sample application which crawls the categories and products from chumbak APIs, and Stores them in mysql database. This Application is Developed on laravel, and offers CRUD operations on the saved data.

### Required steps to test the application:
1. Clone the repository. (`git clone git@github.com:jaideepghosh/Chumbak.git`)
2. Copy `.env.example` to `.env`, and Update database credentials.
3. Execute `composer install` in application root.
4. Generate key using `php artisan key:generate`
5. Execute `php artisan crawl:categories` for crawling the categories. After its completion, execute `php artisan crawl:products` for crawling products.
6. Now access the application in browser. (`http://localhost/public`)