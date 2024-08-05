# library-management-system-ddd
LIBRARY MANAGEMENT SYSTEM API with a DOMAIN DRIVEN DESIGN (DDD) APPROACH

Technology/Language: PHP Object Oriented Programming - MIT

Developing a Library Management System API, using OOPs PHP and DDD which involves organizing the code into domains and bounded contexts i.e. library. Which can be achieved with below steps.

Prerequisites
PHP: Ensure you have PHP installed on your system.
MySQL: Database system.
Composer: PHP dependency manager for loading any required libraries.

--

Create a directory for your project and set up the structure as shown above. Use Composer to initialize the project.

> mkdir library-management-system-ddd
> cd library-management-system-ddd
> composer init
> composer install

Or you can also clone this application.

Configure Autoload
Make sure you have installed a composer then create a file `composer.json` in root path. Make sure you have PSR-4 to load the files from various folders with correct namespaces.
Run below: (run this whenever you add a new files to the application)
> composer dump-autoload -o

--

Application Structure:

library-management-system-ddd/
├── config/
│   └── database.php
|   |__ routecontroller.php
├── src/
│   ├── App/
│   │   ├── Services/
│   │   │   ├── BookService.php
│   │   │   ├── UserService.php
│   │   │   └── BorrowService.php
│   ├── Library/
│   │   ├── Book/
│   │   │   ├── Book.php
│   │   │   ├── BookRepositoryInterface.php
│   │   ├── User/
│   │   │   ├── User.php
│   │   │   ├── UserRepositoryInterface.php
│   │   ├── Borrow/
│   │   │   ├── Borrow.php
│   │   │   ├── BorrowRepositoryInterface.php
│   ├── DbInfra/
│   │   ├── Persistence/
│   │   │   ├── BookRepository.php
│   │   │   ├── UserRepository.php
│   │   │   └── BorrowRepository.php
│   ├── Interfaces/
│   │   ├── Controllers/
│   │   │   ├── BookController.php
│   │   │   ├── UserController.php
│   │   │   └── BorrowController.php
│   └── Shared/
│       └── Entity.php
├── public/
│   └── index.php
└── vendor/
|   └── autoload.php
|__ composer.json
|__ ReadMe.md
|__ LMSuserstory.md
|__ library-management-system-ddd.sql

--

Now, make sure you have a database 'library-management-system-ddd' (which you mentioned in config/database.php file) created in MySQL database server with given tables.
`books`, `users`, `borrows` (db.sql file included)
You can use https://onecompiler.com/mysql online mysql editor for this to test.

--
Next follow the below steps. Similar kind of implementation would be there Symfony, Laravel etc. frameworks.

Step 1: Database Configuration
Create a `config/database.php` file for database configuration.

Step 2: Shared Entity Base Class
Create a base entity `src/Shared/Entity.php` class to be inherited by other entities.

Step 3: Domain Entities under Library Domain
Entities are nothing but Tables associated with database.

Create the Book entity `src/Library/Book/Book.php`.
Similarly, create the User entity `src/Library/User/User.php`.
and
Create the Borrow entity `src/Library/Borrow/Borrow.php`.

Step 4: Repository Interfaces under Library domain

Define repository interfaces for each entity.
i. Book Repository Interface i.e. `src/Library/Book/BookRepositoryInterface.php`
ii. User Repository Interface i.e. `src/Library/User/UserRepositoryInterface.php`
iii. Borrow Repository Interface i.e. `src/Library/Borrow/BorrowRepositoryInterface.php`

Step 5: Infrastructure Persistence
These repositories will connect with model entities to help implement business flow. This will go under database layer.

Implement the repository interfaces.
i. Book Repository i.e. `src/DbInfra/Persistence/BookRepository.php`
ii. User Repository i.e. `src/DbInfra/Persistence/UserRepository.php`
iii. Borrow Repository i.e. `src/DbInfra/Persistence/BorrowRepository.php`

Step 6: Application Services
Create application services to handle business logic to respond the data for various requests by connecting to the controllers.

i. Book Service i.e. `src/App/Services/BookService.php`
ii. User Service i.e. `src/App/Services/UserService.php`
iii. Borrow Service i.e. `src/App/Services/BorrowService.php`

Step 7: Controllers
Create controllers to interface with HTTP requests to serve the data.

i. Book Controller i.e. `src/Interfaces/Controllers/BookController.php`
ii. User Controller i.e. `src/Interfaces/Controllers/UserController.php`
iii. Borrow Controller i.e. `src/Interfaces/Controllers/BorrowController.php`

Step 8: Routing and Entry Point
Create the entry point and route requests in `public/index.php`

Step 9: Configure a VirtualHost
Create a VirtualHost for the website/domain, where you can access the website or APIs.
In my case it would be local.library-management-system-ddd.com

If you failed to do so, you can follow given steps to run the local server.
Start a local server which should contain `public` directory having `index.php` file:
> php -S localhost:8000 -t public

Run below at command prompt:
> composer dump-autoload -o

Access the API endpoints:

Books::
Add a new book: POST http://localhost:8000/api/book/create i.e. title=Book 6, author=Ravin, genre=Guitar, isbn=123456
View list of all books: GET http://localhost:8000/api/book/list
View a book details: GET http://localhost:8000/api/book/view/{id} i.e. id=3
Update a book details: POST http://localhost:8000/api/book/update/{id} i.e. title=Book 6, author=Ravin, genre=Guitar, isbn=123456, status=Borrowed, id=3
Remove a book: GET http://localhost:8000/api/book/remove/{id} i.e. id=5 or id=4

Users::
Add a new user: POST http://localhost:8000/api/user/create i.e. name=Ravi, email=ravi123@yahoo.com, password=12345, role=Admin
View list of all users: GET http://localhost:8000/api/user/list
View a user details: GET http://localhost:8000/api/user/view/{id} i.e. id=5
Update a user details: POST http://localhost:8000/api/user/update/{id} i.e. id=5
Update a user password: POST http://localhost:8000/api/user/updatepwd/{id} i.e. password=1234, id=5
Remove a user: GET http://localhost:8000/api/user/remove/{id}  i.e. id=5 or id=4

Borrows::
Borrow a book: 
    - Add a new borrow record: POST http://localhost:8000/api/borrow/create
    - Updates the status in `books` table and update date in `borrows` table
Return a book:
    - Update a borrow record: POST http://localhost:8000/api/borrow/update/{id}
    - Updates the status in `books` table and update date in `borrows` table
View borrowing history: GET http://localhost:8000/api/borrow/list
    - List of all records from borrows table
Remove a borrow record: GET http://localhost:8000/api/borrow/remove/{id} i.e. id=6 or id=8

This provides a structured approach to build a Library Management System API using Object-Oriented PHP and Domain-Driven Design principles. It covers setting up the project, configuring the database, creating domain entities, repository interfaces, application services, controllers, routing, and testing the API. You can expand this by adding more business logic, validations, and error handling as needed.

