<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;

/**
 * @collection ShowcaseTopCategories
 *
 * @property string $id
 * @property boolean $enabled
 *
 * @property string $title
 * @property Category[] $categories
 * @property Language $language
 */
class ShowcaseTopCategories extends ModelAbstract
{
}