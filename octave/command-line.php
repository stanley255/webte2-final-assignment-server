<?php

require_once("octave.php");

function executeCommand($cmd) {
    $ret = new stdClass();
    $processedCmd = redirectStdErrToStd(escapeCommand($cmd));
    $cmdOut = executeOctaveCommand($processedCmd);
    $ret->content = trimOutput($cmdOut->consoleOutput);
    $ret->returnCode = $cmdOut->returnValue;
    return $ret;
}

function trimOutput($output) {
    $trimOutput = array();
    foreach ($output as $line) {
        array_push($trimOutput, trim($line));
    }
    return $trimOutput;
}

?>