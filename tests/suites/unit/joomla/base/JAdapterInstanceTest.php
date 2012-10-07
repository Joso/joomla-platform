<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Base
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM . '/joomla/base/adapterinstance.php';

/**
 * Test class for JAdapterInstance.
 * Generated by PHPUnit on 2009-10-08 at 11:43:00.
 *
 * @package  Joomla.UnitTest
 *
 * @since    11.1
 */
class JAdapterInstanceTest extends TestCase
{
	/**
	 * Sets up the fixture.
	 *
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->saveFactoryState();

		JFactory::$database = $this->getMockDatabase();
	}

	/**
	 * Tears down the fixture.
	 *
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();

		parent::tearDown();
	}

	/**
	 * Test...
	 *
	 * @todo Decide how to Implement.
	 *
	 * @return void
	 */
	public function testGetParent()
	{
		$this->object = new JAdapter(__DIR__, 'Test', 'stubs');

		$this->assertThat(
			$this->object->getAdapter('Testadapter3')->getParent(),
			$this->identicalTo($this->object)
		);
	}
}
