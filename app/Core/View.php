<?php

namespace App\Core;

class View
{
    public function renderView($view, $params = [])
    {
        $veiwContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $veiwContent, $layoutContent);
    }

    public function renderContent($veiwContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $veiwContent, $layoutContent);
    }

    private function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_PATH . "/app/views/layouts/main.php";
        return ob_get_clean();
    }

    private function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        $frontViewPath = Application::$ROOT_PATH . "/app/views/front/$view.html.twig";
        dump($frontViewPath);
        $backViewPath = Application::$ROOT_PATH . "/app/views/back/$view.html.twig";

        if (file_exists($frontViewPath)) {
            $viewPath = $frontViewPath;
        } elseif (file_exists($backViewPath)) {
            $viewPath = $backViewPath;
        } else {
            throw new \Exception("View file '$view' not found in front or back.");
        }

        ob_start();
        include_once $viewPath;
        return ob_get_clean();
    }
}