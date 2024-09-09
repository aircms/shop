<?php

declare(strict_types=1);

namespace App\Module\Ui\View\Helper;

use Air\Core\Exception\ClassWasNotFound;
use Air\Crud\Model\Phrase;
use Air\Model\Exception\CallUndefinedMethod;
use Air\Model\Exception\ConfigWasNotProvided;
use Air\Model\Exception\DriverClassDoesNotExists;
use Air\Model\Exception\DriverClassDoesNotExtendsFromDriverAbstract;
use Air\Model\Meta\Exception\CollectionCantBeWithoutPrimary;
use Air\Model\Meta\Exception\CollectionCantBeWithoutProperties;
use Air\Model\Meta\Exception\CollectionNameDoesNotExists;
use Air\Model\Meta\Exception\PropertyIsSetIncorrectly;
use ReflectionException;

class Common
{
  /**
   * @param float $price
   * @return string
   * @throws ClassWasNotFound
   * @throws CallUndefinedMethod
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws CollectionCantBeWithoutPrimary
   * @throws CollectionCantBeWithoutProperties
   * @throws CollectionNameDoesNotExists
   * @throws PropertyIsSetIncorrectly
   * @throws ReflectionException
   */
  public static function price(float $price): string
  {
    return number_format(num: $price, thousands_separator: ' ') . ' ' . Phrase::t('грн');
  }

  /**
   * @param int $timestamp
   * @return string
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws CollectionCantBeWithoutPrimary
   * @throws CollectionCantBeWithoutProperties
   * @throws CollectionNameDoesNotExists
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws PropertyIsSetIncorrectly
   * @throws ReflectionException
   */
  public static function date(int $timestamp): string
  {
    return Phrase::t(date('F', $timestamp)) . ' ' . date('j, Y', $timestamp);
  }
}