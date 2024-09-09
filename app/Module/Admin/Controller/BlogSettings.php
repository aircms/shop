<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\MultipleModel;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;

/**
 * @mod-manageable true
 *
 * @mod-controls {"type": "copy"}
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 */
class BlogSettings extends Multiple
{
  /**
   * @param \App\Model\ShopSettings $model
   * @return Form
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Теги' => [
        new MultipleModel('tags', [
          'label' => 'Теги'
        ])
      ]
    ]);
  }
}
