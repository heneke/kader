<?php
namespace Kader\ORM\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class KontaktBeziehungEntity
 * @package Kader\ORM\Entity
 * @Entity
 * @Table(name="kontaktbeziehungen", uniqueConstraints={@UniqueConstraint(columns={"kb_typ", "kb_parent", "kb_child"})})
 */
class KontaktBeziehungEntity
{

    const TYP_HERR = 1;
    const TYP_DAME = 2;

    /**
     * @var int
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="kb_id", type="integer")
     */
    private $id;

    /**
     * @var int
     * @Column(name="kb_typ", type="integer", nullable=false)
     */
    private $typ;

    /**
     * @var KontaktEntity
     * @ManyToOne(targetEntity="KontaktEntity", fetch="EAGER")
     * @JoinColumn(name="kb_parent", nullable=false, referencedColumnName="ko_id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @var KontaktEntity
     * @ManyToOne(targetEntity="KontaktEntity", fetch="EAGER")
     * @JoinColumn(name="kb_child", nullable=false, referencedColumnName="ko_id", onDelete="CASCADE")
     */
    private $child;


    public function __construct(KontaktEntity $parent = null, KontaktEntity $child = null, $typ = 0)
    {
        $this->typ = $typ;
        $this->parent = $parent;
        $this->child = $child;
    }

    /**
     * @return KontaktEntity
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param KontaktEntity $child
     */
    public function setChild(KontaktEntity $child)
    {
        $this->child = $child;
    }

    /**
     * @return KontaktEntity
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param KontaktEntity $parent
     */
    public function setParent(KontaktEntity $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return int
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * @param $typ
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
    }
}
