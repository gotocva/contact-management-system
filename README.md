# Contact Management System

This repository contains a user registration, login, and contact management system built with PHP, MySQL, and styled with Tailwind CSS. The application allows users to register, log in, and manage their contacts through a user-friendly interface.

## Features

- User registration and login
- Add, edit, and delete contacts
- Responsive design using Tailwind CSS
- Secure password hashing
- Simple and clean user interface

## Requirements

- PHP 7.0 or higher
- MySQL
- Web server (e.g., XAMPP, MAMP, or any other)
- Basic knowledge of PHP and SQL

## Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/gotocva/contact-management-system.git
cd contact-management-system
```

### 2. Set Up the Database

1. Create a database named `contact_management`.
2. Run the following SQL queries to create the necessary tables:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(15),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 3. Configure Database Connection

Open `includes/db.php` and update the database connection settings:

```php
$host = 'localhost';
$db = 'contact_management';
$user = 'your_username'; // Update with your database username
$pass = 'your_password'; // Update with your database password
```

### 4. Run the Application

- Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
- Access the application in your web browser at `http://localhost/contact-management-system/register.php`.

## Screenshots

*(Will Add screenshots of the registration, login, and contact management interfaces here)*

## Contributing

If you'd like to contribute to this project, feel free to open an issue or submit a pull request. Any contributions are welcome!

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Acknowledgments

- Tailwind CSS for the beautiful styling
- PHP and MySQL for the backend functionality

## Contact

For any questions or feedback, feel free to reach out at [gotocva@gmail.com].