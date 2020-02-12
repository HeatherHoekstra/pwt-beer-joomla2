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
		$rating = $input->get('rating');
		$model = $this->getModel();
		if ($rating)
		{
			// Insert rating into ratings database on ip address
			// Rating model aanmaken & ophalen
			// Als rating al bestaat op ip address returnen naar de view zodat deze weergeven kan worden
			echo new JsonResponse($rating, 'message' , 'error');
		}
		else
		{
			echo new JResponseJson(null, JText::_('COM_HELLOWORLD_ERROR_NO_MAP_BOUNDS'), true);
		}
	}
}