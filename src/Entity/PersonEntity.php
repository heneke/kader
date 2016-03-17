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
        $this->bezeichnung = $this->nachname ? $this->nachname : null;
        if ($this->vorname) {
            if ($this->bezeichnung) {
                $this->bezeichnung .= ', ';
            }
            $this->bezeichnung .= $this->vorname;
        }
        if ($this->bezeichnung) {
            $this->bezeichnung = mb_strlen($this->bezeichnung > 255) ? mb_substr($this->bezeichnung, 0, 254) . '…' : $this->bezeichnung;
        }
    }
}