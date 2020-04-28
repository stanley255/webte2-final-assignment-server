<?php
    return array(
        "insert_log" => "INSERT INTO cas_logs(command, session, status, info, timestamp) VALUES(:command, :session, :status, :info, :timestamp)",
        "get_all_logs" => "SELECT timestamp, command, session, status, info FROM cas_logs",
        "experiment_statistics" => "SELECT * FROM experiment_statistics",
        "get_current_session_value" => "SELECT IFNULL(info, 0) as r FROM cas_logs WHERE status = 'success' and command = :command and session = :session ORDER BY timestamp DESC LIMIT 1"
    );
?>