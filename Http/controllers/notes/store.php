<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

if (!Validator::string($_POST["body"], 1, 50)) {
    $errors['body'] = "The body must be between 1 and 50 characters long.";
}

if (!empty($errors)) {
    return view("notes/create.view.php", [
        "heading" => "Create note",
        "errors" => $errors,
    ]);
}


$db->query("INSERT INTO notes(body, user_id) VALUES (:body, :user_id)", [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header("Location: /notes");
die();
