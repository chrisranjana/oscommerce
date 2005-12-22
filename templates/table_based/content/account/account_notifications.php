<?php
/*
  $Id:account_notifications.php 187 2005-09-14 14:22:13 +0200 (Mi, 14 Sep 2005) hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License
*/
?>

<?php echo tep_image(DIR_WS_IMAGES . 'table_background_account.gif', $osC_Template->getPageTitle(), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'class="pageIcon"'); ?>

<h1><?php echo $osC_Template->getPageTitle(); ?></h1>

<form name="account_notifications" action="<?php echo tep_href_link(FILENAME_ACCOUNT, 'notifications=save', 'SSL'); ?>" method="post">

<div class="moduleBox">
  <div class="outsideHeading"><?php echo MY_NOTIFICATIONS_TITLE; ?></div>

  <div class="content">
    <?php echo MY_NOTIFICATIONS_DESCRIPTION; ?>
  </div>
</div>

<div class="moduleBox">
  <div class="outsideHeading"><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></div>

  <div class="content">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="moduleRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);" onclick="checkBox('product_global');">
        <td width="30"><?php echo osc_draw_checkbox_field('product_global', '1', $Qglobal->value('global_product_notifications'), 'onclick="checkBox(\'product_global\');"'); ?></td>
        <td><b><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td width="30">&nbsp;</td>
        <td><?php echo GLOBAL_NOTIFICATIONS_DESCRIPTION; ?></td>
      </tr>
    </table>
  </div>
</div>

<?php
  if ($Qglobal->valueInt('global_product_notifications') != '1') {
?>

<div class="moduleBox">
  <div class="outsideHeading"><?php echo NOTIFICATIONS_TITLE; ?></div>

  <div class="content">

<?php
    if ($osC_Template->hasCustomerProductNotifications($osC_Customer->getID())) {
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main" colspan="2"><?php echo NOTIFICATIONS_DESCRIPTION; ?></td>
      </tr>

<?php
      $counter = 0;

      $Qproducts = $osC_Template->getListing();

      while ($Qproducts->next()) {
?>

      <tr class="moduleRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);" onclick="checkBox('products[<?php echo $counter; ?>]');">
        <td width="30"><?php echo osc_draw_checkbox_field('products[' . $counter . ']', $Qproducts->valueInt('products_id'), true, 'onclick="checkBox(\'products[' . $counter . ']\');"'); ?></td>
        <td><b><?php echo $Qproducts->value('products_name'); ?></b></td>
      </tr>

<?php
        $counter++;
      }
?>

    </table>

<?php
    } else {
      echo NOTIFICATIONS_NON_EXISTING;
    }
?>

  </div>
</div>

<?php
  }
?>

<div class="submitFormButtons">
  <span style="float: right;"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></span>

  <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

</form>