<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 *
 * @license     MIT
 */

namespace Falc\Robo\Service\Test;

use Falc\Robo\Service;

/**
 * BaseTestCase.
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    use Service\loadTasks;

    protected function createCommandBuilderMock()
    {
        $mock = $this->getMockBuilder('Falc\Robo\Service\CommandBuilder\CommandBuilderInterface')
            ->setMethods(['start', 'stop', 'restart', 'reload', 'enable', 'disable', 'daemonReload', 'quiet', 'getCommand'])
            ->getMock();

        $mock
            ->method('start')
            ->will($this->returnValue($mock));

        $mock
            ->method('stop')
            ->will($this->returnValue($mock));

        $mock
            ->method('restart')
            ->will($this->returnValue($mock));

        $mock
            ->method('reload')
            ->will($this->returnValue($mock));

        $mock
            ->method('enable')
            ->will($this->returnValue($mock));

        $mock
            ->method('disable')
            ->will($this->returnValue($mock));

        $mock
            ->method('daemonReload')
            ->will($this->returnValue($mock));

        $mock
            ->method('quiet')
            ->will($this->returnValue($mock));

        return $mock;
    }

    protected function createFactoryMock($builder)
    {
        $mock = $this->getMockBuilder('Falc\Robo\Service\Factory\CommandBuilderFactory')
            ->setMethods(['create'])
            ->getMock();

        $mock
            ->method('create')
            ->will($this->returnValue($builder));

        return $mock;
    }
}
