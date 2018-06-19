<?php

namespace App\Cruise;

use \Interop\Container\ContainerInterface as ContainerInterface;
use App\Cruise\CruiseRepo;


class CruiseController
{
  public function __construct(ContainerInterface $container) {
    $this->repo = new CruiseRepo($container);
  }

  /**
   * return partian of cruises and total count of cruises 
   */
  public function get_cruises($request, $response, $args) {
    $page = $request->getQueryParam('offset');
    $page_size = $request->getQueryParam('limit');

    $cruises = $this->repo->get_cruise_data($page, $page_size);
    $cruise_data_count = $this->repo->get_cruise_count();

    return $response->withJson([
      'cruises_count' => $cruise_data_count,
      'cruises' => $cruises
    ]);
  }
}
