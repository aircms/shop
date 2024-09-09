<?php

declare(strict_types=1);

namespace App\Type\Checkout;

use Air\Type\TypeAbstract;

class BankIndividual extends TypeAbstract
{
  /**
   * @var string
   */
  public string $firstName = '';

  /**
   * @var string
   */
  public string $lastName = '';

  /**
   * @var string
   */
  public string $patronymic = '';

  /**
   * @var string
   */
  public string $phone = '';

  /**
   * @return string
   */
  public function getFirstName(): string
  {
    return $this->firstName;
  }

  /**
   * @param string $firstName
   */
  public function setFirstName(string $firstName): void
  {
    $this->firstName = $firstName;
  }

  /**
   * @return string
   */
  public function getLastName(): string
  {
    return $this->lastName;
  }

  /**
   * @param string $lastName
   */
  public function setLastName(string $lastName): void
  {
    $this->lastName = $lastName;
  }

  /**
   * @return string
   */
  public function getPatronymic(): string
  {
    return $this->patronymic;
  }

  /**
   * @param string $patronymic
   */
  public function setPatronymic(string $patronymic): void
  {
    $this->patronymic = $patronymic;
  }

  /**
   * @return string
   */
  public function getPhone(): string
  {
    return $this->phone;
  }

  /**
   * @param string $phone
   */
  public function setPhone(string $phone): void
  {
    $this->phone = $phone;
  }
}