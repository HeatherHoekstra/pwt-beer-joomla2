<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Response\JsonResponse;

class BeersViewBeer extends JViewLegacy
{
	function display($tpl = null)
	{
		$input  = Factory::getApplication()->input;
		$model  = $this->getModel('Beer');
		$rating = $input->get('rating');
		$id     = $input->get('id');

		if ($rating)
		{
			$model->insertRating($id, $rating);
			$newRating = $model->updateAverageRating($id);
			echo new JsonResponse($newRating, 'message', 'error');
		}
		else
		{
			echo new JResponseJson(null, JText::_('COM_HELLOWORLD_ERROR_NO_MAP_BOUNDS'), true);
		}
	}
}