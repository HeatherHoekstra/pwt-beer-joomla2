<?php

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView;

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
	 * Method
	 * @since 0.0.1
	 */
	public function display($tpl = null)
	{
		/** @var BeersModelBeer $model */
		$model = $this->getModel();
		$this->item = $model->getItem();

		$this->form = $this->getForm();


		parent::display($tpl);
	}
}
