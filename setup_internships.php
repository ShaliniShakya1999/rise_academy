<?php
$mysqli = new mysqli("localhost", "root", "", "jobportal");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function tableExists($mysqli, $table) {
    $result = $mysqli->query("SHOW TABLES LIKE '$table'");
    return $result->num_rows > 0;
}

// 1. Internships Table
if (!tableExists($mysqli, 'internships')) {
    $mysqli->query("CREATE TABLE `internships` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `category` varchar(100) NOT NULL,
        `duration` varchar(50) NOT NULL,
        `location` varchar(100) DEFAULT 'Remote',
        `stipend` varchar(50) DEFAULT 'Unpaid',
        `image` varchar(255) DEFAULT NULL,
        `status` enum('active','inactive') DEFAULT 'active',
        `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    echo "Created internships table.<br>";
} else {
    echo "internships table already exists.<br>";
}

// 2. Internship Applications Table
if (!tableExists($mysqli, 'internship_applications')) {
    $mysqli->query("CREATE TABLE `internship_applications` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `internship_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `full_name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `resume_path` varchar(255) DEFAULT NULL,
        `status` enum('pending','reviewed','shortlisted','rejected') DEFAULT 'pending',
        `applied_at` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    echo "Created internship_applications table.<br>";
} else {
    echo "internship_applications table already exists.<br>";
}

echo "Database preparation complete.";
$mysqli->close();
?>




