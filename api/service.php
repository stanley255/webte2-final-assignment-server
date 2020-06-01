<?php
require_once("../config.php");
require_once("../services/octave-service.php");
require_once("../octave/experiments.php");

function mapEndpointToExperiment($endpointName, $session, $value) {
    $command = ENDPOINT_TO_EXPERIMENT_MAPPING[$endpointName];
    $from = json_decode(getLastValidCommandValue($session, $command))->r;
    return callOctaveExperiment($command, $from, $value, $session);
}

function getLastValidCommandValue($session, $command) {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $data = array("command" => $command, "session" => $session);
    $from = $db->getRecordsFromDb($queries["get_current_session_value"], $data)[0]['json'];
    $db->close();
    return is_null($from) ? DEFAULT_EXPERIMENT_VALUE : $from;
}

function getLastExperimentData($session, $command) {
    return getLastValidCommandValue($session, $command);
}