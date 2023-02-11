
# Laravel Livewire Blog Website

 Laravel Blog Management System.



## Installation

Clone the project using SSH or HTTPS.

```bash
  git@github.com:yuvraj-timalsina/blog-website.git
```
    
## Run Locally

Go to the Project Directory

```bash
  cd blog-website
```

Create .env in root directory

```bash
  cp .env.example .env
```

Create and Configure the Database

```bash
  sudo mysql -u <username> -p
  create database blog_website;
```
Install Dependencies

```bash
  composer install
```

Generate Application Key

```bash
  php artisan key:generate
```

Run the Database Migrations and Seeders

```bash
  php artisan migrate:fresh --seed
```

Create a Symbolic Link to Storage

```bash
  php artisan storage:link
```

Run the Server

```bash
  php artisan serve
  
  http://127.0.0.1:8000
```


## Login Credentials

```bash
Email : admin@cms.com
Password: password
```
## ER Diagram

![ER Diagram](https://github.com/yuvraj-timalsina/blog-task/blob/master/graph.png)
## Author

- [@yuvraj-timalsina](https://www.github.com/yuvraj-timalsina)

