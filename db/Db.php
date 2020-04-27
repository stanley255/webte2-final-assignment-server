<?php

require_once('../config.php');
require_once('../credentials.php');

class Db {
    private $pdo;
    private $error;

    function __construct() {
        $this->init();
    }

    public function init() {
        try {
            $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME . ';charset=' . CHARSET;
            $this->pdo = new PDO($dsn, USERNAME, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->set_error($e->getMessage());
        }
    }

    public function close() {
        $this->pdo = null;
    }

    private function bindParametersToStatement($stmt, $binds) {
        foreach ($binds as $k => $v) {
            $stmt->bindValue(":".$k, $v);
        }
    }

    private function set_error($error) {
        $this->error = $error;
    }

    public function get_error() {
        return $this->error;
    }

    public function getRecordsFromDb($select, $binds = array()) {
        $stmt = $this->pdo->prepare($select);
        $this->bindParametersToStatement($stmt, $binds);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->set_error($e->getMessage());
        }
        return null;
    }

    public function executeScript($script, $binds = array()) {
        try {
            $stmt = $this->pdo->prepare($script);
            $this->bindParametersToStatement($stmt, $binds);
            $stmt->execute();
        } catch(PDOException $e) {
            $this->set_error($e->getMessage());
        }
    }

}