<?php

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die('Restricted access');

class BeersModelBeer extends AdminModel
{
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
		Table::addIncludePath('/administrator/components/com_beers/tables');

		return Table::getInstance($type, $prefix, $config);
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
		$form = $this->loadForm('com_beers.beer', 'beer', array('control' => 'jform', 'load_data' => $loadData));

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
		$data = $app->getUserState('com_beers.edit.beer.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		$this->preprocessData('com_beers.beer', $data);

		return $data;
	}

	public function save($array)
	{
		if (isset($array['id']))
		{
			try
			{
				// Insert row with PK if not found
				$obj = (object) ['id' => $array['id']];
				Factory::getDbo()->insertObject('#__beers', $obj, ['id']);
			}
			catch (Exception $e)
			{
				// Exception thrown when PK ID is found and no row can be inserten with the same ID
				echo 'test error';
				echo $e->getMessage();
			}
		}

		parent::save($array);
	}
}