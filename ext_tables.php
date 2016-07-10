<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Orbix.' . $_EXTKEY,
	'Mytimeline',
	'My Timeline'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'My Timeline');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mytimeline_domain_model_timeline', 'EXT:mytimeline/Resources/Private/Language/locallang_csh_tx_mytimeline_domain_model_timeline.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mytimeline_domain_model_timeline');

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
	$_EXTKEY,
	'tx_mytimeline_domain_model_timeline'
);
