# laravel-system-app
This is the app with System design ready for the fast deployement


This system is developed on laravel 5.5.

If you just starting with the new application, and seeing error, double check you already added .env file for the system, secondly also check you have generated the application key.

don't worry if you do not have .env file just copy .env.example to .env file

and to generate application key, run "php artisan key:generate"

Once you are done with it, run "composer update" to install the missing dependencies, if composer update shows error "permission denied", run it like "sudo composer update", in case of linux. please check sudo alternative for your operating system like windows or macOs

now run the application by typing in console "php artisan server" and visit the browser

you are all done to start developing your application
