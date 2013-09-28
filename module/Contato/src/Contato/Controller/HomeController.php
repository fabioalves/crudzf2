<?php

namespace Contato\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * HomeController
 *
 * @author
 *
 * @version
 *
 */
class HomeController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated HomeController::indexAction() default action
		return new ViewModel ();
	}
}