<?php

// DB
define("CHARSET", "utf8");

// OCTAVE
define("OCTAVE_EXEC","octave");
define("OCTAVE_EXEC_WITH_OPTIONS", "octave -W --eval ");
define("CMD_REDIRECT_ERR"," 2>&1");

define("BALL_ON_STICK_LABELS",array("x","y","angle"));
define("INVERSE_PENDULUM_LABELS",array("x","y","angle"));
define("CAR_SHOCK_ABSORBER",array("x","y","bodyworkHeight"));
define("AIRCRAFT_TILT_LABELS",array("x","y","rearFlapAngle"));

define("FORBIDDEN_CMD_PATTERN", "/(pkg\s+install)|(pkg\s+uninstall)/");
define("FORBIDDEN_CMD_ERR", "error: pkg install and pkg uninstall are forbidden");
define("PARSE_CMD_ERR", "error: failed to parse command: ");

?>
