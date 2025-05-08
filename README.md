# 🚀 Proqua Codeigniter 4 App with jQuery, Tailwind, and mysql

This project is a Codeigniter application that uses jQuery and Tailwind CSS for a modern frontend stack. It uses mysql for simple local development.

---

## 🛠 Requirements

Before you begin, make sure you have these installed:

* PHP >= 8.1
* Composer
* Codeigniter 4

## 🧰 Installation Steps

Clone the repository and install dependencies:
```
git clone git@github.com:Fadhyoung/proqua-medical-system.git
cd proqua-medical-system 
composer install
```

## ⚙️ Set Up Environment

Update your app/Config/Database.php

Update your mysql username and password
```
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Create the database
```
mysql -u root -p -e "CREATE DATABASE patient_db;"
```

## 🗃️ Run Migrations and Seeders

To set up your tables and seed the database:
```
php spark migrate
php spark db:seed PcpSeeder
php spark db:seed PatientSeeder
```

## 🔥 Run the App
Use the following command to start the backend server and frontend assets in parallel:
```
php spark serve
```
