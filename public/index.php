<?php
require_once '../config/database.php';
require_once '../app/Controllers/UserController.php';
require_once '../app/Controllers/TaskController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$userController = new UserController($pdo);
$taskController = new TaskController($pdo);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->register();
} elseif ($uri === '/register') {
    include '../app/Views/register.php';
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->login();
} elseif ($uri === '/login') {
    include '../app/Views/login.php';
} elseif ($uri === '/tasks' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->addTask();
} elseif ($uri === '/tasks') {
    include '../app/Views/tasks.php';
} elseif ($uri === '/tasks/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->deleteTask();
} elseif ($uri === '/logout') {
    $userController->logout();
}elseif ($uri === '/tasks/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->updateTask();
}
 else {
    echo "ERREUR, page non trouvé";
}
?>
