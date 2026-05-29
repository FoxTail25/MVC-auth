<?php

namespace Project\Models;

use Core\Model;

class AuthModel extends Model
{
    public function is_auth(string $name, string $pass)
    {
        // ищем в базе пользователя с указанным логином
        $sqlQuery = "SELECT * FROM users WHERE name = :name";
        $sqlVar = ['name' => $name];
        $res = $this->read($sqlQuery, $sqlVar);
        $userFromDB = $res['msg'][0];
        // Если пользователь найден и пароль совпадает
        if ($userFromDB && password_verify($pass, $userFromDB['password'])) {
            return $userFromDB; // Возвращаем массив с данными пользователя
        }
        return false;
    }
    public function regNewUser(string $name, string $pass)
    {
        // Проверяем есть ли в базе такой логин
        if ($this->checkLogin($name)) {
            // если логин не знаят, то создаём его
            $sqlQuery = "INSERT INTO users (role, name, password) VALUES (:role, :username, :password)";
            $sqlVar = [
                'role' => 2,
                'username' => $name,
                'password' => password_hash($pass, PASSWORD_DEFAULT)
            ];
            $result = $this->create($sqlQuery, $sqlVar);
            // возвращаем true
            if ($result['success']) {

                return ['name' => $name, 'id' => $result['id']];
            } else {
                return ['name' => $result['msg'], 'id' => $result['id']];
            }
        } else {
            // Если логин уже занят, возвращаем false
            return false;
        }
    }
    public function checkLogin(string $name)
    {
        // Проверка на существование логина
        $sqlQuery = "SELECT * FROM users WHERE name = :name";
        $sqlVar = ['name' => $name];
        $res = $this->prepareQuery($sqlQuery, $sqlVar);
        $res->execute();
        // Если логин уже есть вернётся false
        if ($res->rowCount() > 0) {
            return false;
        }
        // Если такого логина ещё нет вернётся true
        return true;
    }
}
