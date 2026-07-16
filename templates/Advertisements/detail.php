<?php $user = $this->getRequest()->getSession()->read('user'); ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($advertisement->title) ?> — JobMatch</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { margin: 0; background: #f4f2ed; color: #1b2340; }

    .public-nav {
        background: #0f1b2d; color: #fff; display: flex; justify-content: space-between;
        align-items: center; padding: 14px 40px; position: sticky; top: 0; z-index: 20;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }
    .public-nav .logo { display: flex; align-items: center; gap: 12px; }
    .public-nav .logo img { height: 46px; }
    .public-nav .logo span { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: #e0c468; letter-spacing: 1px; }
    .nav-links a { color: #cfd3da; text-decoration: none; margin-left: 20px; font-weight: 500; }
    .nav-links a:hover { color: #e0c468; }
    .btn-login { background: #c9a227; color: #0f1b2d; font-weight: 600; padding: 9px 22px; border-radius: 6px; text-decoration: none; }
    .btn-login:hover { background: #e0c468; }

    .detail-wrap { max-width: 1000px; margin: 34px auto 60px; padding: 0 24px; }
    .back-link { color: #0f1b2d; text-decoration: none; font-weight: 500; display: inline-block; margin-bottom: 18px; }
    .back-link:hover { color: #c9a227; }

    .detail-card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 6px 24px rgba(15,27,45,0.10); }
    .detail-poster { width: 100%; max-height: 340px; background: linear-gradient(135deg, #0f1b2d, #1a2940); display: flex; align-items: center; justify-content: center; }
    .detail-poster img { width: 100%; max-height: 340px; object-fit: cover; }
    .detail-poster i { color: #c9a227; font-size: 4rem; }

    .detail-body { padding: 32px; }
    .job-type { display: inline-block; background: rgba(201,162,39,0.15); color: #9a7d1a; font-size: 0.8rem; font-weight: 600; padding: 5px 14px; border-radius: 20px; margin-bottom: 12px; }
    .detail-title { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: #0f1b2d; margin: 0 0 6px; }
    .detail-salary { color: #c9a227; font-weight: 700; font-size: 1.3rem; margin: 14px 0; }

    .meta-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin: 22px 0; }
    .meta-item { background: #f8f6f0; border-radius: 8px; padding: 14px 16px; }
    .meta-item .label { font-size: 0.78rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; }
    .meta-item .value { font-weight: 600; color: #0f1b2d; margin-top: 3px; }

    .section-block { margin-top: 26px; }
    .section-block h5 { font-family: 'Playfair Display', serif; color: #0f1b2d; font-weight: 700; margin-bottom: 8px; }
    .section-block p { color: #444; line-height: 1.7; white-space: pre-line; }

    .apply-bar { margin-top: 30px; padding-top: 24px; border-top: 1px solid #eee; text-align: center; }
    .btn-apply { background: #c9a227; color: #0f1b2d; font-weight: 700; padding: 13px 40px; border-radius: 8px; text-decoration: none; font-size: 1.05rem; display: inline-block; }
    .btn-apply:hover { background: #b8911f; }
    .apply-note { color: #6b7280; font-size: 0.9rem; margin-top: 10px; }

    footer { background: #0f1b2d; color: #aab0bc; text-align: center; padding: 24px; font-size: 0.85rem; }
    </style>
</head>
<body>

<nav class="public-nav">
    <div class="logo">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch">
        <span>JobMatch</span>
    </div>
    <div class="nav-links">
        <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'home']) ?>">Browse Jobs</a>
        <?php if ($user): ?>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>" class="btn-login">Dashboard</a>
        <?php else: ?>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="btn-login">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </a>
        <?php endif; ?>
    </div>
</nav>

<div class="detail-wrap">
    <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'home']) ?>" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to all jobs
    </a>

    <div class="detail-card">
        <div class="detail-poster">
            <?php if (!empty($advertisement->poster)): ?>
                <img src="<?= $this->Url->build('/' . rtrim($advertisement->poster_dir, "/") . "/" . $advertisement->poster) ?>" alt="<?= h($advertisement->title) ?>">
            <?php else: ?>
                <i class="fa-solid fa-briefcase"></i>
            <?php endif; ?>
        </div>

        <div class="detail-body">
            <span class="job-type"><?= h($advertisement->job_type) ?></span>
            <h1 class="detail-title"><?= h($advertisement->title) ?></h1>
            <div class="detail-salary">RM <?= number_format((float)$advertisement->salary, 2) ?></div>

            <div class="meta-grid">
                <div class="meta-item"><div class="label">Location</div><div class="value"><?= h($advertisement->location) ?></div></div>
                <div class="meta-item"><div class="label">Category</div><div class="value"><?= h($advertisement->category) ?></div></div>
                <div class="meta-item"><div class="label">Deadline</div><div class="value"><?= h($advertisement->deadlines) ?></div></div>
            </div>

            <div class="section-block">
                <h5>Job Description</h5>
                <p><?= h($advertisement->description) ?></p>
            </div>

            <div class="section-block">
                <h5>Requirements</h5>
                <p><?= h($advertisement->requirements) ?></p>
            </div>

            <div class="apply-bar">
                <?php if ($user): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index', '?' => ['job' => $advertisement->id]]) ?>" class="btn-apply">
                        <i class="fa-solid fa-paper-plane"></i> Apply Now
                    </a>
                <?php else: ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="btn-apply">
                        <i class="fa-solid fa-right-to-bracket"></i> Login to Apply
                    </a>
                    <p class="apply-note">You need an account to apply for this job.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<footer>
    &copy; <?= date('Y') ?> JobMatch. Connect &middot; Match &middot; Succeed.
</footer>

</body>
</html>