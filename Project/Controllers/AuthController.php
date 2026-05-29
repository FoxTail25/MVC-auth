<?php

namespace Project\Controllers;

use Core\Controller;
use Project\Models\AuthModel;

class AuthController extends Controller
{
    // регистрация
    public function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $answer = (new AuthModel)->regNewUser($username, $password);

            if ($answer) {
                $_SESSION['user_id'] = $answer['id'];
                $_SESSION['user_name'] = $answer['name'];
                header("Location: /");
                exit;
            } else {
                $_SESSION['msg'] = 'Такой логин уже занят';
            }
        }
        return $this->render('auth/reg');
    }

    // проверка логина и пароля
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = (new AuthModel)->is_auth($username, $password);


            if ($user) {
                // Записываем данные в сессию
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Отрисовываем страницу
                if (isset($_SESSION['from_url'])) {
                    header("Location: $_SESSION[from_url]");
                    exit;
                } else {
                    header("Location: /");
                    exit;
                }
            }
        }
        return $this->render('auth/login');
    }
    // Выход из системы
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy(); // Удаляем сессию
        header("Location: /");
        exit;
    }
}
