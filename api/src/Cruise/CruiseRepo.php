<?php

namespace App\Cruise;

class CruiseRepo
{
  public function __construct(\Slim\Container $container) {
      $this->container = $container;
  }
  /**
   *
   */
  public function store_cruise_data($query) {
    $stmt = $this->container->db->prepare($query);

    try {
      $stmt->execute();
    } catch (Exception $e)  {
      throw new Error ('error saving csv file');
    }
  }

  /**
   *
   */
  public function get_cruise_data($page, $limit) {
    $page--;
    $offset = $page * $limit;

    $stmt = $this->container->db->prepare(
      "SELECT * FROM cruise_data LIMIT $offset, $limit"
    );

    try {
      $stmt->execute();
    } catch (Exception $e) {
      throw new Error ('error getting cruise data from DB');
    }

    return $stmt->fetchAll();
  }

  /**
   *
   */
  public function get_cruise_count() {
    $stmt = $this->container->db->prepare(
      "SELECT COUNT(*) AS count FROM cruise_data"
    );

    try {
      $stmt->execute();
    } catch (Exception $e) {
      throw new Error('error getting cruise data count');
    }

    return $stmt->fetch()['count'];
  }
}
