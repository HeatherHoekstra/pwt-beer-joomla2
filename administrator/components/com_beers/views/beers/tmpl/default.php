<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_beers
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

JHtml::_('jquery.framework');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

defined('_JEXEC') or die('Restricted access');

$user = Factory::getUser();
?>

<form action="<?php echo JRoute::_('index.php?option=com_beers&view=beers'); ?>" name="adminForm" id="adminForm"
      method="post">
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="1%" class="center">
				<?php echo HTMLHelper::_('grid.checkall'); ?>
            </th>
            <th>Status</th>
            <th>ID</th>
            <th>Name</th>
            <th>Tagline</th>
            <th>Description</th>
            <th>Alcohol percentage</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ($this->getBeers as $i => $beer):
			$canEdit = $user->authorise('core.edit', 'com_beers.beers' . $beer->id);
			$canChange = $user->authorise('core.edit.state', 'com_beers' . $beer->id);
			?>
            <tr>
                <td class="center">
					<?php echo JHtml::_('grid.id', $i, $beer->id); ?>
                </td>

                <td><?php echo JHtml::_('jgrid.published', $beer->state, $i, 'beers.', $canChange, 'cb', $beer->publish_up, $beer->publish_down); ?></td>

                <td><?php echo $beer->id ?></td>
                <td>
					<?php if ($canEdit): ?>
                        <a href="<?php echo JRoute::_('index.php?option=com_beers&task=beer.edit&id=' . (int) $beer->id); ?>"><?php echo $beer->name ?></a>
					<?php else: ?>
						<?php echo $this->escape($beer->name); ?>
					<?php endif; ?>
                </td>
                <td><?php echo $beer->tagline ?></td>
                <td><?php echo $beer->description ?></td>
                <td><?php echo $beer->abv ?></td>
                <td><?php echo $beer->rating ?> / 5</td>
            </tr>
		<?php endforeach; ?>
        <tr>
			<?php echo $this->pagination->getListFooter(); ?>
        </tr>
        </tbody>
    </table>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value=""/>
	<?php echo JHtml::_('form.token'); ?>
</form>
