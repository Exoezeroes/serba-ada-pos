<h1 align="center">SerbaAda PoS App</h1>
This app is created with Laravel10, InertiaJs, and Vue3 with TailwindCSS.

Feel free to inspect the code and/or make some modification for learning purposes.

Claiming this project as someone's else is not allowed, and using this app for commercial is **ILLEGAL**

## Installation
### Cloning Repository
```
git clone https://github.com/Exoezeroes/serba-ada-pos.git
cd serba-ada-pos
```
Feel free to add directory name if you wish so (not mandatory)
### Install Dependencies
```
composer install
npm install
```
### Config File
Rename or duplicate `.env.example` to `.env`
1. run `php artisan key:generate` to generate app key
2. set your database credentials in your `.env` file
3. add this to your `.env` file
```
SERVER_HOST=127.0.0.1
SERVER_PORT=80
```
### Setup Database
```
php artisan migrate --seed
```
This will initialize an admin user for you.
- mail: `admin@mail.com`
- pass: `password`
### Link Storage
```
php artisan storage:link
```
### Run Server
1. run `npm run dev` for development or `npm run build` for production
2. run `php artisan serve` to serve
3. visit `localhost` in your browser
<hr>
Shout out to https://github.com/justboil/admin-one-vue-tailwind
