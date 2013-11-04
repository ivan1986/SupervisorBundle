<?php

namespace Ivan1986\SupervisorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ControlCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('supervisor:control')
            ->addArgument('cmd', InputArgument::IS_ARRAY, 'supervisorCtl command')
            ->setDescription('execute supervisorCtl command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->getContainer()->get('ivan1986_supervisor.supervisor_service')
            ->execute(join(' ',$input->getArgument('cmd')));
        echo $result->getOutput();
    }
}