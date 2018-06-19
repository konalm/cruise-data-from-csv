<?php

require('Csv/CsvService.php');
require('./Cruise/CruiseRepo.php');

$csv_service = new App\Csv\CsvService();
$cruise_repo = new App\Cruise\CruiseRepo();


/**
 * parse the file into readable string
 */
try {
  $parsed_file = $csv_service->parse_csv_file('ux-cruise-data.xlsx');
} catch (Exception $e) {
  throw new Error('Error parsing excel file');
}

/**
 * build sql file to insert into DB
 */
try {
  $import_query = $csv_service->build_insert_csv_import_query($parsed_file);
} catch (Exception $e) {
  throw new Error('error building the insert query');
}

/**
 * store the data in the
 */
try {
   $cruise_repo->store_cruise_data($import_query);
} catch (Exception $e) {
  throw new Error('error storing the cruise data');
}



echo "IMPORTED FILE";
