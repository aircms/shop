<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\MultipleGroup;
use Air\Form\Element\Storage;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;
use App\Module\Admin\Form\Type;

/**
 * @mod-manageable true
 * @mod-sortable title
 * @mod-items-per-page 10
 *
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 * @mod-header {"title": "Увімкнено", "by": "enabled", "type": "bool"}
 *
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 */
class ShowcaseSlider extends Multiple
{
  /**
   * @param \App\Model\ShowcaseSlider $model
   * @return Form
   * @throws ClassWasNotFound
   * @throws PropertyWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new MultipleGroup('desktop', [
          'label' => 'Медіа для десктопних пристроїв',
          'elements' => Type::desktopBanner()
        ]),
        new MultipleGroup('mobile', [
          'label' => 'Медіа для мобільних пристроїв',
          'elements' => Type::mobileBanner()
        ]),
      ]
    ]);
  }
}
