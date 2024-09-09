<?php

declare(strict_types=1);

namespace App\Model;

use Air\Model\ModelAbstract;
use Air\Type\File;

/**
 * @collection Country
 *
 * @property string $id
 * @property string $url
 *
 * @property string $title
 * @property string $code2
 * @property string $code3
 * @property File $image
 *
 * @property string $search
 * @property string $log
 */
class Country extends ModelAbstract
{
}

