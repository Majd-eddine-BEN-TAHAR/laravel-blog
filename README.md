# Laravel Blog Application

## Overview
This Laravel-based blog application offers a comprehensive platform for blogging, including features for managing posts, categories, user profiles, and admin functionalities. Designed with a focus on user experience and administrative efficiency, it utilizes Laravel's robust capabilities, enhanced with Bootstrap 5 for a responsive and intuitive interface.

## Features

- **User Authentication**: Utilizes Laravel's authentication system for secure user registration and login.
- **Profile Management**: Users can view and edit their profile information, including name and email.
- **Admin Dashboard**: A dedicated admin panel for managing blog posts, categories, and user accounts.
- **Post Creation and Management**: Admins can create, edit, and delete blog posts, with markdown support for content creation.
- **Category Management**: Allows for the creation, editing, and deletion of post categories.
- **User Management**: Admins can manage user accounts, including editing user information and deleting users.
- **Change Password Functionality**: Users can securely change their passwords.
- **Search Functionality**: Users can search for blog posts based on content.
- **Responsive Design**: Styled with Bootstrap 5 for a modern, responsive user interface.
- **Settings Page**: Admins can update site settings, including site title and favicon.
- **Pagination**: Implemented pagination for blog posts and categories.
- **Image Uploads**: Support for uploading and displaying featured images in blog posts.
- **Add Comments** : Users can interact with the blog by adding comments to posts.
- **Delete and Edit Comments** : Users have the ability to remove their own comments, giving them control over the content they contribute to the blog, they also can edit their comments after posting them.
- **Like posts** : Users can like posts.
- **About and Contact Pages**: Includes template pages for 'About Us' and 'Contact' with dummy content.

## Technologies Used

- **Laravel**: The application is built using Laravel, a robust PHP framework for web applications.
- **Bootstrap 5**: For front-end styling and responsive design.
- **MySQL**: Database management.
- **Markdown**: For blog post content creation and rendering.

## Getting Started

To get started with this project, clone the repository and install the necessary dependencies via Composer. Configure your `.env` file with your database and other environment settings.

```bash
git clone https://your-repository-url.git
cd laravel-blog
composer install
cp .env.example .env
php artisan key:generate
# Create a database laravel_blog
# Edit .env file with your database settings
php artisan storage:link
mkdir -p public/storage/posts
php artisan migrate
php artisan db:seed
npm install && npm run dev
php artisan serve
```

## Default User Accounts

After running the database seeders, you will have two default user accounts:
- **Admin Account :**

  Email: admin@example.com
  
  Password: majdmajd

- **Regular User Account :**

  Email: user@example.com
  
  Password: majdmajd

## License

This project is open-sourced under the MIT license.

## Contact

For any queries or suggestions, feel free to reach me  out at majdeddinebentahar@gmail.com
