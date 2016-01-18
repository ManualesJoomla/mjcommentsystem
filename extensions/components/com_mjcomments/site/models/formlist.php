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
 * Form list model class
 *
 */
class MjcommentsModelFormlist extends JModelList
{
  /**
	 * Constructor
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'content_id', 'a.content_id',
				'created', 'a.created',
				'state', 'a.state'
			);
		}

		parent::__construct($config);
	}

  /**
	 * Method to auto-populate the model state.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	protected function populateState($ordering = 'created', $direction = 'DESC')
	{
		// List state information
		$this->setState('list.ordering', $ordering);
		$this->setState('list.direction', $direction);
    $this->setState('list.start', 0);
    $this->setState('list.limit', 0);
	}

  /**
	 * Method to get a list of comment.
   *
   * @param   int  $content_id  ID of the article for load comments
	 *
	 * @return  mixed  An array of objects on success, false on failure.
	 *
	 */
	public function getCommentsArticle($content_id)
	{
		$this->setState('filter.content_id', $content_id);

		return $this->getItems();
	}

  /**
	 * Get the master query for retrieving a list of comment subject to the model state.
	 *
	 * @return  JDatabaseQuery
	 *
	 */
	protected function getListQuery()
	{
    $query = parent::getListQuery();

    // Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.content_id, a.visitor_name, a.state, ' .
				'a.visitor_email, a.visitor_comments, a.created'
			)
		);

    $query->from('#__mjcomments AS a');

    // Join over the article.
		$query->select('c.title AS content_title, c.alias AS content_alias, c.catid AS content_category, c.language AS content_language')
			->join('LEFT', '#__content AS c ON c.id = a.content_id');

    // Filter by a single article.
  	$contentId = $this->getState('filter.content_id');

  	if (is_numeric($contentId))
  	{
  		$query->where('a.content_id = ' . (int) $contentId);
  	}

  	// Add the list ordering clause.
  	$query->order($this->getState('list.ordering', 'a.created') . ' ' . $this->getState('list.direction', 'DESC'));

		return $query;
	}

  /**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules/plugins that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . serialize($this->getState('filter.content_id'));

		return parent::getStoreId($id);
	}
}
