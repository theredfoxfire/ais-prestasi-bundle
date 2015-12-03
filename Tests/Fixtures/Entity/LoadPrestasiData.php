<?php

namespace Ais\PrestasiBundle\Tests\Fixtures\Entity;

use Ais\PrestasiBundle\Entity\Prestasi;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadPrestasiData implements FixtureInterface
{
    static public $prestasis = array();

    public function load(ObjectManager $manager)
    {
        $prestasi = new Prestasi();
        $prestasi->setTitle('title');
        $prestasi->setBody('body');

        $manager->persist($prestasi);
        $manager->flush();

        self::$prestasis[] = $prestasi;
    }
}
