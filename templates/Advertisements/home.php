<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobMatch — Find Your Next Job</title>

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
    .btn-login { background: #c9a227; color: #0f1b2d; font-weight: 600; border: none; padding: 9px 22px; border-radius: 6px; text-decoration: none; }
    .btn-login:hover { background: #e0c468; color: #0f1b2d; }

    .hero { background: #0f1b2d; color: #fff; text-align: center; padding: 60px 20px 70px; }
    .hero h1 { font-family: 'Playfair Display', serif; font-size: 2.8rem; font-weight: 700; margin: 0 0 12px; }
    .hero h1 span { color: #e0c468; }
    .hero p { color: #c3c9d4; font-size: 1.1rem; margin: 0; }

    .jobs-wrap { max-width: 1200px; margin: -40px auto 60px; padding: 0 24px; }
    .section-title { font-family: 'Playfair Display', serif; color: #0f1b2d; font-weight: 700; margin: 40px 0 22px; font-size: 1.7rem; }

    .job-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 22px; }
    .job-card {
        background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(15,27,45,0.08);
        display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s;
    }
    .job-card:hover { transform: translateY(-4px); box-shadow: 0 10px 26px rgba(15,27,45,0.15); }
    .job-poster { height: 150px; background: linear-gradient(135deg, #0f1b2d, #1a2940); display: flex; align-items: center; justify-content: center; }
    .job-poster img { width: 100%; height: 100%; object-fit: cover; }
    .job-poster i { color: #c9a227; font-size: 2.6rem; }
    .job-body { padding: 20px; display: flex; flex-direction: column; flex-grow: 1; }
    .job-type { display: inline-block; background: rgba(201,162,39,0.15); color: #9a7d1a; font-size: 0.75rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; margin-bottom: 10px; width: fit-content; }
    .job-title { font-weight: 700; font-size: 1.15rem; color: #0f1b2d; margin: 0 0 8px; }
    .job-meta { color: #6b7280; font-size: 0.88rem; margin: 2px 0; }
    .job-salary { color: #c9a227; font-weight: 700; font-size: 1.05rem; margin: 10px 0; }
    .job-card .btn-gold { margin-top: auto; background: #c9a227; color: #0f1b2d; font-weight: 600; border: none; padding: 9px; border-radius: 6px; text-decoration: none; text-align: center; }
    .job-card .btn-gold:hover { background: #b8911f; }

    .empty-box { background: #fff; border-radius: 12px; padding: 50px; text-align: center; color: #6b7280; box-shadow: 0 4px 18px rgba(15,27,45,0.08); }

    footer { background: #0f1b2d; color: #aab0bc; text-align: center; padding: 24px; font-size: 0.85rem; }
    </style>
</head>
<body>

<nav class="public-nav">
    <div class="logo">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch">
        <span>JobMatch</span>
    </div>
    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="btn-login">
        <i class="fa-solid fa-right-to-bracket"></i> Login
    </a>
</nav>

<section class="hero">
    <h1>Find Your Next <span>Opportunity</span></h1>
    <p>Browse the latest job openings and apply in minutes.</p>
</section>

<div class="jobs-wrap">
    <h2 class="section-title">Available Positions</h2>

    <?php if (count($advertisements) > 0): ?>
        <div class="job-grid">
            <?php foreach ($advertisements as $ad): ?>
                <div class="job-card">
                    <div class="job-poster">
                        <?php if (!empty($ad->poster)): ?>
                            <img src="<?= $this->Url->build('/' . rtrim($ad->poster_dir, "/") . "/" . $ad->poster) ?>" alt="<?= h($ad->title) ?>">
                        <?php else: ?>
                            <i class="fa-solid fa-briefcase"></i>
                        <?php endif; ?>
                    </div>
                    <div class="job-body">
                        <span class="job-type"><?= h($ad->job_type) ?></span>
                        <h3 class="job-title"><?= h($ad->title) ?></h3>
                        <p class="job-meta"><i class="fa-solid fa-location-dot"></i> <?= h($ad->location) ?></p>
                        <p class="job-meta"><i class="fa-solid fa-folder"></i> <?= h($ad->category) ?></p>
                        <p class="job-salary">RM <?= number_format((float)$ad->salary, 2) ?></p>
                        <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'detail', $ad->id]) ?>" class="btn-gold">
                            View &amp; Apply
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-box">No job openings available at the moment. Please check back later.</div>
    <?php endif; ?>
</div>

<footer>
    &copy; <?= date('Y') ?> JobMatch. Connect &middot; Match &middot; Succeed.
</footer>

</body>
</html>