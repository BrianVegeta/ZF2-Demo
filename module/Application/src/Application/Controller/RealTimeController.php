<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class RealTimeController extends AbstractActionController
{
	public function longPollingAction()
	{
	    $request = $this->getRequest();
	    if ($request->isXmlHttpRequest() === false) {
	        return new ViewModel();
	    }
		set_time_limit(0);
		$data_source_file = './public/data.txt';
		
		while (true) {
		    clearstatcache();
		    $timestamp = $request->getQuery('timestamp');
		    $last_change_in_data_file = filemtime($data_source_file);
		
			if ($timestamp == null || $last_change_in_data_file > $timestamp) {
			    $data = file_get_contents($data_source_file);
		          
				$result = new JsonModel(array(
				    'data_from_file' => $data,
				    'timestamp' => $last_change_in_data_file
				));
				
				return $result;
				break;
		
			} else {
				// wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
				sleep( 1 );
				continue;
			}
		}
	}
}
