<?php

require_once("../config.php");
require_once "service.php";

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');

/* API FRONT CONTROLLER */

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', $_GET['uri']);
$endpoint = $uri[0];

if(in_array($requestMethod, ALLOWED_METHODS)) {
    if(in_array($endpoint, AVAILABLE_ENDPOINTS)) {
        switch ($endpoint) {
            case "console":
                if($requestMethod === 'POST') {
                    if (isset($_POST['session']) && isset($_POST['command'])) {
                        $ret = callOctaveCLI($_POST['command'], $_POST['session']);
                        $ret->returnCode === 2 ? http_response_code(400) : http_response_code(200);
                        echo json_encode($ret);
                    }
                } else {
                    http_response_code(405);
                }
                break;
            case "experiments":
                if($requestMethod === 'GET') {
                    $experiment = $uri[1];
                    if (isset($experiment) && strlen($experiment) > 0) {
                        if (in_array($experiment, EXPERIMENT_ENDPOINTS)) {
                            echo json_encode("$experiment endpoint!");
                        } else {
                            echo json_encode("Bad experiment!");
                        }
                    } else {
                        echo json_encode("Default endpoint!");
                    }
                } else {
                    http_response_code(405);
                }
                break;
            case "logs":
                if($requestMethod === 'GET') {
                    $ret = getAllLogs();
                    echo json_encode($ret);
                } else {
                    http_response_code(405);
                }
                break;
            case "stats":
                if($requestMethod === 'GET') {
                    require_once "../services/logging-service.php";
                    $ret = getExperimentLogReport();
                    echo json_encode($ret);
                } else {
                    http_response_code(405);
                }
                break;
        }
    } else {
        http_response_code(501);
        echo json_encode("Invalid endpoint!");
    }
} else {
    http_response_code(405);
    echo json_encode("Method not allowed!");
}