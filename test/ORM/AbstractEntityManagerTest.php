<?php
namespace Kader\ORM;

use Doctrine\ORM\EntityManager;

abstract class AbstractEntityManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var EntityManager
     */
    protected $em;

    public function setUp()
    {
        parent::setUp();
        $this->em = KaderORMCreateEntityManager();
    }
}