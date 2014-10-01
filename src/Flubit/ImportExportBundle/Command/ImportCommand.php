<?php

namespace Flubit\ImportExportBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class ImportCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
                ->setName('flubit:import')
                ->setDescription('Parses all CSV and XML files from a directory and inserts their data into database.')
                ->addOption('debug', null, InputOption::VALUE_OPTIONAL, 'Should not be used on production; display each file import result.', false)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $debug = ('true' == $input->getOption('debug'));
        $debugLogs = '';

        $importFolder = $this->getContainer()->getParameter('import_folder');
        $csvImporter = $this->getContainer()->get('csv_importer');
//        $xmlImporter = $this->getContainer()->get('xml_importer');

        $finder = new Finder();
        $finder->files()->in($importFolder);

        foreach ($finder as $file)
        {
            $fileName = $file->getFileName();
            $filePath = $file->getRealpath();
            $fileExtension = substr($filePath, -3);

            $debugLogs.= "File " . $fileName . " start processing.\n";

            if ($fileExtension == 'csv')
            {
                $parsedProducts = $csvImporter->import($filePath);

                $debugLogs.= $parsedProducts . " product(s) were parsed and imported.\n";
            }
            elseif ($fileExtension == 'xml')
            {
//                $parsedProducts = $xmlImporter->import($filePath);
//                
//                $debugLogs.= $parsedProducts . " product(s) were parsed and imported.\n";
            }
            else
            {
                $debugLogs.= "Not valid file for importing.\n";
            }
        }

        if ($debug)
        {
            $output->writeln($debugLogs);
        }
    }

}
