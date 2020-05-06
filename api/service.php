<?php
require_once("../config.php");
require_once("../services/octave-service.php");

/* PLACE FOR FUTURE IMPLEMENTATION OF SERVICES */

function mapEndpointToExperiment($endpointName, $session, $value) {
    $command = ENDPOINT_TO_EXPERIMENT_MAPPING[$endpointName];
    $from = getLastValidCommandValue($session, $command);
    return callOctaveExperiment($command, $from, $value, $session);
}

function getLastValidCommandValue($session, $command) {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $data = array("command" => $command, "session" => $session);
    $from = $db->getRecordsFromDb($queries["get_current_session_value"], $data)[0]['r'];
    $db->close();
    return is_null($from) ? DEFAULT_EXPERIMENT_VALUE : $from;
}

function getR($session, $command) {
    $val = getLastValidCommandValue($session, $command);
    return array("r" => doubleval($val));
}