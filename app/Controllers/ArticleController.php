<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function showAll()
    {
        $articles = Article::getAll();
        return $this->render('articles/index', [
            'articles' => $articles
        ]);
    }
}
