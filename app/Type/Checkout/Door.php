<?php

declare(strict_types=1);

namespace App\Type\Checkout;

use Air\Type\TypeAbstract;

class Door extends TypeAbstract
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
  public string $postCode = '';

  /**
   * @var string
   */
  public string $line1 = '';

  /**
   * @var string
   */
  public string $line2 = '';

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
  public function getPostCode(): string
  {
    return $this->postCode;
  }

  /**
   * @param string $postCode
   */
  public function setPostCode(string $postCode): void
  {
    $this->postCode = $postCode;
  }

  /**
   * @return string
   */
  public function getLine1(): string
  {
    return htmlentities($this->line1);
  }

  /**
   * @param string $line1
   */
  public function setLine1(string $line1): void
  {
    $this->line1 = $line1;
  }

  /**
   * @return string
   */
  public function getLine2(): string
  {
    return htmlentities($this->line2);
  }

  /**
   * @param string $line2
   */
  public function setLine2(string $line2): void
  {
    $this->line2 = $line2;
  }
}