<?php
/**
 * @package     MJ.Module
 * @subpackage  Comments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

// Proxy to the component site path
$comMjcomments_path = JPATH_SITE . '/components/com_mjcomments/';
$comContent_path    = JPATH_SITE . '/components/com_content/';

// Add the Mjcomments site models
JModelLegacy::addIncludePath($comMjcomments_path . '/models', 'MjcommentsModel');

// Add the com_content route helpers
require_once $comContent_path . 'helpers/route.php';


/**
 * Mj comments model class
 *
 */
final class MjModuleComments extends EpaleModule
{
  /**
	 * Get the base module layout data
	 *
	 * @return  array
	 */
	public function getBaseLayoutData()
	{
		$layoutData = parent::getBaseLayoutData();
		$layoutData['comments'] = $this->getList($layoutData['params']);

		return $layoutData;
  }

  /**
	 * Get a list of comments from the formlist model
	 *
	 * @return mixed
	 */
	protected function getList($params)
	{
		// Get an instance of the formlist model
		$formlist = JModelLegacy::getInstance('Formlist', 'MjcommentsModel', array('ignore_request' => true));

		// Set the filters based on the module params
		$formlist->setState('list.start', (int) $params->get('exclude_comments', 0));
		$formlist->setState('list.limit', (int) $params->get('count', 5));
		$formlist->setState('filter.published', 1);

		// Retrieve Comments
		$comments = $formlist->getItems();

		return $comments;
	}

  /**
	 * Render the module
	 *
	 * @param  array  $layoutData Array containing the data to use in the layout
	 * @return string
	 */
	public function render($layoutData = array())
	{
		$layoutData = array_merge($this->getBaseLayoutData(), $layoutData);

		if (empty($layoutData['comments']))
		{
			$message = JText::_('MOD_MJCOMMENTS_EMPTY_COMMENTS');
			$this->setError($message);
			$this->setLayout('_error');
		}

		return parent::render($layoutData);
  }
}
