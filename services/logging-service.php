<?php

require_once("../db/Db.php");

function logCallToCAS($commandType, $sessionID, $octaveOutput) {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $db->executeScript($queries["insert_log"], array(
        "command" => $commandType,
        "session" => $sessionID,
        "status" => $octaveOutput->returnCode === 0 ? "success" : "error",
        "info" => getErrorMessage($commandType, $octaveOutput)
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
            var_dump($line);
            return $line;
        }
    }
    return sprintf("error (%d) during user command execution", $octaveOutput->returnCode);
}

?>
