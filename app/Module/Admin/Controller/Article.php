<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Controller\Multiple;
use Air\Form\Element\DateTime;
use Air\Form\Element\Model;
use Air\Form\Element\MultipleModel;
use Air\Form\Element\Storage;
use Air\Form\Element\Text;
use Air\Form\Form;
use Air\Form\Generator;
use Air\Model\Meta\Exception\PropertyWasNotFound;

/**
 * @mod-manageable true
 * @mod-sorting {"publishedAt": -1}
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Зобр.", "by": "image", "type": "image"}
 * @mod-header {"title": "Назва", "by": "title"}
 * @mod-header {"title": "Категорія", "by": "category", "type": "model", "field": "title"}
 * @mod-header {"title": "Опубліковано", "by": "publishedAt", "type": "dateTime"}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 *
 * @mod-filter {"type": "search", "by": ["title", "description", "url"]}
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 * @mod-filter {"type": "model", "title": "Категорія", "by": "category", "field": "title", "model": "\\App\\Model\\ArticleCategory"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class Article extends Multiple
{
  /**
   * @param \App\Model\Article $model
   * @return Form
   * @throws PropertyWasNotFound
   * @throws ClassWasNotFound
   */
  protected function getForm($model = null): Form
  {
    return Generator::full($model, [
      'Загальні' => [
        new DateTime('publishedAt', [
          'label' => 'Дата публікації'
        ]),
        new Model('category', [
          'label' => 'Категорія'
        ]),
        new MultipleModel('tags', [
          'label' => 'Теги'
        ])
      ],
      'Попередній перегляд' => [
        new Text('title'),
        new Text('description'),
        new Storage('image'),
      ],
      'Рекомендовані статті' => [
        new MultipleModel('articles', [
          'label' => 'Рекомендовані статті'
        ])
      ],
    ]);
  }
}
