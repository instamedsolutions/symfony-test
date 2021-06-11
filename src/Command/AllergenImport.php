<?php

namespace App\Command;

use App\Service\AllergenService;
use App\Service\DrugService;
use App\Service\FileProcessor;
use App\Service\RPPSService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Command to import file in empty database.
**/
class AllergenImport extends Command
{

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:allergen:import';


    /**
     * @var EntityManagerInterface
     */
    protected $em;


    /**
     * @var AllergenService
     */
    protected $allergenService;



    public function __construct(AllergenService $allergenService,EntityManagerInterface $entityManager)
    {

        parent::__construct(self::$defaultName);

        $this->allergenService = $allergenService;
        $this->em = $entityManager;
    }


    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Import Allergen File into database')
            ->setHelp('This command will import all allergens data.');

    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->allergenService->setOutput($output);

        try {
            // Turning off doctrine default logs queries for saving memory
            $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

            // Showing when the cps process is launched
            $start = new \DateTime();
            $output->writeln('<comment>' . $start->format('d-m-Y G:i:s') . ' Start processing :---</comment>');

            $this->allergenService->parse();

            // Showing when the cps process is launched
            $end = new \DateTime();
            $output->writeln('<comment>' . $end->format('d-m-Y G:i:s') . ' Stop processing :---</comment>');


            return Command::SUCCESS;


        } catch(\Exception $e){
            error_log($e->getMessage());
            $output->writeln($e->getMessage());
            return Command::FAILURE;

        }
    }

}
