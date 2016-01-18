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
 * Comments form controller class
 *
 */
class MjcommentsControllerCommentform extends JControllerForm
{
  /**
	 * Set the redirect view list.
	 *
	 * @var    string
	 */
	protected $view_list = 'commentslist';
}
