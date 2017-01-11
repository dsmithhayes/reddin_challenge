<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CsvImportCommand extends ContainerAwareCommand
{
    /**
     * @var int
     *      The column index for the first name in the CSV data
     */
    const FIRST_NAME = 0;

    /**
     * @var int
     *      The column index for the last name in the CSV data
     */
    const LAST_NAME = 1;

    /**
     * @var int
     *      The column index for the email in the CSV data
     */
    const EMAIL = 2;

    /**
     * The sole argument for the command is the path to the CSV file.
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('csv:import-users')
             ->addArgument('path', InputArgument::REQUIRED);
    }

    /**
     * Reads the CSV file and inputs each row into the database as a user. If
     * the file path given to the command doesn't exist, the Symfony console
     * handles relaying the error.
     */
    protected function execute(InputInterface $in, OutputInterface $out)
    {
        // open the CSV file
        $fh = fopen($in->getArgument('path'), 'r');

        // get Doctrine ready
        $doctrine = $this->getContainer()->get('doctrine');
        $usersRepo = $doctrine->getRepository('AppBundle:User');
        $entityManager = $doctrine->getManager();

        // get the password encoder
        $encoder = $this->getContainer()->get('security.password_encoder');

        // parse the CSV to an associative array
        $rows = $this->parseCsv($fh);
        fclose($fh);

        // input into the database
        foreach ($rows as $row) {

            // only update matching user data based on the email address
            if ($tempUser = $usersRepo->findOneByEmail($row['email'])) {
                $tempUser->setEmail($row['email'])
                         ->setFirstName($row['first_name'])
                         ->setLastName($row['last_name']);

                $entityManager->merge($tempUser);
                $entityManager->flush();

                continue;
            }

            // Set up a new User entity
            $user = new User();
            $row['password'] = $row['first_name'];

            // encode the password
            $row['password'] = $encoder->encodePassword($user, $row['password']);

            $user->setEmail($row['email'])
                 ->setFirstName($row['first_name'])
                 ->setLastName($row['last_name'])
                 ->setPassword($row['password']);

            $entityManager->persist($user);
            $entityManager->flush();
        }
    }

    /**
     * Parses the CSV file into a more sane array that looks like:
     *
     *      [0] => [
     *          'first_name' => 'Dave',
     *          'last_name' => 'Smith-Hayes',
     *          'email' => 'me@davesmithhayes.com'
     *      ];
     *
     * @param resource $fh
     *      An active file handle
     * @return array
     *      An array of rows with associated column names
     */
    private function parseCsv($fh)
    {
        $first = true;
        $rows = [];
        $columnNames = [];

        while (($data = fgetcsv($fh)) !== false) {
            if ($first) {
                foreach ($data as $col) {
                    $columnNames[] = $col;
                }

                $first = false;
                continue;
            }

            $rows[] = [
                $columnNames[self::FIRST_NAME] => $data[self::FIRST_NAME],
                $columnNames[self::LAST_NAME]  => $data[self::LAST_NAME],
                $columnNames[self::EMAIL]      => $data[self::EMAIL]
            ];
        }

        return $rows;
    }
}
