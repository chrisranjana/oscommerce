<?php
/*
  osCommerce Online Merchant $osCommerce-SIG$
  Copyright (c) 2010 osCommerce (http://www.oscommerce.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  namespace osCommerce\OM\Site\Shop\Application\Checkout\Action\Billing;

  use osCommerce\OM\ApplicationAbstract;
  use osCommerce\OM\Registry;
  use osCommerce\OM\OSCOM;
  use osCommerce\OM\ObjectInfo;

  class Address {
    public static function execute(ApplicationAbstract $application) {
      $OSCOM_Template = Registry::get('Template');
      $OSCOM_Service = Registry::get('Service');
      $OSCOM_Breadcrumb = Registry::get('Breadcrumb');
      $OSCOM_Customer = Registry::get('Customer');
      $OSCOM_ShoppingCart = Registry::get('ShoppingCart');

      global $osC_oiAddress;

      $application->setPageTitle(OSCOM::getDef('payment_address_heading'));
      $application->setPageContent('billing_address.php');

      $OSCOM_Template->addJavascriptFilename('templates/' . $OSCOM_Template->getCode() . '/javascript/checkout_payment_address.js');
      $OSCOM_Template->addJavascriptPhpFilename('includes/form_check.js.php');

      if ( $OSCOM_Service->isStarted('Breadcrumb') ) {
        $OSCOM_Breadcrumb->add(OSCOM::getDef('breadcrumb_checkout_payment_address'), OSCOM::getLink(null, null, 'Billing&Address', 'SSL'));
      }

      if ( !$OSCOM_Customer->isLoggedOn() ) {
        $osC_oiAddress = new ObjectInfo($OSCOM_ShoppingCart->getShippingAddress());
      }
    }
  }
?>
