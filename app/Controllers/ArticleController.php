<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Core\Application;

class ArticleController extends Controller
{
    public function showAll()
    {
        $articles = Article::getAll();
        return $this->render('articles/index', [
            'articles' => $articles
        ]);
    }

    public function showArticle($id)
    {
        $article = Article::findArticle(['id' => $id]);

        if (!$article) {
            Application::$app->response->setStatusCode(404);
            return Application::$app->view->renderView('errors/404');
        }

        return Application::$app->view->renderView('articles/show', [
            'article' => $article
        ]);
    }
}
