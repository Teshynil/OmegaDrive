<?php

namespace AppBundle\Command;

use AppBundle\Entity\Entity;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Start the installation')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist(new Entity("File"));
        $em->persist(new Entity("Folder"));
        $em->flush();
        $output->writeln('Installation complete.');
    }

}
