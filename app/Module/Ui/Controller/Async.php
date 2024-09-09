<?php

declare(strict_types=1);

namespace App\Module\Ui\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Model\Language;
use Air\Crud\Model\Phrase;
use Air\Map;
use Air\Model\Exception\CallUndefinedMethod;
use Air\Model\Exception\ConfigWasNotProvided;
use Air\Model\Exception\DriverClassDoesNotExists;
use Air\Model\Exception\DriverClassDoesNotExtendsFromDriverAbstract;

class Async extends Base
{
  public function categories(): void
  {
  }

  public function mobileMenu(): void
  {
  }

  /**
   * @param Language|null $lang
   * @return array
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   */
  public function phrases(?Language $lang = null): array
  {
    if (!$lang) {
      $lang = Language::getLanguage();
    }

    $phrases = [];
    foreach (Phrase::all(['language' => $lang]) as $item) {
      $phrases[$item->key] = $item->value;
    }
    return $phrases;
  }
}