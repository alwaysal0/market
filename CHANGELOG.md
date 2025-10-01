## 17.08.2025
## v0.0.0
#### Changes:
- Created `ChangeLog`;
- Improved handling of POST requests;
- Added a separate window for adding a product;

## 11.09.2025
## v0.0.1
- Added `header` as module in `layouts.app.blade.php`;
- Stylized `header`;
- Added hot-link to 'MainPage' in `header`;

## 11.09.2025
## v0.0.2
- Created `last-products` widget for `Main Page`;
- Created '/resources/view/modules/main/last-products.blade.php' and 'resources/css/modules/main/last-products.css';

## 13.09.2025
## v0.0.3
- Created 'products' page;
- Created new Service Filter Function 'filterMainProducts' which is filtering products for 'products' page;
- Created '/resources/view/products.blade.php' and 'resources/css/products.css';

## 16.09.2025
## v0.0.4
- Added support and middleware filter for `confirmed` status of accounts;
- Created mail classes and Markdown templates for emails;
- Improved user experience with emails when changing passwords or confirming user accounts;

## 20.09.2025
## v0.0.5
### Created:
- `UserController` update user data;
- `EditProile` new service which is updating data;
- `EmailService` new service which is sending emails;

## 27.09.2025
## v0.0.6
### Created:
- Logging Activity by `Spatie`;
### Fixed:
- `EditProfile` service now creates new log in `activity_logs` table in DB;
- `EmailService` service now creates new log in `activity_logs` table in DB;
- `AuthController` service now creates new log in `activity_logs` table in DB;
- `UserController` service now creates new log in `activity_logs` table in DB;
- `GoodController` service now creates new log in `activity_logs` table in DB;

## 01.10.2025
## v0.0.7
### Created:
- `Product Page`;
- New migration `create_reviews_table` for user's reviews;
- Created new model `Review`;
- Created new module `reviews`;