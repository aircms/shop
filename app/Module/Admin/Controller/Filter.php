<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\MultipleText;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;

/**
 * @mod-manageable true
 * @mod-sorting {"title": -1}
 * @mod-items-per-page 50
 *
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 * @mod-header {"title": "Увімкнено", "type": "bool", "by": "enabled"}
 *
 * @mod-filter {"type": "search", "by": ["title", "subTitle", "description", "content"]}
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Enabled", "false": "Disabled", "value": "true"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class Filter extends Multiple
{
  /**
   * @param \App\Model\Filter $model
   * @return Form
   * @throws PropertyWasNotFound|ClassWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Значення' => [
        new MultipleText('values', [
          'label' => 'Значення',
        ])
      ]
    ]);
  }
}
