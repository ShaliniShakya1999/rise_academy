<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| EMAIL CONFIGURATION - Attempt 4 (jinlindia.com)
| -------------------------------------------------------------------
*/

$config['protocol']     = 'smtp';
$config['smtp_host']    = 'send.one.com'; 
$config['smtp_port']    = 587;
$config['smtp_user']    = 'shalini.shakya@paymanent.com'; 
$config['smtp_pass']    = '@paymanent.com'; 
$config['smtp_crypto']  = 'tls';
$config['mailtype']     = 'html';
$config['charset']      = 'utf-8';
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";
$config['wordwrap']     = TRUE;
$config['smtp_timeout'] = 30;
