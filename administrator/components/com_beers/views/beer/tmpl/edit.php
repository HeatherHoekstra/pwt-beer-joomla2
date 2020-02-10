<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;

JHtml::_('jquery.framework');
JHtml::_('behavior.formvalidator');

JFactory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task)
	{
		if (task == "beer.cancel" || document.formvalidator.isValid(document.getElementById("beer-form")))
		{
			Joomla.submitform(task, document.getElementById("beer-form"));
		}
	};
	
');
?>

<form action="<?php echo JRoute::_('index.php?option=com_beers&layout=edit&id=' . (int) $this->beer->id); ?>"
      method="post" name="adminForm" id="beer-form" class="form-validate">

	<?php echo $this->form->renderFieldset('details'); ?>

    <input type="hidden" name="task" value=""/>
	<?php echo JHtml::_('form.token'); ?>
</form>
