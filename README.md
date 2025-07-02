# Secure Login & Registration Demo

**Author:** Sangam Pradhan  
**GitHub:** [https://github.com/SangamPradhan/SecureRegisterHTML](https://github.com/SangamPradhan/SecureRegisterHTML)

This project is a modern, secure login and registration system built with PHP, MySQL, HTML, CSS (Bootstrap), and JavaScript. It demonstrates best practices for user authentication, password security, and user experience.

## Features
- **User Registration**: Users can register with their first name, last name, email, and a strong password.
- **Password Strength Meter & Suggestions**: Real-time feedback and suggestions for creating strong passwords.
- **Password Visibility Toggle**: Users can show/hide their password while typing.
- **Google reCAPTCHA**: Prevents automated/bot registrations.
- **Email Uniqueness Check**: Prevents duplicate registrations with the same email.
- **Secure Password Hashing**: Passwords are hashed using PHP's `password_hash` before storing in the database.
- **User Login**: Secure login with session management.
- **Session Authentication**: Only logged-in users can access the dashboard.
- **Logout with Confirmation**: SweetAlert2 popup for logout confirmation.
- **Modern UI**: Responsive design using Bootstrap and custom CSS.
- **SweetAlert2 Popups**: For all important user feedback (success, error, confirmation).

## Project Structure
```
SecureLoginRegister/
├── bg-1.jpg
├── index.php
├── css/
│   └── style.css
├── front/
│   ├── login.html
│   └── register.html
├── js/
│   └── script.js
├── php/
│   ├── db_connection.php
│   ├── login.php
│   ├── logout.php
│   └── register.php
```

## How It Works
- **Registration**: Users fill out the registration form. Password strength and suggestions are shown as they type. The backend checks for email uniqueness and password validity, then stores the user securely.
- **Login**: Users log in with their email and password. On success, they are redirected to the dashboard. Sessions are used for authentication.
- **Logout**: Users can log out with a confirmation popup. Sessions are destroyed and users are redirected to the login page.

## Security Best Practices
- Passwords are never stored in plain text.
- SQL injection is prevented using prepared statements.
- reCAPTCHA is used to block bots.
- Sessions are used for authentication and access control.

## Requirements
- XAMPP or similar local server with PHP and MySQL
- Modern web browser

## Setup
1. Clone or download this repository to your XAMPP `htdocs` directory.
2. Create a MySQL database (e.g., `auth_system`) and a `users` table with appropriate fields.
3. Update `php/db_connection.php` with your database credentials if needed.
4. Start Apache and MySQL in XAMPP.
5. Open `http://localhost/SecureLoginRegister/front/register.html` to register a new user.
6. Open `http://localhost/SecureLoginRegister/front/login.html` to log in.

## License
This project is for educational/demo purposes. Feel free to use and modify it for your own learning or projects.

---
**Author:** Sangam Pradhan  
**GitHub:** [https://github.com/SangamPradhan/SecureRegisterHTML](https://github.com/SangamPradhan/SecureRegisterHTML)
