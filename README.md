# Project and Task Management API

This Laravel project provides a RESTful API for managing projects and tasks. It demonstrates a one-to-many relationship between projects and tasks, with full CRUD operations for both resources.

## Requirements
- PHP 8.0+
- Composer
- MySQL or compatible database

## Steps to run the project

1. Clone the project from repo and run composer install
```bash
git clone https://github.com/dhaneshnarvekar/tti-laravel.git
cd tti-laravel
composer install
```
2. Create a MySql database with user to access it
3. Copy the .env.example file and rename it to .env
4. Update the .env file with database username, host, port and password
5. Run the following commands
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
6. View the API documentation 
7. Run unit tests using following command
```bash
php artisan test
```

## API Documentation

### Projects
- GET /api/projects: List all projects
- POST /api/projects: Create a new project
- GET /api/projects/{id}: Get a specific project
- PUT /api/projects/{id}: Update a project
- DELETE /api/projects/{id}: Delete a project
- GET /api/projects/{id}/tasks: Get all tasks of a specific project
- POST /api/projects/{id}/tasks: Create a new task under a specific project

### Tasks
- GET /api/tasks: List all tasks
- POST /api/tasks: Create a new task
- GET /api/tasks/{id}: Get a specific task
- PUT /api/tasks/{id}: Update a task
- DELETE /api/tasks/{id}: Delete a task

## License

[MIT](https://choosealicense.com/licenses/mit/)