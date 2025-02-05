<?php

namespace App\Core;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public string $title = '';
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(Application::$ROOT_PATH . '/app/views');
        $this->twig = new Environment($loader);
    }

    public function renderView($view, $params = [])
    {
        if ($this->isTwigView($view)) {
            return $this->renderTwigView($view, $params);
        } else {
            $veiwContent = $this->renderOnlyView($view, $params);
            $layoutContent = $this->layoutContent();
            return str_replace('{{content}}', $veiwContent, $layoutContent);
        }
    }

    public function renderContent($veiwContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $veiwContent, $layoutContent);
    }

    private function layoutContent()
    {
        $layout = 'main';
        if(isset(Application::$app->controller)) {
            $layout = Application::$app->controller->layout;
        }

        ob_start();
        include_once Application::$ROOT_PATH . "/app/views/layouts/$layout.php";
        return ob_get_clean();
    }

    private function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_PATH . "/app/views/$view.php";
        return ob_get_clean();
    }

    private function renderTwigView($view, $params)
    {
        echo $this->twig->render("front/$view.html.twig", $params);
    }

    private function isTwigView($view)
    {
        return file_exists(Application::$ROOT_PATH . "/app/views/front/$view.html.twig") ||
            file_exists(Application::$ROOT_PATH . "/app/views/back/$view.html.twig");
    }
}