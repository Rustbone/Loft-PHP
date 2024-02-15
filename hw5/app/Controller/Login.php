<?php
namespace App\Controller;

use App\Model\UserModel;
use Base\AbstractController;

class Login extends AbstractController {
    public function index()
    {
        if ($this->getUser()) {
            $this->redirect('/blog');
        }
        return $this->view->render(
            'register.phtml',
            [
                'title' => 'Главная',
                'user' => $this->getUser(),
            ]
        );
    }

    public function auth() {
        $email = (string) $_POST['email'];
        $password = (string) $_POST['password'];
        $user = UserModel::getByEmail($email);
        //$passwordHash = $user->getPasswordHash($password);

        if (!$user) {
            return 'Неверный логин и пароль юзер';
        }
        $passwordHash = $user->getPasswordHash($password);

        if (password_verify($password, $passwordHash)) {
            return "Авторизация успешна.";
        } else {
            return "Неправильный логин и пароль.";
        }

        // return $this->view->render('User/register.phtml', [
        //     'user' => UserModel::getById((int) $_GET['id'])
        // ]);

        // $this->session->authUser($user->getId());
        // $this->redirect('/blog');
    }

    public function register() {
        $name = trim($_POST['name']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if (!$name || !$password) {
            return 'Не заданы имя и пароль';
        }

        if (!$email) {
            return 'Не задан email';
        }

        if (mb_strlen($password) < 4) {
            return "Пароль должен содержать не менее 4 символов.";
        }

        if ($password !== $confirmPassword) {
            return "Введенные пароли не совпадают.";
        }

        $userData = [
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
            'password' => $password,
            'email' => $email,
        ];
        $user = new UserModel($userData);
        $user->save();

        // $this->session->authUser($user->getId());
        // $this->redirect('/blog');

        return "Регистрация прошла успешно.";
    }

    // public function profile() {
    //     return $this->view->render('User/profile.phtml', [
    //         'user' => UserModel::getById((int) $_GET['id'])
    //     ]);
    // }

}

// class Login extends AbstractController
// {
//     public function index()
//     {
//         if ($this->getUser()) {
//             $this->redirect('/blog');
//         }
//         return $this->view->render(
//             'register.phtml',
//             [
//                 'title' => 'Главная',
//                 'user' => $this->getUser(),
//             ]
//         );
//     }

//     public function auth()
//     {
//         $email = (string) $_POST['email'];
//         $password = (string) $_POST['password'];

//         $user = UserModel::getByEmail($email);
//         if (!$user) {
//             return 'Неверный логин и пароль user';
//         }

//         if ($user->getPassword() !== UserModel::getPasswordHash($password)) {
//             return 'Неверный логин и пароль';
//         }

//         $this->session->authUser($user->getId());

//         $this->redirect('/blog');
//     }

//     public function register()
//     {
//         $name = (string) $_POST['name'];
//         $email = (string) $_POST['email'];
//         $password = (string) $_POST['password'];
//         $password2 = (string) $_POST['confirm_password'];

//         if (!$name || !$password) {
//             return 'Не заданы имя и пароль';
//         }

//         if (!$email) {
//             return 'Не задан email';
//         }

//         if ($password !== $password2) {
//             return 'Введенные пароли не совпадают';
//         }

//         if (mb_strlen($password) < 5) {
//             return 'Пароль слишком короткий';
//         }

//         $userData = [
//             'name' => $name,
//             'created_at' => date('Y-m-d H:i:s'),
//             'password' => $password,
//             'email' => $email,
//         ];
//         $user = new UserModel($userData);
//         $user->save();

//         $this->session->authUser($user->getId());
//         $this->redirect('/blog');
//     }
// }