<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        'Homer',
        'Marge',
        'Bart',
        'Lisa',
        'Maggie',
        'Grand-père'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('Actor_' . $actorName, $actor);
        }
        $manager->flush();
    }
}
