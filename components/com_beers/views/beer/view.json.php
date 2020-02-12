<?php
/**
 * View file for responding to Ajax request for performing Search Here on the map
 *
 */

// No direct access to this file
use Joomla\CMS\Factory;
use Joomla\CMS\Response\JsonResponse;

defined('_JEXEC') or die('Restricted access');

class BeersViewBeer extends JViewLegacy
{
	/**
	 * This display function returns in json format the Helloworld greetings
	 *   found within the latitude and longitude boundaries of the map.
	 * These bounds are provided in the parameters
	 *   minlat, minlng, maxlat, maxlng
	 */

	function display($tpl = null)
	{
		$input = Factory::getApplication()->input;

		$model = $this->getModel('Beer');

		$rating = $input->get('rating');
		$id = $input->get('id');
//		$model->insertRating($id, $rating);

		if ($rating)
		{
			$model->insertRating($id, $rating);
			$newRating = $model->updateAverageRating($id);

			echo new JsonResponse($newRating, 'message' , 'error');
		}
		else
		{
			echo new JResponseJson(null, JText::_('COM_HELLOWORLD_ERROR_NO_MAP_BOUNDS'), true);
		}
	}
}