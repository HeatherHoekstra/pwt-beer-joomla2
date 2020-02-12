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

/**
 * HTML View class for the Tags component
 *
 * @since  3.1
 */
class BeersViewBeer extends JViewLegacy
{

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since   3.1
	 */
	public function display($tpl = null)
	{
		$id  = Factory::getApplication()->input->get('id');

		/** @var BeersModelBeer $model */
		$model = $this->getModel('Beer');
		$this->item = $model->getItem();

		parent::display($tpl);
	}
}
