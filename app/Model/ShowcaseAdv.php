<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use App\Type\Adv;

/**
 * @collection ShowcaseAdv
 *
 * @property string $id
 *
 * @property string $title
 * @property Adv[] $items
 *
 * @property boolean $enabled
 * @property Language $language
 */
class ShowcaseAdv extends ModelAbstract
{
}