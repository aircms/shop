<?php

declare(strict_types=1);

namespace App\Type\Checkout;

use Air\Type\TypeAbstract;

class BankEntity extends TypeAbstract
{
  /**
   * @var string
   */
  public string $edrpou = '';

  /**
   * @var string
   */
  public string $entityName = '';

  /**
   * @return string
   */
  public function getEdrpou(): string
  {
    return $this->edrpou;
  }

  /**
   * @param string $edrpou
   */
  public function setEdrpou(string $edrpou): void
  {
    $this->edrpou = $edrpou;
  }

  /**
   * @return string
   */
  public function getEntityName(): string
  {
    return htmlentities($this->entityName);
  }

  /**
   * @param string $entityName
   */
  public function setEntityName(string $entityName): void
  {
    $this->entityName = $entityName;
  }
}