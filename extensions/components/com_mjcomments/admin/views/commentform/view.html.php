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
class MjcommentsViewCommentform extends JViewLegacy
{
  protected $form;
	protected $item;
	protected $state;

  /**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 *
	 */
	public function display($tpl = null)
	{
    $this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

    // Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

    $this->addToolbar();
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
    JFactory::getApplication()->input->set('hidemainmenu', true);
    $user       = JFactory::getUser();
    $userId     = $user->get('id');
    $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

    // Built the actions for existing records.
    $canDo = JHelperContent::getActions('com_mjcomments', 'component');

    JToolbarHelper::title(
			JText::_('COM_MJCOMMENTS_VIEW_COMMENTFORM_EDIT_COMMENT'),
			'pencil-2 comment-edit'
		);

    // Check again the edit permission.
		if (!$checkedOut)
		{
      // Since it's an existing record, check the edit permission.
      if ($canDo->get('core.edit'))
      {
        JToolbarHelper::apply('commentform.apply');
        JToolbarHelper::save('commentform.save');
      }

      JToolbarHelper::cancel('commentform.cancel', 'JTOOLBAR_CLOSE');
		}
  }
}
