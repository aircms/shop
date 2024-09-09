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
 * @mod-sortable title
 * @mod-sorting {"createdAt": -1}
 * @mod-items-per-page 10
 *
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 * @mod-header {"title": "Увімкнено", "type": "bool", "by": "enabled"}
 *
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class ShowcaseTopCategories extends Multiple
{
  /**
   * @param \App\Model\ShowcaseTopCategories $model
   * @return Form
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new MultipleModel('categories', ['label' => 'Категорія'])
      ]
    ]);
  }
}
