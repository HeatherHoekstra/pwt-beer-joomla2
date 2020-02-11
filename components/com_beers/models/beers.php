<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

/**
 * This models supports retrieving a list of tags.
 *
 * @since  3.1
 */
class BeersModelBeers extends JModelList
{
	/**
	 * Model context string.
	 *
	 * @var    string
	 * @since  3.1
	 */
	public $_context = 'com_beers.beers';

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return  string  An SQL query
	 *
	 * @since   1.6
	 */
	protected function getListQuery()
	{
		$db = Factory::getDbo();

		$query = $db->getQuery(true);

		$query
			->select('*')
			->where('state', '>', '1')
			->from($db->quoteName('#__beers'));

		return $query;
	}
}
