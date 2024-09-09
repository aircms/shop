<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\File;
use Air\Type\Meta;
use App\Type\Banner;

/**
 * @collection CatalogSettings
 *
 * @property string $id
 *
 * @property string $title
 * @property File $noImage
 * @property Meta $meta
 * @property Banner[] $banners
 * @property Filter[] $filters
 * @property Brand[] $brands
 * @property Country[] $countries
 *
 * @property Language $language
 */
class CatalogSettings extends ModelAbstract
{
}