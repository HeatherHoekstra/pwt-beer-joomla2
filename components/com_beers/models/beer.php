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
use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Table\Table;

/**
 * Tags Component Tag Model
 *
 * @since  3.1
 */
class BeersModelBeer extends ItemModel
{

	protected $_item;

	public function populateState()
	{
		$this->setState('beer.id', Factory::getApplication()->input->get('id'));
		parent::populateState();
	}

	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('beer.id');
		if (!isset($this->_item[$pk]))
		{
			$db = Factory::getDbo();

			$query = $db->getQuery(true);

			$query
				->select('*')
				->from($db->quoteName('#__beers'))
				->where('id' . '=' . $db->quote($pk));

			$db->setQuery($query);

			$this->_item[$pk] = $db->loadObject();
		}

		return $this->_item[$pk];
	}


	public function insertRating($id, $rating)
	{

		$db = Factory::getDbo();

		$columns =
			[
				'beer_id',
				'rating',
			];

		$values =
			[
				$db->quote($id),
				$db->quote($rating),
			];

		$query = $db->getQuery(true);

		$query
			->insert($db->quoteName('#__ratings'))
			->columns($columns)
			->values(implode(',', $values));

		$db->setQuery($query);

		$db->execute();
	}

	public function getAllRatings($id)
	{
		$db = Factory::getDbo();

		$query = $db->getQuery(true);

		$query
			->select('rating')
			->from($db->quoteName('#__ratings'))
			->where($db->quoteName('beer_id'). '='. $db->quote($id));

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	public function calcAverageRating($id)
	{
		$ratings = $this->getAllRatings($id);
		$count = count($ratings);
		$value = 0;

		foreach($ratings as $rating)
		{
			$value += $rating->rating;
		}

		return round(($value/$count));
	}

	public function updateAverageRating($id)
	{
		$avgRating = $this->calcAverageRating($id);

		$db = Factory::getDbo();

		$query = $db->getQuery(true);

		// Fields to update.
		$fields = [
			$db->quoteName('rating') . ' = ' . $db->quote($avgRating),
		];

		// Conditions for which records should be updated.
		$conditions = [
			$db->quoteName('id') . ' = ' . $id,
		];

		$query->update($db->quoteName('#__beers'))->set($fields)->where($conditions);

		$db->setQuery($query);

		$db->execute();

		return $avgRating;
	}
}
