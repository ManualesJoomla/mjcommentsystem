<?php
/**
 * @package     MJ.Plugin
 * @subpackage  Content.Mjformcomment
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

extract($displayData);

?>

<?php if (!$data['form']) : ?>
	<div class="row">
		<div class="alert alert-danger" role="alert">
			<?php echo JText::_('PLG_CONTENT_MJFORMCOMMENT_FORM_ERROR'); ?>
		</div>
	</div>
<?php else : ?>
	<div class="row">
		<form id="comments-form" action="" method="post" class="form-validate" enctype="multipart/form-data">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $data['form']->getLabel('visitor_name'); ?>
					<?php echo $data['form']->getInput('visitor_name'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $data['form']->getLabel('visitor_email'); ?>
					<?php echo $data['form']->getInput('visitor_email'); ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<?php echo $data['form']->getInput('visitor_comments'); ?>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-9">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary btn-block">Enviar</button>
				</div>
			</div>
		</form>
	</div>
<?php endif; ?>
