<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\Meta;

/**
 * @collection ArticleTag
 *
 * @property string $id
 *
 * @property string $url
 * @property string $title
 *
 * @property integer $position
 *
 * @property Meta $meta
 * @property Language $language
 */
class ArticleTag extends ModelAbstract
{
}