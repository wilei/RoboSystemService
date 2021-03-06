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

namespace Falc\Robo\Service;

use Robo\Contract\CommandInterface;

/**
 * Service enable
 *
 * ``` php
 * // Enabling a service:
 * $this->taskServiceEnable()
 *     ->serviceManager('systemd')
 *     ->service('httpd')
 *     ->run();
 *
 * // Compact form:
 * $this->taskServiceEnable('systemd', 'httpd')->run();
 * ```
 */
class Enable extends BaseTask implements CommandInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function getCommand()
    {
        if ($this->builder === null) {
            throw new \InvalidArgumentException('Service manager not defined');
        }

        $this->builder->enable($this->service);

        if (!$this->verbose) {
            $this->builder->quiet();
        }

        return $this->builder->getCommand();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function run()
    {
        $command = $this->getCommand();

        $this->printTaskInfo('Enabling service...');
        return $this->executeCommand($command);
    }
}
