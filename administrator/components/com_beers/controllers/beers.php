<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * Banners list controller class.
 *
 * @since  1.6
 */
class BeersControllerBeers extends JControllerAdmin
{
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_BEERS_BEERS';

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JControllerLegacy
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JModelLegacy  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Beer', $prefix = 'BeersModel', $config = array('ignore_request' => true))
	{
		BaseDatabaseModel::addIncludePath('/administrator/components/com_beers/models');

		return parent::getModel($name, $prefix, $config);
	}

	public function delete()
	{
		parent::delete();
	}

	public function import()
	{
		/** @var BeersModelBeers $model */
		$model = $this->getModel('Beers');
		$model->import();

		Factory::getApplication()->enqueueMessage('Successfully imported beers');
		Factory::getApplication()->redirect('index.php?option=com_beers&view=beers');
	}
}
