<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use App\Type\Banner;

/**
 * @collection ShowcaseProducts
 *
 * @property string $id
 * @property string $title
 *
 * @property Banner $desktopBanner
 * @property Banner $mobileBanner
 *
 * @property Product[] $products
 *
 * @property integer $position
 * @property boolean $enabled
 *
 * @property Language $language
 */
class ShowcaseProducts extends ModelAbstract
{
}

