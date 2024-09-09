<?php

declare(strict_types=1);

namespace App\Type;

use Air\Type\TypeAbstract;
use App\Model\Product;

class CartItem extends TypeAbstract
{
  /**
   * @var int|null
   */
  public ?int $count = null;

  /**
   * @var Product|null
   */
  public Product|null $product = null;

  /**
   * @return int|null
   */
  public function getCount(): ?int
  {
    return $this->count;
  }

  /**
   * @return Product|null
   */
  public function getProduct(): ?Product
  {
    return $this->product;
  }

  /**
   * @param int|null $count
   */
  public function setCount(?int $count): void
  {
    $this->count = $count;
  }

  /**
   * @param Product|null $product
   */
  public function setProduct(?Product $product): void
  {
    $this->product = $product;
  }

  /**
   * @return array
   */
  public function toRaw(): array
  {
    return [
      'count' => $this->getCount(),
      'product' => $this->getProduct()?->id
    ];
  }
}