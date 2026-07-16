<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Interview Invitation | JobMatch</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #e9e7e1; font-family: Georgia, 'Times New Roman', serif; color: #222; }
        .toolbar { text-align: center; padding: 16px; }
        .toolbar button, .toolbar a {
            font-family: Inter, sans-serif; font-size: 0.9rem; font-weight: 600;
            padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; margin: 0 4px;
        }
        .btn-print { background: #c9a227; color: #0f1b2d; }
        .btn-back { background: #0f1b2d; color: #fff; }
        .sheet { width: 21cm; min-height: 29.7cm; margin: 0 auto 30px; background: #fff; padding: 2.4cm; box-shadow: 0 6px 24px rgba(0,0,0,0.18); }
        .letterhead { display: flex; align-items: center; gap: 16px; border-bottom: 3px solid #c9a227; padding-bottom: 16px; }
        .letterhead img { height: 74px; width: auto; }
        .lh-name { font-family: 'Playfair Display', serif; font-size: 1.9rem; font-weight: 700; color: #0f1b2d; line-height: 1; }
        .lh-tag { font-family: Inter, sans-serif; font-size: 0.72rem; letter-spacing: 2px; color: #c9a227; text-transform: uppercase; margin-top: 4px; }
        .lh-contact { font-family: Inter, sans-serif; font-size: 0.72rem; color: #777; margin-top: 3px; }
        .letter-body { margin-top: 26px; font-size: 12.5pt; line-height: 1.7; white-space: pre-wrap; }
        @page { size: A4; margin: 0; }
        @media print { body { background:#fff; } .toolbar { display:none; } .sheet { box-shadow:none; margin:0; width:100%; min-height:auto; padding:2cm 2.2cm; } }
    </style>
</head>
<body>
<div class="toolbar">
    <button class="btn-print" onclick="window.print()">🖨 Print / Save as PDF</button>
    <a class="btn-back" href="javascript:history.back()">← Back</a>
</div>
<div class="sheet">
    <div class="letterhead">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch">
        <div>
            <div class="lh-name">JobMatch</div>
            <div class="lh-tag">Connect · Match · Succeed</div>
            <div class="lh-contact">www.jobmatch.com &nbsp;•&nbsp; hr@jobmatch.com</div>
        </div>
    </div>
    <div class="letter-body"><?= h($interview->letter) ?></div>
</div>
</body>
</html>