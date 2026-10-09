# PHP CRUD Web Application (Dockerized)

A full-stack CRUD (Create, Read, Update, Delete) web application built with **PHP 8.2**, **MySQL 8.0**, and **Bootstrap 5**, fully containerized using **Docker** and **Docker Compose**. It also includes **phpMyAdmin** for database administration.

---

## 🚀 Features

- **Create**: Add new users with first name, last name, email, and gender.
- **Read**: Display all user records in a clean, responsive table with timestamps.
- **Update**: Edit and update existing user details.
- **Delete**: Remove user records with safety confirmations.
- **Dockerized Environment**: Ready-to-run setup with Apache, PHP, and MySQL container configuration.
- **Auto DB Initialization**: Automatically creates database and tables upon first boot.
- **phpMyAdmin Integration**: Built-in GUI database manager.

---

## 🛠️ Tech Stack

- **Backend**: PHP 8.2 (Apache)
- **Frontend**: HTML5, CSS3, Bootstrap 5.3.3, Font Awesome 6.5.1
- **Database**: MySQL 8.0
- **Database GUI**: phpMyAdmin
- **DevOps**: Docker, Docker Compose

---

## 📂 Project Structure

```text
crud-wed-project/
├── Dockerfile              # Docker image definition for PHP 8.2 + Apache + mysqli
├── docker-compose.yml      # Multi-container setup (web, db, phpmyadmin)
├── README.md               # Project documentation
├── .gitignore              # Files to ignore in Git
├── mysql-init/
│   └── init.sql            # Initial database schema and table setup
├── src/                    # Source files
└── www/                    # Web root directory (PHP Application)
    ├── add_new.php         # User registration form & insert logic
    ├── db_conn.php         # Database connection script
    ├── delete.php          # Delete confirmation & action logic
    ├── edit.php            # Edit form & update logic
    └── index.php           # User list dashboard
```

---

## ⚙️ Prerequisites

Make sure you have installed on your machine:
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (includes Docker Compose)
- [Git](https://git-scm.com/)

---

## 🏃 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/Shanewrs/crud-wed-project.git
cd crud-wed-project
```

### 2. Start the Containers
Run Docker Compose to build and start all services in the background:
```bash
docker compose up -d --build
```

### 3. Access the Services

| Service | URL / Port | Credentials |
| :--- | :--- | :--- |
| **Web Application** | [http://localhost:8082](http://localhost:8082) | N/A |
| **phpMyAdmin** | [http://localhost:8081](http://localhost:8081) | Server: `db`<br>User: `root` / Pass: `rootpassword`<br>or User: `myuser` / Pass: `mypassword` |
| **MySQL Database** | `localhost:3307` | Database: `my_crud_db`<br>User: `myuser` / Pass: `mypassword` |

---

## 🛑 Stopping the Application

To stop and remove running containers:
```bash
docker compose down
```

To stop containers and remove the database volume (resets data):
```bash
docker compose down -v
```

---

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).
