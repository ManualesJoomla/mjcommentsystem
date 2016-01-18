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
 * Methods supporting a list of comments records.
 *
 */
class MjcommentsModelCommentform extends JModelAdmin
{
  /**
	 * @var  string  The prefix to use with controller messages.
	 */
	protected $text_prefix = 'COM_MJCOMMENTS';

  /**
	 * The type alias for this content type.
	 *
	 * @var      string
	 */
	public $typeAlias = 'com_mjcomments.commentform';

  /**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 *
	 */
	public function getForm($data = array(), $loadData = true)
	{
    // Get the form.
		$form = $this->loadForm($this->typeAlias, 'commentform', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
			// Disable fields for display.
			$form->setFieldAttribute('state', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('state', 'filter', 'unset');
		}

		return $form;
  }

  /**
	 * Get database table
	 *
   * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable
	 */
	public function getTable($type = 'Mjcomments', $prefix = 'MjcommentsTable', $config = array())
	{
		$table = JTable::getInstance($type, $prefix, $config);
		$table->setColumnAlias('published', 'state');

		return $table;
	}

	/**
	 * Method to get a single comment.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk))
		{
			$item->content_id = (string) $item->content_id . ' - ' . $this->_getContentTitle($item->id);
		}

		return $item;
	}

	/**
	* Method to get the title of the content related.
	*
	* @param   integer  $pk  The id of the content related.
	*
	* @return  string  Title content.
	 */
	protected function _getContentTitle($pk)
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select($db->quoteName('title'))
				->from($db->quoteName('#__content'))
    		->where($db->quoteName('id') . ' = ' . $pk);

		$db->setQuery($query);
		$pkTitle = $db->loadResult();

		return $pkTitle;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app = JFactory::getApplication();
		$data = $app->getUserState('com_mjcomments.edit.commentform.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		$this->preprocessData($this->typeAlias, $data);

		return $data;
	}
}
