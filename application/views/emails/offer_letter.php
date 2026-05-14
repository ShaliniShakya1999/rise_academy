<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Internship Offer Letter - Rise Academy</title>
    <style>
        body { 
            font-family: 'Georgia', 'Times New Roman', Times, serif; 
            line-height: 1.5; 
            color: #000; 
            margin: 0; 
            padding: 40px; 
            background-color: #fff; 
        }
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
            background: #fff; 
            padding: 40px;
        }
        .header { 
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .logo { 
            float: left;
            height: 70px; 
        }
        .company-info {
            float: right;
            text-align: right;
            font-size: 12px;
            font-family: Arial, sans-serif;
            color: #444;
        }
        .doc-meta {
            margin-bottom: 30px;
            font-size: 14px;
        }
        .doc-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 40px;
            text-transform: uppercase;
        }
        .salutation {
            font-weight: bold;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 15px;
            text-align: justify;
        }
        .terms-box {
            margin: 30px 0;
            padding: 15px;
            border: 1px solid #ccc;
            font-style: italic;
            font-size: 14px;
        }
        .signature-section {
            margin-top: 60px;
        }
        .sign-block {
            float: left;
            width: 250px;
        }
        .sign-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 80px;
            border-top: 1px solid #eee;
            padding-top: 10px;
            text-align: center;
            font-size: 10px;
            color: #777;
            font-family: Arial, sans-serif;
        }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="<?= base_url('assets/website/images/rise_logo.png') ?>" alt="Logo" class="logo">
            <div class="company-info">
                <strong>RISE ACADEMY PVT. LTD.</strong><br>
                Plot No. 42, Knowledge Park III,<br>
                Greater Noida, UP - 201310<br>
                Email: info@riseacademy.co.in | Web: www.riseacademy.co.in
            </div>
            <div class="clear"></div>
        </div>

        <div class="doc-meta">
            <strong>Ref No:</strong> <?= $unid ?><br>
            <strong>Date:</strong> <?= date('d F, Y') ?>
        </div>

        <div class="doc-title">Internship Offer Letter</div>

        <div class="salutation">To, <?= $name ?>,</div>

        <p>
            We are pleased to offer you an internship position as a <strong><?= $role ?> Intern</strong> with <strong>Rise Academy Pvt. Ltd.</strong> 
            This internship is scheduled for a period of <strong><?= $duration ?> months</strong>, effective from 
            <strong><?= $start_date ?></strong> to <strong><?= $end_date ?></strong>.
        </p>

        <p>
            During this period, you will be under the guidance and supervision of our technical team. Your internship will focus on 
            developing practical skills and gaining industry experience in your chosen field. 
        </p>

        <p>
            Please note that this is a temporary internship role. It does not constitute an offer of permanent employment, 
            and successful completion of the program does not guarantee a future position within the company. 
            You will be expected to follow all company policies and maintain professional conduct throughout your tenure.
        </p>

        <div class="terms-box">
            By accepting this offer, you agree to maintain the confidentiality of all company data and intellectual property 
            that you may access during your internship.
        </div>

        <p>
            We are excited to have you join us and look forward to a mutually beneficial association. We wish you a productive 
            and successful internship experience at Rise Academy.
        </p>

        <div class="signature-section">
            <div class="sign-block">
                <div class="sign-line">
                    Authorized Signatory<br>
                    <span style="font-size: 12px; font-weight: normal;">HR Department, Rise Academy</span>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="footer">
            Regd Office: Rise Academy Pvt. Ltd., Knowledge Park III, Greater Noida, Uttar Pradesh, India.<br>
            This is a computer-generated document and does not require a physical signature.
        </div>
    </div>
</body>
</html>
