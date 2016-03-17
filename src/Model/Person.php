<?php
namespace Kader\ORM\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;

/**
 * Class Person
 * @package Kader\ORM\Model
 * @Entity
 * @HasLifecycleCallbacks
 */
class Person extends Kontakt
{

    /**
     * @PrePersist
     * @PreUpdate
     */
    public function prePersistOrUpdate()
    {
        $bezeichnung = $this->nachname ? $this->nachname : null;
        if ($bezeichnung && $this->vorname) {
            $bezeichnung .= ', ';
            $bezeichnung .= $this->vorname;
        }
        if ($bezeichnung) {
            $this->bezeichnung = strlen($bezeichnung > 255) ? substr($bezeichnung, 0, 255) : $bezeichnung;
        }
    }
}