
## Setup Environment

- [Download laragon](https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe)
- [Download nodejs](https://nodejs.org/dist/v18.12.1/node-v18.12.1-x64.msi)
- [Download composer](https://getcomposer.org/Composer-Setup.exe)
- [Download Github Desktop](https://central.github.com/deployments/desktop/desktop/latest/win32)
- Install all download programs
## Clone the Repository

- Install github desktop (skip if already installed)
- Signin to github
- Clone the repository
- Change the clone directory into C:\laragon\www

## Generate the Database

- Open Laragon
- Install phpmyadmin right click on the panel > tools > quick add

## Running the project

- Open project using the editor you prefer
- Open terminal
- Run the following commands below 

```bash
cp env/env.text .env 
composer install 
php artisan key:generate 
php artisan app:demo
php artisan storage:link 
npm install && npm run dev
```