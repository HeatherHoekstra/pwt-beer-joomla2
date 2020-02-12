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

defined('_JEXEC') or die('Restricted access');

/**
 * General Controller of Beers component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_beers
 * @since       0.0.1
 */
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