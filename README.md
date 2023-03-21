# Troubadour Web

## Instalation
Required:
- Mysql
- Php and Laravel
- SoundFonts file

For help with installation of Php and Laravel 
[reference this link](https://www.hostinger.com/tutorials/how-to-install-laravel-on-ubuntu-18-04-with-apache-and-php/).

To install the required dependencies:

```composer install```

```npm install```

```npm run dev```

```apt install ffmpeg fluidsynth ```

Replace .env with .env.example and edit as needed.

Create mysql database with same name as in .env file.

Copy your downloaded SoundFonts file to /storage/fonts/ and name it Soundfont.sf2.

Generate Laravel app key:

```php artisan key:generate```

Create db tables:

```php artisan migrate:fresh```

Populate tables with data:

```php artisan db:seed```

To run the app:

``` php artisan serve```

## Mobile dev setup
Intial setup is the same as above.
Edit ```APP_URL``` in .env file to your local ip.
Allow your mobile device ip through the firewall.

If using wsl, go to powershell (with admin) and forward request to wsl url as such:

```netsh interface portproxy add v4tov4 listenport=8000 listenaddress=0.0.0.0 connectport=8000 connectaddress=wsl_ip ```

This will forawrd all connections on port 8000 from Windows to wsl.

Then run your php server with:

```php artisan serve --host 0.0.0.0 --port 8000```





