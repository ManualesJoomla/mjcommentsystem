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
 * @var   MjModule  				$moduleInstance  Module rendering this layout
 * @var   JRegistry        	$params          Object with the module config
 */

$moduleInstance->loadScript('script_mod_mjcomments.js');
$moduleInstance->loadStylesheet('style_mod_mjcomments.css');

$cssId = $cssId ? 'id="' . $cssId . '"' : null;
?>
<div class="<?php echo $cssClass; ?> latest" <?php echo $cssId; ?>>
	<?php echo $moduleInstance->setLayout('latest_basic')->render($displayData); ?>
</div>
