# SFMS (School Fees Management System)
SFMS was a simple project I did when I was learning to use Laravel's Filament package. I focused on the finance aspect of a school setup, defined the relevant objects, linked their relationships and eventually utilized the features of filament to actualize the project.

## Modules
- Fees Management.
- Students Management.
- School Administration.
- Role assignments using shield.

# How to install
 - Ensure you install a DBMS, preferably XAMPP/WAMPP (or a relevant php host). SQLite works as well.
 - Open a terminal (Linux) / CMD (windows). use `Ctrl` + `Alt` +`T`.
 - clone this repo: `git clone https://github.com/ObedNyakundi/schoolfeesmodule`
 - when cloning is done, `cd` into the project folder and run `composer install`.
 - create a `.env` file from file `env.example`.
 - create a new application key: `php artisan key:generate`
 - run xampp/wampp
 - make migrations: `php artisan migrate`
 - run server `php artisan serve`

### Enjoy the software.

# Gallery

![Dashboard Dark](./pictures/a.png)
