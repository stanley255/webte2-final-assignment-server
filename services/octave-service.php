<?php

    require_once("logging-service.php");

    function callOctaveExperiment($experimentName, $from, $to, $sessionID) {
        require_once("../octave/experiments.php");
        $ret = $experimentName($from, $to);
        logCallToCAS($experimentName, $sessionID, $ret, $to);
        return $ret;
    }

    function callOctaveCLI($command, $sessionID) {
        require_once("../octave/command-line.php");
        $ret = executeCommand($command);
        logCallToCAS("commandLine", $sessionID, $ret);
        return $ret;
    }

?>
