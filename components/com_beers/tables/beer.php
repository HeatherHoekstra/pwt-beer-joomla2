<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_beers
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Beers Table class
 *
 * @since  0.0.6
 */
class BeersTableBeer extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__beers', 'id', $db);
		$this->setColumnAlias('published', 'state');
	}
}
