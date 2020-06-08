<?php

    require_once("logging-service.php");

    function callOctaveExperiment($experimentName, $from, $to, $sessionID) {
        require_once("../octave/experiments.php");
        $ret = $experimentName(doubleval($from), doubleval($to));
        $logInfo = new stdClass();
        $logInfo->r = doubleval($to);
        $logInfo->lastPosition = end($ret->content);
        logCallToCAS($experimentName, $sessionID, $ret, json_encode($logInfo));
        return $ret;
    }

    function callOctaveCLI($command, $sessionID) {
        require_once("../octave/command-line.php");
        $ret = executeCommand($command);
        logCallToCAS("commandLine", $sessionID, $ret, $command);
        return $ret;
    }

?>
