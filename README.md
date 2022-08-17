## CMS

This is a basic content management system that's used primarily to try out new programming ideas, techniques and to test new Laravel features. Although it's mainly used for this purpose, it does work!

## Install

Clone the repo: ```git clone git@github.com:GeordieJackson/cms.git```

create a database

copy the .env.example file to .env and enter your database credentials into it

Open a terminal in the main folder and run: ```composer install```

Then run ```npm install```
then ```npm run dev```

run ```php artisan migrate:fresh --seed```

The website should be available 

You can log in using username: ```admin@cms.test```and password: ```password```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
