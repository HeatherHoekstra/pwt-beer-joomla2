<?php
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
	 * @since 0.0.6
	 */
	function __construct(&$db)
	{
		parent::__construct('#__beers', 'id', $db);
		$this->setColumnAlias('published', 'state');
	}
}
