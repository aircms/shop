<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\Meta;

/**
 * @collection Contact
 *
 * @property string $id
 *
 * @property string $title
 * @property string $subTitle
 * @property string $description
 *
 * @property array $phones
 * @property array $emails
 *
 * @property string $address
 * @property string $map
 *
 * @property Meta $meta
 * @property Language $language
 */
class Contact extends ModelAbstract
{
}