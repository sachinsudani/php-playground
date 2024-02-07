<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$currentUserId = 1;

$note = $db->query("SELECT * FROM notes WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 50)) {
    $errors['body'] = "Body must be between 1 and 50 characters.";
}

if (!empty($errors)) {
    return view("notes/edit.view.php", [
        "heading" => "Edit note",
        "errors" => $errors,
        "note" => $note,
    ]);
}

$db->query("UPDATE notes SET body = :body WHERE id = :id", [
    'id' => $_POST['id'],
    'body' => $_POST['body'],
]);

header("Location: /notes");
die();