<?php
namespace Orbix\Mytimeline\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Orbix\Mytimeline\Controller\TimelineController.
 *
 */
class TimelineControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Orbix\Mytimeline\Controller\TimelineController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Orbix\\Mytimeline\\Controller\\TimelineController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTimelinesFromRepositoryAndAssignsThemToView()
	{

		$allTimelines = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$timelineRepository = $this->getMock('Orbix\\Mytimeline\\Domain\\Repository\\TimelineRepository', array('findAll'), array(), '', FALSE);
		$timelineRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTimelines));
		$this->inject($this->subject, 'timelineRepository', $timelineRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('timelines', $allTimelines);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTimelineToView()
	{
		$timeline = new \Orbix\Mytimeline\Domain\Model\Timeline();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('timeline', $timeline);

		$this->subject->showAction($timeline);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTimelineToTimelineRepository()
	{
		$timeline = new \Orbix\Mytimeline\Domain\Model\Timeline();

		$timelineRepository = $this->getMock('Orbix\\Mytimeline\\Domain\\Repository\\TimelineRepository', array('add'), array(), '', FALSE);
		$timelineRepository->expects($this->once())->method('add')->with($timeline);
		$this->inject($this->subject, 'timelineRepository', $timelineRepository);

		$this->subject->createAction($timeline);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTimelineToView()
	{
		$timeline = new \Orbix\Mytimeline\Domain\Model\Timeline();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('timeline', $timeline);

		$this->subject->editAction($timeline);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTimelineInTimelineRepository()
	{
		$timeline = new \Orbix\Mytimeline\Domain\Model\Timeline();

		$timelineRepository = $this->getMock('Orbix\\Mytimeline\\Domain\\Repository\\TimelineRepository', array('update'), array(), '', FALSE);
		$timelineRepository->expects($this->once())->method('update')->with($timeline);
		$this->inject($this->subject, 'timelineRepository', $timelineRepository);

		$this->subject->updateAction($timeline);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTimelineFromTimelineRepository()
	{
		$timeline = new \Orbix\Mytimeline\Domain\Model\Timeline();

		$timelineRepository = $this->getMock('Orbix\\Mytimeline\\Domain\\Repository\\TimelineRepository', array('remove'), array(), '', FALSE);
		$timelineRepository->expects($this->once())->method('remove')->with($timeline);
		$this->inject($this->subject, 'timelineRepository', $timelineRepository);

		$this->subject->deleteAction($timeline);
	}
}
