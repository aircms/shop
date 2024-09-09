<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\Checkbox;
use Air\Form\Element\Meta;
use Air\Form\Element\MultipleGroup;
use Air\Form\Element\MultipleText;
use Air\Form\Element\Text;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;
use Air\ThirdParty\MonoBank;
use Air\ThirdParty\NewPost;

/**
 * @mod-manageable true
 * @mod-controls {"type": "copy"}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 */
class ShopSettings extends Multiple
{
  /**
   * @param \App\Model\ShopSettings $model
   * @return Form
   * @throws PropertyWasNotFound
   * @throws ClassWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new Checkbox('phoneMaskEnabled', [
          'label' => 'Активувати маску для введення номера телефону'
        ]),
        new Text('phoneMask', [
          'label' => 'Маска номеру телефона',
          'description' => 'Наприклад: +38 000 000 00 00'
        ])
      ],
      'Доставка' => [
        new Text('newPostApiKey', [
          'label' => 'API-ключ "Нова Пошта"',
          'allowNull' => true,
          'validators' => [[
            'message' => 'API-ключ недійсний',
            'isValid' => function (string $newPostApiKey) {
              if (!strlen($newPostApiKey)) {
                return true;
              }
              return NewPost::isKeyValid($newPostApiKey);
            }
          ]]
        ]),
        new Checkbox('deliveryNewPostDoorEnabled', [
          'label' => 'Доставка додому за допомогою Нової Пошти',
          'description' => 'Для активації необхідно вказати API-ключ Нової Пошти'
        ]),
        new Checkbox('deliveryNewPostWarehouseEnabled', [
          'label' => 'Самовивіз із відділення Нової Пошти',
          'description' => 'Для активації необхідно вказати API-ключ Нової Пошти'
        ]),
        new Checkbox('deliveryDoorEnabled', [
          'label' => 'Доставка додому'
        ]),
        new Checkbox('deliveryWarehouseEnabled', [
          'label' => 'Самовивіз із нашого магазину'
        ]),
      ],
      'Оплата' => [
        new Text('monoApiKey', [
          'label' => 'API-ключ Mono-bank',
          'allowNull' => true,
          'validators' => [[
            'message' => 'API-ключ недійсний',
            'isValid' => function (string $monoApiKey) {
              if (!strlen($monoApiKey)) {
                return true;
              }
              return MonoBank::isValidKey($monoApiKey);
            }
          ]]
        ]),
        new Checkbox('paymentOnlineEnabled', [
          'label' => 'Оплата ОНЛАЙН',
          'description' => 'Для активації необхідно вказати API-ключ Mono-bank'
        ]),
        new Checkbox('paymentCashEnabled', [
          'label' => 'Оплата при отриманні замовлення'
        ]),
        new Checkbox('paymentBankIndividual', [
          'label' => 'Безготівковими для фізичних осіб'
        ]),
        new Checkbox('paymentBankEntity', [
          'label' => 'Безготівкою для юридичних осіб'
        ]),
      ],
      'Meta для Кошика' => [
        new Meta('cartMeta', [
          'label' => 'Meta',
          'description' => 'МЕТА-налаштування для сторінки кошика'
        ])
      ],
      'Meta для замовлення' => [
        new Meta('checkoutMeta', [
          'label' => 'Meta',
          'description' => 'МЕТА-налаштування для сторінки замовлення'
        ])
      ],
      'Meta для Дякую' => [
        new Meta('thankYouMeta', [
          'label' => 'Meta settings',
          'description' => 'МЕТА-налаштування для сторінки дякую'
        ])
      ],
      'Регіони' => [
        new MultipleGroup('regions', [
          'label' => 'Регіони',
          'allowNull' => false,
          'elements' => [
            new Text('title', ['label' => 'Назва області']),
            new MultipleText('cities', ['label' => 'Міста'])
          ]
        ])
      ]
    ]);
  }
}
