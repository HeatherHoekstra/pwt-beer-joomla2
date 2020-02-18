<?php

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Response\JsonResponse;

class BeersControllerBeer extends FormController
{
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
		BaseDatabaseModel::addIncludePath('/components/com_beers/models');

		return parent::getModel($name, $prefix, $config);
	}

	/**
	 * Checks token for ajax request
	 *
	 * @since 0.0.1
	 * */

	public function ajax()
	{
		if (!JSession::checkToken('get'))
		{
			echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
		}
		else
		{
			parent::display();
		}
	}

	/**
	 * Overwriting the regular allowSave method to always give permission
	 *
	 * @return    boolean Allowing saving a new item from non-users
	 *
	 * @since    1.7
	 * */
	protected function allowSave($data, $key = 'id')
	{
		return true;
	}

	/**
	 * Overwriting save function to check data type of abv field
	 *
	 * @throws Exception
	 *
	 * @since     1.8
	 */

	public function save()
	{
		$input = Factory::getApplication()->input;
		$abv   = $input->get('jform')[4];

		if (!is_numeric($abv))
		{
			Factory::getApplication()->enqueueMessage('Alcohol percentage is not a number', 'error');
			Factory::getApplication()->redirect('index.php?option=com_beers&view=beer&layout=create');

			return;
		}

		parent::save();
	}
}
