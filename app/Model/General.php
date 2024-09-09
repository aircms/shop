<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\Meta;

/**
 * @collection General
 *
 * @property string $id
 *
 * @property string $title
 * @property array $socials
 * @property string $copyright
 * @property array $phones
 * @property string $address
 * @property Meta $meta
 *
 * @property Language $language
 */
class General extends ModelAbstract
{
}