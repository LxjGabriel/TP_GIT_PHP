<?php
require_once __DIR__ . '/../../config/database.php';

class Task {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function getTasks($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask($title, $description, $status, $userId) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, status, user_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $status, $userId]);
    }



    public function updateStatus($taskId, $status) {
        $stmt = $this->pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $taskId]);
    }

    public function deleteTask($taskId) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$taskId]);
    }
    
    
}
?>
