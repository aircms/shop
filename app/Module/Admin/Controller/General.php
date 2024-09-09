<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\Meta;
use Air\Form\Element\MultipleKeyValue;
use Air\Form\Element\MultipleText;
use Air\Form\Element\Text;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;

/**
 * @mod-title Загальні налаштування
 * @mod-manageable true
 *
 * @mod-controls {"type": "copy"}
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 */
class General extends Multiple
{
  /**
   * @param $model
   * @return Form
   * @throws PropertyWasNotFound
   * @throws ClassWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new Text('copyright', ['label' => 'Копірайт текст']),
        new Text('address', ['label' => 'Адреса']),
      ],
      'Контакти та соці. мережі' => [
        new MultipleKeyValue('socials', [
          'label' => 'Cоці. мережі',
          'keyLabel' => 'Cоц. мережа',
          'valueLabel' => 'Посилання'
        ]),
        new MultipleText('phones', ['label' => 'Номери телефонів']),
      ],
      'Мета' => [
        new Meta('meta')
      ],
    ]);
  }
}
