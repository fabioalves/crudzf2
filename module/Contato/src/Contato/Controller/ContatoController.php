<?php

namespace Contato\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ContatoController
 *
 * @author
 *
 * @version
 *
 */
class ContatoController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated ContatoController::indexAction() default action
		return array('message' => $this->getFlashMessenger());
	}
	
	public function novoAction() {
		return array('message' => $this->getFlashMessenger());
	} 
	
	public function adicionarAction() {
		$request = $this->getRequest();
		
		if($request->isPost()) {
			$postDate = $request->getPost()->toArray();
			$formularioValido = true;
			
			if($formularioValido) {
				$this->flashMessenger()->addSuccessMessage("Contato criado com sucesso");
				return $this->redirect()->toRoute("contato");
			} else {
				$this->flashMessenger()->addErrorMessage("Erro ao criar contato");
				return $this->redirect()->toRoute("contato", array('action' => 'novo'));
			}
		}
	}
	
	public function getFlashMessenger() {
		$messenger = array();
	    $flashMessenger = $this->flashMessenger();
	 
	    if ($flashMessenger->hasSuccessMessages()){
			$message = $flashMessenger->getSuccessMessages();
	    	$messenger['alert-success'] = array_shift($message);
	    }
	    if ($flashMessenger->hasErrorMessages()) {
	    	$message = $flashMessenger->getErrorMessages();
	        $messenger['alert-error'] = array_shift($message);
	    }
	    return $messenger;
	}
	
	public function detalhesAction() {
		$id = (int)$this->params()->fromRoute('id',0);
		
		if(!$id) {
			$this->flashMessenger()->addErrorMessage("Contato não encontrado");
			return $this->redirect()->toRoute('contato');
		}
		
		$form = array(
				"nome"                  => "Igor Rocha",
				"telefone_principal"    => "(085) 8585-8585",
				"telefone_secundario"   => "(085) 8585-8585",
				"data_criacao"          => "02/03/2013",
				"data_atualizacao"      => "02/03/2013",
		);
		
		return array('id' => $id, 'form' => $form, 'message' => $this->getFlashMessenger());		
	}
	
	public function editarAction() {
		$id = (int)$this->params()->fromRoute('id',0);
		if(!$id){
			$this->flashMessenger()->addErrorMessage("Contato não encontrado");
			return $this->redirect()->toRoute('contato');
		}
		
		$form = array(
				'nome'                  => 'Igor Rocha',
				"telefone_principal"    => "(085) 8585-8585",
				"telefone_secundario"   => "(085) 8585-8585",
		);
		
		return array('id' => $id, 'form' => $form, 'message' => $this->getFlashMessenger());
	}
	
	public function atualizarAction() {
		$request = $this->getRequest();
		if($request->isPost()) {
			$postData = $request->getPost()->toArray();
			$formularioValido = true;
			
			if($formularioValido) {
				$this->flashMessenger()->addSuccessMessage("Contato editado com sucesso");
				
				return $this->redirect()->toRoute('contato', array("action" => 'detalhes', "id"=> $postData['id'],));
			} else {
				$this->flashMessenger()->addErrorMessage("Erro ao editar o contato");
				return  $this->redirect()->toRoute('contato', array('action' => 'editar', 'id' => $postData['id'],));
			}
		}
	}
	
	public function deletarAction() {
		$id = (int)$this->params()->fromRoute('id', 0);
		
		if(!id) {
			$this->flashMessenger()->addErrorMessage("Contato não encontrado");
		} else {
			$this->flashMessenger()->addSuccessMessage("Contato de ID $id deletado com sucesso");
		}
		
		return $this->redirect()->toRoute("contato");
	}
	
}