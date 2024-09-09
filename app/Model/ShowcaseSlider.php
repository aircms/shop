<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use App\Type\Banner;

/**
 * @collection ShowcaseSlider
 *
 * @property string $id
 * @property boolean $enabled
 *
 * @property string $title
 *
 * @property Banner[] $desktop
 * @property Banner[] $mobile
 *
 * @property integer $position
 * @property Language $language
 */
class ShowcaseSlider extends ModelAbstract
{

}

