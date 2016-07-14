<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Orbix.' . $_EXTKEY,
	'Mytimeline',
	array(
		'Timeline' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Timeline' => 'list, show, new, create, edit, update, delete',
		
	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['messageList'] = 'EXT:'.$_EXTKEY.'/class.eid_message_list.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['messageCreate'] = 'EXT:'.$_EXTKEY.'/class.eid_message_create.php';