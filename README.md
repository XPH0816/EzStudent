# EzStudent
## Prerequisite
- A Stripe account (It's ok to use Developer Account for Testing)
- A SMTP Mail Server or used your own gmail account [How to Setup using Gmail](https://laracoding.com/how-to-send-email-with-laravel-using-gmail/) follow Step 1 only to get the APP Password 
- A Google Recaptcha v3 Site Key and Secret Key [How to Setup](https://www.google.com/recaptcha/about/)
- Laravel [Herd](https://herd.laravel.com/) with Composer (PHP) and  Node.js (npm) are installed 

## How to setup
1. Open your Laravel Herd and check your herd path unzip the folder and put on that path
![image](https://github.com/XPH0816/FashionStoreSystem/assets/50739818/a69f93ac-6753-48db-8e5c-510b0f684ee2)
2. Install the Dependencies
```bash
herd composer install 
```
3. Setup the enviroment 
```bash
herd composer run-script post-root-package-install
herd composer run-script post-create-project-cmd
```
4. Add your enviroment variables inside the your .env files
```bash
STRIPE_KEY="pk_xxxx_xxxxx"
STRIPE_SECRET="sk_xxxx_xxxxxx"

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="your-email-address"
MAIL_PASSWORD="your-app-passowrd-get-from-the-prerequiesite"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email-address"
MAIL_FROM_NAME="${APP_NAME}"

RECAPTCHAV3_SITEKEY="your-site-key"
RECAPTCHAV3_SECRET="your-secret-key"
```
5. Create The Database call fashionstoresystem on your database server

6. Run Migrations with seed 🌱
```bash
herd php artisan migrate:refresh --seed
```

7. Click on this Icon Button to have a SSL with automated trust and sign cert (this features used for HTTPS)
![image](https://github.com/XPH0816/FashionStoreSystem/assets/50739818/ce6567d8-3051-48d1-9c52-3f5e11f96ed5)

8. Enjoy your system
