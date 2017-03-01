# blog
A blog with both admin panel where admin have different roles and can perform different tasks according to their roles. Developed in Laravel 5.3

## How to use for the first time?
- Clone the repo or download it as zip file and extract it.
- Open command prompt or terminal and go to the projects directory.
- Type "php artisan migrate --seed" without double quotes.
- Now you are ready.
- Go to browser and enter the url of this project. It will depend on where you have kept this project folder. E.g. If you have cloned this repo/project in the htdocs folder(in case if you are using XAMPP) then type "localhost/blog" and done.
- The client side UI is not good. 
- To go to admin side type "localhost/blog/admin" without quotes.
- There are three users created by default, they are Ashish, Anita and Kedar.
 -- Ashish [email: ashish@gmail.com, password: ashish, role: core]
 -- Anita [email: anitah@gmail.com, password: anita, role: main]
 -- Kedar [email: kedar@gmail.com, password: kedar, role: editor]
- The core user has access to everything. Give core role to developers.
- The main user has access to everything except some core features like: they cannot change default static navigation in admin side.
- The user with editor cannot assign roles to users. They can do all the things with article published.
- There is also a user with role normal who cannot access admin side. You can assign such roles to your website subscribers.
