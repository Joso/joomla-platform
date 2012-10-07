<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Cache
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JCacheStorageApc.
 * Generated by PHPUnit on 2009-10-08 at 21:44:48.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Cache
 *
 * @since       11.1
 */
class JCacheStorageApcTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JCacheStorageApc
	 * @access protected
	 */
	protected $object;

	/**
	 * @var    apcAvailable
	 * @access protected
	 */
	protected $apcAvailable;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		include_once JPATH_PLATFORM . '/joomla/cache/storage.php';
		include_once JPATH_PLATFORM . '/joomla/cache/storage/apc.php';

		$this->object = JCacheStorage::getInstance('apc');
		$this->apcAvailable = extension_loaded('apc');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{
	}

	/**
	 * Test...
	 *
	 * @todo Implement testGet().
	 *
	 * @return void
	 */
	public function testGet()
	{
		if ($this->apcAvailable)
		{
			$this->markTestIncomplete('This test has not been implemented yet.');
		}
		else
		{
			$this->markTestSkipped('This caching method is not supported on this system.');
		}
	}

	/**
	 * Test...
	 *
	 * @todo Implement testStore().
	 *
	 * @return void
	 */
	public function testStore()
	{
		if ($this->apcAvailable)
		{
			$this->markTestIncomplete('This test has not been implemented yet.');
		}
		else
		{
			$this->markTestSkipped('This caching method is not supported on this system.');
		}
	}

	/**
	 * Test...
	 *
	 * @todo Implement testRemove().
	 *
	 * @return void
	 */
	public function testRemove()
	{
		if ($this->apcAvailable)
		{
			$this->markTestIncomplete('This test has not been implemented yet.');
		}
		else
		{
			$this->markTestSkipped('This caching method is not supported on this system.');
		}
	}

	/**
	 * Test...
	 *
	 * @todo Implement testClean().
	 *
	 * @return void
	 */
	public function testClean()
	{
		if ($this->apcAvailable)
		{
			$this->markTestIncomplete('This test has not been implemented yet.');
		}
		else
		{
			$this->markTestSkipped('This caching method is not supported on this system.');
		}
	}

	/**
	 * Testing isSupported().
	 *
	 * @return void
	 */
	public function testIsSupported()
	{
		$this->assertThat(
			$this->object->isSupported(),
			$this->equalTo($this->apcAvailable),
			'Claims APC is not loaded.'
		);
	}

	/**
	 * Test...
	 *
	 * @todo Implement test_setExpire().
	 *
	 * @return void
	 */
	public function testSetExpire()
	{
		if ($this->apcAvailable)
		{
			$this->markTestIncomplete('This test has not been implemented yet.');
		}
		else
		{
			$this->markTestSkipped('This caching method is not supported on this system.');
		}
	}

	/**
	 * Test...
	 *
	 * @todo Implement test_getCacheId().
	 *
	 * @return void
	 */
	public function testGetCacheId()
	{
		if ($this->apcAvailable)
		{
			$this->markTestIncomplete('This test has not been implemented yet.');
		}
		else
		{
			$this->markTestSkipped('This caching method is not supported on this system.');
		}
	}
}
