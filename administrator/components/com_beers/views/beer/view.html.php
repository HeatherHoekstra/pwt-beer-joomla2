<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

// No direct access to this file
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;

JLoader::register('BeersHelper', JPATH_ADMINISTRATOR . '/components/com_beers/helpers/beers.php');


/**
 * HTML View class for the Beer Component
 *
 * @since  0.0.1
 */
class BeersViewBeer extends HtmlView
{
	/**
	 * The JForm object
	 *
	 * @var  JForm
	 */
	protected $form = null;

	/**
	 * The active item
	 *
	 * @var  object
	 */
	protected $beer;

	/**
	 * The model state
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * Display the Beer view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('state');
		$this->beer  = $this->get('item');
		$this->form  = $this->get('form');

		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		Factory::getApplication()->input->set('hidemainmenu', true);

		$isNew = ($this->beer->id == 0);
		JToolbarHelper::title($isNew ? JText::_('COM_BEERS_MANAGER_BEER_NEW') : JText::_('COM_BEERS_MANAGER_BEER_EDIT'), 'bookmark banners');

		// If not checked out, can save the item.
		JToolbarHelper::apply('beer.apply');
		JToolbarHelper::save('beer.save');

		JToolbarHelper::save2new('beer.save2new');

		// If an existing item, can save to a copy.
		if (!$isNew)
		{
			JToolbarHelper::save2copy('beer.save2copy');
		}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('beer.cancel');
		}
		else
		{
			JToolbarHelper::cancel('beer.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_BANNERS_BANNERS_EDIT');
	}
}