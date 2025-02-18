<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

require_once 'app/Controllers/TaskController.php';
$taskController = new TaskController($pdo);
$tasks = $taskController->showTasks();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
</head>
<body>
    <h2>Mes Tâches</h2>
    <form action="/tasks" method="POST">
        <input type="text" name="title" placeholder="Titre de la tâche" required>
        <textarea name="description" placeholder="Description"></textarea>
        <select name="status">
            <option value="À faire">À faire</option>
            <option value="En cours">En cours</option>
            <option value="Terminé">Terminé</option>
        </select>
        <button type="submit">Ajouter</button>
    </form>

    <h3>Liste des Tâches</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?= $task['title'] ?></strong> - <?= $task['status'] ?>
                <form action="/tasks/delete" method="POST" style="display:inline;">
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="/logout">Déconnexion</a>
</body>
</html>
