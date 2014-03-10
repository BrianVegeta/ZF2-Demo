<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;
use Application\Entity\Address;
use Application\Entity\Project;

class UserController extends AbstractActionController
{
	protected $_objectManager;

	public function indexAction()
	{
		$users = $this->getObjectManager()->getRepository('\Application\Entity\User')->findAll();

		return new ViewModel(array('users' => $users));
	}

	public function addAction()
	{
		if ($this->request->isPost()) {
		    $fullname = $this->getRequest()->getPost('fullname');
		    $city = $this->getRequest()->getPost('city');
		    $country = $this->getRequest()->getPost('country');
// 		    $projectName = $this->getRequest()->getPost('projectName');
		    
			$user = new User();
			$user->setFullName($fullname);
			$this->getObjectManager()->persist($user);
			
			$address = new Address();
			$address->setCity($city);
			$address->setCountry($country);
			$this->getObjectManager()->persist($address);
			
// 			$project = new Project();
// 			$project->setName($projectName);
// 			$this->getObjectManager()->persist($project);
			
			$user->setAddress($address);
// 			$user->getProjects()->add($project);

			$this->getObjectManager()->flush();
			$newId = $user->getId();

			return $this->redirect()->toRoute('user');
		}
		return new ViewModel();
	}

	public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		$user = $this->getObjectManager()->find('\Application\Entity\User', $id);

		if ($this->request->isPost()) {
			$fullname = $this->getRequest()->getPost('fullname');
		    $city = $this->getRequest()->getPost('city');
		    $country = $this->getRequest()->getPost('country');
// 		    $projectName = $this->getRequest()->getPost('projectName');
		    
			$user->setFullName($fullname);
			$this->getObjectManager()->persist($user);
			
			$address = $user->getAddress();
			$address->setCity($city);
			$address->setCountry($country);
			$this->getObjectManager()->persist($address);
			
// 			$project = $user->getProjects()->first();
// 			$project->setName($projectName);
// 			$this->getObjectManager()->persist($project);
			
			$user->setAddress($address);
// 			$user->getProjects()->add($project);

			$this->getObjectManager()->flush();

			return $this->redirect()->toRoute('user');
		}

		return new ViewModel(array('user' => $user));
	}

	public function deleteAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		$user = $this->getObjectManager()->find('\Application\Entity\User', $id);

		if ($this->request->isPost()) {
			$this->getObjectManager()->remove($user);
			$this->getObjectManager()->remove($user->getAddress());
			$this->getObjectManager()->flush();

			return $this->redirect()->toRoute('user');
		}

		return new ViewModel(array('user' => $user));
	}

	protected function getObjectManager()
	{
		if (!$this->_objectManager) {
			$this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}

		return $this->_objectManager;
	}
}