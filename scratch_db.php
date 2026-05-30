<?php
$mysqli = new mysqli("localhost", "root", "", "jobportal");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function addColumn($mysqli, $table, $column, $definition, $after) {
    $result = $mysqli->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
    if ($result->num_rows == 0) {
        if ($mysqli->query("ALTER TABLE `$table` ADD `$column` $definition AFTER `$after`")) {
            echo "Added $column column.<br>\n";
        } else {
            echo "Error adding $column: " . $mysqli->error . "<br>\n";
        }
    } else {
        echo "$column column already exists.<br>\n";
    }
}

addColumn($mysqli, 'projects', 'sub_domain', 'VARCHAR(255) NULL', 'project_title');
addColumn($mysqli, 'projects', 'full_name', 'VARCHAR(255) NULL', 'user_id');
addColumn($mysqli, 'projects', 'email', 'VARCHAR(255) NULL', 'full_name');

echo "Database check complete.";
$mysqli->close();
?>




