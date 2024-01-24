<?php

namespace App\DataFixtures;

use App\Entity\Song;
use App\Entity\Album;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $singers = ['ACDC', 'Stromae', 'Jael', 'Panda Dub', 'Biga Ranx', 'Dub inc'];
        // TODO use API to get 50 random words
        $words = ['happy', 'holy', 'ordinary', 'malicious', 'wood', 'compare', 'juvenile', 'yarn',
        'sisters', 'after', 'math', 'stare', 'bomb', 'versed', 'light', 'wasteful', 'infamous', 'door',
        'improve', 'cover', 'ruddy', 'inexpensive', 'war', 'overrated', 'depend', 'land', 'abject', 'seat',
        'xenophobic', 'ants', 'complex', 'waves', 'growth', 'married', 'recite', 'stream', 'soup', 'course', 'fly',
        'reuse', 'tank', 'mass', 'high', 'kindly', 'spoil', 'awesome', 'regret', 'rewind', 'nose', 'throw', 'town'];

        for($i = 0; $i < 20; $i++) {
            $randSinger = rand(0, count($singers) - 1);
            $album = new Album();
            $album->setName(ucfirst($words[rand(0, count($words) -1 )]));
            $album->setSinger($singers[$randSinger]);
            $manager->persist($album);
            // Number of songs for this album
            $randSong = rand(1, 10);
            for($j = 0; $j < $randSong; $j++) {
                $song = new Song();
                $song->setAlbum($album);
                $songWords = rand(2, 7);
                $songName = '';
                for($x = 0; $x < $songWords; $x++) {
                    $songName .= $words[rand(0, count($words)-1)] . ' ';
                }
                $song->setName(ucfirst($songName));
                $song->setLength(rand(1, 5));

                $manager->persist($song);
            }
        }

        $manager->flush();
    }
}
