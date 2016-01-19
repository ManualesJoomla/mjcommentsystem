<?php
/**
 * @package     MJ.Component
 * @subpackage  mjcomments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

/**
 * Base controller class.
 *
 */
class MjcommentsController extends JControllerLegacy
{
  /**
	 * The default view for the display function.
	 *
	 * @var    string
	 */
	protected $default_view = 'commentslist';
}
