<?php

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

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

	protected function allowSave($data, $key = 'id')
	{
		return true;
	}
//
//	public function save()
//	{
//		$app   = Factory::getApplication();
//		$input = $app->input->post;
//		$model = $this->getModel();
//		$form = $model->getForm();
//
//		echo 'test';
//
////		$model->save(['name' => 'TestBeer', 'tagline' => 'Beautiful tagline written for TestBeer', 'description' => 'A well written description', 'abv' => '5.6']);
//	}
}
