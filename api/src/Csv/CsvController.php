<?php

namespace App\Csv;

use \Interop\Container\ContainerInterface as ContainerInterface;
use App\Csv\CsvService;
use App\Csv\CsvRepo;
use App\Cruise\CruiseRepo;


class CsvController
{
  public function __construct(ContainerInterface $container) {
    $this->service = new CsvService();
    $this->cruise_repo = new CruiseRepo($container);
  }

  /**
   * parse data from csv file
   * build query to insert data into db
   * store it
   */
  public function csv_to_mysql_data($request, $response, $args) {
    $parsed_file = $this->service->parse_csv_file('../src/ux-cruise-data.xlsx');
    $import_query = $this->service->build_insert_csv_import_query($parsed_file);
    $this->cruise_repo->store_cruise_data($import_query);

    return $response->withJson('imported csv file into the DB');
  }
}
