<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Song;
use App\Entity\Album;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $singers = ['ACDC', 'Stromae', 'Jael', 'Panda Dub', 'Biga Ranx', 'Dub inc'];
        // TODO use API to get 50 random words
        $words = ['happy', 'holy', 'ordinary', 'malicious', 'wood', 'compare', 'juvenile', 'yarn',
        'sisters', 'after', 'math', 'stare', 'bomb', 'versed', 'light', 'wasteful', 'infamous', 'door',
        'improve', 'cover', 'ruddy', 'inexpensive', 'war', 'overrated', 'depend', 'land', 'abject', 'seat',
        'xenophobic', 'ants', 'complex', 'waves', 'growth', 'married', 'recite', 'stream', 'soup', 'course', 'fly',
        'reuse', 'tank', 'mass', 'high', 'kindly', 'spoil', 'awesome', 'regret', 'rewind', 'nose', 'throw', 'town'];

        for($i = 0; $i < 20; $i++) {
            $album = new Album();
            $album->setName(ucfirst($faker->randomElement($words)));
            $album->setSinger($faker->randomElement($singers));
            $manager->persist($album);
            // Number of songs for this album
            $randSongNumber = $faker->numberBetween(1, 10);
            for($j = 0; $j < $randSongNumber; $j++) {
                $song = new Song();
                $song->setAlbum($album);
                // Number of words of the song name
                $songWords = $faker->numberBetween(2, 5);
                $songName = '';
                for($x = 0; $x < $songWords; $x++) {
                    $songName .= $faker->randomElement($words) . ' ';
                }
                $song->setName(ucfirst($songName));
                $song->setLength($faker->numberBetween(1, 5));

                $manager->persist($song);
            }
        }

        $manager->flush();
    }
}
