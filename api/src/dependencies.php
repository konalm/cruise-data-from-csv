<?php
// DIC configuration

use App\Cruise\CruiseController;
// use App\Cruise\CruiseService;
// use App\Cruise\Cruise

use App\Csv\CsvController;
use App\Csv\CsvService;


$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// database connection
$container['db'] = function ($c) {
  $db = $c['settings']['db'];

  $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
    $db['user'], $db['pass']);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  return $pdo;
};


/**
 * inject controllers
 */
$container['CruiseController'] = function ($c) {
    return new CruiseController($c);
};

$container['CsvController'] = function ($c) {
    // return new CsvController($c['CsvService'], $c['CsvRepo']);
    return new CsvController($c);
};

// $container['CsvService'] = function ($c) {
//   return new CsvService();
// };
//
// $container['CsvRepo'] = function ($c) {
//   return new Repo();
// };
