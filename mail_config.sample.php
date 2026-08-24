<?php
/**
 * Sample SMTP config for send_mail.php.
 *
 * Copy this file to mail_config.php (same directory) on the server and
 * fill in real values. mail_config.php is gitignored — never commit
 * real credentials.
 */

return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls', // 'tls' for port 587, 'ssl' for port 465
    'smtp_username' => 'your-account@gmail.com',
    'smtp_password' => 'your-16-char-app-password',
    'from_address' => 'your-account@gmail.com', // must match smtp_username for Gmail
    'from_name' => 'GBASE Website',
    'to_address' => 'gbasetechnologies.info@gmail.com',
];
