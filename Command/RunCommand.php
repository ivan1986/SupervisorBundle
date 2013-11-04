<?php

namespace Ivan1986\SupervisorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('supervisor:run')
            //->addArgument('all', InputArgument::OPTIONAL, 'All recheck')
            ->setDescription('run supervisor instance')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        chdir($this->getContainer()->getParameter('kernel.root_dir'));

        echo getcwd();
    }


} 