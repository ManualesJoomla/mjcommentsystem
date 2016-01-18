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
 * Form controller class.
 *
 */
class MjcommentsControllerComment extends JControllerForm
{
	/**
	 * Method to check the form data
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 */
	protected function checkFormData(&$message, &$error)
	{
		$app    = JFactory::getApplication();
		$model  = $this->getModel('Formcomment', 'MjcommentsModel');
		$data 	= new stdClass;

		// Get the comment data.
		$requestData 	= $this->input->post->get('jform', '', 'raw');

		// Get the form
		$form	= $model->getForm();

    // Check for validation errors
		if (!$form)
		{
      $message 	= JText::_('COM_MJCOMMENTS_CONTROLLERS_COMMENT_VALIDATE_FORM');
			$error 		= true;

      return false;
		}

    // Validate the posted data
		$data	= $model->validate($form, $requestData);

		// Check for validation errors
		if ($data === false)
		{
      $message 	= JText::_('COM_MJCOMMENTS_CONTROLLERS_COMMENT_VALIDATE_FORM_DATA');
			$error 		= true;

			// Save the data in the session
			$app->setUserState('com_mjcomments.formcomment.data', $requestData);

      return false;
		}

		// Attempt to save the data
		$return	= $model->comment($data);

		// Check for errors
		if ($return === false)
		{
      $message 	= JText::_('COM_MJCOMMENTS_CONTROLLERS_COMMENT_SAVE_FORM_DATA');
			$error 		= true;

			// Save the data in the session
			$app->setUserState('com_mjcomments.formcomment.data', $requestData);

			return false;
		}

		// Flush the data from the session.
		$app->setUserState('com_mjcomments.formcomment.data', null);

		return true;
	}

  /**
	 * Method to proccess the ajax request
	 *
	 */
	public function send()
	{
    $message        = JText::_('COM_MJCOMMENTS_CONTROLLERS_COMMENT_SEND_SUCCESS');
    $error          = false;
		$checkResult	  = $this->checkFormData($message, $error);

		try
    {
      echo new JResponseJson($checkResult, $message, $error);
    }

    catch(Exception $e)
    {
      echo new JResponseJson($e);
    }
	}
}
