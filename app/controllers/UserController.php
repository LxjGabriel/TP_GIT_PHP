<?php
require_once __DIR__ . '/../Models/User.php';

session_start();

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }



    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->register($name, $email, $password)) {
                header("Location: /login");
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }





    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: /tasks");
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }
















    
    public function logout() {
        session_destroy();
        header("Location: /login");
        exit();
    }
}
?>
