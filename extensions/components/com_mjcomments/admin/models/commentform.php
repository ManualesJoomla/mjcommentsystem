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
}
