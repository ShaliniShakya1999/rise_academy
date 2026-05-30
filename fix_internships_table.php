<?php
$mysqli = new mysqli("localhost", "root", "", "jobportal");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function addColumn($mysqli, $table, $column, $definition) {
    $result = $mysqli->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
    if ($result->num_rows == 0) {
        if ($mysqli->query("ALTER TABLE `$table` ADD `$column` $definition")) {
            echo "Added $column to $table.<br>\n";
        } else {
            echo "Error adding $column: " . $mysqli->error . "<br>\n";
        }
    } else {
        echo "$column already exists in $table.<br>\n";
    }
}

// Fix internships table
addColumn($mysqli, 'internships', 'duration', 'VARCHAR(50) NULL');
addColumn($mysqli, 'internships', 'location', 'VARCHAR(100) DEFAULT "Remote"');
addColumn($mysqli, 'internships', 'stipend', 'VARCHAR(50) DEFAULT "Unpaid"');
addColumn($mysqli, 'internships', 'status', 'ENUM("active","inactive") DEFAULT "active"');
addColumn($mysqli, 'internships', 'created_at', 'DATETIME DEFAULT CURRENT_TIMESTAMP');
addColumn($mysqli, 'internships', 'category', 'VARCHAR(100) DEFAULT "General"');

// Fix internship_applications table
addColumn($mysqli, 'internship_applications', 'applied_at', 'DATETIME DEFAULT CURRENT_TIMESTAMP');
addColumn($mysqli, 'internship_applications', 'status', 'ENUM("pending","reviewed","shortlisted","rejected") DEFAULT "pending"');

echo "Database fix complete.";
$mysqli->close();
?>




