<?php
define('BASEPATH', '1');
define('ENVIRONMENT', 'development');
require_once 'application/config/database.php';
$db_config = $db['default'];
try {
    $dsn = "mysql:host={$db_config['hostname']};dbname={$db_config['database']};charset=utf8mb4";
    $pdo = new PDO($dsn, $db_config['username'], $db_config['password']);
    
    // Check columns
    $stmt = $pdo->query("SHOW COLUMNS FROM internship_users LIKE 'password_hash'");
    $col = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Column type: {$col['Type']}\n";
    
    // Check stored hash for user
    $stmt2 = $pdo->prepare("SELECT password_hash FROM internship_users WHERE email = ?");
    $stmt2->execute(['shakyashalini1999@gmail.com']);
    $user = $stmt2->fetch(PDO::FETCH_ASSOC);
    echo "Stored Hash: {$user['password_hash']} (Length: " . strlen($user['password_hash']) . ")\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
