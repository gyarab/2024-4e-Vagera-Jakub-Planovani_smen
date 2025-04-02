<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a> 
  <a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" height="150" width="150" style="margin-right: 400" alt="Plus Logo"></a>
<a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Android_Studio_icon_%282023%29.svg/2048px-Android_Studio_icon_%282023%29.svg.png"  height="150" width="150" alt="Android Logo"></a>

</p>

<!--<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>-->

## O projektu

Maturitní ročníkový projekt 2024/2025. Projekt umožnuje vytvářet, plánovat, přihlašovat se a monitorovat pracovní směny ve webovém rozhranní ve frameworku Laravel a v Android operačním systému. 

## Instalace webového serveru

Webový server je uložen na větvy **master**. Instalace je možná přes příkaz:  
```git
git clone -b master https://github.com/gyarab/2024-4e-Vagera-Jakub-Planovani_smen.git
```
K přihlášení do systému je potřeba instalace MySQL databáze. Do databáze je zapotřebí zkopírovat strukturu projektu ze souboru `RP_database.sql`. V struktuře se nachází jeden účet s heslem Qwerty123 schopný přihlášení do systému. Dále je potřeba v Laravel frameworku nastavit přístupové parametry v souboru `.ENV`
```env

DB_CONNECTION=mysql
DB_HOST=myhost
DB_PORT=3306
DB_DATABASE=mydatabase
DB_USERNAME=myusername
DB_PASSWORD=mypassword

```
Ke spuštění serveru je nutno v bashi v adresáři `/RP` zadat příkaz: 
```bash
#Všeobecné spuštění
php artisan serve

#Pro konkrétní spuštění
php artisan serve --host=10.9.9.127 --port=8000
```

[Optional] Pro odesílání emailů v projektu je zapotřebí zadat parametry odkazující na službu, která je schopná odesílat emaily do souboru `.ENV` (K zasílání emailů jsem využívam službu [Mailtrap](https://mailtrap.io/), ale může zde být uvedena i jiná služba). Pro spuštění a odesíláních živých zpráv je zapotřebí do souboru`.ENV` vložit osobní přihlašovací parametry ke službě [Pusher](https://pusher.com/). 
```env
#Pro zasílaní emailů
MAIL_USERNAME=myusername
MAIL_PASSWORD=mypassword
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="example@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

#Pro pusher
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=pusherid
PUSHER_APP_KEY=publickey
PUSHER_APP_SECRET=secretkey
PUSHER_APP_CLUSTER=eu
PUSHER_SCHEME=https
PUSHER_PORT=443
PUSHER_APP_TLS=true
```
## Instace Android aplikace
Android aplikace je uložena v [zde](https://github.com/gyarab/2024-4e-Vagera-Jakub-Android-Aplikace) v repozitáři :  
```git
2024-4e-Vagera-Jakub-Android-Aplikace

```
Pro úspěšné přihlášení do aplikace je zapotřebí mít spuštený webového server a aby uživatel měl v databázi účet. Cesta k serveru se v aplikaci nastavuje v souboru `/connection/ConnectionFile.java`. K ověřování server používá nástroj Laravel Sanctum. Pokud server běží na adrese jiné něž localhost, je zapotřebí na serveru do souboru `/config/sanctum.php` nastavit tuto adresu.
```php
//sanctum.php

'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
  '%s%s',
  'localhost,localhost:3000,127.0.0.1,mojeadresa',
  env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
))),

```
[Optional] Pro spuštění a odesíláních živých zpráv v aplikaci je zapotřebí do souboru `/connection/PusherConnection.java` nastavit osobní klíč a cluster.



<!--<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a> 
  <a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" height="150" width="150" style="margin-right: 400" alt="Plus Logo"></a>
<a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Android_Studio_icon_%282023%29.svg/2048px-Android_Studio_icon_%282023%29.svg.png"  height="150" width="150" alt="Android Logo"></a>

</p>-->
