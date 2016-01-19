<?php
/**
 * @package     Epale
 * @subpackage  Library
 *
 * @copyright   Copyright (C) 2016 Carlos Rodriguez - All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

define('EPALE_LIB_PATH', __DIR__);

// Global libraries autoloader
JLoader::registerPrefix('Epale', EPALE_LIB_PATH);
