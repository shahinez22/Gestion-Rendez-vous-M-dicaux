# Gestion des Rendez-vous Médicaux

A modern Medical Appointment Management System developed with Laravel, MySQL, Blade, Tailwind CSS, and Eloquent ORM.

## Features

* Authentication and Authorization
* Doctor Management (CRUD)
* Patient Management (CRUD)
* Appointment Management (CRUD)
* Dashboard with Statistics
* Search and Pagination
* Appointment Calendar View
* Responsive Design with Tailwind CSS
* Form Validation
* MVC Architecture

## Technologies

* Laravel 12
* PHP 8+
* MySQL
* Blade Templates
* Tailwind CSS
* Eloquent ORM

## Database Structure

### Medecins

* id
* nom
* specialite
* timestamps

### Patients

* id
* nom
* telephone
* timestamps

### Rendez-vous

* id
* date_rdv
* medecin_id
* patient_id
* timestamps

## Installation

```bash
git clone https://github.com/shahinez22/Gestion-Rendez-vous-M-dicaux.git
cd Gestion-Rendez-vous-M-dicaux

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

npm install
npm run build

php artisan serve
```

## Project Objectives

The application allows medical centers and clinics to manage doctors, patients, and appointments efficiently through an intuitive web interface while following Laravel best practices and modern web development standards.

## Author

Shahinez Morsli
