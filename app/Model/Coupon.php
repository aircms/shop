<?php

declare(strict_types=1);

namespace App\Model;

use Air\Model\ModelAbstract;

/**
 * @collection Coupon
 *
 * @property string $id
 * @property boolean $enabled
 *
 * @property string $code
 * @property boolean $isMultiple
 * @property array $usages
 *
 * @property string $type
 * @property float $value
 */
class Coupon extends ModelAbstract
{
  const string TYPE_FIXED = 'fixed';
  const string TYPE_PERCENTAGE = 'percentage';
  const string TYPE_INFO = 'info';

  /**
   * @return bool
   */
  public function canItBeUsed(): bool
  {
    if (!$this->enabled) {
      return false;
    }

    if (!$this->isMultiple && count($this->usages)) {
      return false;
    }

    return true;
  }
}