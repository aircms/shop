<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\Meta;

/**
 * @collection BlogSettings
 *
 * @property string $id
 * @property string $title
 *
 * @property ArticleTag[] $tags
 * @property Meta $meta
 * @property Language $language
 */
class BlogSettings extends ModelAbstract
{
}