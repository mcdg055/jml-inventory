
Setup Environment
1. download laragon - https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe
1.1 install
2. download nodejs - https://nodejs.org/dist/v18.12.1/node-v18.12.1-x64.msi
2.1 install
3. download composer - https://getcomposer.org/Composer-Setup.exe
3.1 install

Clone the project
1. download github desktop -  https://central.github.com/deployments/desktop/desktop/latest/win32
2. install github desktop
3. Signin to github
4. clone the repository
5. change the clone directory into C:\laragon\www

Generate the Database
1. open Laragon
2. install phpmyadmin
    right click on the panel > tools > quick add

Run the project
1. Open project using the editor you prefer
2. Open terminal
3. run the following commands below
    cp env/env.text .env
    composer install
    php artisan key:generate
    php artisan migrate --seed
    php artisan storage:link
    npm install
    npm run dev
