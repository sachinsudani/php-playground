<?php
use Core\Response;

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $statusCode = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($statusCode);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $data = [])
{
    extract($data);
    require base_path("views/" . $path);
}

function redirect($path)
{
    header("Location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}