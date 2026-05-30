<?php
define('BASEPATH', '1');
define('ENVIRONMENT', 'development');
require_once 'application/config/database.php';
$db_config = $db['default'];
try {
    $dsn = "mysql:host={$db_config['hostname']};dbname={$db_config['database']};charset=utf8mb4";
    $pdo = new PDO($dsn, $db_config['username'], $db_config['password']);
    
    $stmt = $pdo->prepare("SELECT section_json FROM resume_sections WHERE resume_id = ? AND section_key = ?");
    $stmt->execute([28, 'theme']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo "Database theme color: {$row['section_json']}\n";
    } else {
        echo "No theme section found.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
