<?php
namespace Kader\ORM\Entity;

use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Class KontaktEntity
 * @package Kader\ORM\Entity
 *
 * @Entity
 * @Table(name="kontakte")
 * @InheritanceType(value="SINGLE_TABLE")
 * @DiscriminatorColumn(name="ko_typ", type="integer")
 * @DiscriminatorMap(value={1="PersonEntity"})
 *
 * @property-read int $id Kontakt-ID
 * @property-read string $bezeichnung Bezeichnung
 * @property string $nachname Nachname
 * @property string $vorname Vorname
 */
abstract class KontaktEntity
{

    /**
     * @var int
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="ko_id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @Column(name="ko_bezeichnung", type="string", length=255)
     */
    protected $bezeichnung;

    /**
     * @var string
     * @Column(name="ko_nachname", type="string", length=100, nullable=true)
     */
    protected $nachname;

    /**
     * @var string
     * @Column(name="ko_vorname", type="string", length=100, nullable=true)
     */
    protected $vorname;

    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    public function __set($key, $value)
    {
        switch ($key) {
            case 'nachname':
            case 'vorname':
                $this->$key = $value;
                break;
        }
    }

    public function __unset($key)
    {
        switch ($key) {
            case 'nachname':
            case 'vorname':
                unset($this->$key);
                break;
        }
    }

    public function __isset($key)
    {
        return isset($this->$key);
    }
}