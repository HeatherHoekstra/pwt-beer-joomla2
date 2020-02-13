<?php
defined('_JEXEC') or die('Restricted access');

class BeersControllerBeer extends JControllerForm
{
	/**
	 * Checks token for ajax request
	 *
	 * @since 0.0.1
	 * */

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