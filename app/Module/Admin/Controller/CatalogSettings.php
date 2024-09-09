<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\MultipleGroup;
use Air\Form\Element\MultipleModel;
use Air\Form\Element\Storage;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;
use App\Module\Admin\Form\Type;

/**
 * @mod-manageable true
 *
 * @mod-controls {"type": "copy"}
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 */
class CatalogSettings extends Multiple
{
  /**
   * @param \App\Model\CatalogSettings $model
   * @return Form
   * @throws PropertyWasNotFound|ClassWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new Storage('noImage', [
          'label' => 'Зображення',
          'description' => 'Зображення для товарів, які не мають свого зображення',
        ]),
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
