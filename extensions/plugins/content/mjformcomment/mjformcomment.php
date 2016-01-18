<?php
/**
 * @package     MJ.Plugin
 * @subpackage  Content.Mjformcomment
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

/**
 * Mjformcomment plugin.
 *
 */
class PlgContentMjformcomment extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 */
	protected $autoloadLanguage = true;

  /**
	 * A JForm object on success, false on failure
	 *
	 * @var    JForm
	 */
	protected $form;

  /**
	 * Displays the comments area
	 *
	 * @param   string   $context  The context of the content being passed to the plugin
	 * @param   object   &$row     The article object
	 * @param   object   &$params  The article params
	 * @param   integer  $page     The 'page' number
	 *
	 * @return  mixed  html string containing code for the comment if in com_content.article else boolean false
	 *
	 */
  public function onContentAfterDisplay($context, &$row, &$params, $page=0)
	{
    $parts 		= explode(".", $context);
		$plgCatid = $this->params->def('catid');

		// Check is run com_content
		if ($parts[0] != 'com_content')
		{
			return false;
		}

		// Check category of the plugin in the allowable category array of the plugin
		if ($plgCatid[0] != 'all' && !in_array($row->catid, $plgCatid))
		{
			return false;
		}

		// Add media file
		JHtml::_('jquery.framework');
		JHtml::script(JUri::base() . 'media/pkg_mjcommentsystem/plg_content_mjformcomment/js/plg_mjformcomment.js', false, true);
		JHtml::stylesheet(JUri::base() . 'media/pkg_mjcommentsystem/plg_content_mjformcomment/css/plg_mjformcomment.css', false, true, false);

		// Add the language file of the component
		$lang = JFactory::getLanguage();
		$basePath = JPATH_SITE . '/components/com_mjcomments';
		$lang->load('com_mjcomments', $basePath, null, true);

		// Assign value to the layout variables
		$content_id = $row->id;
		$formReturn = 'index.php?option=com_mjcomments&task=comment.send&format=json';

		// Get the comment form
    $this->setCommentForm();

    // Name of the variables that will be used in the layout
		$data = array(
						'view' 				=> $context,
						'form' 				=> $this->form,
						'formReturn' 	=> $formReturn,
						'content_id' 	=> $content_id
					);

    return JLayoutHelper::render('default', compact('data'), __DIR__ . '/layouts');
  }

  /**
	 * Method to get the comment form
   *
	 * @return   html    Html comment form structure
	 */
	protected function setCommentForm()
	{
		$modelForm 	= $this->getModel('Formcomment');
		$this->form = $modelForm->getForm();
	}

  /**
	 * Method to get the model instance.
	 *
   * @param  string   $name     The model
   * @param  string   $prefix   The model prefix
   *
	 * @return  JForm  A JForm object on success, false on failure
	 *
	 */
	protected function getModel($name, $prefix = 'MjcommentsModel')
	{
		// Proxy to the component site path
		$com_path = JPATH_SITE . '/components/com_mjcomments/';

		// Add the models
		JModelLegacy::addIncludePath($com_path . '/models', $prefix);

		// Add the form.
		JForm::addFormPath($com_path . '/models/forms');

		// Get an instance of the generic form model
		$model = JModelLegacy::getInstance($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
