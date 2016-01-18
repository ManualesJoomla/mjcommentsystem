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

<?php if ($data['comments'] !== false) : ?>
  <div class="row comments-list">
  	<?php foreach ($data['comments'] as $comment) : ?>
  		<div class="col-md-12">
  			<div class="panel panel-default">
  				<ul class="list-group">
  					<li class="list-group-item">
    					<strong><?php echo $comment->visitor_name; ?></strong>
    					<time class="pull-right"><?php echo JText::sprintf('PLG_CONTENT_MJFORMCOMMENT_PUBLISHED_DATE', JHtml::_('date', $comment->created, JText::_('DATE_FORMAT_LC2'))); ?></time>
    				</li>
    			</ul>

    			<div class="panel-body">
      			<p><?php echo $comment->visitor_comments; ?></p>
    			</div>
  			</div>
  		</div>
  	<?php endforeach; ?>
  </div>
<?php endif; ?>
