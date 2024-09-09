<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\FaIcon;
use Air\Form\Element\Icon;
use Air\Form\Element\MultipleGroup;
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
 * @mod-header {"title": "Увімкнено", "type": "bool", "by": "enabled"}
 *
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class ShowcaseAdv extends Multiple
{
  /**
   * @param \App\Model\ShowcaseAdv $model
   * @return Form
   *
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new MultipleGroup('items', [
          'label' => 'Елементи',
          'elements' => [
            new FaIcon('faIcon', ['label' => 'Iконка']),
            new Text('title', ['label' => 'Назва']),
            new Text('description', ['label' => 'Опис']),
          ]
        ])
      ]
    ]);
  }
}
