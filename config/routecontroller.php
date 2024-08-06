<?php
// config/routecontroller.php
/* 
 * Specimen Routes look like below:
 * 
 * Books::
 * Add a new book: POST http://localhost:8000/api/book/create i.e. title=Book 6, author=Ravin, genre=Guitar, isbn=123456
 * View list of all books: GET http://localhost:8000/api/book/list
 * View a book details: GET http://localhost:8000/api/book/view/{id} i.e. 3
 * Update a book details: POST http://localhost:8000/api/book/update/{id} i.e. title=Book 6, author=Ravin, genre=Guitar, isbn=123456, status=Borrowed
 * Remove a book: GET http://localhost:8000/api/book/remove/{id} i.e. 5 or 4 or 6
 * 
 * Users::
 * Add a new user: POST http://localhost:8000/api/user/create i.e. name=Ravi, email=ravi123@yahoo.com, password=12345, role=Admin
 * View list of all users: GET http://localhost:8000/api/user/list
 * View a user details: GET http://localhost:8000/api/user/view/{id} i.e. id=5
 * Update a user details: POST http://localhost:8000/api/user/update/{id} i.e. id=5
 * Update a user password: POST http://localhost:8000/api/user/updatepwd/{id} i.e. password=1234, id=5
 * Remove a user: GET http://localhost:8000/api/user/remove/{id}  i.e. id=5 or id=4
 * 
 * Borrows::
 * Borrow a book: 
 *   - Add a new borrow record: POST http://localhost:8000/api/borrow/create
 *   - Updates the status in `books` table and update date in `borrows` table
 * Return a book:
 *   - Update a borrow record: POST http://localhost:8000/api/borrow/update/{id}
 *   - Updates the status in `books` table and update date in `borrows` table
 * View borrowing history: GET http://localhost:8000/api/borrow/list
 *   - List of all records from borrows table
 * Remove a borrow record: GET http://localhost:8000/api/borrow/remove/{id} i.e. id=6 or id=8
 * 
 */

use App\DbInfra\Persistence\BookRepository;
use App\DbInfra\Persistence\UserRepository;
use App\DbInfra\Persistence\BorrowRepository;
use App\App\Services\BookService;
use App\App\Services\UserService;
use App\App\Services\BorrowService;
use App\Interfaces\Controllers\BookController;
use App\Interfaces\Controllers\UserController;
use App\Interfaces\Controllers\BorrowController;

$pdo = require_once '../config/database.php';

$routecontroller = $uri[2];
$action = $uri[3] ?? null;
$id = $uri[4] ?? null;

switch ($routecontroller) {
    case 'book':
        $routecontroller = new BookController(new BookService(new BookRepository($pdo)));
        break;
    case 'user':
        $routecontroller = new UserController(new UserService(new UserRepository($pdo)));
        break;
    case 'borrow':
        $routecontroller = new BorrowController(new BorrowService(new BorrowRepository($pdo), new BookRepository($pdo), new UserRepository($pdo)));
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data) && !isset($data)) {
    $data = json_decode(json_encode($_REQUEST, true), true);
}

switch ($action) {
    case 'list':
        $routecontroller->list();
        break;
    case 'view':
        $routecontroller->view($id);
        break;
    case 'create':
        $routecontroller->create($data);
        break;
    case 'update':
        $routecontroller->update($data, $id);
        break;
    case 'updatepwd':
        $routecontroller->updatePassword($data, $id);
        break;
    case 'remove':
        $routecontroller->remove($id);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}
