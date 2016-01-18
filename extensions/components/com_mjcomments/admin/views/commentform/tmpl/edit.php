<?php
/**
 * @package     MJ.Component
 * @subpackage  mjcomments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'commentform.cancel' || document.formvalidator.isValid(document.getElementById('item-form'))) {
			" . $this->form->getField('visitor_comments')->save() . "
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	};
");

?>

<form action="<?php echo JRoute::_('index.php?option=com_mjcomments&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
  <div class="form-inline form-inline-header">
    <?php
    	echo $this->form->renderField('visitor_name');
    	echo $this->form->renderField('visitor_email');
  	?>
  </div>

  <div class="form-horizontal">
    <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
      <?php /* Content Tab */ ?>
      <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_MJCOMMENTS_VIEW_GALLERYFORM_CONTENT_TAB', true)); ?>
        <div class="row-fluid">
          <div class="span9">
            <fieldset class="adminform form-vertical">
              <?php echo $this->form->renderField('visitor_comments'); ?>
            </fieldset>
          </div>
          <div class="span3">
            <fieldset class="form-vertical">
              <?php echo $this->form->renderField('state'); ?>
							<?php echo $this->form->renderField('created'); ?>
							<?php echo $this->form->renderField('content_id'); ?>
            </fieldset>
          </div>
        </div>
      <?php echo JHtml::_('bootstrap.endTab'); ?>
    <?php echo JHtml::_('bootstrap.endTabSet'); ?>

    <input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
  </div>
</form>
