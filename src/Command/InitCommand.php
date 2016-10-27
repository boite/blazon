<?php

namespace Blazon\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;
use Blazon\Blazon;
use Blazon\Model\Site;
use Blazon\Loader\SiteLoader;
use Blazon\Utils;

class InitCommand extends Command
{
    public function configure()
    {
        $this->setName('init')
            ->setDescription('Initialize build directory (static assets)')
            ->addOption(
                'filename',
                null,
                InputOption::VALUE_OPTIONAL,
                'blazon.yml file'
            )
            ->addOption(
                'dest',
                null,
                InputOption::VALUE_OPTIONAL,
                'Destination path'
            )
        ;
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = getcwd() . '/blazon.yml';
        if ($input->getOption('filename')) {
            $filename = $input->getOption('filename');
        }
        
        $dest = null;
        if ($input->getOption('dest')) {
            $dest = $input->getOption('dest');
            $dest = Utils::makePathAbsolute($dest);
        }
        
        $blazon = new Blazon($filename, $output, $dest);

        $blazon->init();
        
        $output->writeLn("<comment>Done</comment>");
    }
}
