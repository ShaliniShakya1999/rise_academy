<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Setup.php — ONE-TIME password-reset helper for the imported `jobportal` dump.
 *
 * The dump already contains these users (id 1 admin, id 2 user, id 4 user):
 *   admin@example.com
 *   user@example.com
 *   shakyashalini1999@gmail.com
 *
 * Their password hashes are unknown to us, so visit:
 *     {base_url}/setup/seed
 * once. It will reset them to known credentials below.
 *
 * DELETE THIS FILE after seeding (security).
 */
class Setup extends CI_Controller
{
    public function index()
    {
        show_404();
    }

    public function seed()
    {
        $this->load->database();
        $this->load->helper('url');

        $accounts = [
            ['email' => 'admin@example.com',            'password' => 'Admin@123', 'role_id' => 1, 'full_name' => 'Admin User'],
            ['email' => 'user@example.com',             'password' => 'User@123',  'role_id' => 2, 'full_name' => 'Priya Sharma'],
            ['email' => 'shakyashalini1999@gmail.com',  'password' => 'Shalini@123','role_id' => 2, 'full_name' => 'Shalini Shakya'],
        ];

        $log = [];
        foreach ($accounts as $a) {
            $existing = $this->db->where('email', $a['email'])->get('users')->row();
            $hash     = password_hash($a['password'], PASSWORD_DEFAULT);
            $now      = date('Y-m-d H:i:s');

            if ($existing) {
                $this->db->where('id', $existing->id)->update('users', [
                    'role_id'           => $a['role_id'],
                    'password_hash'     => $hash,
                    'full_name'         => $a['full_name'],
                    'email_verified_at' => $existing->email_verified_at ?: $now,
                    'deleted_at'        => null,
                    'updated_at'        => $now,
                ]);
                $log[] = $a['email'] . ' → password reset (id ' . $existing->id . ')';
            } else {
                $this->db->insert('users', [
                    'role_id'           => $a['role_id'],
                    'email'             => $a['email'],
                    'password_hash'     => $hash,
                    'full_name'         => $a['full_name'],
                    'email_verified_at' => $now,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]);
                $log[] = $a['email'] . ' → created (id ' . $this->db->insert_id() . ')';
            }
        }

        header('Content-Type: text/html; charset=utf-8');
        echo '<!doctype html><meta charset="utf-8"><title>Setup complete</title>';
        echo '<body style="font-family: ui-sans-serif, system-ui; max-width:680px; margin:40px auto; padding:24px; background:#f8fafc; color:#0f172a;">';
        echo '<div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:24px;">';
        echo '<h1 style="margin-top:0;">✅ Passwords reset</h1>';
        echo '<ul>';
        foreach ($log as $l) echo '<li>' . htmlspecialchars($l) . '</li>';
        echo '</ul>';
        echo '<table style="width:100%;border-collapse:collapse;margin-top:16px;font-size:14px;">';
        echo '<tr style="background:#f1f5f9;"><th style="text-align:left;padding:8px;border:1px solid #e2e8f0;">Email</th><th style="text-align:left;padding:8px;border:1px solid #e2e8f0;">Password</th><th style="text-align:left;padding:8px;border:1px solid #e2e8f0;">Role</th></tr>';
        foreach ($accounts as $a) {
            echo '<tr><td style="padding:8px;border:1px solid #e2e8f0;">' . htmlspecialchars($a['email']) . '</td>';
            echo '<td style="padding:8px;border:1px solid #e2e8f0;font-family:monospace;">' . htmlspecialchars($a['password']) . '</td>';
            echo '<td style="padding:8px;border:1px solid #e2e8f0;">' . ($a['role_id'] === 1 ? 'admin' : 'user') . '</td></tr>';
        }
        echo '</table>';
        echo '<p style="margin-top:24px;color:#9b1c1c;"><strong>Security:</strong> Delete <code>application/controllers/Setup.php</code> now.</p>';
        echo '<p><a href="' . site_url('login') . '" style="display:inline-block;margin-top:12px;padding:10px 16px;background:#2563eb;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;">Go to Login</a></p>';
        echo '</div></body>';
    }
}
