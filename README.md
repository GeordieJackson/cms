## CMS

This is a basic content management system that's used primarily to try out new programming ideas, techniques and to test new Laravel features. Although it's mainly used for this purpose, it does work!

## Install

Clone the repo: ```git clone git@github.com:GeordieJackson/cms.git```

create a database

copy the .env.example file to .env and enter your database credentials into it

Open a terminal in the main folder and run: ```php artisan key:generate```

then ```composer install``` NOTE: Ignore error message about Plesk if it shows up (!)

then ```npm install```

then ```npm run dev```

run ```php artisan migrate:fresh --seed```

The website should be available 

You can log in using username: ```admin@cms.test```and password: ```password```

Create some categories, temporal sections (blog, latest news, etc.) and then create some posts. The menus for the front should be built automatically and only display when content is placed in them.

Users can be assigned roles and roles assigned permissions.

### Tests

The site was built using the TDD approach. Tests can be run in the terminal with: ```vendor/bin/phpunit```

