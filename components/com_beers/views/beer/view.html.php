<?php
defined('_JEXEC') or die;

class BeersViewBeer extends JViewLegacy
{
	public function display($tpl = null)
	{
		/** @var BeersModelBeer $model */
		$model = $this->getModel('Beer');
		$this->item = $model->getItem();

		parent::display($tpl);
	}
}
