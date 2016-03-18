<?php
namespace Kader\ORM\Entity;

use Kader\ORM\AbstractEntityManagerTest;
use Kader\ORM\Entity\PersonEntity;

class PersonEntityTest extends AbstractEntityManagerTest
{

    /**
     * @test
     */
    public function persist()
    {
        $p = new PersonEntity();
        $p->vorname = 'Max';
        $p->nachname = 'Mustermann';
        $this->em->persist($p);
        $this->em->flush();
        $this->assertEquals('Mustermann, Max', $p->bezeichnung);

        $p = new PersonEntity();
        $p->vorname = 'Max';
        $this->em->persist($p);
        $this->em->flush();
        $this->assertEquals('Max', $p->bezeichnung);


        $p = new PersonEntity();
        $p->nachname = 'Mustermann';
        $this->em->persist($p);
        $this->em->flush();
        $this->assertEquals('Mustermann', $p->bezeichnung);
    }

    /**
     * @test
     */
    public function update()
    {
        $p = new PersonEntity();
        $p->vorname = 'Max';
        $p->nachname = 'Mustermann';
        $this->em->persist($p);
        $this->em->flush();
        $this->assertEquals('Mustermann, Max', $p->bezeichnung);

        $p->vorname = 'Maria';
        $p->nachname = 'Schulze';
        $this->em->merge($p);
        $this->em->flush();
        $this->assertEquals('Schulze, Maria', $p->bezeichnung);
    }

}