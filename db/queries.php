<?php
    return array(
        "insert_log" => "INSERT INTO cas_logs(command, session, status, info) VALUES(:command, :session, :status, :info)",
        "get_all_logs" => "SELECT timestamp, command, session, status, info FROM cas_logs",
        "experiment_statistics" => "SELECT * FROM experiment_statistics"
    );

?>