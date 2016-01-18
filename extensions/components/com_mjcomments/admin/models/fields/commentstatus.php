<?php
/**
 * @package     MJ.Component
 * @subpackage  mjcomments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('predefinedlist');

/**
 * Form Field to load a list of states
 *
 */
class JFormFieldCommentStatus extends JFormFieldPredefinedList
{
	/**
	 * The form field type.
	 * @var    string
	 */
	public $type = 'CommentStatus';

	/**
	 * Available statuses
	 * @var  array
	 */
	protected $predefinedOptions = array(
		'0'  => 'JUNPUBLISHED',
		'1'  => 'JPUBLISHED',
		'*'  => 'JALL'
	);
}
