<?php
 
class android extends TYPO3\CMS\Frontend\Plugin\AbstractPlugin {
	
	function main(){
		TYPO3\CMS\Frontend\Utility\EidUtility::initFeUser();
		

		/*
		 * Following code will create a new message
		 * All messages details are read from HTTP Post Request
		 */
		
		// array for JSON response
		$response = array();
		
		$message = TYPO3\CMS\Core\Utility\GeneralUtility::_GP('message');
		if(isset($message)) {
			$fieldValues = array(
				'pid' => 37, // Android folder
				'entrydate' => time(),
				'message' => $message
			);
			
			$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery(
				'`tx_mytimeline_domain_model_timeline`',
				$fieldValues
			);
			
			$response['success'] = 1;
			$response['message'] = 'OK';
		}
		
		return json_encode($response);
	}
}

$output = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('android');
$result = $output->main();
echo $result;
?>