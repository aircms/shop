<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Crud\Controller\Multiple;

/**
 * @mod-manageable true*
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Назва", "by": "title", "sorting": true}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 *
 * @mod-filter {"type": "search", "by": ["title", "url"]}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class ArticleTag extends Multiple
{
}
