<?php
defined('_JEXEC') or die('Restricted access');

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
JLoader::register('BeersHelper', JPATH_ADMINISTRATOR . '/components/com_beers/helpers/beers.php');

/**
 * HTML View class for the Beer Component
 *
 * @since  0.0.1
 */
class BeersViewBeers extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// alle biertjes ophalen
		$this->getBeers = $this->get('Items');
		$this->state    = $this->get('State');

		// creating the toolbar
		$this->createToolbar();

		// Display the view
		parent::display($tpl);
	}

	protected function createToolbar()
	{
		// all toolbar items
		JToolbarHelper::title('Beers');
		JToolbarHelper::addNew('beers.import', 'Biertjes opnieuw ophalen');
		JToolbarHelper::editList('beers.edit');

		if ($this->state->get('filter.published') != 2)
		{
			JToolbarHelper::publish('beers.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('beers.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::deleteList('Delete', 'beers.delete');
		}
	}
}