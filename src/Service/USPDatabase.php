<?php
/**
 * Alunos dos cursos de Extensao (Bloco)
 * Equipe de Moodle da USP
 * https://github.com/moodle-usp
 */
namespace enrol_extensao\Service;

use PDO;

class USPDatabase
{
    private static $instance;
    
    // para exibir as mensagens de erro
    const DEBUG = true;

    public static function getInstance()
    {
        global $CFG;

        $host = get_config('block_enrol_extensao', 'host');
        $port = get_config('block_enrol_extensao', 'port');
        $db   = get_config('block_enrol_extensao', 'database');
        $user = get_config('block_enrol_extensao', 'user');
        $pass = get_config('block_enrol_extensao', 'password');

        if (empty($host) or empty($port) or empty($db) or empty($user) or empty($pass)) {
            echo "ERRO: As credenciais de conexão estão vazias." . PHP_EOL;
            die();
        }

        if (!self::$instance) {
            try {
                $dsn = "dblib:host={$host}:{$port};dbname={$db};charset=UTF-8";
                self::$instance = new PDO($dsn, $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Throwable $t) {
                echo "Erro na conexão com o database do replicado! Contate o suporte" . PHP_EOL . PHP_EOL;
                if (self::DEBUG) {
                    echo $t->getMessage() . '<br>';
                }
                die();
            }
        }
        return self::$instance;
    }

    public static function utf8_converter($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    // overhide fetch
    public static function fetch(string $query, array $param = null)
    {
        try {
            $stmt = self::getInstance()->prepare($query);
            if (!is_null($param)) {
                foreach ($param as $campo => $valor) {
                    $valor = utf8_decode($valor);
                    $stmt->bindValue(":$campo", $valor);
                }
            }
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $result = self::utf8_converter($result);
            }
            return $result;
        } catch (\Throwable $t) {
            echo "Erro Interno: " . $t->getMessage() . PHP_EOL;
            if (self::DEBUG) {
                echo $t->getMessage() . '<br>';
            }
            return false;
        }
    }

    public static function fetchAll(string $query, array $param = null)
    {
        try {
            $stmt = self::getInstance()->prepare($query);
            if (!is_null($param)) {
                foreach ($param as $campo => $valor) {
                    $valor = utf8_decode($valor);
                    $stmt->bindValue(":$campo", $valor);
                }
            }
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($results)) {
                $results = array_map('self::utf8_converter', $results);
            }
            return $results;
        } catch (\Throwable $t) {
            echo "Erro Interno: " . $t->getMessage() . PHP_EOL;
            if (self::DEBUG) {
                echo $t->getMessage() . '<br>';
            }
            return false;
        }
    }
}
