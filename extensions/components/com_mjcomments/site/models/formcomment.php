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
 * Form model class.
 *
 */
class MjcommentsModelFormcomment extends JModelForm
{
  /**
	 * Method to get the form.
	 *
	 * @param   array    $data       An optional array of data for the form to interogate.
	 * @param   boolean  $loadData   True if the form is to load its own data (default case), false if not.
	 *
	 * @return  JForm  A JForm object on success, false on failure
	 *
	 */
	public function getForm($data = array(), $loadData = false)
	{
		// Get the form.
		$form = $this->loadForm('com_mjcomments.formcomment', 'formcomment', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}
}
