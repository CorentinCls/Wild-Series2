<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
            [
                "title" => "Le jour de l'an",
                "number" => 1,
                "synopsys" => "C'est le jour de l'an pour la ville de Springfield, que nous réserve la fammille simpson ?",
                "seasonReference" => "Season_1"
            ],

            [
                "title" => "Un anniversaire hamer",
                "number" => 2,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_1"
            ],

            [
                "title" => "Un épisode quelconque",
                "number" => 3,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_2"
            ],

            [
                "title" => "Episode trois",
                "number" => 4,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_2"
            ],

            [
                "title" => "Un jour chez les simpson",
                "number" => 5,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_3"
            ],

            [
                "title" => "Advienne qui pourra",
                "number" => 6,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_3"
            ],

            [
                "title" => "Nouvel an",
                "number" => 7,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_4"
            ],

            [
                "title" => "Moe déviens riche",
                "number" => 8,
                "synopsys" => "Cette année, l'anniversaire d'homer pourrait bien avoir un goût amer !",
                "seasonReference" => "Season_4"
            ]
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $episodeData) {
            $episode = new Episode();
            $episode->setTitle($episodeData['title']);
            $episode->setNumber($episodeData['number']);

            $episode->setSynopsys($episodeData['synopsys']);

            $episode->setSeason($this->getReference($episodeData['seasonReference']));
        
            $manager->persist($episode);
        }
    
        $manager->flush();
    } 

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
