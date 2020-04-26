<?php

// API
define("ALLOWED_METHODS",array("GET", "POST"));
define("AVAILABLE_ENDPOINTS",array("console", "experiments", "logs", "stats"));
define("EXPERIMENT_ENDPOINTS",array("pendulum", "ball", "suspension", "aircraft"));

// OCTAVE
define("OCTAVE_EXEC","octave");
define("OCTAVE_EXEC_WITH_OPTIONS", "octave -W --eval ");
define("CMD_REDIRECT_ERR"," 2>&1");

define("BALL_ON_STICK_LABELS",array("x","y","angle"));
define("INVERSE_PENDULUM_LABELS",array("x","y","angle"));
define("CAR_SHOCK_ABSORBER",array("x","y","bodyworkHeight"));
define("AIRCRAFT_TILT_LABELS",array("x","y","rearFlapAngle"));

?>
