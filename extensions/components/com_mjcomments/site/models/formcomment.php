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
	 * @var    object  The client form data.
	 */
	protected $data;

	/**
	 * Method to get the form data.
	 *
	 * @return  mixed  Data object on success, false on failure.
	 *
	 */
	public function getData()
	{
		if ($this->data === null)
		{
			$this->data = new stdClass;
			$app 				= JFactory::getApplication();

			// Override the base client data with any data in the session.
			$temp = (array) $app->getUserState('com_mjcomments.formcomment.data', array());

			foreach ($temp as $k => $v)
			{
				$this->data->$k = $v;
			}
		}

		return $this->data;
	}

	/**
	 * Get database table
	 *
	 * @param   string  $name  Instance name of the table to load
	 *
	 * @return  JTable
	 */
	public function getTable($name = 'Mjcomments', $prefix = 'MjcommentsTable', $config = array())
	{
        return JTable::getInstance($name, $prefix, $config);
	}

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

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $temp  The form data.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 */
	public function comment($temp)
	{
		$data = (array) $this->getData();

		// Merge in the comment data.
		foreach ($temp as $k => $v)
		{
			$data[$k] = $v;
		}

		$data['state'] 						= 1;
		$data['content_id']				= (int) $data['content_id'];
		$data['visitor_email'] 		= JStringPunycode::emailToPunycode($data['visitor_email']);
		$data['visitor_comments']	= stripcslashes(nl2br(htmlentities($data['visitor_comments'])));
		$data['created'] 					= JFactory::getDate()->toSql();

		// Get a level row instance.
		$table = $this->getTable();

		if ($table->save($data) === false)
		{
			return false;
		}

		return true;
	}
}
