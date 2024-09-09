<?php

return [
  '/' => [],

  '/payment-delivery' => ['action' => 'paymentDelivery'],
  '/about' => ['action' => 'about'],
  '/contact' => ['action' => 'contact'],

  '/async/categories' => ['controller' => 'async', 'action' => 'categories'],
  '/async/mobile-menu' => ['controller' => 'async', 'action' => 'mobileMenu'],
  '/async/phrases' => ['controller' => 'async', 'action' => 'phrases'],

  '/catalog' => ['controller' => 'catalog'],
  '/product/:product' => ['controller' => 'product', 'action' => 'index'],
  '/productQuickView/:product' => ['controller' => 'product', 'action' => 'quickView'],

  '/cart/preview' => ['controller' => 'cart', 'action' => 'preview'],
  '/cart/add' => ['controller' => 'cart', 'action' => 'add',],
  '/cart/remove' => ['controller' => 'cart', 'action' => 'remove',],

  '/cart/plus' => ['controller' => 'cart', 'action' => 'minusPlus',],
  '/cart/minus' => ['controller' => 'cart', 'action' => 'minusPlus',],

  '/cart/coupon' => ['controller' => 'cart', 'action' => 'coupon',],
  '/cart/remove-coupon' => ['controller' => 'cart', 'action' => 'removeCoupon',],
  '/cart/warehouses' => ['controller' => 'cart', 'action' => 'warehouses',],
  '/cart/saveOrderData' => ['controller' => 'cart', 'action' => 'saveOrderData',],

  '/cart' => ['controller' => 'cart',],
  '/cart/checkout' => ['controller' => 'cart', 'action' => 'checkout'],
  '/cart/checkout/callback' => ['controller' => 'cart', 'action' => 'checkoutCallback'],
  '/cart/checkout/thank-you' => ['controller' => 'cart', 'action' => 'checkoutThankYou'],

  '/blog' => ['controller' => 'blog'],
  '/article/:article' => ['controller' => 'blog', 'action' => 'article'],
];