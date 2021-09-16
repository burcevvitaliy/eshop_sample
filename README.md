# deploy project
- git clone https://github.com/burcevvitaliy/eshop_sample.git
- composer install
- cp .env.example .env
- ./vendor/bin/sail build
- ./vendor/bin/sail up -d
- ./vendor/bin/sail php artisan migrate --seed
- open http://localhost/ 
- click Electronics and then Phones

**Eshop include:categories, subcategories, list of products, shopping cart and order**.
**Project was maked as a test sample**
