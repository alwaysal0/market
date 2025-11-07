# Laravel Market (Educational Project)

Welcome to the Laravel Market, a sample e-commerce/marketplace application built as an educational project. The primary goal of this project is not just to build a functional application, but to serve as a practical example of implementing various OOP principles and robust architectural patterns in a real-world Laravel environment.

## 🌟 Core Features

* User Authentication and Profiles
* Product Listings and Management
* (Add more of your specific features here, e.g., Shopping Cart, Order Processing)

## 💻 Technology Stack

* **Framework:** Laravel
* **Database:** PostgreSQL
* **Caching:** Redis

## 🏛️ Architectural Design and Patterns

This project was built with a strong emphasis on OOP principles, scalability, and maintainability. The following patterns and architectures were intentionally used:

### 1. MVC (Model-View-Controller)
The application adheres to the standard Laravel MVC pattern to separate application logic.
* **Models:** Handle database interaction (PostgreSQL).
* **Views:** Render the frontend (Blade templates).
* **Controllers:** Act as the intermediary, handling HTTP requests.

### 2. Multi-Layered Architecture (N-Tier)
To go beyond a basic MVC, the application logic is further divided into multiple layers. This promotes a strong **separation of concerns (SoC)**, makes the application easier to test, and simplifies future scalability.

### 3. Service Layer
All core business logic is encapsulated within a **Service Layer**.
* **Keeps Controllers Thin:** Controllers are only responsible for handling HTTP requests and responses. They delegate all business logic (e.g., "how to create a product," "what happens when an order is placed") to a specific service.
* **Reusability:** Services can be easily reused by controllers, API endpoints, or Artisan commands.
* **Testability:** Business logic can be tested in isolation by unit-testing the service class.

### 4. Events and Listeners
To decouple parts of the application, we use Laravel's built-in Event system.
* **Example: Logging:** Instead of cluttering services with logging code, a `ProductCreated` event (for example) is dispatched. A separate `LogProductCreation` listener handles the logging.
* **Benefit:** This keeps the main service clean and fast. If the logging service fails, it doesn't stop the main application flow (especially when using queues).

### 5. Middleware
Middleware is used for **vertical access control** and filtering HTTP requests.
* **Examples:** Checking if a user is authenticated, verifying if a user is an administrator, or validating that a user owns a specific resource before allowing an edit.

### 6. Factory Pattern
The Factory pattern is used extensively for two key purposes:
* **Database Seeding:** To populate the PostgreSQL database with realistic mock data for development and demonstration.
* **Testing:** To create model instances in a consistent state for unit and feature tests.

### 7. Caching (with Redis)
To improve performance, Redis is used as a caching layer.
* Frequently queried data (e.g., homepage products, categories) is cached to reduce database load and speed up response times.

---

## 🚀 Getting Started

Instructions on setting up this project locally.

### Prerequisites

* PHP 8.1+
* Composer
* Node.js & NPM
* PostgreSQL
* Redis

### Installation

1.  **Clone the repository:**
    ```sh
    git clone [https://github.com/your-username/laravel-market.git](https://github.com/your-username/laravel-market.git)
    cd laravel-market
    ```

2.  **Install dependencies:**
    ```sh
    composer install
    npm install && npm run dev
    ```

3.  **Set up your environment:**
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure your `.env` file:**
    Update the `DB_` and `CACHE_` variables to match your PostgreSQL and Redis credentials.

    ```ini
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=market
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password

    CACHE_DRIVER=redis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    ```

5.  **Run migrations and seed the database:**
    ```sh
    php artisan migrate
    php artisan db:seed
    ```

6.  **Serve the application:**
    ```sh
    php artisan serve
    ```

## 🧪 Testing

Run the application's feature and unit tests.

```sh
php artisan test
