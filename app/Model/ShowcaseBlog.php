<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;

/**
 * @collection ShowcaseBlog
 *
 * @property string $id
 *
 * @property string $title
 * @property Article[] $articles
 *
 * @property Language $language
 */
class ShowcaseBlog extends ModelAbstract
{
}