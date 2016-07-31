<?php
namespace Orbix\Mytimeline\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * TimelineController
 */
class TimelineController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * timelineRepository
     *
     * @var \Orbix\Mytimeline\Domain\Repository\TimelineRepository
     * @inject
     */
    protected $timelineRepository = NULL;
	
	
    /**
     * categoryRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository = NULL;
	
    
    /**
     * action list
     *
     * @return void
     */
    public function initializeAction()
    {
        // Nécessaire pour sauvegarder la date
        $arguments = array('newTimeline', 'timeline');
        foreach ($arguments as $argument) {
            if ($this->arguments->hasArgument($argument)) {
                // Change files properties type from string to array
                $this->arguments->getArgument($argument)->getPropertyMappingConfiguration()->forProperty('entrydate')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd/m/Y');
            }
        }
    }
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $timelines = $this->timelineRepository->findAll();
        $this->view->assign('timelines', $timelines);
    }
    
    /**
 * action show
 *
 * @param \Orbix\Mytimeline\Domain\Model\Timeline $timeline
 * @return void
 */
    public function showAction(\Orbix\Mytimeline\Domain\Model\Timeline $timeline)
    {
        $this->view->assign('timeline', $timeline);
    }


    /**
     * action timeline
     *
     * @param \Orbix\Mytimeline\Domain\Model\Timeline $timeline
     * @return void
     */
    public function timelineAction(\Orbix\Mytimeline\Domain\Model\Timeline $timeline)
    {
        $this->view->assign('timeline', $timeline);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
		$categories = $this->categoryRepository->findAll();
		$this->view->assign( 'categories', $categories );
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($categories);
    }
    
    /**
     * action create
     *
     * @param \Orbix\Mytimeline\Domain\Model\Timeline $newTimeline
     * @return void
     */
    public function createAction(\Orbix\Mytimeline\Domain\Model\Timeline $newTimeline)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->timelineRepository->add($newTimeline);
        $this->redirect('list');
    }
    
    /**
     * action edit
     *
     * @param \Orbix\Mytimeline\Domain\Model\Timeline $timeline
     * @ignorevalidation $timeline
     * @return void
     */
    public function editAction(\Orbix\Mytimeline\Domain\Model\Timeline $timeline)
    {



        $this->view->assign('timeline', $timeline);

        // Gestion des catégories dans le formulaire d'édition
        $categories = $this->categoryRepository->findAll();
        $this->view->assign( 'categories', $categories );
    }
    
    /**
     * action update
     *
     * @param \Orbix\Mytimeline\Domain\Model\Timeline $timeline
     * @return void
     */
    public function updateAction(\Orbix\Mytimeline\Domain\Model\Timeline $timeline)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->timelineRepository->update($timeline);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \Orbix\Mytimeline\Domain\Model\Timeline $timeline
     * @return void
     */
    public function deleteAction(\Orbix\Mytimeline\Domain\Model\Timeline $timeline)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->timelineRepository->remove($timeline);
        $this->redirect('list');
    }

}