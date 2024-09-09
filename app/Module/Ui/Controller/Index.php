<?php

declare(strict_types=1);

namespace App\Module\Ui\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Form\Exception\FilterClassWasNotFound;
use Air\Form\Exception\ValidatorClassWasNotFound;
use Air\Model\Exception\CallUndefinedMethod;
use Air\Model\Exception\ConfigWasNotProvided;
use Air\Model\Exception\DriverClassDoesNotExists;
use Air\Model\Exception\DriverClassDoesNotExtendsFromDriverAbstract;
use Air\Model\Meta\Exception\CollectionCantBeWithoutPrimary;
use Air\Model\Meta\Exception\CollectionCantBeWithoutProperties;
use Air\Model\Meta\Exception\CollectionNameDoesNotExists;
use Air\Model\Meta\Exception\PropertyIsSetIncorrectly;
use App\Model\About;
use App\Model\Contact;
use App\Model\PaymentDelivery;
use App\Model\UserRequest;
use Exception;
use ReflectionException;

class Index extends Base
{
  public function index(): void
  {
  }

  /**
   * @return void
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws Exception
   */
  public function paymentDelivery(): void
  {
    $paymentDelivery = PaymentDelivery::one();
    $this->getView()->setMeta($paymentDelivery->meta);

    $this->getView()->setVars([
      'title' => $paymentDelivery->title,
      'richContent' => $paymentDelivery->richContent
    ]);

    $this->getView()->setScript('index/service-page');
  }

  /**
   * @return void
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws Exception
   */
  public function about(): void
  {
    $about = About::one();
    $this->getView()->setMeta($about->meta);

    $this->getView()->setVars([
      'title' => $about->title,
      'richContent' => $about->richContent
    ]);

    $this->getView()->setScript('index/service-page');
  }

  /**
   * @return array|void
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws FilterClassWasNotFound
   * @throws ValidatorClassWasNotFound
   * @throws CollectionCantBeWithoutPrimary
   * @throws CollectionCantBeWithoutProperties
   * @throws CollectionNameDoesNotExists
   * @throws PropertyIsSetIncorrectly
   * @throws ReflectionException
   * @throws Exception
   */
  public function contact()
  {
    if ($this->getRequest()->isPost()) {
      $this->getView()->setLayoutEnabled(false);
      $this->getView()->setAutoRender(false);

      $form = new \App\Module\Ui\Form\Contact();

      if ($form->isValid($this->getParams())) {
        (new UserRequest($form->getValues()))->save();
        return;
      }
      $this->getResponse()->setStatusCode(400);
      return $form->getErrorFields();
    }

    $contact = Contact::one();

    $this->getView()->setMeta($contact->meta);
    $this->getView()->assign('contact', $contact);
  }
}