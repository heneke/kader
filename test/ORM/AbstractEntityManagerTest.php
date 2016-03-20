<?php
namespace Kader\ORM;

use Doctrine\ORM\EntityManager;
use Kader\AbstractTest;

abstract class AbstractEntityManagerTest extends AbstractTest
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