<?php
/**
 * @var \App\View\AppView 
 */
$user   = $this->getRequest()->getSession()->read('user');
$roleId = (int)($user->role_id ?? 0);
$ctrl   = $this->getRequest()->getParam('controller');
$act    = $this->getRequest()->getParam('action');
?>
<!DOCTYPE html>
<html lang="ms" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?: 'JobMatch' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { margin: 0; background: #f4f2ed; transition: background 0.3s, color 0.3s; }

    .brand-mark { text-align: center; margin-bottom: 8px; }
    .brand-logo { height: 120px; width: auto; object-fit: contain; }

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

    /* CONTENT */
    .content { margin-left: 260px; margin-top: 64px; padding: 28px 32px; transition: 0.3s; }
    .content.expanded { margin-left: 70px; }
    .page-heading { font-family: 'Playfair Display', serif; color: #0f1b2d; font-weight: 700; margin: 0 0 18px; transition: color 0.3s; }

    .panel-card {
        background: #fff; border-radius: 8px; padding: 22px;
        box-shadow: 0 2px 10px rgba(15,27,45,0.06); margin-bottom: 22px; color: #3a3a3a;
        transition: background 0.3s, color 0.3s;
    }
    .panel-card.accent { border-left: 4px solid #c9a227; }

    .count-card {
        background: #fff; border-left: 5px solid #c9a227; border-radius: 8px; padding: 22px;
        box-shadow: 0 2px 10px rgba(15,27,45,0.06); display: flex; align-items: center; gap: 18px; margin-bottom: 22px;
        transition: background 0.3s, color 0.3s;
    }
    .count-number { font-family: 'Playfair Display', serif; font-size: 3.4rem; font-weight: 700; color: #c9a227; line-height: 1; }

    .btn-gold { background: #c9a227; color: #0f1b2d; font-weight: 600; border: none; }
    .btn-gold:hover { background: #b8911f; color: #0f1b2d; }

    table.jm-table { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(15,27,45,0.06); width: 100%; margin: 0; }
    table.jm-table thead { background: #0f1b2d; color: #fff; }
    table.jm-table thead th { font-weight: 600; padding: 14px 16px; border: none; }
    table.jm-table td { padding: 12px 16px; vertical-align: middle; border-top: 1px solid #eee; }
    .status-badge { background: #c9a227; color: #0f1b2d; font-weight: 600; }

    /* DARK MODE */
    [data-bs-theme="dark"] body { background: #11161f; }
    [data-bs-theme="dark"] .topbar { background: #1a2233; border-bottom: 1px solid rgba(255,255,255,0.06); }
    [data-bs-theme="dark"] .page-heading { color: #e0c468; }
    [data-bs-theme="dark"] .panel-card,
    [data-bs-theme="dark"] .count-card { background: #1a2233; color: #cfd3da; box-shadow: 0 2px 10px rgba(0,0,0,0.25); }
    [data-bs-theme="dark"] table.jm-table { background: #1a2233; color: #cfd3da; }
    [data-bs-theme="dark"] table.jm-table td { border-top: 1px solid rgba(255,255,255,0.06); }
    [data-bs-theme="dark"] .text-muted { color: #8b93a3 !important; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="brand-mark">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch Logo" class="brand-logo">
    </div>

    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>"
       class="<?= ($ctrl === 'Users' && $act === 'dashboard') ? 'active' : '' ?>">
        <i class="fa-solid fa-house"></i> <span class="text">Dashboard</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'Members', 'action' => 'myProfile']) ?>"
       class="<?= $ctrl === 'Members' ? 'active' : '' ?>">
        <i class="fa-solid fa-user"></i> <span class="text">Profile</span>
    </a>

    <?php if ($roleId !== 1): // Application untuk User sahaja ?>
    <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index']) ?>"
       class="<?= $ctrl === 'Applications' ? 'active' : '' ?>">
        <i class="fa-solid fa-file-lines"></i> <span class="text">Application</span>
    </a>
    <?php endif; ?>

    <?php if ($roleId === 1): ?>
    <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'index']) ?>"
       class="<?= $ctrl === 'Advertisements' ? 'active' : '' ?>">
        <i class="fa-solid fa-bullhorn"></i> <span class="text">Advertisement</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'Interviews', 'action' => 'index']) ?>"
       class="<?= $ctrl === 'Interviews' ? 'active' : '' ?>">
        <i class="fa-solid fa-calendar-check"></i> <span class="text">Interviews</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"
       class="<?= ($ctrl === 'Users' && $act !== 'dashboard') ? 'active' : '' ?>">
        <i class="fa-solid fa-users"></i> <span class="text">Users</span>
    </a>

    <a href="<?= $this->Url->build(['controller' => 'AuditLogs', 'action' => 'index']) ?>"
       class="<?= $ctrl === 'AuditLogs' ? 'active' : '' ?>">
        <i class="fa-solid fa-clock-rotate-left"></i> <span class="text">Audit Logs</span>
    </a>
    <?php endif; ?>

    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> <span class="text">Logout</span>
    </a>
</div>

<!-- TOP NAVBAR -->
<div class="topbar" id="topbar">
    <button onclick="toggleSidebar()" class="dark-mode-toggle">☰</button>
    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fa-solid fa-moon" id="darkModeIcon"></i>
    </button>
</div>

<!-- CONTENT -->
<div class="content" id="content">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
