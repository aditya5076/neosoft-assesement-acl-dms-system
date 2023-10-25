# Admin Panel Data Management System (DMS)

## Overview

The Admin Panel Data Management System (DMS) is a powerful and versatile tool for managing your Data efficiently. This system is designed with a focus on three main features: Access Control List (ACL), SMTP Mails, CSV export, and DataTables for data representation.

## Features

-   **Access Control List (ACL)**: Securely manage user access and permissions to control who can view, edit, or delete specific data.
-   **SMTP Mails**: Send email notifications and alerts directly from the system. Easily configure SMTP settings for email integration.

-   **CSV Export**: Quickly export data in CSV format for easy data migration and backups.

-   **DataTables**: Utilize DataTables for a responsive and interactive data representation. Sort, search, and paginate your data effortlessly.

-   **Queues for Welcome Emails**: Utilize Laravel queues to send welcome emails with login credentials asynchronously for improved performance.

## Installation

To get started with this Admin Panel DMS, follow these steps:

1. **Clone the repository**:

    ```shell
    $ git clone https://github.com/aditya5076/data-management-system.git
    $ cd data-management-system
    $ composer install
    $ cp .env.example .env
    $ npm install
    $ npm run
    $ npm dev
    $ php artisan key:generate
    $ php artisan db:seed --class=PermissonsTableSeeder
    $ php artisan db:seed --class=AdminUserTableSeeder
    $ php artisan db:seed --class=CategoryTableSeeder
    $ php artisan db:seed --class=ProductTableSeeder
    $ php artisan serve

    ```

2. **To run the queue job**:

    ```shell
    $ php artisan queue:listen

    ```
