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
 * View class for a list of comments.
 */
class MjcommentsViewCommentslist extends JViewLegacy
{
  protected $items;
  protected $pagination;
  protected $state;

  /**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
    $this->items      = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    $this->state      = $this->get('State');
    $this->filterForm = $this->get('FilterForm');

    // Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}

    $this->addToolbar();

    JFactory::getDocument()->addStyleSheet(JUri::base() . 'components/com_mjcomments/media/css/com_mjcomments.admin.css');

    parent::display($tpl);
  }

  /**
	 * Add the page title and toolbar.
	 *
	 * @return  void
   *
	 */
	protected function addToolbar()
	{
    // Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_MJCOMMENTS_VIEW_COMMENTSLIST_TITLE'), 'title comments');

    JToolbarHelper::publish('commentslist.publish', 'JTOOLBAR_PUBLISH', true);
    JToolbarHelper::unpublish('commentslist.unpublish', 'JTOOLBAR_UNPUBLISH', true);
  }
}
