<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();


$app['view.path'] = __DIR__.'/../pages';
$app['layout.path'] = __DIR__.'/../layouts';
$app['view.defaults'] = ['index.md', 'README.md'];
$app['layout.default'] = 'main';
$app['layout.error'] = 'error';

$app['view.finder'] = $app->share(function ($app) {
    return new MdView\Finder($app['view.path'], $app['view.defaults']);
});

$app['layout.engine'] = $app->share(function ($app) {
    $layout = new MdView\Layout($app['layout.path']);
    $layout->setDefaultTemplate($app['layout.default']);
    $layout->setErrorTemplate($app['layout.error']);
    $layout->setBasePath($app['request']->getBasePath());
    return $layout;
});

$app->get('/{pageName}', function ($pageName) use ($app) {
    $finder = $app['view.finder'];
    if (null === ($view = $finder->find($pageName))) {
        $app->abort(404, "Page $pageName does not exist");
    }
    return $app['layout.engine']->render($view);
})
->assert('pageName', '[0-9a-zA-Z_\-\/\.]*');





$app->error(function (\Exception $e, $code) use ($app) {
    return $app['layout.engine']->error($e->getMessage(), $code);
});

$app->run();
