<?php
/**
 * @package     MJ.Plugin
 * @subpackage  Content.Mjformcomment
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

extract($displayData);

?>

<?php if ($data['view'] == 'com_content.article') : ?>
  <div id="mjformcomments">
    <?php echo JLayoutHelper::render('default_form', compact('data'), __DIR__); ?>
    <?php echo JLayoutHelper::render('default_list', compact('data'), __DIR__); ?>
  </div>
<?php endif; ?>
