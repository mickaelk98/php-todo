<?php
const ERROR_REQUIRED = "Veuillez renseigner une todo";
const ERROR_TOO_SHORT = "veuillez saisir au moin 5 caractères";

$filename = __DIR__ . "\data\\todo.json";
$error = "";
$todos = [];

if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $todoValue = $_POST["value"] ?? "";

    if (!$todoValue) {
        $error = ERROR_REQUIRED;
    } else if (mb_strlen($todoValue) < 5) {
        $error = ERROR_TOO_SHORT;
    }

    if (!$error) {
        $todos = [...$todos, [
            'name' => $todoValue,
            'done' => false,
            'id' => time()
        ]];
        file_put_contents($filename, json_encode($todos));
        header('Location: /');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once "includes/head.php" ?>
    <title>Todo app</title>
</head>

<body>
</body>
<div class="container">
    <?php require_once "includes/header.php" ?>
    <main class="content">
        <div class="todo-container">
            <h1>Ma Todo</h1>
            <form class="todo-form" action="/" method="POST">
                <input value="<?= isset($todoValue) ? $todoValue : "" ?>" type="text" name="value" id="">
                <button class="btn btn-primary">Ajouter</button>
            </form>
            <?php if ($error): ?>
                <p class="text-danger"><?= $error ?></p>
            <?php endif; ?>
            <ul class="todo-list">
                <?php foreach ($todos as $todo): ?>
                    <li class="todo-item">
                        <span class="todo-name <?= $todo["done"] ? "todo-done" : "" ?> "><?= $todo['name'] ?></span>
                        <a href="/edit-todo.php?id=<?= $todo["id"] ?>">
                            <button class="btn btn-primary"><?= $todo['done'] ? "Annuler" : "Valider" ?></button>
                        </a>
                        <a href="/delete-todo.php?id=<?= $todo["id"] ?>">
                            <button class="btn btn-danger">Supprimer</button>
                        </a>

                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>
</div>

</html>