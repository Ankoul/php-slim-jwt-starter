# Created From Slim Framework 3 Skeleton Application

Use this application to quickly setup and start working on a new Slim Framework 3 application. This application uses:
* [Slim Framework 3](https://www.slimframework.com/ ) to create REST API
* [Monolog logger](https://github.com/Seldaek/monolog ) to log
* [Slim Basic Auth](https://github.com/tuupola/slim-basic-auth ) to retrieve Auth Token
* [Slim JWT Auth](https://github.com/tuupola/slim-jwt-auth/ ) to authenticate on API
* [Firebase PHP-JWT](https://github.com/firebase/php-jwt ) to generate tokens

## Install the Application

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.
* Use `config/dev.config.ini` as model to create `config/config.ini`. 

To first installation, you can run these commands 

    git clone https://github.com/Ankoul/php-slim-jwt-starter.git [my-app-name]
	cd [my-app-name]
	php composer.phar install
	
To run the application in development, you can run these commands 

	php composer.phar start

Run this command in the application directory to run the test suite

	php composer.phar test

That's it! Now go build something cool.
