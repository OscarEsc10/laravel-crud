# Laravel User CRUD Application

A modern, responsive User CRUD (Create, Read, Update, Delete) application built with Laravel 12, PostgreSQL, and Tailwind CSS.

## 🚀 Features

- **Full CRUD Operations**: Create, read, update, and delete users
- **Modern UI**: Beautiful interface with Tailwind CSS
- **Enhanced Notifications**: SweetAlert2 for success/error messages and confirmations
- **Responsive Design**: Works seamlessly on desktop and mobile devices
- **Database Integration**: PostgreSQL with optimized schema
- **Soft Deletes**: Users are soft-deleted for data integrity
- **Validation**: Comprehensive form validation
- **Pagination**: Efficient data handling with paginated user lists
- **Custom Favicon**: Branded browser tab icon

## 📋 Requirements

- PHP ^8.2
- Composer
- Node.js & npm
- PostgreSQL
- Git

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/OscarEsc10/laravel-crud.git
   cd laravel-crud
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Edit your `.env` file with your PostgreSQL credentials:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=Crud-PHP
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Create the users table**
   
   If you need to create the table manually, run this SQL:
   ```sql
   CREATE TABLE users (
       uid BIGSERIAL PRIMARY KEY,
       username VARCHAR(100) NOT NULL,
       email VARCHAR(150) NOT NULL UNIQUE,
       password_hash VARCHAR(255) NOT NULL,
       role VARCHAR(50) NOT NULL DEFAULT 'user',
       is_active BOOLEAN NOT NULL DEFAULT TRUE,
       email_verified_at TIMESTAMP NULL,
       last_login_at TIMESTAMP NULL,
       created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       deleted_at TIMESTAMP NULL
   );
   
   CREATE INDEX idx_users_username ON users(username);
   CREATE INDEX idx_users_active ON users(is_active);
   ```

## 🚀 Running the Application

1. **Start the development server**
   ```bash
   php artisan serve
   ```

2. **Start the frontend assets**
   ```bash
   npm run dev
   ```

3. **Access the application**
   
   Open your browser and navigate to: `http://localhost:8000`

## 📁 Project Structure

```
laravel-crud/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── UserController.php      # Main CRUD controller
│   │   │   └── Web/
│   │   │       └── HomeController.php   # Home page controller
│   │   └── ...
│   └── Models/
│       └── User.php                    # User model
├── database/
│   └── migrations/
│       └── 0001_01_01_000000_create_users_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Main layout
│       └── users/
│           ├── index.blade.php         # User list
│           ├── create.blade.php        # Create user form
│           ├── edit.blade.php          # Edit user form
│           └── show.blade.php          # User details
├── public/
│   └── user-crud-php.png               # Favicon
└── routes/
    └── web.php                         # Application routes
```

## 🎯 Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | `home` | Home page (users list) |
| GET | `/users` | `users.index` | List all users |
| GET | `/users/create` | `users.create` | Show create user form |
| POST | `/users` | `users.store` | Store new user |
| GET | `/users/{id}` | `users.show` | Show user details |
| GET | `/users/{id}/edit` | `users.edit` | Show edit user form |
| PUT/PATCH | `/users/{id}` | `users.update` | Update user |
| DELETE | `/users/{id}` | `users.destroy` | Delete user (soft delete) |

## 📊 Database Schema

### Users Table

| Column | Type | Description |
|--------|------|-------------|
| `uid` | BIGSERIAL | Primary key |
| `username` | VARCHAR(100) | User's username |
| `email` | VARCHAR(150) | User's email (unique) |
| `password_hash` | VARCHAR(255) | Hashed password |
| `role` | VARCHAR(50) | User role (user/admin/moderator) |
| `is_active` | BOOLEAN | Account status |
| `email_verified_at` | TIMESTAMP | Email verification timestamp |
| `last_login_at` | TIMESTAMP | Last login timestamp |
| `created_at` | TIMESTAMP | Creation timestamp |
| `updated_at` | TIMESTAMP | Last update timestamp |
| `deleted_at` | TIMESTAMP | Soft delete timestamp |

## 🎨 UI Features

- **SweetAlert2**: Beautiful notifications and confirmations
- **Tailwind CSS**: Modern, utility-first CSS framework
- **Responsive Design**: Mobile-friendly interface
- **Custom Favicon**: Branded browser tab icon
- **Hover Effects**: Interactive UI elements
- **Form Validation**: Real-time validation feedback

## 🔧 Technologies Used

- **Backend**: Laravel 12, PHP 8.2+
- **Database**: PostgreSQL
- **Frontend**: Blade, Tailwind CSS, SweetAlert2
- **Build Tools**: Vite, npm
- **Version Control**: Git

## 📝 Validation Rules

### Create User
- `username`: Required, max 100 characters
- `email`: Required, valid email, unique
- `password_hash`: Required, min 6 characters
- `role`: Optional, must be one of: user, admin, moderator
- `is_active`: Optional, boolean

### Update User
- `username`: Sometimes required, max 100 characters
- `email`: Sometimes required, valid email, unique (except current user)
- `password_hash`: Sometimes required, min 6 characters
- `role`: Sometimes required, must be one of: user, admin, moderator
- `is_active`: Sometimes required, boolean

## 🚀 Deployment

1. **Configure production environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Install dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install --production
   npm run build
   ```

3. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👤 Author

**OscarEsc10**
- GitHub: [@OscarEsc10](https://github.com/OscarEsc10)
- Project: [Laravel CRUD](https://github.com/OscarEsc10/laravel-crud)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [SweetAlert2](https://sweetalert2.github.io) - Beautiful, responsive, customizable JavaScript popup boxes
- [PostgreSQL](https://www.postgresql.org) - The World's Most Advanced Open Source Relational Database