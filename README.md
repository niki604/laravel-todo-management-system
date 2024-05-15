## Introduction

This Laravel application is designed to manage todos within an organization. It provides a platform where administrators can create, assign, and track todos, while employees can view, update, and complete assigned tasks.

## Features

**System Users:** The system supports two types of users: Administrator and Employees.

**Authentication:** Users can log in using their respective credentials.

**Administrator Seeders:** Seeders are provided to initialize the system with default administrators.

**Employee Invitation:** Administrators can invite employees via email.

**Create Password:** Employees can join the system by clicking on the invitation link and setting their password.

**Todo Management:** Administrators can create todos with statuses such as Open, In Progress, and Completed.

**Todo Assignment:** Administrators can assign todos to their employees.

**Notification System:** Employees receive notifications whenever a new todo is assigned to them.

**Todo Status Update:** Employees can change the status of todos assigned to them.

**Todo Editing and Deletion:** Administrators can edit or delete todos as needed.

**Logout:** Users can safely log out of their accounts.

## Installation

1. Clone the repository:
   git clone https://github.com/your-repository.git

2. Install dependencies:
   composer install
   npm install

3. Set up environment variables:
   cp .env.example .env
   Configure your database connection and mail settings in the .env file.

4. Generate application key:
   php artisan key:generate

5. Migrate the database:
   php artisan migrate

6. Seed the database seeder:
   php artisan db:seed --class=DatabaseSeeder

7. Serve the application:
   php artisan serve
   npm run dev

## Author

Nikita Wasnik
