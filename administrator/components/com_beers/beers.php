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

// Get an instance of the controller prefixed by Beers
$controller = JControllerLegacy::getInstance('Beers');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();