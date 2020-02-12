<?php
use Joomla\CMS\Factory;

defined('_JEXEC') or die('Restricted access');

class BeersControllerBeer extends JControllerForm
{
	public function ajax()
	{
		if (!JSession::checkToken('get'))
		{
			echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
		}
		else
		{
			parent::display();
		}
	}
}