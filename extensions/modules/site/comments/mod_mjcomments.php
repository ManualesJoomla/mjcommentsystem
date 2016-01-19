<?php
/**
 * @package     MJ.Module
 * @subpackage  Comments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

JLoader::import('epale.library');

// Register our own prefix
JLoader::registerPrefix('Mj', __DIR__);

// Load language
$lang = JFactory::getLanguage();
$lang->load('mod_mjcomments', __DIR__);

// Load instance
$moduleInstance = new MjModuleComments($params);

// Create unique css class
$cssId = !empty($module->id) ? $moduleInstance->getCssClass() . '-' . $module->id : null;

// Render layout
echo $moduleInstance->render(
	array(
		'module' => $module,
		'cssId'  => $cssId
	)
);
