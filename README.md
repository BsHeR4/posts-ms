# Post-MS

A minimal Laravel project for managing posts using the **Service-Repository Design Pattern**.

## Description

This project is a **Post Management** built with **Laravel 12** that provides a **RESTful API** for managing posts. It allows users to perform **CRUD operations** (Create, Read, Update, Delete) on posts, with the ability to filter posts by **title** and **tags**. The project follows **repository-service design patterns** and incorporates **clean code** and **refactoring principles**.

### Key Features:

* **Service-Repository Pattern**: Business logic is separated from controllers for better maintainability and testability.
* **Caching Strategy**: Filters create unique cache keys; uncached queries expire after 3 minutes, others after 1 hour.
* **CRUD Operations**: Create, read, update, and delete posts.
* **Filtering**: Filter posts by title and tags
* **Form Requests**: Input validation is handled via custom FormRequest classes.
* **Consistent API Responses**: All responses follow a standard structure for consistency.
* **Pagination**: Results are paginated for performance and simplicity.
* **API Resources**: Responses are wrapped using Laravel Resources for clean output.
- **Pagination**: Results are paginated for better performance and usability.
---

## About the Service-Repository Pattern

This project adopts the **Service-Repository Pattern** to promote clean architecture and better separation of concerns.

### How it Works:

* **Repository Layer**
  Responsible for interacting with the database. It abstracts the data access logic (e.g., queries, filters, pagination) away from the controller or service.

* **Service Layer**
  Contains the business logic of the application. It acts as a bridge between the controller and the repository, orchestrating how data is fetched, validated, transformed, or processed.

* **Controller Layer**
  Simply handles incoming HTTP requests and delegates processing to the service layer. It remains thin and clean, focusing only on request handling and response formatting.

### Benefits:

* **Better Code Organization** – Each layer has a single responsibility, making the codebase more modular and readable.
* **Testability** – Business logic can be tested independently from controllers and database access.
* **Reusability** – Services and repositories can be reused across multiple controllers or jobs.
* **Maintainability** – Changes to logic (e.g., filters or validation) can be made without touching controllers.

This structure makes it easier to scale, maintain, and understand the application over time.


### Technologies Used:
- **Laravel 12**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Postman Collection**: Contains all API requests for easy testing and interaction with the API.

## Installation

### Prerequisites

Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project
- **Postman**: Required for testing the requestes.

---

### Setup Steps

1. **Clone the repository**:

   ```bash
   git clone https://github.com/BsHeR4/posts-ms.git
   ```
   Then navigate to the Project Directory
   ```bash
   cd post
   ```

2. **Install dependencies**:

   ```bash
   composer install
   ```

3. **Create `.env` file**:

   ```bash
   cp .env.example .env
   ```

4. **Generate app key**:

   ```bash
   php artisan key:generate
   ```

5. **Run database migrations**:

   ```bash
   php artisan migrate
   ```

6. **Start the application**:

   ```bash
   php artisan serve
   ```

7. Interact with the API and test the various endpoints via Postman collection.
   Get the collection from [here](https://documenter.getpostman.com/view/33882685/2sB2qgeJiD)
