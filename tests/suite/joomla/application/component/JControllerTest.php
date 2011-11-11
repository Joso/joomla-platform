<?php
/**
 * @version   $Id: JControllerTest.php 20196 2011-01-09 02:40:25Z ian $
 * @copyright Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

require_once JPATH_PLATFORM . '/joomla/application/component/controller.php';
require_once JPATH_PLATFORM . '/joomla/environment/request.php';

/**
 * Test class for JController.
 * Generated by PHPUnit on 2011-11-11 at 17:20:53.
 */
class JControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var JController
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
		if (!defined('JPATH_COMPONENT'))
		{
			define('JPATH_COMPONENT', JPATH_BASE . '/components/com_foobar');
		}

		include_once 'JControllerInspector.php';

		$this->object = new JControllerInspector;
    }

	/**
	 * Test JController::addModelPath
	 *
	 * @since	11.3
	 */
	public function testAddModelPath()
	{
		// Include JModel as this method is a proxy for JModel::addIncludePath
		require_once JPATH_PLATFORM . '/joomla/application/component/model.php';

		$path = JPath::clean(JPATH_ROOT . '/addmodelpath');
		JController::addModelPath($path);

		// The default path is the class file folder/forms
		$valid = JPATH_PLATFORM . '/joomla/form/fields';

		$this->assertThat(
			in_array($path, JModel::addIncludePath()),
			$this->isTrue(),
			'Line:' . __LINE__ . ' The path should be added to the JModel paths.'
		);
	}

    /**
     * Test JController::createFileName().
     */
    public function testCreateFileName()
    {
    	$parts = array('name' => 'test');
    	
    	$this->assertThat(
    		JControllerInspector::createFileName('controller', $parts),
    		$this->equalTo('test.php')
    	);
    	
    	$parts['format'] = 'html';

    	$this->assertThat(
    		JControllerInspector::createFileName('controller', $parts),
    		$this->equalTo('test.php')
    	);

    	$parts['format'] = 'json';

    	$this->assertThat(
    		JControllerInspector::createFileName('controller', $parts),
    		$this->equalTo('test.json.php')
    	);
    	
    	$parts = array('name' => 'TEST', 'format' => 'JSON');
    	
    	$this->assertThat(
    		JControllerInspector::createFileName('controller', $parts),
    		$this->equalTo('test.json.php')
    	);
    	
    	$parts = array('name' => 'test');
    	
		$this->assertThat(
    		JControllerInspector::createFileName('view', $parts),
    		$this->equalTo('test/view.php')
    	);
    	
    	$parts['type'] = 'json';
    	
		$this->assertThat(
    		JControllerInspector::createFileName('view', $parts),
    		$this->equalTo('test/view.json.php')
    	);
    	
    	$parts = array('type' => 'JSON', 'name' => 'TEST');

		$this->assertThat(
    		JControllerInspector::createFileName('view', $parts),
    		$this->equalTo('test/view.json.php')
    	);
    }
	
    /**
     * @todo Implement testGetInstance().
     */
    public function testGetInstance()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
        JController::getInstance('not-found');
    }

    /**
	 * Test JController::__construct
	 *
	 * @since	11.3
	 */
	public function test__construct()
	{
		$controller = new TestTestController;
		$this->assertThat(
			$controller->getTasks(),
			$this->equalTo(
				array(
					'task5', 'task1', 'task2', 'display'
				)
			),
			'Line:' . __LINE__ . ' The available tasks should be the public tasks in _all_ the derived classes after controller plus "display".'
		);
	}

	/**
	 * Test JController::addPath().
	 *
	 * Note that addPath call JPath::check which will exit if the path is out of bounds.
	 * If execution halts for some reason, a bad path could be the culprit.
	 *
	 * @since	11.3
	 */
	public function testAddPath()
	{
		$controller = new JControllerInspector;

		$path = JPATH_ROOT . '//foobar';
		$controller->addPath('test', $path);
		$paths = $controller->getPaths();

		$this->assertThat(
			isset($paths['test']),
			$this->isTrue(),
			'Line:' . __LINE__ . ' The path type should be set.'
		);

		$this->assertThat(
			is_array($paths['test']),
			$this->isTrue(),
			'Line:' . __LINE__ . ' The path type should be an array.'
		);

		$this->assertThat(
			str_replace(DIRECTORY_SEPARATOR, '/', $paths['test'][0]),
			$this->equalTo(str_replace(DIRECTORY_SEPARATOR, '/', JPATH_ROOT . '/foobar/')),
			'Line:' . __LINE__ . ' The path type should be present, clean and with a trailing slash.'
		);
	}
	
	/**
	 * Test JController::addViewPath
	 */
	public function testAddViewPath()
	{
		$controller = new JControllerInspector;

		$path = JPATH_ROOT . '/views';
		$controller->addViewPath($path);
		$paths = $controller->getPaths();

		$this->assertThat(
			isset($paths['view']),
			$this->isTrue(),
			'Line:' . __LINE__ . ' The path type should be set.'
		);

		$this->assertThat(
			is_array($paths['view']),
			$this->isTrue(),
			'Line:' . __LINE__ . ' The path type should be an array.'
		);

		$this->assertThat(
			str_replace(DIRECTORY_SEPARATOR, '/', $paths['view'][0]),
			$this->equalTo(str_replace(DIRECTORY_SEPARATOR, '/', JPATH_ROOT . '/views/')),
			'Line:' . __LINE__ . ' The path type should be present, clean and with a trailing slash.'
		);
	}

    /**
     * @todo Implement testAuthorize().
     */
    public function testAuthorize()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testAuthorise().
     */
    public function testAuthorise()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testCheckEditId().
     */
    public function testCheckEditId()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testCreateModel().
     */
    public function testCreateModel()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testCreateView().
     */
    public function testCreateView()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testDisplay().
     */
    public function testDisplay()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testExecute().
     */
    public function testExecute()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testGetModel().
     */
    public function testGetModel()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

	/**
	 * Test JController::getName
	 */
	public function testGetName()
	{
		$this->assertThat(
			$this->object->getName(),
			$this->equalTo('j')
		);

		$this->object->name = 'inspector';

		$this->assertThat(
			$this->object->getName(),
			$this->equalTo('inspector')
		);
	}

	/**
	 * Test JController::getTask().
	 * 
	 * @return  void
	 * 
	 * @since   11.3
	 */
	public function testGetTask()
	{
		$this->assertThat(
			$this->object->get('task'),
			$this->equalTo(null)
		);

		$this->object->set('task', 'test');

		$this->assertThat(
			$this->object->get('task'),
			$this->equalTo('test')
		);
	}

	/**
	 * Test JController::getTasks
	 */
	public function testGetTasks()
	{
		$controller = new TestController;

		$this->assertThat(
			$controller->getTasks(),
			$this->equalTo(
				array(
					'task1', 'task2', 'display'
				)
			),
			'Line:' . __LINE__ . ' The available tasks should be the public tasks in the derived controller plus "display".'
		);
	}

    /**
     * @todo Implement testGetView().
     */
    public function testGetView()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testHoldEditId().
     */
    public function testHoldEditId()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRedirect().
     */
    public function testRedirect()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRegisterDefaultTask().
     */
    public function testRegisterDefaultTask()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRegisterTask().
     */
    public function testRegisterTask()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testUnregisterTask().
     */
    public function testUnregisterTask()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testReleaseEditId().
     */
    public function testReleaseEditId()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testSetAccessControl().
     */
    public function testSetAccessControl()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

	/**
	 * Test JController::setMessage
	 */
	public function testSetMessage()
	{
		$controller = new JControllerInspector;
		$controller->setMessage('Hello World');

		$this->assertEquals($controller->message, 'Hello World',
							'Line:' . __LINE__ . ' The message text does not equal with previuosly set one'
		);

		$this->assertEquals($controller->messageType, 'message',
							'Line:' . __LINE__ . ' Default message type should be "message"'
		);

		$controller->setMessage('Morning Universe', 'notice');

		$this->assertEquals($controller->message, 'Morning Universe',
							'Line:' . __LINE__ . ' The message text does not equal with previuosly set one'
		);

		$this->assertEquals($controller->messageType, 'notice',
							'Line:' . __LINE__ . ' The message type does not equal with previuosly set one'
		);
	}

    /**
     * @todo Implement testSetPath().
     */
    public function testSetPath()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

	/**
	 * Test JController::setRedirect
	 */
	public function testSetRedirect()
	{
		// Set the URL only
		$this->object->setRedirect('index.php?option=com_foobar');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertNull(
			$this->object->message,
			'Line:' . __LINE__ . ' The message is not set, so it should be null'
		);

		$this->assertEquals(
			$this->object->messageType,
			'message',
			'Line:' . __LINE__ . ' Default message type should be "message"'
		);

		// Set the URL and message
		$this->object->setRedirect('index.php?option=com_foobar', 'Hello World');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Hello World',
			'Line:' . __LINE__ . ' The message text does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->messageType,
			'message',
			'Line:' . __LINE__ . ' Default message type should be "message"'
		);

		// URL, message and message type
		$this->object->setRedirect('index.php?option=com_foobar', 'Morning Universe', 'notice');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Morning Universe',
			'Line:' . __LINE__ . ' The message text does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->messageType,
			'notice',
			'Line:' . __LINE__ . ' The message type does not equal with passed one'
		);

		// With previously set message
		// URL
		$this->object->setMessage('Hi all');
		$this->object->setRedirect('index.php?option=com_foobar');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Hi all',
			'Line:' . __LINE__ . ' The message text does not equal with previously set one'
		);

		$this->assertEquals(
			$this->object->messageType,
			'message',
			'Line:' . __LINE__ . ' Default message type should be "message"'
		);

		// URL and message
		$this->object->setMessage('Hi all');
		$this->object->setRedirect('index.php?option=com_foobar', 'Bye all');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Bye all',
			'Line:' . __LINE__ . ' The message text should be overridden'
		);

		$this->assertEquals(
			$this->object->messageType,
			'message',
			'Line:' . __LINE__ . ' Default message type should be "message"'
		);

		// URL, message and message type
		$this->object->setMessage('Hi all');
		$this->object->setRedirect('index.php?option=com_foobar', 'Bye all', 'notice');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Bye all',
			'Line:' . __LINE__ . ' The message text should be overridden'
		);

		$this->assertEquals(
			$this->object->messageType,
			'notice',
			'Line:' . __LINE__ . ' The message type should be overridden'
		);

		// URL and message type
		$this->object->setMessage('Hi all');
		$this->object->setRedirect('index.php?option=com_foobar', null, 'notice');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Hi all',
			'Line:' . __LINE__ . ' The message text should not be overridden'
		);

		$this->assertEquals(
			$this->object->messageType,
			'notice',
			'Line:' . __LINE__ . ' The message type should be overridden'
		);

		// With previously set message and message type
		// URL
		$this->object->setMessage('Hello folks', 'notice');
		$this->object->setRedirect('index.php?option=com_foobar');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Hello folks',
			'Line:' . __LINE__ . ' The message text does not equal with previously set one'
		);

		$this->assertEquals(
			$this->object->messageType,
			'notice',
			'Line:' . __LINE__ . ' The message type does not equal with previously set one'
		);

		// URL and message
		$this->object->setMessage('Hello folks', 'notice');
		$this->object->setRedirect('index.php?option=com_foobar', 'Bye, Folks');

		$this->assertEquals(
		$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Bye, Folks',
			'Line:' . __LINE__ . ' The message text should be overridden'
		);

		$this->assertEquals(
			$this->object->messageType,
			'notice',
			'Line:' . __LINE__ . ' The message type does not equal with previously set one'
		);

		// URL, message and message type
		$this->object->setMessage('Hello folks', 'notice');
		$this->object->setRedirect('index.php?option=com_foobar', 'Bye, folks', 'notice');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Bye, folks',
			'Line:' . __LINE__ . ' The message text should be overridden'
		);

		$this->assertEquals(
			$this->object->messageType,
			'notice',
			'Line:' . __LINE__ . ' The message type should be overridden'
		);

		// URL and message type
		$this->object->setMessage('Folks?', 'notice');
		$this->object->setRedirect('index.php?option=com_foobar', null, 'question');

		$this->assertEquals(
			$this->object->redirect,
			'index.php?option=com_foobar',
			'Line:' . __LINE__ . ' The redirect address does not equal with passed one'
		);

		$this->assertEquals(
			$this->object->message,
			'Folks?',
			'Line:' . __LINE__ . ' The message text should not be overridden'
		);

		$this->assertEquals(
			$this->object->messageType,
			'question',
			'Line:' . __LINE__ . ' The message type should be overridden'
		);
	}
}
