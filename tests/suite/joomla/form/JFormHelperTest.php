<?php
/**
 * @package     Joomla.UnitTest
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

include_once JPATH_PLATFORM . '/joomla/form/helper.php';

/**
 * Test class for JFormHelper.
 * Generated by PHPUnit on 2011-10-26 at 19:32:58.
 */
class JFormHelperTest extends PHPUnit_Framework_TestCase {
    /**
     * @todo Implement testLoadFieldType().
     */
    public function testLoadFieldType() {	
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testLoadRuleType().
     */
    public function testLoadRuleType() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testLoadFieldClass().
     */
    public function testLoadFieldClass() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testLoadRuleClass().
     */
    public function testLoadRuleClass() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * Test JFormHelper::addFieldPath().
     */
    public function testAddFieldPath() {
    	$paths = JFormHelper::addFieldPath();
    	foreach($paths as &$path)
    	{
    		$path = JPath::clean($path, '/');
    	}
    	
    	$this->assertThat(
    		$paths,
    		$this->equalTo(array(JPATH_PLATFORM.'/joomla/form/fields'))
    	);
    	
    	$paths = JFormHelper::addFieldPath(JPATH_ROOT.'/docs');
    	foreach($paths as &$path)
    	{
    		$path = JPath::clean($path, '/');
    	}
    	
    	$this->assertThat(
    		$paths,
    		$this->equalTo(
    			array(
    				JPATH_ROOT.'/docs', 
    				JPATH_PLATFORM.'/joomla/form/fields'
    			)
    		)
    	);
    }

    /**
     * Test JFormHelper::addFormPath().
     */
    public function testAddFormPath() {
    	$paths = JFormHelper::addFormPath();
    	foreach($paths as &$path)
    	{
    		$path = JPath::clean($path, '/');
    	}
    	
    	$this->assertThat(
    		$paths,
    		$this->equalTo(array(JPATH_PLATFORM.'/joomla/form/forms'))
    	);
    	
    	$paths = JFormHelper::addFormPath(JPATH_ROOT.'/docs');
    	foreach($paths as &$path)
    	{
    		$path = JPath::clean($path, '/');
    	}
    	
    	$this->assertThat(
    		$paths,
    		$this->equalTo(
    			array(
    				JPATH_ROOT.'/docs', 
    				JPATH_PLATFORM.'/joomla/form/forms'
    			)
    		)
    	);
	}

    /**
     * Test JFormHelper::addRulePath().
     */
    public function testAddRulePath() {
    	$paths = JFormHelper::addRulePath();
    	foreach($paths as &$path)
    	{
    		$path = JPath::clean($path, '/');
    	}
    	
    	$this->assertThat(
    		$paths,
    		$this->equalTo(array(JPATH_PLATFORM.'/joomla/form/rules'))
    	);
    	
    	$paths = JFormHelper::addRulePath(JPATH_ROOT.'/docs');
    	foreach($paths as &$path)
    	{
    		$path = JPath::clean($path, '/');
    	}
    	
    	$this->assertThat(
    		$paths,
    		$this->equalTo(
    			array(
    				JPATH_ROOT.'/docs', 
    				JPATH_PLATFORM.'/joomla/form/rules'
    			)
    		)
    	);
    }

}

?>