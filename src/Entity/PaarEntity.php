<?php
namespace Kader\ORM\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;

/**
 * Class PaarEntity
 * @package Kader\ORM\Entity
 * @Entity
 * @HasLifecycleCallbacks
 */
class PaarEntity extends KontaktEntity
{

    /**
     * @PrePersist
     * @PreUpdate
     */
    public function prePersistOrUpdate()
    {
        $partner = $this->getPartner();
        if ($partner != null) {
            $this->bezeichnung = $partner->bezeichnung;
        }
        $partnerin = $this->getPartnerin();
        if ($partnerin != null) {
            if ($this->bezeichnung) {
                $this->bezeichnung .= ' / ';
            }
            $this->bezeichnung .= $partnerin->bezeichnung;
        }
    }

    /**
     * @return KontaktEntity|null
     */
    public function getPartner()
    {
        $beziehung = $this->findKontaktBeziehung(KontaktBeziehungEntity::TYP_HERR);
        if ($beziehung != null) {
            return $beziehung->getChild();
        }
    }

    /**
     * @return KontaktEntity|null
     */
    public function getPartnerin()
    {
        $beziehung = $this->findKontaktBeziehung(KontaktBeziehungEntity::TYP_DAME);
        if ($beziehung != null) {
            return $beziehung->getChild();
        }
    }

    /**
     * @param $typ
     * @return KontaktBeziehungEntity|null
     */
    public function findKontaktBeziehung($typ)
    {
        foreach ($this->getChildren() as $child) {
            if ($child->getTyp() == $typ) {
                return $child;
            }
        }
    }

    /**
     * @param PersonEntity $partner
     */
    public function setPartner(PersonEntity $partner)
    {
        $this->createOrUpdateKontaktBeziehung($partner, KontaktBeziehungEntity::TYP_HERR);
        $this->prePersistOrUpdate();
    }

    /**
     * @param PersonEntity $partnerin
     */
    public function setPartnerin(PersonEntity $partnerin)
    {
        $this->createOrUpdateKontaktBeziehung($partnerin, KontaktBeziehungEntity::TYP_DAME);
        $this->prePersistOrUpdate();
    }

    private function createOrUpdateKontaktBeziehung(PersonEntity $personEntity, $typ)
    {
        $beziehung = $this->findKontaktBeziehung($typ);
        if ($beziehung == null) {
            $this->getChildren()->add(new KontaktBeziehungEntity($this, $personEntity, $typ));
        } else {
            $beziehung->setChild($personEntity);
        }
    }
}