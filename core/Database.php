<?php

/**
 * Class Database
 *
 * Esta clase es la que realizará la conexión con la base de datos.
 *
 * De momento solo será conexiones simples hacia MySQL
 */
class Database {

    static $db;

    static function init($config)
    {
        // Establecemos la conexión con la base de datos.
        self::$db = new PDO('mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['name'],
                            $config['user'],
                            $config['pass'],
                            array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    }


    /**
     * Método con el que ejecutamos las consultas para gestionar
     * la base de datos.
     *
     * @param String $query Query a ejecutar.
     * @param Array $params Array de valores a tener en cuenta en la Query
     * @param bool $fetch
     * @return mixed
     */
    static function query($query, $params = null, $fetch = true)
    {
        $response = self::$db->prepare($query);
        $response->execute($params);

        if ($fetch)
        {
            return $response->fetchAll();
        }

        return $respones;
    }

    static function lastInsertId($name = null)
    {
        return self::$db->lastInsertId($name);
    }

} 