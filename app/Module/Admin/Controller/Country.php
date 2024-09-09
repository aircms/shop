<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Crud\Controller\Multiple;

/**
 * @mod-sorting {"title": 1}
 * @mod-items-per-page 100
 * @mod-manageable true
 *
 * @mod-header {"title": "Зобр.", "by": "image", "type": "image"}
 * @mod-header {"title": "Назва", "by": "title"}
 * @mod-header {"title": "ISO 3166-1 alpha-2", "by": "code2"}
 * @mod-header {"title": "ISO 3166-1 alpha-3", "by": "code3"}
 *
 * @mod-filter {"type": "search", "by": ["title", "code2", "code3", "search"]}
 */
class Country extends Multiple
{
}
