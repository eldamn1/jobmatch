<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | JobMatch</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
* {
    font-family: 'Inter', sans-serif;
    box-sizing: border-box;
}

body {
    margin: 0;
    background: #f4f2ed;
    transition: background 0.3s, color 0.3s;
}

.brand-logo {
    height: 120px;
    width: auto;
    object-fit: contain;
    transition: all 0.3s;
}

.sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    left: 0; top: 0;
    background: #0f1b2d;
    color: #cfd3da;
    transition: 0.3s;
    overflow-x: hidden;
    border-right: 1px solid rgba(255,255,255,0.05);
    z-index: 10;
}

.sidebar.collapsed { width: 70px; }

.sidebar .brand-mark {
    text-align: center;
    margin-bottom: 8px;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 22px;
    color: #aab0bc;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    border-left: 3px solid transparent;
    transition: 0.2s;
}

.sidebar a:hover,
.sidebar a.active {
    background: rgba(201,162,39,0.08);
    color: #e0c468;
    border-left: 3px solid #c9a227;
}

.sidebar a.logout {
    color: #c0786f;
    margin-top: 10px;
    border-top: 1px solid rgba(255,255,255,0.08);
}

.sidebar a.logout:hover {
    background: rgba(192,57,43,0.1);
    color: #e07a6c;
    border-left-color: #c0392b;
}

.sidebar span.text { transition: 0.2s; }
.sidebar.collapsed span.text { display: none; }
.sidebar.collapsed .brand-logo { height: 60px; width: 40px; }

.topbar {
    height: 64px;
    background: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 24px;
    position: fixed;
    top: 0; left: 260px; right: 0;
    z-index: 9;
    box-shadow: 0 2px 8px rgba(15,27,45,0.06);
    border-bottom: 1px solid #e8e4da;
    transition: left 0.3s, background 0.3s;
}

.topbar.collapsed { left: 70px; }

.dark-mode-toggle {
    background: #0f1b2d;
    border: none;
    color: #e0c468;
    border-radius: 5px;
    padding: 6px 12px;
    cursor: pointer;
    font-size: 1rem;
}

.dark-mode-toggle:hover { background: #1a2940; }


.content { margin-left: 260px; margin-top: 64px; padding: 28px 32px; transition: 0.3s; }
.content.expanded { margin-left: 70px; }
.page-heading { font-family: 'Playfair Display', serif; color: #0f1b2d; font-weight: 700; margin: 0 0 18px; transition: color 0.3s; }

.welcome-card { background: #ffffff; border-left: 4px solid #c9a227; border-radius: 8px; padding: 18px 22px; box-shadow: 0 2px 10px rgba(15,27,45,0.06); color: #3a3a3a; transition: background 0.3s, color 0.3s; margin-bottom: 22px; }

.dash-search { display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:22px; }
.dash-search-input { flex:1; min-width:220px; padding:10px 14px; border:1px solid #d9d4c8; border-radius:8px; font-size:0.9rem; background:#fff; color:#3a3a3a; }
.dash-search-select { padding:10px 14px; border:1px solid #d9d4c8; border-radius:8px; font-size:0.9rem; background:#fff; color:#3a3a3a; }
.dash-search-input:focus, .dash-search-select:focus { outline:none; border-color:#c9a227; box-shadow:0 0 0 3px rgba(201,162,39,0.15); }
.dash-search-btn { background:#c9a227; color:#0f1b2d; border:none; border-radius:8px; padding:10px 22px; font-weight:600; cursor:pointer; font-size:0.88rem; }
.dash-search-btn:hover { background:#b8911f; }
.dash-search-clear { background:#efece4; color:#333; border-radius:8px; padding:10px 16px; text-decoration:none; font-weight:600; font-size:0.88rem; display:inline-flex; align-items:center; }

.stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 22px; }
.stat-card { background:#fff; border-radius:8px; padding:18px 20px; box-shadow:0 2px 10px rgba(15,27,45,0.06); border-left:4px solid #c9a227; }
.stat-number { font-family:'Playfair Display',serif; font-size:2.4rem; font-weight:700; color:#0f1b2d; line-height:1; }
.stat-label { color:#6b7280; font-size:0.85rem; margin-top:6px; }

.dash-grid { display:grid; grid-template-columns: 1fr 1fr; gap:20px; }
.dash-panel { background:#fff; border-radius:8px; padding:20px; box-shadow:0 2px 10px rgba(15,27,45,0.06); margin-bottom:22px; }
.dash-panel h4 { font-family:'Playfair Display',serif; color:#0f1b2d; margin:0 0 14px; font-size:1.2rem; }

.dash-table { width:100%; border-collapse:collapse; }
.dash-table th { text-align:left; font-size:0.78rem; color:#6b7280; padding:8px; border-bottom:2px solid #eee; }
.dash-table td { padding:10px 8px; border-bottom:1px solid #f0f0f0; font-size:0.9rem; }

.badge2 { padding:4px 11px; border-radius:20px; font-size:0.78rem; font-weight:600; }
.badge2.pending { background:#fff3cd; color:#8a6d00; }
.badge2.approved { background:#d1e7dd; color:#0f5132; }
.badge2.rejected { background:#f8d7da; color:#842029; }

.btn-gold { display:inline-block; background:#c9a227; color:#0f1b2d; font-weight:600; border:none; padding:7px 16px; border-radius:6px; text-decoration:none; font-size:0.85rem; cursor:pointer; }
.btn-gold:hover { background:#b8911f; color:#0f1b2d; }
.btn-outline-nav { display:inline-block; border:1px solid #0f1b2d; color:#0f1b2d; padding:7px 16px; border-radius:6px; text-decoration:none; font-size:0.85rem; }
.btn-outline-nav:hover { background:#0f1b2d; color:#fff; }

.job-item { display:flex; justify-content:space-between; align-items:center; padding:11px 0; border-bottom:1px solid #f0f0f0; }
.job-item:last-child { border-bottom:none; }
.profile-alert { background:#fff8e6; border-left:4px solid #c9a227; padding:14px 18px; border-radius:8px; margin-bottom:18px; color:#5a4a1a; }

@media (max-width: 900px) {
    .stat-grid { grid-template-columns: repeat(2, 1fr); }
    .dash-grid { grid-template-columns: 1fr; }
}

[data-bs-theme="dark"] body { background: #11161f; }
[data-bs-theme="dark"] .topbar { background: #1a2233; border-bottom: 1px solid rgba(255,255,255,0.06); box-shadow: 0 2px 8px rgba(0,0,0,0.3); }
[data-bs-theme="dark"] .page-heading { color: #e0c468; }
[data-bs-theme="dark"] .welcome-card,
[data-bs-theme="dark"] .stat-card,
[data-bs-theme="dark"] .dash-panel { background: #1a2233; color: #cfd3da; box-shadow: 0 2px 10px rgba(0,0,0,0.25); }
[data-bs-theme="dark"] .stat-number,
[data-bs-theme="dark"] .dash-panel h4 { color: #e0c468; }
[data-bs-theme="dark"] .dash-table td { border-bottom: 1px solid rgba(255,255,255,0.06); }
[data-bs-theme="dark"] .job-item { border-bottom: 1px solid rgba(255,255,255,0.06); }
[data-bs-theme="dark"] .btn-outline-nav { border-color:#e0c468; color:#e0c468; }
[data-bs-theme="dark"] .text-muted { color: #8b93a3 !important; }
[data-bs-theme="dark"] .dash-search-input,
[data-bs-theme="dark"] .dash-search-select { background:#141d2e; border-color:rgba(255,255,255,0.12); color:#cfd3da; }
[data-bs-theme="dark"] .dash-search-clear { background:#242e42; color:#cfd3da; }
</style>
</head>

<body>

<?php $roleId = (int)($user->role_id ?? 0); ?>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <div class="brand-mark">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch Logo" class="brand-logo">
    </div>

    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>" class="active">
        <i class="fa-solid fa-house"></i> <span class="text">Dashboard</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'Members', 'action' => 'myProfile']) ?>">
        <i class="fa-solid fa-user"></i> <span class="text">Profile</span>
    </a>

    <?php if ($roleId !== 1): ?>
    <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index']) ?>">
        <i class="fa-solid fa-file-lines"></i> <span class="text">Application</span>
    </a>
    <?php endif; ?>

    <?php if ($roleId === 1): ?>
    <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'index']) ?>">
        <i class="fa-solid fa-bullhorn"></i> <span class="text">Advertisement</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'Interviews', 'action' => 'index']) ?>">
        <i class="fa-solid fa-calendar-check"></i> <span class="text">Interviews</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
        <i class="fa-solid fa-users"></i> <span class="text">Users</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'AuditLogs', 'action' => 'index']) ?>">
        <i class="fa-solid fa-clock-rotate-left"></i> <span class="text">Audit Logs</span>
    </a>
    <?php endif; ?>

    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> <span class="text">Logout</span>
    </a>

</div>

<div class="topbar" id="topbar">
    <button onclick="toggleSidebar()" class="dark-mode-toggle">☰</button>
    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fa-solid fa-moon" id="darkModeIcon"></i>
    </button>
</div>

<div class="content" id="content">

    <h3 class="page-heading">Dashboard</h3>

    <div class="welcome-card">
        Welcome back, <strong><?= h($user->fullname ?? '') ?></strong>
    </div>

    <form method="get" class="dash-search">
        <input type="text" name="search" value="<?= h($search ?? '') ?>"
               placeholder="Search by name or job title..." class="dash-search-input">
        <select name="status" class="dash-search-select">
            <option value="">All Status</option>
            <option value="0" <?= (string)($statusFilter ?? '') === '0' ? 'selected' : '' ?>>Pending</option>
            <option value="1" <?= (string)($statusFilter ?? '') === '1' ? 'selected' : '' ?>>Approved</option>
            <option value="2" <?= (string)($statusFilter ?? '') === '2' ? 'selected' : '' ?>>Rejected</option>
        </select>
        <button type="submit" class="dash-search-btn"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <?php if (($search ?? '') !== '' || ($statusFilter ?? '') !== ''): ?>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>" class="dash-search-clear">Clear</a>
        <?php endif; ?>
    </form>

    <?php if ($roleId === 1): ?>

        <div class="stat-grid">
            <div class="stat-card"><div class="stat-number"><?= $adminStats['jobs'] ?></div><div class="stat-label">Job Positions</div></div>
            <div class="stat-card"><div class="stat-number"><?= $adminStats['applicants'] ?></div><div class="stat-label">Total Applicants</div></div>
            <div class="stat-card"><div class="stat-number"><?= $adminStats['pending'] ?></div><div class="stat-label">Pending Review</div></div>
            <div class="stat-card"><div class="stat-number"><?= $adminStats['approved'] ?></div><div class="stat-label">Approved</div></div>
        </div>

        <div style="margin-bottom:22px;">
            <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'add']) ?>" class="btn-gold">
                <i class="fa-solid fa-plus"></i> Add Job
            </a>
            <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'index']) ?>" class="btn-outline-nav">
                <i class="fa-solid fa-bullhorn"></i> Manage Positions
            </a>
        </div>

        <div class="dash-grid">
            <div class="dash-panel">
                <h4>Recent Applicants</h4>
                <?php if (!empty($recentApplicants)): ?>
                    <table class="dash-table">
                        <thead><tr><th>Applicant</th><th>Position</th><th>Status</th></tr></thead>
                        <tbody>
                        <?php foreach ($recentApplicants as $app): ?>
                            <?php
                                $st  = (int)$app->status;
                                if (!empty($app->offer_letter)) { $st = 1; } // has offer -> approved
                                $cls = $st === 1 ? 'approved' : ($st === 2 ? 'rejected' : 'pending');
                                $lbl = $st === 1 ? 'Approved' : ($st === 2 ? 'Rejected' : 'Pending');
                            ?>
                            <tr>
                                <td><?= h($app->member->name ?? '-') ?></td>
                                <td><?= h($app->advertisement->title ?? '-') ?></td>
                                <td><span class="badge2 <?= $cls ?>"><?= $lbl ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No applications found.</p>
                <?php endif; ?>
            </div>

            <div class="dash-panel">
                <h4>Recent Job Postings</h4>
                <?php if (!empty($recentJobs)): ?>
                    <?php foreach ($recentJobs as $job): ?>
                        <div class="job-item">
                            <div>
                                <strong><?= h($job->title) ?></strong><br>
                                <small class="text-muted"><?= count($job->applications ?? []) ?> applicants &middot; <?= h($job->location) ?></small>
                            </div>
                            <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'manage', $job->id]) ?>" class="btn-gold">Manage</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No job postings found.</p>
                <?php endif; ?>
            </div>
        </div>

    <?php else: ?>

        <div class="stat-grid">
            <div class="stat-card"><div class="stat-number"><?= $stats['total'] ?></div><div class="stat-label">Total Applied</div></div>
            <div class="stat-card"><div class="stat-number"><?= $stats['pending'] ?></div><div class="stat-label">Pending</div></div>
            <div class="stat-card"><div class="stat-number"><?= $stats['approved'] ?></div><div class="stat-label">Approved</div></div>
            <div class="stat-card"><div class="stat-number"><?= $stats['rejected'] ?></div><div class="stat-label">Rejected</div></div>
        </div>

        <?php if (!empty($offerAlert)): ?>
            <div style="background:#e8f6ec;border-left:4px solid #1e7e34;padding:15px 20px;border-radius:8px;margin-bottom:18px;color:#0f1b2d;">
                <strong><i class="fa-solid fa-circle-check"></i> Congratulations! You got the job!</strong><br>
                <span style="font-size:0.92rem;">
                    You have received an offer for the position of
                    <strong><?= h($offerAlert->advertisement->title ?? '') ?></strong>.
                </span>
                <div class="mt-2">
                    <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'letter', $offerAlert->id]) ?>"
                       target="_blank" class="btn-gold" style="padding:6px 14px;">
                        <i class="fa-solid fa-file-lines"></i> View Offer Letter
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($interviewAlert)): ?>
            <div style="background:#e7f1fb;border-left:4px solid #0d6efd;padding:15px 20px;border-radius:8px;margin-bottom:18px;color:#0f1b2d;">
                <strong><i class="fa-solid fa-calendar-check"></i> You have an interview scheduled!</strong><br>
                <span style="font-size:0.92rem;">
                    Position: <strong><?= h($interviewAlert->application->advertisement->title ?? '') ?></strong>
                    &middot; <?= $interviewAlert->interview_date ? h($interviewAlert->interview_date->format('d/m/Y')) : '' ?>
                    <?= ($interviewAlert->interview_time && is_object($interviewAlert->interview_time)) ? h($interviewAlert->interview_time->format('g:i A')) : '' ?>
                    &middot; <?= h($interviewAlert->location) ?>
                </span>
                <?php if (!empty($interviewAlert->letter)): ?>
                    <div class="mt-2">
                        <a href="<?= $this->Url->build(['controller' => 'Interviews', 'action' => 'letter', $interviewAlert->id]) ?>"
                           target="_blank" class="btn-gold" style="padding:6px 14px;">
                            <i class="fa-solid fa-file-lines"></i> View Interview Letter
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php $hasResume = !empty($member->resume); ?>
        <?php if (!$member || !$hasResume): ?>
            <div class="profile-alert">
                <strong>Complete your profile:</strong>
                <?php if (!$member): ?>
                    Please set up your profile first.
                <?php else: ?>
                    You haven't uploaded a resume yet.
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div style="margin-bottom:22px;">
            <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index']) ?>" class="btn-gold">
                <i class="fa-solid fa-paper-plane"></i> Apply for a Job
            </a>
            <a href="<?= $this->Url->build(['controller' => 'Members', 'action' => 'myProfile']) ?>" class="btn-outline-nav">
                <i class="fa-solid fa-user-pen"></i> Update Profile
            </a>
        </div>

        <div class="dash-grid">
            <div class="dash-panel">
                <h4>Recent Applications</h4>
                <?php if (!empty($recentApplications)): ?>
                    <table class="dash-table">
                        <thead><tr><th>Position</th><th>Date</th><th>Status</th></tr></thead>
                        <tbody>
                        <?php foreach ($recentApplications as $app): ?>
                            <?php
                                $st  = (int)$app->status;
                                if (!empty($app->offer_letter)) { $st = 1; }
                                $cls = $st === 1 ? 'approved' : ($st === 2 ? 'rejected' : 'pending');
                                $lbl = $st === 1 ? 'Approved' : ($st === 2 ? 'Rejected' : 'Pending');
                            ?>
                            <tr>
                                <td><?= h($app->advertisement->title ?? '-') ?></td>
                                <td><?= $app->created ? $app->created->format('d/m/Y') : '-' ?></td>
                                <td><span class="badge2 <?= $cls ?>"><?= $lbl ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No applications found.</p>
                <?php endif; ?>
            </div>

            <div class="dash-panel">
                <h4>Latest Jobs</h4>
                <?php if (!empty($latestJobs)): ?>
                    <?php foreach ($latestJobs as $job): ?>
                        <div class="job-item">
                            <div>
                                <strong><?= h($job->title) ?></strong><br>
                                <small class="text-muted"><?= h($job->job_type) ?> &middot; <?= h($job->location) ?></small>
                            </div>
                            <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index', '?' => ['job' => $job->id]]) ?>" class="btn-gold">Apply</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No jobs found.</p>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>

</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('content').classList.toggle('expanded');
    document.getElementById('topbar').classList.toggle('collapsed');
}
const darkModeToggle = document.getElementById('darkModeToggle');
const darkModeIcon = document.getElementById('darkModeIcon');
const htmlEl = document.documentElement;
const savedTheme = localStorage.getItem('theme') || 'light';
htmlEl.setAttribute('data-bs-theme', savedTheme);
updateIcon(savedTheme);
darkModeToggle.addEventListener('click', () => {
    const current = htmlEl.getAttribute('data-bs-theme');
    const newTheme = current === 'light' ? 'dark' : 'light';
    htmlEl.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateIcon(newTheme);
});
function updateIcon(theme) {
    darkModeIcon.className = theme === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
}
</script>

</body>
</html>