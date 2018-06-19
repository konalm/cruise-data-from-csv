<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


$app->get('/cruises', 'CruiseController:get_cruises');
$app->get('/csv-to-db', 'CsvController:csv_to_mysql_data');
