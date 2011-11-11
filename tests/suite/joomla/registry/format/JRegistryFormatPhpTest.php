<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Registry
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM.'/joomla/registry/format.php';
require_once JPATH_PLATFORM.'/joomla/registry/format/php.php';

/**
 * Test class for JRegistryFormatPHP.
 * Generated by PHPUnit on 2009-10-27 at 15:13:25.
 */
class JRegistryFormatPHPTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	function setUp()
	{
		$this->instance = new JRegistryFormatPHP;
	}

	/**
	 * Convert an array into an object.
	 *
	 * @param   array
	 * @return  object
	 */
	private static function _objectFactory($properties)
	{
		$obj = new stdClass();
		foreach ($properties as $k => $v) {
			$obj->{$k} = $v;
		}
		return $obj;
	}

	/**
	 * Get the objects to run tests on.
	 */
	public function getObjects()
	{
		$tests = array(
			'Regular Object' => array(
				self::_objectFactory(array('test1' => 'value1', 'test2' => 'value2', 'array' => array('test3' => 'value3'))),
				array('class' => 'myClass'),
				'<?php'."\n".'class myClass {'."\n\t".'public $test1 = \'value1\';'."\n\t".'public $test2 = \'value2\';'."\n\t".'public $array = array("test3" => "value3");'."\n}\n".'?>'
			),
			'Object with Double Quote' => array(
				self::_objectFactory(array('test1' => 'value1"', 'test2' => 'value2')),
				array('class' => 'myClass'),
				'<?php'."\n".'class myClass {'."\n\t".'public $test1 = \'value1"\';'."\n\t".'public $test2 = \'value2\';'."\n}\n".'?>'
			),
			'Object with nested arrays' => array(
				self::_objectFactory(array('test1' => array('test2' => array('test3' => 'value3')))),
				array('class' => 'myClass'),
				'<?php'."\n".'class myClass {'."\n\t".'public $test1 = array("test2" => array("test3" => "value3"));'."\n}\n".'?>'
			)
			

		);

		return $tests;
	}

	/**
	 * Test the JRegistryFormatPHP::objectToString method.
	 *
	 * @dataProvider getObjects
	 *
	 * @param string The type of input
	 * @param string The input
	 * @param string The expected result for this test.
	 */
	function testObjectToString($object, $params, $expect)
	{
		$this->assertEquals($expect, $this->instance->objectToString($object, $params));
	}

	/**
	 * Test the JRegistryFormatPHP::stringToObject method.
	 */
	public function testStringToObject()
	{
		// This method is not implemented in the class. The test is to achieve 100% code coverage
		$this->assertTrue($this->instance->stringToObject(''));
	}
}
