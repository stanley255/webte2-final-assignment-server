<?php

require_once("octave.php");
require_once("utils.php");

function ballOnStick($from, $to) {
    return executeExperiment($from, $to, "ballOnStick", "ballOnStringRange", BALL_ON_STICK_LABELS);
}

function inversePendulum($from, $to) {
    return executeExperiment($from, $to, "inversePendulum", "inversePendulumRange", INVERSE_PENDULUM_LABELS);
}

function carShockAbsorber($from, $to) {
    return executeExperiment($from, $to, "carShockAbsorber", "carShockAbsorberRange", CAR_SHOCK_ABSORBER);
}

function aircraftTilt($from, $to) {
    return executeExperiment($from, $to, "aircraftTilt", "aircraftTiltRange", AIRCRAFT_TILT_LABELS);
}

function executeExperiment($from, $to, $singleCommand, $rangeCommand, $labels) {
    $scriptRepository = require("experiment-script-repository.php");
    $ret = new stdClass();
    $script = $from == 0 ? $scriptRepository[$singleCommand] : $scriptRepository[$rangeCommand];
    $cmdOut = $from == 0 ? executeOctaveCommand(sprintf(escapeCommand($script), $to)) : executeOctaveCommand(sprintf(escapeCommand($script), $from, $to));
    $ret->content = parseOutput($cmdOut->consoleOutput, $labels);
    $ret->returnCode = $cmdOut->returnValue;
    $ret->rangeFrom = $from;
    $ret->rangeTo = $to;
    return $ret;
}

function parseOutput($output, $labels) {
    $trimOutput = array();
    foreach ($output as $line) {
        $vector = array_map('doubleval', preg_split('/\s+/', trim($line)));
        array_push($trimOutput, convertVectorToObject($vector, $labels));
    }
    return $trimOutput;
}

function convertVectorToObject($vector, $labels) {
    $ret = new stdClass();
    $ret->{$labels[0]} = $vector[0];
    $ret->{$labels[1]} = $vector[1];
    $ret->{$labels[2]} = $vector[2];
    return $ret;
}

?>
