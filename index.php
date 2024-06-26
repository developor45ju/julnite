<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require __DIR__ . '/vendor/autoload.php';
    include __DIR__ . '/public/views/partials/header.php';
?>

    <main>
<?php
    use AltoRouter;

    $router = new AltoRouter;
    $router->map('GET', '/', function () {
        include __DIR__ . '/public/views/home.php';
    }, 'home');

    $router->map('GET', '/login', function () {
        include __DIR__ . '/public/views/login.php';
    }, 'login');

    $router->map('GET', '/register', function () {
        include __DIR__ . '/public/views/register.php';
    }, 'register');

    $match = $router->match();
    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        include __DIR__ . '/public/views/404.php';
    }
    ?>
    </main>

<?php
    include __DIR__ . '/public/views/partials/footer.php';
    ?>