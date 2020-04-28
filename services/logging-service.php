<?php

require_once("../db/Db.php");

function getAllLogs() {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $logs = $db->getRecordsFromDb($queries["get_all_logs"]);
    $db->close();
    return $logs;
}

function getExperimentLogReport() {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $statistics = $db->getRecordsFromDb($queries["experiment_statistics"]);
    $db->close();
    return $statistics;
}

function logCallToCAS($commandType, $sessionID, $octaveOutput, $to = "") {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $db->executeScript($queries["insert_log"], array(
        "command" => $commandType,
        "session" => $sessionID,
        "status" => $octaveOutput->returnCode === 0 ? "success" : "error",
        "info" => $octaveOutput->returnCode === 0 ? $to : getErrorMessage($commandType, $octaveOutput),
        "timestamp" => date('Y-m-d H:i:s', time() + 2 * 3600) // TODO timezone
    ));
    $db->close();
}

function getErrorMessage($commandType, $octaveOutput) {
    if ($octaveOutput->returnCode === 0) {
        return "";
    }
    if ($commandType === "commandLine") {
        return findErrorLine($octaveOutput);
    } else {
        return sprintf("error (%d) during experiment execution", $octaveOutput->returnCode);
    }
}

function findErrorLine($octaveOutput) {
    foreach($octaveOutput->content as $line) {
        if (strpos($line, "error") !== false) {
            return $line;
        }
    }
    return sprintf("error (%d) during user command execution", $octaveOutput->returnCode);
}

?>
