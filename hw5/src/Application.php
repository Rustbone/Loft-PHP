<?php
namespace Base;

class Application
{
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function run()
    {
      $view = new View();
      $view->setTemplatePath(getcwd() . '/../app/View');
        try {
          $this->route->dispatch($_SERVER['REQUEST_URI']);
          $controller = $this->route->getController();
          $action = $this->route->getAction();
          $controller->setView($view);

          $session = new Session();
          $session->init();
          $controller->setSession($session);
          $controller->preDispatch();
          $result = $controller->$action();

          echo $result;

        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
        } catch (RedirectException $e) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            echo 'Page not found';
        }
    }

    // private function initUser()
    // {
    //     $id = $_SESSION['id'] ?? null;
    //     if ($id) {
    //         $user = \App\Model\UserModel::getById($id);
    //         if ($user) {
    //             $this->controller->setUser($user);
    //         }
    //     }
    // }
}