<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Crud\Controller\Multiple;

/**
 * @mod-manageable true
 * @mod-items-per-page 50
 *
 * @mod-header {"title": "Зобр.", "by": "image", "type": "image"}
 * @mod-header {"title": "Назва", "by": "title"}
 * @mod-header {"title": "Увімкнено", "by": "enabled", "type": "bool"}
 *
 * @mod-filter {"type": "search", "by": ["title", "description"]}
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 */
class Brand extends Multiple
{
}
