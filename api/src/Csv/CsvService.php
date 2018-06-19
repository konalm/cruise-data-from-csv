<?php

namespace App\Csv;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;


class CsvService
{
    /**
     *
     */
    public function parse_csv_file($file) {
      $reader = ReaderFactory::create(Type::XLSX);

      try {
        $reader->open($file);
      } catch (Excetion $e) {
        return new Exception($e->getMessage());
      }

      return $reader;
    }

    /**
     *
     */
    public function build_insert_csv_import_query($data) {
      $query = "INSERT INTO cruise_data
        (
          offer_id, offer_name, departure_date, itinerary, cruise_line_name,
          cruise_line_logo, cruise_ship_name
        ) VALUES";

      foreach($data->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $key => $row) {
          if ($key === 1) { continue; }

          $date_formatted = $row[2]->format('Y-m-d');

          $query .=
            "('$row[0]', '$row[1]', '$date_formatted', '$row[3]',
            '$row[4]', '$row[5]', '$row[6]'),";
        }
      }

      return rtrim($query, ',');
    }
}
