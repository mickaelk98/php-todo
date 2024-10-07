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
                <input type="text" name="value" id="">
                <button class="btn btn-primary">Ajouter</button>
            </form>
            <div class="togo-list"></div>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>
</div>

</html>