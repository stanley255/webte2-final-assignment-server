<?php

require_once("../config.php");
require_once("utils.php");

function executeOctaveCommand($octCmd) {
    $ret = new stdClass();
    if (containsForbiddenCommands($octCmd)) {
        $ret->consoleOutput = array(FORBIDDEN_CMD_ERR);
        $ret->returnValue = 1;
        return $ret;
    }
    $cmdToExec = OCTAVE_EXEC_WITH_OPTIONS.$octCmd;
    exec($cmdToExec, $out, $retValue);
    $ret->consoleOutput = $out;
    $ret->returnValue = $retValue;
    return $ret;
}

function containsForbiddenCommands($octCmd) {
    preg_match(FORBIDDEN_CMD_PATTERN, $octCmd, $matches, PREG_OFFSET_CAPTURE);
    return sizeof($matches) > 0;
}

?>
