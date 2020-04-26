<?php

require_once("octave.php");
require_once("../config.php");

function executeCommand($cmd) {
    $ret = new stdClass();
    $processedCmd = redirectStdErrToStd(escapeCommand($cmd));
    $cmdOut = executeOctaveCommand($processedCmd);
    $ret->content = trimOutput($cmdOut->consoleOutput, $cmd);
    $ret->returnCode = $cmdOut->returnValue;
    return $ret;
}

function trimOutput($output, $cmd) {
    $trimOutput = array();
    foreach ($output as $line) {
        $trimmedLine = trim($line);
        if (strlen($trimmedLine)) {
            if (strpos($trimmedLine, "parse error") !== false) {
                array_push($trimOutput, PARSE_CMD_ERR.$cmd);
                return $trimOutput;
            }
        }
        array_push($trimOutput, $trimmedLine);
    }
    return $trimOutput;
}

?>