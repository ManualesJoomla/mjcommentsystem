<?php
/**
 * @package     MJ.Component
 * @subpackage  mjcomments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$columns   = 6;

?>

<form action="<?php echo JRoute::_('index.php?option=com_mjcomments&view=commentslist'); ?>" method="post" name="adminForm" id="adminForm">
  <div id="j-main-container">
    <?php
  		// Search tools bar
  		echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		?>
    <?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
      <table class="table table-striped" id="commentList">
				<thead>
					<tr>
            <th width="1%" class="center">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th width="1%" style="min-width:55px" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
						</th>
            <th width="20%">
							<?php echo JHtml::_('searchtools.sort', 'COM_MJCOMMENTS_VIEW_COMMENTLIST_ARTICLE_TITLE', 'a.content_id', $listDirn, $listOrder); ?>
						</th>
            <th>
              <?php echo JText::_('COM_MJCOMMENTS_VIEW_COMMENTLIST_COMMENT_TEXT'); ?>
            </th>
            <th width="10%" class="nowrap hidden-phone">
							<?php echo JHtml::_('searchtools.sort',  'JAUTHOR', 'a.visitor_name', $listDirn, $listOrder); ?>
						</th>
            <th width="10%" class="nowrap hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'JDATE', 'a.created', $listDirn, $listOrder); ?>
						</th>
            <th width="1%" class="nowrap hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th>
          </tr>
        </thead>

        <tfoot>
					<tr>
						<td colspan="<?php echo $columns; ?>">
						</td>
					</tr>
				</tfoot>

        <tbody>
  				<?php foreach ($this->items as $i => $item) :
            $canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
            $canChange  = $user->authorise('core.edit.state', 'com_mjcomments') && $canCheckin;
            ?>
            <tr class="row<?php echo $i % 2; ?>">
              <td class="center">
  							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
  						</td>
              <td class="center">
                <div class="btn-group">
                  <?php if ($item->checked_out) : ?>
                    <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'commentslist.', $canCheckin); ?>
                  <?php endif; ?>
                  <?php echo JHtml::_('jgrid.published', $item->state, $i, 'commentslist.', $canChange); ?>
                </div>
              </td>
              <td class="has-context">
                <span><?php echo $this->escape($item->content_title); ?></span>
              </td>
              <td class="has-context">
                <span><?php echo $item->visitor_comments; ?></span>
              </td>
              <td class="small hidden-phone">
                <?php echo $this->escape($item->visitor_name); ?>
              </td>
              <td class="nowrap small hidden-phone">
  							<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
  						</td>
              <td class="hidden-phone">
  							<?php echo (int) $item->id; ?>
  						</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <?php echo $this->pagination->getListFooter(); ?>

    <input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
  </div>
</form>
