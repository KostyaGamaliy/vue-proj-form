<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $annotation = $_POST["annotation"];
    $content = $_POST["content"];
    $email = $_POST["email"];
    $views = $_POST["views"];
    $date = $_POST["date"];
    $publish_in_index = $_POST["publish_in_index"] ?? "";
    $category = $_POST["category"] ?? "";

    if (empty($title)) {
        $errors["title"] = "Заголовок не должен быть пустым";
    } elseif (strlen($title) < 3) {
        $errors["title"] = "Заголовок не должен быть меньше 3 символов";
    } elseif (strlen($title) > 255) {
        $errors["title"] = "Заголовок не должен быть больше 255 символов";
    }

    if (strlen($annotation) > 500) {
        $errors["annotation"] = "Поле аннотация не должно превышать 500 символов";
    }

    if (strlen($content) > 30000) {
        $errors["content"] = "Поле контента не должно превышать 30000 символов";
    }

    if (empty($email)) {
        $errors["email"] = "Поле email не должно быть пустым";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Неверный формат";
    }

    if (!is_numeric($views) || $views < 0 || !filter_var($views, FILTER_VALIDATE_INT)) {
        $errors["views"] = "Количество просмотров должно быть целым положительным числом";
    }

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date) || $date < date("Y-m-d")) {
        $errors["date"] = "Дата публикации должна быть действительной и не ранее сегодняшнего дня";
    }

    if (empty($publish_in_index) || ($publish_in_index != "yes" && $publish_in_index != "no")) {
        $errors["publish_in_index"] = "Поле публикация на главной является обязательным и должно содержать значение 'yes' или 'no'";
    }

    if (!is_numeric($category) || !in_array($category, [1, 2, 3])) {
        $errors["category"] = "Поле категории должно быть числом и иметь одно из значений [1, 2, 3]";
    }

    $_SESSION['errors'] = $errors;
    $_SESSION['data'] = $_POST;

    header('Location: http://localhost:85/');
    die();
}