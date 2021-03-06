<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2016 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 *
 * @license     MIT
 */

namespace Falc\Robo\Service\CommandBuilder;

/**
 * SysVinit command builder.
 */
abstract class SysVinitCommandBuilder implements CommandBuilderInterface
{
    /**
     * Command name.
     *
     * @var string
     */
    protected $cmd;

    /**
     * Command action.
     *
     * @var string
     */
    protected $action;

    /**
     * Whether the command should be quiet or not.
     *
     * @var boolean
     */
    protected $quiet = false;

    /**
     * Service.
     *
     * @var string
     */
    protected $service;

    /**
     * Option list.
     *
     * @var string[]
     */
    protected $options = [];

    /**
     * {@inheritdoc}
     */
    public function start($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be started');
        }

        $this->cmd = '/etc/init.d';
        $this->service = $service;
        $this->action = 'start';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function stop($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be stopped');
        }

        $this->cmd = '/etc/init.d';
        $this->service = $service;
        $this->action = 'stop';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function restart($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be restarted');
        }

        $this->cmd = '/etc/init.d';
        $this->service = $service;
        $this->action = 'restart';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reload($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be reloaded');
        }

        $this->cmd = '/etc/init.d';
        $this->service = $service;
        $this->action = 'reload';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function enable($service);

    /**
     * {@inheritdoc}
     */
    abstract public function disable($service);

    /**
     * {@inheritdoc}
     *
     * @throws \BadMethodCallException
     */
    public function daemonReload()
    {
        throw new \BadMethodCallException('Action "daemon-reload" not supported for SysVinit');
    }

    /**
     * {@inheritdoc}
     */
    public function quiet()
    {
        $this->quiet = true;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommand()
    {
        $options = implode(' ', array_unique($this->options));

        $command = "{$this->cmd}/{$this->service} {$this->action} {$options}";

        if (!in_array($this->action, ['start', 'stop', 'restart', 'reload'])) {
            $command = "{$this->cmd} {$options} {$this->service} {$this->action}";
        }

        if ($this->quiet === true) {
            $command = "{$command} > /dev/null";
        }

        // Remove extra whitespaces
        $command = preg_replace('/\s+/', ' ', trim($command));

        return $command;
    }
}
