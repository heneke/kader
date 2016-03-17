<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$em = KaderORMCreateEntityManager();
$connection = $em->getConnection();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);