<?php
$dotenv = new Dotenv\Dotenv(__DIR__."/../..");
$dotenv->load();

require "helpers.php";

ini_set('display_errors', env('APP_DEBUG'));
ini_set('display_startup_errors', env('APP_DEBUG'));
ini_set('error_reporting', env('APP_DEBUG') ? E_ALL : 0);


$app = new \App\Core\App;

$app::bind('app', $app);

$app::bind('image', new \Intervention\Image\ImageManager(array('driver' => 'imagick')));

$app::bind('database', new \App\Core\Database\QueryBuilder(
	\App\Core\Database\Connection::make(),
	env('DB_PREFIX', '')
));

\App\Services\Implemented_Functionality::check();

//Blade Setup
$views = __DIR__ . '/../resources/views/';
$cache = __DIR__ . '/../resources/cache/';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$app::bind('blade', new \eftec\bladeone\BladeOne($views, $cache));
//End Blade Setup

/** Router must be last call in bootstrap */
App\Core\Router::load(app_path() . '/routes.php')
    ->direct(App\Core\Request::uriToLower(), App\Core\Request::method());
/** End router call */
