<?php
/**
 * @package     MJ.Module
 * @subpackage  Comments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   string           	$cssClass        Module CSS class
 * @var   string           	$cssId           Module CSS identifier
 * @var   object           	$module          Module data as it comes from Joomla
 * @var   MjModule          $moduleInstance  Module rendering this layout
 * @var   JRegistry        	$params          Object with the module config
 */

?>

<div class="list-group">
  <?php foreach ($comments as $comment) : ?>
    <a href="#" class="list-group-item">
      <h4 class="list-group-item-heading">
        <?php echo $comment->visitor_name; ?>
      </h4>
      <p class="list-group-item-text">
        <?php echo $comment->visitor_comments; ?>
      </p>
    </a>
  <?php endforeach; ?>
</div>
