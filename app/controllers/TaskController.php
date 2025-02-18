<?php
require_once 'app/Models/Task.php';

class TaskController {
    private $taskModel;

    public function __construct($pdo) {
        $this->taskModel = new Task($pdo);
    }

    public function showTasks() {
        $tasks = $this->taskModel->getTasks($_SESSION['user_id']);
        include 'app/Views/tasks.php';
    }

    public function addTask() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $userId = $_SESSION['user_id'];

            $this->taskModel->addTask($title, $description, $status, $userId);
            header("Location: /tasks.php");
        }
    }
}
?>
