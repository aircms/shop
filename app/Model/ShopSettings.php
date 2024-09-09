<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\Meta;
use App\Type\Region;

/**
 * @collection ShopSettings
 *
 * @property string $id
 *
 * @property string $phoneMaskEnabled
 * @property string $phoneMask
 *
 * @property string $newPostApiKey
 *
 * @property boolean $deliveryNewPostDoorEnabled
 * @property boolean $deliveryNewPostWarehouseEnabled
 * @property boolean $deliveryDoorEnabled
 * @property boolean $deliveryWarehouseEnabled
 *
 * @property boolean $paymentCashEnabled
 * @property boolean $paymentOnlineEnabled
 * @property string $monoApiKey
 *
 * @property boolean $paymentBankIndividual
 * @property boolean $paymentBankEntity
 *
 * @property Meta $cartMeta
 * @property Meta $checkoutMeta
 * @property Meta $thankYouMeta
 *
 * @property Region[] $regions
 *
 * @property Language $language
 */
class ShopSettings extends ModelAbstract
{
}