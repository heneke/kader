<?php
namespace Kader\ORM\Entity;

use Kader\ORM\AbstractEntityManagerTest;

class PaarEntityTest extends AbstractEntityManagerTest
{

    /**
     * @test
     */
    public function persist()
    {
        $p1 = new PersonEntity();
        $p1->vorname = 'Partner';
        $p1->nachname = 'Nachname';

        $p2 = new PersonEntity();
        $p2->vorname = 'Partnerin';
        $p2->nachname = 'Nachname';

        $p = new PaarEntity();
        $p->setPartner($p1);
        $p->setPartnerin($p2);

        $this->em->persist($p1);
        $this->em->persist($p2);
        $this->em->persist($p);
        $this->em->flush();

        $p->setPartnerin($p1);
        $p->setPartner($p2);
        $this->em->merge($p);
        $this->em->flush();
    }

}