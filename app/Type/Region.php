<?php

declare(strict_types=1);

namespace App\Type;

use Air\Type\TypeAbstract;

class Region extends TypeAbstract
{
  /**
   * @var string
   */
  public string $title = '';

  /**
   * @var array
   */
  public array $cities = [];

  /**
   * @return string
   */
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * @param string $title
   */
  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  /**
   * @return array
   */
  public function getCities(): array
  {
    return $this->cities;
  }

  /**
   * @param array $cities
   */
  public function setCities(array $cities): void
  {
    $this->cities = $cities;
  }
}