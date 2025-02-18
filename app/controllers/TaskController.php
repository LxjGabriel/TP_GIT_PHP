<?php
require_once __DIR__ . '/../Models/Task.php';

class TaskController {
    private $taskModel;

    public function __construct($pdo) {
        $this->taskModel = new Task($pdo);
    }



    public function showTasks() {
        return $this->taskModel->getTasks($_SESSION['user_id']);
    }


    public function addTask() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $userId = $_SESSION['user_id'];

            if ($this->taskModel->addTask($title, $description, $status, $userId)) {
                header("Location: /tasks");
            } else {
                echo "Erreur lors de l'ajout de la tâche.";
            }
        }
    }

    public function updateTask() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $taskId = $_POST['task_id'];
            $status = $_POST['status'];
    
            if ($this->taskModel->updateStatus($taskId, $status)) {
                header("Location: /tasks");
                exit();
            } else {
                echo "Erreur lors de la mise à jour.";
            }
        }
    }
    




    public function deleteTask() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $taskId = $_POST['task_id'];

        if ($this->taskModel->deleteTask($taskId)) {
            header("Location: /tasks");
            exit();
        } else {
            echo "Erreur lors de la suppression.";
        }
    }
}

}
?>
