<?php

declare(strict_types=1);

namespace App\Type;

use Air\Type\FaIcon;
use Air\Type\TypeAbstract;

class Adv extends TypeAbstract
{
  /**
   * @var FaIcon|null
   */
  public FaIcon|null $faIcon = null;

  /**
   * @var string|null
   */
  public ?string $title = null;

  /**
   * @var string|null
   */
  public ?string $description = null;

  /**
   * @return FaIcon|null
   */
  public function getFaIcon(): ?FaIcon
  {
    return $this->faIcon;
  }

  /**
   * @param FaIcon|null $faIcon
   */
  public function setFaIcon(?FaIcon $faIcon): void
  {
    $this->faIcon = $faIcon;
  }

  /**
   * @return string|null
   */
  public function getTitle(): ?string
  {
    return $this->title;
  }

  /**
   * @return string|null
   */
  public function getDescription(): ?string
  {
    return $this->description;
  }
}