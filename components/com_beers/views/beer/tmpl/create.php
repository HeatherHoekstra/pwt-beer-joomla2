<?php
/**
 * @package    Beercomponent
 *
 * @author     Perfect Web Team <hallo@perfectwebteam.nl>
 * @copyright  Copyright (C) 2020 Perfect Web Team. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link       https://perfectwebteam.nl
 */

defined('_JEXEC') or die;

?>


<form action="<?php echo JRoute::_('index.php?option=com_beers&view=beer'); ?>"
      method="post" name="adminForm" id="beer-form adminForm" class="form-validate">

	<?php echo $this->form->renderFieldset('details'); ?>

<!--	<a href="--><?php //echo JRoute::_('index.php/beers?task=beer.save'); ?><!--" class="btn btn-primary">Create new beer</a>-->
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Create new beer</button>
    </div>

	<input type="hidden" name="task" value="beer.save"/>
	<?php echo JHtml::_('form.token'); ?>
</form>


