<?php
class AuthMiddleware
{
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Если в сессии нет ID пользователя, отправляем на вход
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['from_url'] = $_SERVER['REQUEST_URI'];
            header("Location: /login");
            exit;
        }
    }
}
