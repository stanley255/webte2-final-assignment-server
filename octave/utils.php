<?php

require_once("../config.php");

function escapeCommand($cmd) {
    if(($cmd[0] === '"' && $cmd[strlen($cmd) - 1] === '"') || ($cmd[0] === "'" && $cmd[strlen($cmd) - 1] === "'")) {
        $cmd = substr($cmd, 1, -1);
    }
    $cmd = str_replace('\\\\', '', $cmd);
    $cmd = str_replace('\\"', '"', $cmd);
    return '"'.str_replace("\"", '\\"', $cmd).'"';
}

function redirectStdErrToStd($cmd) {
    return $cmd.CMD_REDIRECT_ERR;
}

?>
