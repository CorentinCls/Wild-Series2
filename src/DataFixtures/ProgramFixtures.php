<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{   
    public const PROGRAMS = [
            [
                "title" => 'Les simpsons',
                "summary" => "Les Simpson (The Simpsons) sont une série télévisée d'animation américaine pour adultes créée par Matt Groening et diffusée depuis le 17 décembre 1989 sur le réseau Fox. Elle met en scène les Simpson, stéréotype d'une famille de classe moyenne américaine. Leurs aventures servent une satire du mode de vie américain.",
                "poster" => "https://picsum.photos/200/300",
                "categoryreference" => "Horreur"
            ],

            [
                "title" => 'Ma famille d\'abord',
                "summary" => "Ma famille d'abord (My Wife and Kids) est une sitcom américaine en 123 épisodes de 20 minutes créée par Don Reo et Damon Wayans et diffusée entre le 28 mars 2001 et le 17 mai 2005 sur le réseau ABC aux États-Unis et sur le réseau CTV au Canada.",
                "poster" => "https://picsum.photos/200/300",
                "categoryreference" => "Action"
            ],

            [
                "title" => 'Malcom',
                "summary" => "Petit génie malgré lui, Malcolm vit dans une famille hors du commun. Le jeune surdoué n'hésite pas à se servir de son intelligence pour faire les 400 coups avec ses frères.",
                "poster" => "https://picsum.photos/200/300",
                "categoryreference" => "Horreur"
            ],

            [
                "title" => 'Dysnastie',
                "summary" => "La série suit la vie de la riche et puissante famille Carrington, à Atlanta dans l'état de Géorgie aux États-Unis. Fallon Carrington revient au domicile familial dans le but d'être choisie comme nouvelle PDG de la société de son père.",
                "poster" => "https://picsum.photos/200/300",
                "categoryreference" => "Horreur"
            ],

            [
                "title" => 'You',
                "summary" => "Synopsis. La première saison se concentre sur Joe Goldberg, gérant d'une modeste librairie à New York. ... Joe devient vite obsédé par Beck. Il l'observe et cherche à connaître chaque détail de sa vie sur les réseaux sociaux, notamment ses habitudes ou ses amis.",
                "poster" => "https://picsum.photos/200/300",
                "categoryreference" => "Horreur"
            ],
        ];
    public function load(ObjectManager $manager): void
    {

        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSummary($programData['summary']);
            $program->setPoster($programData['poster']);
            
            $this->addReference($programData['title'], $program);
            $program->setCategory($this->getReference($programData['categoryreference']));
            $manager->persist($program);

        }
        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

}
