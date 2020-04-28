<?php
require_once("../config.php");
require_once("../services/octave-service.php");
require_once("../octave/experiments.php");


/* PLACE FOR FUTURE IMPLEMENTATION OF SERVICES */

function mapEndpointToExperiment($endpointName, $session, $value) {
    $experiment = ENDPOINT_TO_EXPERIMENT_MAPPING[$endpointName];
    $from = getLastValidCommandValue($session, $experiment);
    $value = doubleval($value);
    return callOctaveExperiment($experiment, $from, $value, $session);
}

function getLastValidCommandValue($session, $command) {
    $queries = require_once("../db/queries.php");
    $db = new Db();
    $db->init();
    $data = array("command" => $command, "session" => $session);
    $from = $db->getRecordsFromDb($queries["get_current_session_value"], $data)[0]['r'];
    $db->close();
    return is_null($from) ? DEFAULT_EXPERIMENT_VALUE : doubleval($from);
}