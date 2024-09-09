<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Model\Exception\CallUndefinedMethod;
use Air\Model\Exception\ConfigWasNotProvided;
use Air\Model\Exception\DriverClassDoesNotExists;
use Air\Model\Exception\DriverClassDoesNotExtendsFromDriverAbstract;
use App\Helper\Checkout;

/**
 * @mod-sorting {"createAt": -1}
 */
class Order extends Multiple
{
  /**
   * @return array
   */
  protected function getFilter(): array
  {
    return [
      [
        'type' => 'search',
        'by' => ['firstName', 'lastName', 'phone', 'email', 'number']
      ],
      [
        'type' => 'select',
        'by' => 'deliveryMethod',
        'options' => [
          ['title' => 'Доставка до будинку Новою Поштою', 'value' => \App\Model\Order::DELIVERY_NEW_POST_DOOR,],
          ['title' => 'Забрати зі складу Новою Поштою', 'value' => \App\Model\Order::DELIVERY_NEW_POST_WAREHOUSE,],
          ['title' => 'Доставка до дому', 'value' => \App\Model\Order::DELIVERY_DOOR,],
          ['title' => 'Самовивіз зі складу', 'value' => \App\Model\Order::DELIVERY_WAREHOUSE,],
        ]
      ],
      [
        'type' => 'select',
        'by' => 'paymentMethod',
        'options' => [
          ['title' => 'При отриманні', 'value' => \App\Model\Order::PAYMENT_CASH,],
          ['title' => 'Mono pay', 'value' => \App\Model\Order::PAYMENT_ONLINE,],
          ['title' => 'Фіз. лице', 'value' => \App\Model\Order::PAYMENT_BANK_INDIVIDUAL,],
          ['title' => 'Юр. лице', 'value' => \App\Model\Order::PAYMENT_BANK_ENTITY,],
        ]
      ],
      [
        'type' => 'select',
        'by' => 'status',
        'value' => \App\Model\Order::PAYMENT_STATUS_SUCCESS,
        'options' => [
          ['title' => 'Не авторизовано', 'value' => \App\Model\Order::PAYMENT_STATUS_NOT_AUTHORIZED,],
          ['title' => 'Не підтверджено', 'value' => \App\Model\Order::PAYMENT_STATUS_NOT_CONFIRMED,],
          ['title' => 'В процесі', 'value' => \App\Model\Order::PAYMENT_STATUS_IN_PROGRESS,],
          ['title' => 'При отриманні', 'value' => \App\Model\Order::PAYMENT_STATUS_PAYMENT_ON_DELIVERY,],
          ['title' => 'Успіх', 'value' => \App\Model\Order::PAYMENT_STATUS_SUCCESS,],
          ['title' => 'Не успіх', 'value' => \App\Model\Order::PAYMENT_STATUS_FAIL,],
        ]
      ],
      [
        'type' => 'dateTime',
        'by' => 'createAt'
      ],
    ];
  }

  /**
   * @return array[]
   */
  protected function getHeader(): array
  {
    return [
      'number' => [
        'title' => 'Номер',
        'source' => function (\App\Model\Order $order) {
          return self::badge((string)$order->number, self::LIGHT);
        }
      ],
      'name' => [
        'title' => 'Ім\'я',
        'source' => function (\App\Model\Order $order) {
          return self::multiple([
            self::label($order->firstName, self::INFO),
            self::label($order->lastName, self::INFO),
          ]);
        }
      ],
      'contacts' => [
        'title' => 'Контакти',
        'source' => function (\App\Model\Order $order) {
          return self::multiple([
            self::link($order->phone, $order->phone, null, self::LIGHT),
            self::link($order->email, $order->email, null, self::LIGHT)
          ]);
        }
      ],
      'createAt' => [
        'title' => 'Дата, час',
        'type' => 'dateTime'
      ],
      'cart' => [
        'title' => 'Ціна',
        'source' => function (\App\Model\Order $order) {
          if ($order->coupon) {
            return self::multiple([
              self::badge($order->price . ' грн.', self::PRIMARY),
              self::badge($order->priceWithoutDiscount . ' грн.', self::DANGER),
            ]);
          }
          return self::badge($order->price . ' грн.', self::PRIMARY);
        }
      ],
      'deliveryMethod' => [
        'title' => 'Доставка',
        'source' => function (\App\Model\Order $order) {
          return match ($order->deliveryMethod) {
            \App\Model\Order::DELIVERY_DOOR => self::badge('Доставка до будинку'),
            \App\Model\Order::DELIVERY_WAREHOUSE => self::badge('Склад Нової Пошти'),
            default => self::badge('Самовивіз зі складу'),
          };
        },
      ],
      'paymentMethod' => [
        'title' => 'Оплата',
        'source' => function (\App\Model\Order $order) {
          return match ($order->paymentMethod) {
            \App\Model\Order::PAYMENT_CASH => self::badge('При отриманні'),
            \App\Model\Order::PAYMENT_ONLINE => self::badge('Mono pay'),
            \App\Model\Order::PAYMENT_BANK_INDIVIDUAL => self::badge('Фіз. лице'),
            default => self::badge('Юр. лице'),
          };
        },
      ],
      'status' => [
        'title' => 'Статус',
        'source' => function (\App\Model\Order $order) {
          return match ($order->status) {
            \App\Model\Order::PAYMENT_STATUS_NOT_AUTHORIZED => self::badge('Не авторизовано', self::DANGER),
            \App\Model\Order::PAYMENT_STATUS_NOT_CONFIRMED => self::badge('Не підтверджено', self::DANGER),
            \App\Model\Order::PAYMENT_STATUS_IN_PROGRESS => self::badge('В процесі', self::WARNING),
            \App\Model\Order::PAYMENT_STATUS_PAYMENT_ON_DELIVERY => self::badge('При отриманні', self::DANGER),
            \App\Model\Order::PAYMENT_STATUS_SUCCESS => self::badge('Успіх', self::SUCCESS),
            \App\Model\Order::PAYMENT_STATUS_FAIL => self::badge('Не успіх', self::DANGER),
          };
        }
      ]
    ];
  }

  /**
   * @return array[]
   */
  protected function getControls(): array
  {
    return [
      [
        'title' => 'Подробиці',
        'icon' => 'info-circle',
        'url' => [
          'controller' => 'order',
          'action' => 'details',
        ]
      ],
      [
        'title' => 'Оновити статус замовлення',
        'icon' => 'refresh',
        'confirm' => 'Оновити статус замовлення?',
        'url' => [
          'controller' => 'order',
          'action' => 'refresh',
        ]
      ]
    ];
  }

  /**
   * @param string $id
   * @return string
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   */
  public function refresh(string $id): string
  {
    $order = \App\Model\Order::one(['id' => $id]);

    if ($order->paymentMethod === \App\Model\Order::PAYMENT_ONLINE) {
      Checkout::update($order);
    }

    return self::navBack();
  }

  /**
   * @param string|null $id
   * @return void
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws \Exception
   */
  public function details(string $id = null): void
  {
    $this->getView()->assign('order', \App\Model\Order::one(['id' => $id]));
  }
}
