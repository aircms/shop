<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\Model;
use Air\Form\Element\MultipleGroup;
use Air\Form\Element\MultipleModel;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;
use App\Module\Admin\Form\Type;

/**
 * @mod-manageable true
 * @mod-sortable title
 * @mod-items-per-page 50
 *
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Зобр.", "by": "image", "type": "image"}
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Іконка", "by": "faIcon", "type": "faIcon"}
 * @mod-header {"title": "Батьківська категорія", "by": "parent", "type": "model", "field": "title"}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 * @mod-header {"title": "Увімкнено", "by": "enabled", "type": "bool"}
 *
 * @mod-filter {"type": "search", "by": ["title", "description", "url"]}
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 * @mod-filter {"type": "model", "title": "Батьківська категорія", "by": "parent", "field": "title", "model": "\\App\\Model\\Category"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class Category extends Multiple
{
  /**
   * @param \App\Model\Category $model
   * @return Form
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new Model('parent', ['label' => 'Батьківська категорія']),
      ],
      'Фільтри' => [
        new MultipleModel('filters', ['label' => 'Фільтри'])
      ],
      'Бренди' => [
        new MultipleModel('brands', ['label' => 'Бренди'])
      ],
      'Країни виробники' => [
        new MultipleModel('countries', ['label' => 'Країни виробники'])
      ],
      'Банери' => [
        new MultipleGroup('banners', [
          'label' => 'Банери',
          'allowNull' => true,
          'elements' => Type::mobileBanner()
        ])
      ]
    ]);
  }
}
