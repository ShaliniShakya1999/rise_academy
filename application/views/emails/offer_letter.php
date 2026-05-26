<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Internship Offer Letter - Internmo</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f0f0f0; 
            margin: 0; 
            padding: 20px; 
        }
        .outer-border {
            background-color: #fff;
            border: 15px solid #d4af37; /* Gold Border */
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 60px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header-title {
            color: #1a5fb4; /* Blue Header */
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            font-family: 'serif';
        }
        .logo-section {
            text-align: right;
            margin-bottom: 30px;
        }
        .logo-section img {
            height: 40px;
        }
        .logo-section p {
            font-size: 11px;
            margin: 2px 0;
            color: #333;
        }
        .meta-info {
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        .salutation {
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 15px;
        }
        .body-text {
            text-align: justify;
            margin-bottom: 15px;
            line-height: 1.6;
            font-size: 14px;
            color: #000;
        }
        .responsibilities-title {
            font-weight: bold;
            font-size: 15px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .sincerely {
            margin-top: 40px;
            font-size: 14px;
            line-height: 1.6;
        }
        .signature-lines {
            margin-top: 50px;
        }
        .sign-row {
            margin-bottom: 15px;
            font-size: 13px;
        }
        .line {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 300px;
        }
    </style>
</head>
<body>
    <div class="outer-border">
        <!-- Header -->
        <div class="header-title">Offer Letter</div>
        
        <div class="logo-section">
            <a href="http://internmo.com/" class="font-bold text-lg text-white">Internmo</a>" alt="Logo"><br>
            <p>[Internmo Pvt. Ltd.]</p>
        </div>

        <div class="meta-info">
            <strong><?= date('m/d/Y') ?></strong><br><br>
            <strong><?= $name ?></strong><br>
            [Candidate Address]<br>
            [City, State, Zip Code]
        </div>

        <div class="salutation">Dear <?= $name ?>,</div>

        <!-- Main Paragraph from Snippet -->
        <p class="body-text">
            We are pleased to offer you an internship position as a <strong><?= $role ?> Intern</strong> with <strong>Internmo Pvt. Ltd.</strong> This internship is scheduled for a period of <strong><?= $duration ?> months</strong>, effective from <strong><?= $start_date ?></strong> to <strong><?= $end_date ?></strong>.
        </p>

        <p class="body-text">
            You will be reporting directly to the Project Manager at our office location. We believe your skills and experience are an excellent match for our company. In this role, you will be required to assist in technical developments and project implementations.
        </p>

        <!-- Responsibilities -->
        <div class="responsibilities-title">Roles & Key Responsibilities:</div>
        <ul style="font-size: 14px; color: #000; margin-left: 20px; margin-bottom: 20px; line-height: 1.6;">
            <?php 
            $role_lower = strtolower($role);
            if (strpos($role_lower, 'web') !== false || strpos($role_lower, 'stack') !== false): ?>
                <li>Developing and maintaining responsive web applications.</li>
                <li>Writing clean and efficient code for frontend and backend.</li>
                <li>Testing and troubleshooting to ensure high-quality deliverables.</li>
            <?php else: ?>
                <li>Assisting in technical projects and requirement gathering.</li>
                <li>Participating in daily team stand-ups and learning sessions.</li>
                <li>Maintaining project documentation and progress reports.</li>
            <?php endif; ?>
        </ul>

        <p class="body-text">
            The stipend for this position is <strong>Performance Based</strong> to be paid on a monthly basis. Your employment with Internmo will be on an at-will basis, which means you and the company are free to terminate the relationship at any time for any reason.
        </p>

        <p class="body-text">
            This letter is not a contract or guarantee of employment for a definitive period of time. As an intern of Internmo, you are also eligible for our learning program and orientation package. Please confirm your acceptance of this offer by signing and returning this letter. We are excited to have you join our team!
        </p>

        <!-- Closing -->
        <div class="sincerely">
            Sincerely,<br><br>
            <strong>[Drishti Madaan]</strong><br>
            HR Manager<br>
            Internmo Pvt. Ltd.
        </div>

        <!-- Signature -->
        <div class="signature-lines">
            <div class="sign-row">Signature: <span class="line"></span></div>
            <div class="sign-row">Printed Name: <span class="line"></span></div>
        </div>
    </div>
</body>
</html>




