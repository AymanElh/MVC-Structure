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
        ob_start();
        include_once Application::$ROOT_PATH . "/app/views/$view.php";
        return ob_get_clean();
    }
}