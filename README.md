# Tasks List App
This is my Laravel project for managing tasks.

### Dependencies:

* PHP 8.3.3
* Laravel 10
* Composer 2.6.6

For my project I used `MySql` 8.0 version.

### Installation:

1. Clone the project.

2. Install composer packages:
```commandline
composer install
```
3. Rename `.env.example` into `.env` (or make copy and rename it). Set database connection.

4. Use command for making migrations:
```commandline
php artisan migrate
```
5. Run server:
```commandline
php artisan serve
```
6. Sing up and enjoy!

6.1. If you want to create fast a bunch of tasks for specific user, you can use Seeder for it. In `DatabaseSeeder.php` set user`s id number:

```
$user = User::find({ID}); // change {ID} on id number
\App\Models\Task::factory(7)->forUser($user->id)->create();
```

Then run terminal command:

```commandline
php artisan db:seed
```

## Features:

### User authentication system
* Register new user.
* Login and logout existing user.
* Unauthorized users can only register or login, another  functionality will be unavailable.

### Profile management
* Change Name and Email.
* Change password.
* Delete account.

### Tasks
* See your tasks list.
* Pagination.
* Create a task.
* See specific task.
* Mark task as completed (uncompleted).
* Edit task.
* Delete task.
* Add tags.
