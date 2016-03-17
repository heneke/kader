<?php

if (!function_exists('KaderORMFindEnvFile')) {
    /**
     * Returns the path to the environment configuration file
     *
     * @return string
     * @throws RuntimeException if no environment definition file is found
     */
    function KaderORMFindEnvFile()
    {
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            return $envFile;
        }
        $envFile = $envFile . '.default';
        if (file_exists($envFile)) {
            return $envFile;
        }

        throw new RuntimeException('Environment definition file does not exist!');
    }
}

if (!function_exists('KaderORMLoadEnv')) {
    /**
     * Loads the environment configuration
     *
     * @return void
     */
    function KaderORMLoadEnv()
    {
        $envFile = KaderORMFindEnvFile();
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../', basename($envFile));
        $dotenv->load();
        $dotenv->required(['DB1_URL']);
    }
}

if (!function_exists('KaderORMCreateEntityManager')) {
    /**
     * Creates the EntityManager
     *
     * @return \Doctrine\ORM\EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    function KaderORMCreateEntityManager()
    {
        KaderORMLoadEnv();
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../src'], true, null, null, false);
        $connection = [
            'url' => getenv('DB1_URL')
        ];
        return \Doctrine\ORM\EntityManager::create($connection, $config);
    }
}