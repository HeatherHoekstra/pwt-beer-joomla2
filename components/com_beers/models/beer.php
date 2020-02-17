<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;

class BeersModelBeer extends AdminModel
{
	protected $_item;

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */

	public function getTable($type = "Beer", $prefix = "BeersTable", $config = array())
	{
		Table::addIncludePath('/components/com_beers/tables');

		return Table::getInstance($type, $prefix, $config);
	}

	/**
	 *  Setting state of Beer Model
	 *
	 * @since 0.0.1
	 * */
	public function populateState()
	{
		$this->setState('beer.id', Factory::getApplication()->input->get('id'));
		parent::populateState();
	}

	/**
	 * Get item information
	 *
	 * @param   int  $pk  The id of item for which we need the associated items
	 *
	 * @return  JTable|null
	 *
	 * @since   0.0.1
	 */
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

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form. [optional]
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not. [optional]
	 *
	 * @return  JForm|boolean  A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_beers.beer', 'beer', array('control' => 'jform'));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app  = JFactory::getApplication();
		$data = $app->getUserState('com_beers.beer.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		$this->preprocessData('com_beers.beer', $data);

		return $data;
	}


	/**
	 * Method to retrieve all ratings for specific beer item
	 *
	 * @return Object List of all ratings for specific beer
	 *
	 * @since 0.0.1
	 */
	public function getAllRatings($id)
	{
		$db = Factory::getDbo();

		$query = $db->getQuery(true);

		$query
			->select('rating')
			->from($db->quoteName('#__ratings'))
			->where($db->quoteName('beer_id') . '=' . $db->quote($id));

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	/**
	 * Method to calculate the average rating given by users for specific beer
	 *
	 * @return int Average rating for a specific beer
	 *
	 * @since 0.0.1
	 */
	public function calcAverageRating($id)
	{
		$ratings = $this->getAllRatings($id);
		$count   = count($ratings);
		$value   = 0;

		foreach ($ratings as $rating)
		{
			$value += $rating->rating;
		}

		return round(($value / $count));
	}

	/**
	 * Method to update the average rating for a specific beer
	 *
	 * @return int Average rating for specific beer
	 *
	 * @since 0.0.1
	 */
	public function updateAverageRating($id)
	{
		$avgRating = $this->calcAverageRating($id);

		$db = Factory::getDbo();

		$query = $db->getQuery(true);

		$fields = [
			$db->quoteName('rating') . ' = ' . $db->quote($avgRating),
		];

		$conditions = [
			$db->quoteName('id') . ' = ' . $id,
		];

		$query->update($db->quoteName('#__beers'))->set($fields)->where($conditions);

		$db->setQuery($query);

		$db->execute();

		return $avgRating;
	}
}
