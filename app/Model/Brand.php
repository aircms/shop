<?php

declare(strict_types=1);

namespace App\Model;

use Air\Model\ModelAbstract;
use Air\Type\File;
use Air\Type\Meta;

/**
 * @collection Brand
 *
 * @property string $id
 *
 * @property string $title
 * @property string $description
 * @property File $image
 *
 * @property Meta $meta
 * @property string $url
 *
 * @property integer $position
 * @property boolean $enabled
 */
class Brand extends ModelAbstract
{
}

