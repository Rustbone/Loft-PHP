<?php
namespace Base;

class View {
  private $templatePath;
  private $data;
  private $twig;

  public function setTemplatePath($templatePath) {
      $this->templatePath = $templatePath;
  }

  public function __get($name)
  {
      return $this->data[$name];
   }

  // public function render($template, $data = []) {
  //     $templateFile = $this->templatePath . '/' . $template . '.php';
      
  //     if (file_exists($templateFile)) {
  //         extract($data);
  //         ob_start();
  //         include $templateFile;
  //         return ob_get_clean();
  //     } else {
  //         throw new RedirectException("Template file not found: " . $templateFile);
  //     }
  // }
  public function render(string $tpl, $data = []): string
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        ob_start();
        include $this->templatePath . '/' . $tpl;
        $data = ob_get_clean();
        return $data;
    }
  
    // public function renderTwig(string $tpl, $data = [])
    // {
    //     if (!$this->twig) {
    //         $loader = new \Twig\Loader\FilesystemLoader($this->templatePath);
    //         $this->twig = new \Twig\Environment($loader);
    //     }

    //     return $this->twig->render($tpl, $data);
    // }
}