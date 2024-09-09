<?php

declare(strict_types=1);

namespace App\Module\Ui\Form;

use Air\Core\Exception\ClassWasNotFound;
use Air\Filter\Email;
use Air\Filter\HtmlSpecialChars;
use Air\Filter\Lowercase;
use Air\Filter\Phone;
use Air\Filter\Trim;
use Air\Form\Element\Text;
use Air\Form\Form;

final class Contact extends Form
{
  /**
   * @throws ClassWasNotFound
   */
  public function __construct()
  {
    parent::__construct([], [
      new Text('name', [
        'filters' => [
          Trim::class,
          HtmlSpecialChars::class,
        ]
      ]),
      new Text('phone', [
        'filters' => [
          Trim::class,
          Phone::class
        ],
        'validators' => [
          \Air\Validator\Phone::class
        ]
      ]),
      new Text('email', [
        'filters' => [
          Trim::class,
          Email::class,
          Lowercase::class
        ],
        'validators' => [
          \Air\Validator\Email::class
        ]
      ]),
    ]);
  }
}