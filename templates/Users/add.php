<!DOCTYPE html>
<html>
<head>
    <title>Add User | JobMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
* { font-family: 'Inter', sans-serif; box-sizing: border-box; }
body { margin: 0; background: #f4f2ed; transition: background 0.3s, color 0.3s; }
.brand-logo { height: 120px; width: auto; object-fit: contain; transition: all 0.3s; }


.sidebar { width: 260px; height: 100vh; position: fixed; left: 0; top: 0; background: #0f1b2d; color: #cfd3da; transition: 0.3s; overflow-x: hidden; border-right: 1px solid rgba(255,255,255,0.05); z-index: 10; }
.sidebar.collapsed { width: 70px; }
.sidebar .brand-mark { text-align: center; margin-bottom: 8px; }
.sidebar a { display: flex; align-items: center; gap: 12px; padding: 13px 22px; color: #aab0bc; text-decoration: none; font-size: 0.9rem; font-weight: 500; border-left: 3px solid transparent; transition: 0.2s; }
.sidebar a:hover, .sidebar a.active { background: rgba(201,162,39,0.08); color: #e0c468; border-left: 3px solid #c9a227; }
.sidebar a.logout { color: #c0786f; margin-top: 10px; border-top: 1px solid rgba(255,255,255,0.08); }
.sidebar a.logout:hover { background: rgba(192,57,43,0.1); color: #e07a6c; border-left-color: #c0392b; }
.sidebar span.text { transition: 0.2s; }
.sidebar.collapsed span.text { display: none; }
.sidebar.collapsed .brand-logo { height: 60px; width: 40px; }

.topbar { height: 64px; background: #ffffff; display: flex; justify-content: space-between; align-items: center; padding: 0 24px; position: fixed; top: 0; left: 260px; right: 0; z-index: 9; box-shadow: 0 2px 8px rgba(15,27,45,0.06); border-bottom: 1px solid #e8e4da; transition: left 0.3s, background 0.3s; }
.topbar.collapsed { left: 70px; }
.dark-mode-toggle { background: #0f1b2d; border: none; color: #e0c468; border-radius: 5px; padding: 6px 12px; cursor: pointer; font-size: 1rem; }
.dark-mode-toggle:hover { background: #1a2940; }

.content { margin-left: 260px; margin-top: 64px; padding: 28px 32px; transition: 0.3s; }
.content.expanded { margin-left: 70px; }
.page-heading { font-family: 'Playfair Display', serif; color: #0f1b2d; font-weight: 700; margin: 0 0 18px; transition: color 0.3s; }

.dash-panel { background:#fff; border-radius:8px; padding:24px; box-shadow:0 2px 10px rgba(15,27,45,0.06); margin-bottom:22px; }

.btn-gold { display:inline-block; background:#c9a227; color:#0f1b2d; font-weight:600; border:none; padding:10px 22px; border-radius:8px; text-decoration:none; font-size:0.9rem; cursor:pointer; }
.btn-gold:hover { background:#b8911f; color:#0f1b2d; }
.btn-outline-nav { display:inline-block; border:1px solid #0f1b2d; color:#0f1b2d; padding:10px 22px; border-radius:8px; text-decoration:none; font-size:0.9rem; }
.btn-outline-nav:hover { background:#0f1b2d; color:#fff; }

.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:0 20px; }
.form-row { margin-bottom:18px; }
.form-row label { display:block; font-size:0.78rem; font-weight:600; color:#4a4438; text-transform:uppercase; letter-spacing:0.4px; margin-bottom:6px; }
.form-row input, .form-row select { width:100%; padding:10px 14px; border:1px solid #d9d4c8; border-radius:8px; font-size:0.95rem; background:#fff; color:#3a3a3a; }
.form-row input:focus, .form-row select:focus { outline:none; border-color:#c9a227; box-shadow:0 0 0 3px rgba(201,162,39,0.15); }
.form-hint { font-size:0.74rem; color:#8a8478; margin-top:5px; }
.form-actions { margin-top:8px; display:flex; gap:10px; }

.detail-row { display:flex; padding:12px 0; border-bottom:1px solid #f0f0f0; }
.detail-row .label { width:170px; color:#6b7280; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.4px; font-weight:600; }
.detail-row .value { flex:1; color:#3a3a3a; font-size:0.95rem; }
.tag { padding:4px 11px; border-radius:20px; font-size:0.76rem; font-weight:600; }
.tag.admin { background:#e2d3f0; color:#5a2c86; }
.tag.user { background:#d1e7dd; color:#0f5132; }
.tag.active { background:#d1e7dd; color:#0f5132; }
.tag.inactive { background:#f8d7da; color:#842029; }

@media (max-width: 900px) { .form-grid { grid-template-columns: 1fr; } }

[data-bs-theme="dark"] body { background: #11161f; }
[data-bs-theme="dark"] .topbar { background: #1a2233; border-bottom: 1px solid rgba(255,255,255,0.06); box-shadow: 0 2px 8px rgba(0,0,0,0.3); }
[data-bs-theme="dark"] .page-heading { color: #e0c468; }
[data-bs-theme="dark"] .dash-panel { background: #1a2233; color: #cfd3da; box-shadow: 0 2px 10px rgba(0,0,0,0.25); }
[data-bs-theme="dark"] .btn-outline-nav { border-color:#e0c468; color:#e0c468; }
[data-bs-theme="dark"] .form-row input, [data-bs-theme="dark"] .form-row select { background:#141d2e; border-color:rgba(255,255,255,0.12); color:#cfd3da; }
[data-bs-theme="dark"] .detail-row .value { color:#cfd3da; }
[data-bs-theme="dark"] .detail-row { border-bottom:1px solid rgba(255,255,255,0.06); }
[data-bs-theme="dark"] .text-muted { color:#8b93a3 !important; }
</style>
</head>
<body>

<?php
    $sessionUser = $this->request->getSession()->read('user');
    $sbRole = (int)($sessionUser->role_id ?? 0);
?>
<div class="sidebar" id="sidebar">
    <div class="brand-mark">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch Logo" class="brand-logo">
    </div>
    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>">
        <i class="fa-solid fa-house"></i> <span class="text">Dashboard</span>
    </a>
    <a href="<?= $this->Url->build(['controller' => 'Members', 'action' => 'myProfile']) ?>">
        <i class="fa-solid fa-user"></i> <span class="text">Profile</span>
    </a>
    <?php if ($sbRole !== 1): ?>
    <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index']) ?>">
        <i class="fa-solid fa-file-lines"></i> <span class="text">Application</span>
    </a>
    <?php endif; ?>
    <?php if ($sbRole === 1): ?>
    <a href="<?= $this->Url->build(['controller' => 'Advertisements', 'action' => 'index']) ?>">
        <i class="fa-solid fa-bullhorn"></i> <span class="text">Advertisement</span>
    </a>
    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="active">
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
    <button class="dark-mode-toggle" id="darkModeToggle"><i class="fa-solid fa-moon" id="darkModeIcon"></i></button>
</div>

<div class="content" id="content">
    <h3 class="page-heading">Add New User</h3>
    <div class="panel-card" style="max-width:720px;">
        <?= $this->Form->create($user, ['type' => 'file']) ?>
        <div class="form-grid">
            <div class="form-group">
                <label>Full Name</label>
                <?= $this->Form->text('fullname', ['required' => true]) ?>
            </div>
            <div class="form-group">
                <label>Email</label>
                <?= $this->Form->email('email', ['required' => true]) ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <?= $this->Form->password('password', ['required' => true]) ?>
                <div class="hint">Minimum 6 characters.</div>
            </div>
            <div class="form-group">
                <label>Role</label>
                <?= $this->Form->select('user_group_id', [1 => 'Admin', 2 => 'User'], ['default' => 2]) ?>
            </div>
            <div class="form-group">
                <label>Status</label>
                <?= $this->Form->select('status', [1 => 'Active', 0 => 'Inactive'], ['default' => 1]) ?>
            </div>
            <div class="form-group">
                <label>Avatar (optional)</label>
                <?= $this->Form->file('avatar') ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn-back']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
function toggleSidebar(){document.getElementById('sidebar').classList.toggle('collapsed');document.getElementById('content').classList.toggle('expanded');document.getElementById('topbar').classList.toggle('collapsed');}
const dt=document.getElementById('darkModeToggle'),di=document.getElementById('darkModeIcon'),he=document.documentElement,st=localStorage.getItem('theme')||'light';
he.setAttribute('data-bs-theme',st);ic(st);
dt.addEventListener('click',()=>{const c=he.getAttribute('data-bs-theme'),n=c==='light'?'dark':'light';he.setAttribute('data-bs-theme',n);localStorage.setItem('theme',n);ic(n);});
function ic(t){di.className=t==='dark'?'fa-solid fa-sun':'fa-solid fa-moon';}
</script>
</body>
</html>