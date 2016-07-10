<?php
 
class android extends TYPO3\CMS\Frontend\Plugin\AbstractPlugin {
	
	function main(){
		TYPO3\CMS\Frontend\Utility\EidUtility::initFeUser();
		
		$aDiary = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			//'`uid`, `entry_date`, `message`',
			'`uid`, `message`',
			'`tx_mytimeline_domain_model_timeline`',
			'`deleted` = 0 AND `hidden` = 0'
		);
		
		$aMessage = array();
		$response['messages'] = array();
		foreach($aDiary as $diary) {
			array_push($response["messages"], $diary);
		}
		
		$response["success"] = 1;
		//return '{"messages":[{"uid":"1","message":"Test"},{"uid":"2","message":"Coucou Fabienne "},{"uid":"3","message":"hello"},{"uid":"4","message":"Coucou"},{"uid":"5","message":"Coucou4"}],"success":1}';
		return json_encode($response);
	}
}

$output = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('android');
$result = $output->main();

echo $result;
die();
?>