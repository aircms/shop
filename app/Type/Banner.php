<?php

declare(strict_types=1);

namespace App\Type;

use Air\Type\File;
use Air\Type\TypeAbstract;

class Banner extends TypeAbstract
{
  /**
   * @var string|null
   */
  public ?string $url = null;

  /**
   * @var File|null
   */
  public ?File $file = null;

  /**
   * @return string|null
   */
  public function getUrl(): ?string
  {
    return $this->url;
  }

  /**
   * @param string|null $url
   */
  public function setUrl(?string $url): void
  {
    $this->url = $url;
  }

  /**
   * @return File|null
   */
  public function getFile(): ?File
  {
    return $this->file;
  }

  /**
   * @param File|null $file
   */
  public function setFile(?File $file): void
  {
    $this->file = $file;
  }
}