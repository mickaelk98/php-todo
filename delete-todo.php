<?php
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';
$filename = __DIR__ . "\data\\todo.json";

if ($id) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];

    if (count($todos)) {
        $todoIndex = (int)array_search($id, array_column($todos, 'id'));
        array_splice($todos, $todoIndex, 1);
        file_put_contents($filename, json_encode($todos));
    }
}

header('Location: /');
