<?php
namespace hw5\Controller;

use hw5\Model\UserModel.php as UserModel;


class UserController extends UserModel {
    public function login() {
        $name = trim($_POST['name']);
        $password = $_POST['password'];

        if (password_verify($password, $passwordHash)) {
            return "Авторизация успешна.";
        } else {
            return "Неправильный email или пароль.";
        }

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

    public function register() {
        $user = (new UserModel())
                ->setName($name)
                ->setEmail($email)
                 ->setPassword(UserModel::getPasswordHash($password));

        $user->save();

        if (strlen($this->password) < 4) {
            return "Пароль должен содержать не менее 4 символов.";
        }

        if ($this->password !== $this->confirmPassword) {
            return "Введенные пароли не совпадают.";
        }

        return "Регистрация прошла успешно.";
    }

    public function profil() {
        return $this->view->render('User/profile.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

}