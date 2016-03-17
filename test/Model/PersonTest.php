<?php
namespace Kader\ORM\Model;

use Kader\ORM\AbstractEntityManagerTest;

class PersonTest extends AbstractEntityManagerTest
{

    /**
     * @test
     */
    public function persist()
    {
        $p = new Person();
        $p->vorname = 'Max';
        $p->nachname = 'Mustermann';
        $this->em->persist($p);
        $this->em->flush();
        $this->assertEquals('Mustermann, Max', $p->bezeichnung);
    }
}