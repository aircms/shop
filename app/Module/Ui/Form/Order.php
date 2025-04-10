<?php

declare(strict_types=1);

namespace App\Module\Ui\Form;

use Air\Filter\HtmlSpecialChars;
use Air\Filter\StripTags;
use Air\Filter\Trim;
use Air\Validator\Email;
use Air\Validator\Phone;
use Air\Validator\StringLength;

final class Order
{
  /**
   * @var array
   */
  public array $values = [];

  /**
   * @var array
   */
  public array $errors = [];

  /**
   * @param string $value
   * @return string
   */
  private function defaultStringFilter(string $value): string
  {
    return
      HtmlSpecialChars::clean(
        StripTags::clean(
          Trim::clean(
            $value
          )
        )
      );
  }

  /**
   * @param array $data
   * @return bool
   */
  public function isValid(array $data = []): bool
  {
    $this->errors = [];
    $this->values = [];

    if (!StringLength::valid(min: 2, max: 100)->isValid($data['firstName'])) {
      $this->errors[] = 'firstName';
    } else {
      $this->values['firstName'] = $this->defaultStringFilter($data['firstName']);
    }

    if (!StringLength::valid(min: 2, max: 100)->isValid($data['lastName'])) {
      $this->errors[] = 'lastName';
    } else {
      $this->values['lastName'] = $this->defaultStringFilter($data['lastName']);
    }

    if (!Phone::valid($data['phone'])) {
      $this->errors[] = 'phone';
    } else {
      $this->values['phone'] = \Air\Filter\Phone::clean($data['phone']);
    }

    if (!Email::valid()->isValid($data['email'])) {
      $this->errors[] = 'email';
    } else {
      $this->values['email'] = \Air\Filter\Email::clean($data['email']);
    }

    if (!in_array($data['delivery'], \App\Model\Order::getAllowedDeliveryOptions())) {
      $this->errors[] = 'delivery';
      return false;
    } else {
      $this->values['deliveryMethod'] = $data['delivery'];
    }

    if (
      $data['delivery'] === \App\Model\Order::DELIVERY_DOOR ||
      $data['delivery'] === \App\Model\Order::DELIVERY_NEW_POST_DOOR
    ) {
      $this->values['address'] = [];

      if (!StringLength::valid(min: 5, max: 200)->isValid($data['door']['region'])) {
        $this->errors[] = 'door[region]';
      } else {
        $this->values['address']['region'] = $this->defaultStringFilter($data['door']['region']);
      }

      if (!StringLength::valid(min: 2, max: 100)->isValid($data['door']['city'])) {
        $this->errors[] = 'door[city]';
      } else {
        $this->values['address']['city'] = $this->defaultStringFilter($data['door']['city']);
      }

      if (!StringLength::valid(min: 2, max: 100)->isValid($data['door']['line1'])) {
        $this->errors[] = 'door[line1]';
      } else {
        $this->values['address']['line1'] = $this->defaultStringFilter($data['door']['line1']);
      }

      $this->values['address']['line2'] = $this->defaultStringFilter($data['door']['line2']);
      $this->values['address']['postCode'] = intval($data['door']['postCode']);

    } else if ($data['delivery'] === \App\Model\Order::DELIVERY_NEW_POST_WAREHOUSE) {
      $this->values['address'] = [];

      if (!StringLength::valid(min: 5, max: 200)->isValid($data['warehouse']['region'] ?? '')) {
        $this->errors[] = 'warehouse[region]';
      } else {
        $this->values['address']['region'] = $this->defaultStringFilter($data['warehouse']['region']);
      }

      if (!StringLength::valid(min: 2, max: 200)->isValid($data['warehouse']['city'] ?? '')) {
        $this->errors[] = 'warehouse[city]';
      } else {
        $this->values['address']['city'] = $this->defaultStringFilter($data['warehouse']['city']);
      }

      if (!StringLength::valid(min: 2, max: 200)->isValid($data['warehouse']['warehouse'] ?? '')) {
        $this->errors[] = 'warehouse[warehouse]';
      } else {
        $this->values['address']['warehouse'] = $this->defaultStringFilter($data['warehouse']['warehouse']);
      }
    }

    if (!in_array($data['payment'], \App\Model\Order::getAllowedPaymentOptions())) {
      $this->errors[] = 'payment';
      return false;

    } else {
      $this->values['paymentMethod'] = $data['payment'];
    }

    $this->values['payment'] = [];

    if ($data['payment'] === \App\Model\Order::PAYMENT_BANK_INDIVIDUAL) {

      if (!StringLength::valid(min: 2, max: 100)->isValid($data['bankIndividual']['firstName'])) {
        $this->errors[] = 'bankIndividual[firstName]';
      } else {
        $this->values['payment']['firstName'] = $this->defaultStringFilter($data['bankIndividual']['firstName']);
      }

      if (!StringLength::valid(min: 2, max: 100)->isValid($data['bankIndividual']['lastName'])) {
        $this->errors[] = 'bankIndividual[lastName]';
      } else {
        $this->values['payment']['lastName'] = $this->defaultStringFilter($data['bankIndividual']['lastName']);
      }

      if (!StringLength::valid(min: 2, max: 100)->isValid($data['bankIndividual']['patronymic'])) {
        $this->errors[] = 'bankIndividual[patronymic]';
      } else {
        $this->values['payment']['patronymic'] = $this->defaultStringFilter($data['bankIndividual']['patronymic']);
      }

      if (!Phone::valid()->isValid($data['bankIndividual']['phone'])) {
        $this->errors[] = 'bankIndividual[phone]';
      } else {
        $this->values['payment']['phone'] = \Air\Filter\Phone::clean($data['bankIndividual']['phone']);
      }

    } else if ($data['payment'] === \App\Model\Order::PAYMENT_BANK_ENTITY) {

      if (!StringLength::valid(min: 2, max: 200)->isValid($data['bankEntity']['edrpou'])) {
        $this->errors[] = 'bankEntity[edrpou]';
      } else {
        $this->values['payment']['edrpou'] = intval($data['bankEntity']['edrpou']);
      }

      if (!StringLength::valid(min: 2, max: 200)->isValid($data['bankEntity']['entityName'])) {
        $this->errors[] = 'bankEntity[entityName]';
      } else {
        $this->values['payment']['entityName'] = $this->defaultStringFilter($data['bankEntity']['entityName']);
      }
    }

    return !count($this->errors);
  }

  /**
   * @return array
   */
  public function getValues(): array
  {
    return $this->values;
  }

  /**
   * @return array
   */
  public function getErrors(): array
  {
    return $this->errors;
  }
}