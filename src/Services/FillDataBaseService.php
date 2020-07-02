<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\Portfolio;
use App\Entity\TwitterAuth;
use Doctrine\ORM\EntityManagerInterface;

class FillDataBaseService
{
    /**
     * @var array
     */
    private $twittersNames = ['GoT_Tyrion', 'Daenerys', 'LordSnow', 'Lady_Sansa', 'GameOfThrones'];

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Fill data profiles
     */
    public function fillData(): void
    {
        foreach ($this->twittersNames as $twitterName) {
            $newPortfolio = new Portfolio();
            $newPortfolio->setTwitterUserName($twitterName);
            $this->entityManager->persist($newPortfolio);
        }

        $newTwitterAuth = new TwitterAuth();
        $newTwitterAuth->setConsumerKey('KRy7l0v8wex3w8Sy5zThai3Ea');
        $newTwitterAuth->setConsumerSecret('X2eBm0Y21kYEuR74W3Frqc2JVIizOj8Q1EVGatDsEVVEJo0ucu');
        $newTwitterAuth->setOauthToken('1220032047516921859-otvXjhExyUTZ5GLxssc9h5ORqtPZja');
        $newTwitterAuth->setOauthTokenSecret('tmJKqM4ORfQW6CH7wIVV8uKNpmSEmeFAP8lYwGb19uYjj');
        $this->entityManager->persist($newTwitterAuth);
        $this->entityManager->flush();
    }

}