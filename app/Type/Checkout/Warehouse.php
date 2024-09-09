<?php

declare(strict_types=1);

namespace App\Type\Checkout;

use Air\Type\TypeAbstract;

class Warehouse extends TypeAbstract
{
  /**
   * @var string
   */
  public string $region = '';

  /**
   * @var string
   */
  public string $city = '';

  /**
   * @var string
   */
  public string $warehouse = '';

  /**
   * @return string
   */
  public function getRegion(): string
  {
    return $this->region;
  }

  /**
   * @param string $region
   */
  public function setRegion(string $region): void
  {
    $this->region = $region;
  }

  /**
   * @return string
   */
  public function getCity(): string
  {
    return $this->city;
  }

  /**
   * @param string $city
   */
  public function setCity(string $city): void
  {
    $this->city = $city;
  }

  /**
   * @return string
   */
  public function getWarehouse(): string
  {
    return htmlentities($this->warehouse);
  }

  /**
   * @param string $warehouse
   */
  public function setWarehouse(string $warehouse): void
  {
    $this->warehouse = $warehouse;
  }
}