<?php

namespace ApiBancoDigital\DAO;

use PDO;
use PDOException;

abstract class DAO 
{
    /**
     * Atributo (ou Propriedade) da classe destinado a armazenar o link (vínculo aberto)
     * de conexão com o banco de dados.
     */
    protected $conexao;


    /**
     *  Neste caso, assim que é instânciado, abre uma conexão com o MySQL (Banco de dados)
     * A conexão é aberta via PDO (PHP Data Object) que é um recurso da linguagem para
     * acesso a diversos SGBDs.
     */
    public function __construct()
    {
        /**
         * Configurações do drive do PDO para MySQL trabalhar com exceções
         * e resolver problema de acentos com utf-8
         */
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];


        // DSN (Data Source Name) onde o servidor MySQL será encontrado
        // (host) em qual porta o MySQL está operado e qual o nome do banco pretendido
        // Mais informações sobre DSN: https://www.php.net/manual/pt_BR/ref.pdo-mysql.connection.php
        $dsn = "mysql:host=" . $_ENV['db']['host'] . ";dbname=" . $_ENV['db']['database'];

        // Criando a conexão e armazenado na propriedade definida para tal.
        // Veja o que é PDO: https://www.php.net/manual/pt_BR/intro.pdo.php
         $this->conexao = new PDO($dsn, $_ENV['db']['user'], $_ENV['db']['pass'], $options);
    }
}