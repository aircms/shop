<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\Group;
use Air\Form\Element\MultipleModel;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;
use App\Module\Admin\Form\Type;

/**
 * @mod-manageable true
 * @mod-sortable title
 *
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 * @mod-header {"title": "Увімкнено", "type": "bool", "by": "enabled"}
 *
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class ShowcaseProducts extends Multiple
{
  /**
   * @param \App\Model\ShowcaseProducts $model
   * @return Form
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Товари' => [
        new MultipleModel('products', [
          'label' => 'Товари'
        ])
      ],
      'Баннер' => [
        new Group('desktopBanner', [
          'label' => 'Вертикальний баннер',
          'description' => 'Для десктопних пристроїв',
          'elements' => Type::desktopBanner()
        ]),
        new Group('mobileBanner', [
          'label' => 'Горизонтальний баннер',
          'description' => 'Для мобільних пристроїв',
          'elements' => Type::mobileBanner()
        ]),
      ]
    ]);
  }
}
