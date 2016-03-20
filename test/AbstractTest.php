<?php
namespace Kader;

use Doctrine\Common\Annotations\AnnotationRegistry;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @beforeClass
     */
    public static function beforeClass()
    {
        AnnotationRegistry::registerLoader('class_exists');
    }
}