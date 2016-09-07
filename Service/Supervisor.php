<?php

namespace Ivan1986\SupervisorBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Process\Process;

class Supervisor
{
    /** @var TwigEngine */
    protected $templating;
    private $appDir;
    private $name;

    public function __construct($templating, $appDir, $name)
    {
        $this->templating = $templating;
        $this->appDir = $appDir;
        $this->name = $name ? (' -i '.$name) : '';
    }

    /**
     * Сгенерировать конфиг для программы
     *
     * @param $fileName string file in app/supervisor dir
     * @param $vars array array(name,command,[numprocs])
     * @param bool $template string non default template
     */
    public function genProgrammConf($fileName, $vars, $template = false)
    {
        $template = $template?:'@Supervisor/programm.conf.twig';
        $content = $this->templating->render($template, $vars);
        file_put_contents($this->appDir.'/supervisor/'.$fileName.'.conf', $content);
    }

    /**
     * Выполняет команду супервизора
     *
     * @param string $cmd string supervisorctl command
     * @return Process Завершенный процесс
     */
    public function execute($cmd)
    {
        $p = new Process("supervisorctl ".$cmd);
        $p->setWorkingDirectory($this->appDir);
        $p->run();
        $p->wait();
        return $p;
    }

    /**
     * Перечитать конфиг и перезапустить процессы
     */
    public function reloadAndUpdate()
    {
        $this->execute('reread');
        $this->execute('update');
    }

    /**
     * Запустить демона, если он не работает
     */
    public function run()
    {
        $result = $this->execute('status')->getOutput();
        if (strpos($result, 'sock no such file') || strpos($result, 'refused connection')) {
            $p = new Process('supervisord'.$this->name);
            $p->setWorkingDirectory($this->appDir);
            $p->run();
        }
    }
}
