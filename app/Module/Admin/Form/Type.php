<?php

declare(strict_types=1);

namespace App\Module\Admin\Form;

use Air\Form\Element\Storage;
use Air\Form\Element\Text;

final class Type
{
  /**
   * @return array
   */
  public static function desktopBanner(): array
  {
    return [
      new Text('url', [
        'label' => 'Посилання'
      ]),
      new Storage('file', [
        'label' => 'Вертикальне медіа',
      ]),
    ];
  }

  /**
   * @return array
   */
  public static function mobileBanner(): array
  {
    return [
      new Text('url', [
        'label' => 'Посилання'
      ]),
      new Storage('file', [
        'label' => 'Горизонтальне медіа',
      ]),
    ];
  }
}