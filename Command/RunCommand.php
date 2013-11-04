<?php

namespace Ivan1986\SupervisorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class RunCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('supervisor:run')
            ->setDescription('run supervisor instance')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('ivan1986_supervisor.supervisor_service')->run();
    }
}