<?php
function cors()
{
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        }

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        }

        exit(0);
    }
}
cors();

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$title = $input["title"];
$annotation = $input["annotation"];
$content = $input["content"];
$email = $input["email"];
$views = $input["views"];
$date = $input["date"];
$publish_in_index = $input["publish_in_index"] ?? "";
$category = $input["category"] ?? "";



if (empty($title)) {
    $errors["title"] = "Заголовок не должен быть пустым";
} else if (strlen($title) < 3) {
    $errors["title"] = "Заголовок не должен быть меньше 3 символов";
} else if (strlen($title) > 255) {
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

header("Content-type: application/json");
echo json_encode(['errors' => $errors]);
die();