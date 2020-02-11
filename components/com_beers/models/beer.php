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
use Joomla\CMS\Table\Table;

/**
 * Tags Component Tag Model
 *
 * @since  3.1
 */
class BeersModelBeer extends JModelList
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
		Table::addIncludePath('/components/com_beers/tables');

		return Table::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to build an SQL query to load the list data of all items with a given tag.
	 *
	 * @return  string  An SQL query
	 *
	 * @since   3.1
	 */
//	protected function getListQuery()
//	{
//		$id = Factory::getApplication()->input->get('id');
//
//		$db = Factory::getDbo();
//
//		$query = $db->getQuery(true);
//
//		$query
//			->select('*')
//			->from($db->quoteName('#__beers'));
////			->where('id' . '=' . $id);
//
//		return $query;
//	}

	/**
	 *  Return specific beer content
	 *
	 *  @param int $id given parameter of url
	 *
	 *  @return Object returned query data
	 *
	 *  @since 0.0.11
	 * */
	public function getBeer($id)
	{
		$db = Factory::getDbo();

		$query = $db->getQuery(true);

		$query
			->select('*')
			->from($db->quoteName('#__beers'))
			->where('id' . '=' . $db->quote($id));

		$db->setQuery($query);

		return $db->loadObjectList();
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
}
