<?php

namespace App\Command;

use App\Entity\User\TwitterAuth;
use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FillDataBaseCommand extends Command
{
    protected static $defaultName = 'app:fill-data-base';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Initialize Data Base');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $newUser = new User();
        $newUser->setName('Ronald Lopez Jaramillo');
        $newUser->setTitle('About me');
        $newUser->setDescription('Systems engineer with emphasis on software development, I have more than 4 years of experience in web development. Management of HTML, CSS, JavaScript, PHP languages. Implementation of queuing systems. Relational database. Non-relational database Mongo, Redis. I work with the Scrum methodology. Git version manager management. Using Frameworks like Vuejs, symfony, laravel.');
        $this->entityManager->persist($newUser);

        $newTwitterAuth = new TwitterAuth();
        $newTwitterAuth->setUser($newUser);
        $newTwitterAuth->setConsumerKey('KRy7l0v8wex3w8Sy5zThai3Ea');
        $newTwitterAuth->setConsumerSecret('X2eBm0Y21kYEuR74W3Frqc2JVIizOj8Q1EVGatDsEVVEJo0ucu');
        $newTwitterAuth->setOauthToken('1220032047516921859-otvXjhExyUTZ5GLxssc9h5ORqtPZja');
        $newTwitterAuth->setOauthTokenSecret('tmJKqM4ORfQW6CH7wIVV8uKNpmSEmeFAP8lYwGb19uYjj');
        $this->entityManager->persist($newTwitterAuth);
        $this->entityManager->flush();

        $io->success('Data Created!');

        return 0;
    }
}
