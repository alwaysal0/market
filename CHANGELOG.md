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

## 03.10.25
## v0.0.8
### Created:
- New module 'Reviews';
- New module 'Same Products';

## 03.10.25
## v0.1.0
### Fixed:
- Fixed `profile.js`: added URL verification to start the script;
- Renamed some objects in `product-card` and `profile`;

### Created:
- Implemented `delete` button functionality in `product card`;
- Hide `same_products` in `product` if none exist.

## 04.10.25
## v0.2.0
### Created:
- New DB migration `create_admins_table`;
- New model `Admin`;

### Fixed:
- Now all models extend the `Model` class, except the `User.php`;

## 05.10.25
## v0.3.0
### Created:
- New 'Admin Panel';

## 07.10.25
## v0.3.1
### Created:
- New "Admin Service" which is providing opportunity to update user data;

### Fixed:
- Restyling "admin-panel";
- Changed redirections from `back` method to `route` in `AdminController.php`;

## 08.10.25
## v0.3.2
### Created:
- New method in `Product Service`;
- Development the possibility to edit products of the selected user;

### Fixed:
- Restyling "admin-panel";

## 08.10.25
## v0.4.0
### Created:
- Finished 'Admin-Panel';
- New methods in 'Admin Service' to edit and delete products;
- New `EditProductRequest` validator;

## 12.10.25
## v0.4.1
### Fixed:
- Fixed `FeedBackForm`;

## 16.10.25
## v0.4.2
### Fixed:
- Refactoring `UserController` and `UserService`. The code has become cleaner and more readable, and unnecessary database queries have been removed.
- Created new Request Validators:
  - `SendReportRequest.php`;
  - `SendReviewRequest.php`;
  - `CheckPasswordCodeRequest.php`;
  - `UpdatePasswordRequest.php`;
  - `UpdateUsernameRequest.php`;
  
## 17.10.25
## v0.4.3
### Fixed:
- Refactored `AdminService.php` and `AdminController.php`. The code has become cleaner and more readable, and unnecessary database queries have been removed.

## 26.10.25
## v0.4.4
### Fixed:
- Fixed `ProductService.php` and `ProductController.php`. The code has become cleaner and more readable, and unnecessary database queries have been removed.
### Created:
- New Request Validators for **middleware['admin']**:
  - `AdminSearchUserRequest.php`;
  - `AdminUpdateUserRequest.php`;
- New Request Validators for User Actions:
  - `UploadProductRequest.php`;
  - `EditProductRequest.php`;
- New **Unit-Test** for `Admin`, which tests accessing the admin panel and editing user profiles with various inputs.

## 26.10.25
## v0.4.5
### Fixed:
- `ProductController.php` and `ProductService.php`. Added catching and logging of errors.
- Fixed `register` and `login` request validation. Added separate `RegisterUserRequest.php` and `LoginUserRequest.php` validators.
- Created a separate Feature Test for user authentication.

## 28.10.25
## v0.4.6
### Created:
- A new **[Redis NoSQL](https://redis.io/nosql/what-is-nosql/)** database was created for data caching.
- **Pagination** was added to the `ProductsPage`.
### Changed:
- Product data is now being cached.
- The `ProductController.php` was updated — caching logic was added.
- The `RenderController.php` was updated — the logic of the showProducts function was simplified.

## 29.10.25
## v0.4.7
### Created:
- Pagination was introduced on the `ProductsPage`;
- All pages are cached using **Redis Caching**;
- A custom **Paginator module** was created for page navigation.

## 31.10.25
## v0.4.8
### Created:
- Created a **Custom Caching Model Binding** for the `Product` model;
- Optimized product data storage;
### Fixed:
- Minor coding style improvements;

## 04.11.25
## v0.4.9
### Created:
- New `footer.blade.php`, `footer.css`;
### Fixed:
- Minor coding style improvements;
- Restyled `MainPage`, `ProductsPage`, `SupportPage`.

## 05.11.25
## v0.4.10
### Created:
- Caching **filtered** `ProductsPage`;

## 07.11.25
## v0.4.11
### Fixed:
- Restyled `ProfilePage`.
- **Model Binding** for Edit&Delete actions in `your-products`;
