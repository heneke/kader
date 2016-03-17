<?php
namespace Kader\ORM\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Kader\ORM\Entity\KontaktEntity;

/**
 * Class PersonEntity
 * @package Kader\ORM\Entity
 * @Entity
 * @HasLifecycleCallbacks
 */
class PersonEntity extends KontaktEntity
{

    /**
     * @PrePersist
     * @PreUpdate
     */
    public function prePersistOrUpdate()
    {
        $bezeichnung = $this->nachname ? $this->nachname : null;
        if ($this->vorname) {
            if ($bezeichnung) {
                $bezeichnung .= ', ';
            }
            $bezeichnung .= $this->vorname;
        }
        if ($bezeichnung) {
            $this->bezeichnung = strlen($bezeichnung > 255) ? substr($bezeichnung, 0, 255) : $bezeichnung;
        }
    }
}