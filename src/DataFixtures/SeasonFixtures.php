<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface 
{
    public const SEASONS = [
            [
                "number" => 1,
                "year" => 2018,
                "description" => "Dans cette saison, homer va devenir un nouvel homme ...",
                "programReference" => "Program_Les simpsons"
            ],

            [
                "number" => 2,
                "year" => 2019,
                "description" => "Dans cette saison, Marge va devenir une nouvelle femme ...",
                "programReference" => "Program_Les simpsons"
            ],
        

            [
                "number" => 3,
                "year" => 2020,
                "description" => "Dans cette saison, Bart va devenir un gentil garçon ...",
                "programReference" => "Program_Les simpsons"
            ],

            [
                "number" => 4,
                "year" => 2021,
                "description" => "Dans cette saison, Maggie va apprendre à parler ...",
                "programReference" => "Program_Les simpsons"
            ]

        ];
    
    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $seasonData) {

            $season = new Season();

            $season->setNumber($seasonData['number']);
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);


            $season->setProgram($this->getReference($seasonData['programReference']));
            $this->addReference('Season_' . $seasonData['number'], $season);

            $manager->persist($season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
