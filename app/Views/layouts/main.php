<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarButtons"
                aria-controls="navbarButtons" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarButtons">
            <div class="navbar-nav">
                <a href="/login" class="btn btn-outline-primary me-2">Login</a>
                <a href="/signup" class="btn btn-primary">Sign Up</a>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <?php if (App\Core\Application::$app->session->getFlashMessages('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= App\Core\Application::$app->session->getFlashMessages('success') ?>
        </div>
    <?php endif; ?>
    {{content}}
</div>

</body>
</html>