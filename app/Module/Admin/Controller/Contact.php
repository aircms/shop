<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\Embed;
use Air\Form\Element\MultipleText;
use Air\Form\Element\Text;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;

/**
 * @mod-manageable true
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 */
class Contact extends Multiple
{
  /**
   * @param \App\Model\Contact $model
   * @return Form
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new MultipleText('phones', [
          'label' => 'Телефони'
        ]),
        new MultipleText('emails', [
          'label' => 'Имейли'
        ]),
        new Text('address', [
          'label' => 'Адреса'
        ]),
        new Embed('map', [
          'label' => 'Мапа'
        ])
      ]
    ]);
  }
}
