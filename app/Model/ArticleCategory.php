<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\FaIcon;
use Air\Type\Meta;

/**
 * @collection ArticleCategory
 *
 * @property string $id
 *
 * @property string $url
 * @property string $title
 * @property string $description
 * @property FaIcon $faIcon
 *
 * @property integer $position
 *
 * @property Meta $meta
 * @property Language $language
 */
class ArticleCategory extends ModelAbstract
{
}