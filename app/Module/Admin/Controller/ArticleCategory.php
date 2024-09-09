<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Crud\Controller\Multiple;

/**
 * @mod-manageable true
 * @mod-sortable title
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Іконка", "by": "faIcon", "type": "faIcon"}
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 */
class ArticleCategory extends Multiple
{
}
