<?php
defined('_JEXEC') or die;

class BeersViewBeer extends JViewLegacy
{
	/**
	 * Method
	 * @since 0.0.1
	 */
	public function display($tpl = null)
	{
		/** @var BeersModelBeer $model */
		$model = $this->getModel('Beer');
		$this->item = $model->getItem();

		parent::display($tpl);
	}
}
