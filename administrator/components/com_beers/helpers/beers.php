<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

/**
 *  Beers component helper
 *
 * @since 0.0.9
 * */
class BeersHelper extends JHelperContent
{
	/**
	 *  Url used to connect and retrieve data from beer API
	 *
	 * @since 0.0.3
	 * */
	protected static $apiUrl = "https://api.punkapi.com/v2/beers";

	/**
	 *  Retrieving beer data from API and creating a readable object
	 *
	 * @return array of json object
	 * @since 0.0.10
	 *
	 * */
	public static function retrieveBeers()
	{
		$beers = file_get_contents(self::$apiUrl);

		return json_decode($beers);
	}
}