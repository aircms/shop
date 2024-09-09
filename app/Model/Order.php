<?php

declare(strict_types=1);

namespace App\Model;

use Air\Model\ModelAbstract;
use App\Type\CartItem;

/**
 * @collection Orders
 *
 * @property string $id
 * @property integer $number
 * @property CartItem[] $products
 * @property Coupon $coupon
 * @property float $price
 * @property float $priceWithoutDiscount
 * @property integer $count
 *
 * @property string $firstName
 * @property string $lastName
 * @property string $phone
 * @property string $email
 *
 * @property string $deliveryMethod
 * @property array $address
 *
 * @property string $paymentMethod
 * @property array $payment
 * @property array $acquiring
 *
 * @property string $status
 * @property integer $createAt
 */
class Order extends ModelAbstract
{
  const string DELIVERY_NEW_POST_DOOR = 'new-post-door';
  const string DELIVERY_NEW_POST_WAREHOUSE = 'new-post-warehouse';
  const string DELIVERY_DOOR = 'door';
  const string DELIVERY_WAREHOUSE = 'warehouse';

  const string PAYMENT_CASH = 'cash';
  const string PAYMENT_ONLINE = 'online';
  const string PAYMENT_BANK_INDIVIDUAL = 'bankIndividual';
  const string PAYMENT_BANK_ENTITY = 'bankEntity';

  const string PAYMENT_STATUS_NOT_AUTHORIZED = 'not_authorized';
  const string PAYMENT_STATUS_NOT_CONFIRMED = 'not_confirmed';
  const string PAYMENT_STATUS_IN_PROGRESS = 'in_process';
  const string PAYMENT_STATUS_PAYMENT_ON_DELIVERY = 'payment_on_delivery';
  const string PAYMENT_STATUS_SUCCESS = 'success';
  const string PAYMENT_STATUS_FAIL = 'fail';

  /**
   * @return string[]
   */
  public static function getAllowedDeliveryOptions(): array
  {
    return [
      self::DELIVERY_NEW_POST_DOOR,
      self::DELIVERY_NEW_POST_WAREHOUSE,
      self::DELIVERY_DOOR,
      self::DELIVERY_WAREHOUSE,
    ];
  }

  /**
   * @return string[]
   */
  public static function getAllowedPaymentOptions(): array
  {
    return [
      self::PAYMENT_CASH,
      self::PAYMENT_ONLINE,
      self::PAYMENT_BANK_INDIVIDUAL,
      self::PAYMENT_BANK_ENTITY
    ];
  }

  /**
   * @return string[]
   */
  public static function getAllowedPaymentStatuses(): array
  {
    return [
      self::PAYMENT_STATUS_NOT_AUTHORIZED,
      self::PAYMENT_STATUS_NOT_CONFIRMED,
      self::PAYMENT_STATUS_IN_PROGRESS,
      self::PAYMENT_STATUS_PAYMENT_ON_DELIVERY,
      self::PAYMENT_STATUS_SUCCESS,
      self::PAYMENT_STATUS_FAIL
    ];
  }
}