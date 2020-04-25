<?php

require_once("../config.php");
require_once("utils.php");

function executeOctaveCommand($octCmd) {
    $cmdToExec = OCTAVE_EXEC_WITH_OPTIONS.$octCmd;
    exec($cmdToExec, $out, $retValue);
    $ret = new stdClass();
    $ret->consoleOutput = $out;
    $ret->returnValue = $retValue;
    return $ret;
}

?>
