<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Joining Letter - Internmo</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #334155; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; }
        .header { background: linear-gradient(135deg, #00204a 0%, #003a8c 100%); padding: 40px; text-align: center; }
        .logo { width: 80px; height: 80px; margin-bottom: 20px; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .content { padding: 40px; }
        .greeting { font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 20px; }
        .credentials { background-color: #f0f9ff; border: 1px solid #bae6fd; border-radius: 16px; padding: 25px; margin: 30px 0; }
        .credentials-title { font-size: 12px; font-weight: 800; color: #0369a1; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; }
        .credential-item { font-family: monospace; font-size: 16px; color: #0c4a6e; margin-bottom: 10px; font-weight: bold; }
        .footer { background-color: #f1f5f9; padding: 30px; text-align: center; font-size: 12px; color: #64748b; }
        .btn { display: inline-block; padding: 16px 32px; background-color: #d4af37; color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 800; font-size: 14px; margin-top: 20px; box-shadow: 0 4px 6px -1px rgba(212, 175, 55, 0.3); }
        .highlight { color: #d4af37; font-weight: 800; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Internmo</h1>
        </div>
        <div class="content">
            <div class="greeting">Congratulations, <?= htmlspecialchars($name) ?>!</div>
            <p>We are delighted to welcome you to the Internmo family. This letter confirms your selection for the <span class="highlight"><?= htmlspecialchars($course) ?></span> internship program.</p>
            
            <p>Your application has been reviewed and approved by our management team. You can now access your personalized learning dashboard using the credentials provided below:</p>

            <div class="credentials">
                <div class="credentials-title">Your Portal Credentials</div>
                <div class="credential-item">User ID: <?= htmlspecialchars($email) ?></div>
                <div class="credential-item">Temporary Password: <?= htmlspecialchars($password) ?></div>
                <p style="font-size: 11px; color: #64748b; margin-top: 10px;">*Please change your password after your first login.</p>
            </div>

            <p>We are excited to see the impact you will make during your time with us. Please click the button below to log in and get started with your orientation.</p>

            <div style="text-align: center;">
                <a href="<?= base_url('projects/login') ?>" class="btn">LOG IN TO PORTAL</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; <?= date('Y') ?> Internmo. All rights reserved.</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>




