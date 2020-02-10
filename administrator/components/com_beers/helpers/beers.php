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


//load model
JModelLegacy::addIncludePath(JPATH_SITE . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_beers' . DIRECTORY_SEPARATOR . 'models');

class BeersHelper extends JHelperContent
{

	protected static $data = '';

	/**
	 *  Url used to connect and retrieve data from beer API
	 *
	 * */
	protected static $apiUrl = "https://api.punkapi.com/v2/beers";

	/**
	 *
	 *  Retrieving beer data from API and creating a readable object
	 *
	 * @return array of json object
	 *
	 * */
	public static function retrieveBeers()
	{
		$beers = file_get_contents(self::$apiUrl);

		return json_decode($beers);
	}

	/**
	 *
	 *  Using retrieved data from the API to create an array ready for database insertion
	 *
	 * @return array of needed information out of api
	 *
	 * */
	public static function orderBeers()
	{
		$beers = self::retrieveBeers();
		$array = [];

		foreach ($beers as $beer)
		{
			$array[] =
				[
					'id'          => $beer->id,
					'name'        => $beer->name,
					'tagline'     => $beer->tagline,
					'description' => $beer->description,
					'abv'         => $beer->abv,
				];
		}

		return $array;
	}

	public static function checkBeers()
	{
		$model = JModelLegacy::getInstance('Beers', 'BeersModel');

		// todo: kijken voor mogelijkheid om model aan te roepen in helper functie zodat query functie aangeroepen kunnen worden

		// todo: ophalen van naam query om te kijken of item al in database staat
		//todo: als dit NIET het geval is query voor insert uitvoeren
		// todo: als dit wel het geval is geen query uitvoeren

		$beers = self::orderBeers();

//        foreach($beers as $beer)
//        {
//            // todo: execute function to check if name is in database
//            if($model->get('BeersName') == null || empty(getBeersName($beer->name)))
//            {
//                // todo: execute query to insert beer into database
//            }
//
//        }
	}
}