<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs | JobMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
* { font-family: 'Inter', sans-serif; box-sizing: border-box; }
body { margin: 0; background: #f4f2ed; transition: background .3s, color .3s; }
.brand-logo { height: 120px; width: auto; object-fit: contain; transition: all .3s; }
.sidebar { width: 260px; height: 100vh; position: fixed; left:0; top:0; background:#0f1b2d; color:#cfd3da; transition:.3s; overflow-x:hidden; border-right:1px solid rgba(255,255,255,.05); z-index:10; }
.sidebar.collapsed { width: 70px; }
.sidebar .brand-mark { text-align:center; margin-bottom:8px; }
.sidebar a { display:flex; align-items:center; gap:12px; padding:13px 22px; color:#aab0bc; text-decoration:none; font-size:.9rem; font-weight:500; border-left:3px solid transparent; transition:.2s; }
.sidebar a:hover, .sidebar a.active { background:rgba(201,162,39,.08); color:#e0c468; border-left:3px solid #c9a227; }
.sidebar a.logout { color:#c0786f; margin-top:10px; border-top:1px solid rgba(255,255,255,.08); }
.sidebar a.logout:hover { background:rgba(192,57,43,.1); color:#e07a6c; border-left-color:#c0392b; }
.sidebar.collapsed span.text { display:none; }
.sidebar.collapsed .brand-logo { height:60px; width:40px; }
.topbar { height:64px; background:#fff; display:flex; justify-content:space-between; align-items:center; padding:0 24px; position:fixed; top:0; left:260px; right:0; z-index:9; box-shadow:0 2px 8px rgba(15,27,45,.06); border-bottom:1px solid #e8e4da; transition:left .3s, background .3s; }
.topbar.collapsed { left:70px; }
.dark-mode-toggle { background:#0f1b2d; border:none; color:#e0c468; border-radius:5px; padding:6px 12px; cursor:pointer; font-size:1rem; }
.dark-mode-toggle:hover { background:#1a2940; }
.content { margin-left:260px; margin-top:64px; padding:28px 32px; transition:.3s; }
.content.expanded { margin-left:70px; }
.page-heading { font-family:'Playfair Display',serif; color:#0f1b2d; font-weight:700; margin:0 0 18px; }
.panel-card { background:#fff; border-radius:8px; padding:20px; box-shadow:0 2px 10px rgba(15,27,45,.06); }
.al-search { display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:20px; }
.al-search input, .al-search select { padding:10px 14px; border:1px solid #d9d4c8; border-radius:8px; font-size:.9rem; background:#fff; color:#3a3a3a; }
.al-search input { flex:1; min-width:220px; }
.al-search input:focus, .al-search select:focus { outline:none; border-color:#c9a227; box-shadow:0 0 0 3px rgba(201,162,39,.15); }
.btn-gold { background:#c9a227; color:#0f1b2d; border:none; border-radius:8px; padding:10px 20px; font-weight:600; cursor:pointer; font-size:.88rem; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
.btn-gold:hover { background:#b8911f; color:#0f1b2d; }
.btn-clear { background:#efece4; color:#333; border-radius:8px; padding:10px 16px; text-decoration:none; font-weight:600; font-size:.88rem; }
.al-table { width:100%; border-collapse:collapse; }
.al-table th { text-align:left; font-size:.78rem; color:#6b7280; padding:10px 8px; border-bottom:2px solid #eee; text-transform:uppercase; letter-spacing:.4px; }
.al-table td { padding:11px 8px; border-bottom:1px solid #f0f0f0; font-size:.9rem; color:#3a3a3a; }
.tag { padding:4px 11px; border-radius:20px; font-size:.76rem; font-weight:600; text-transform:uppercase; letter-spacing:.3px; }
.tag.create { background:#d1e7dd; color:#0f5132; }
.tag.update { background:#fff3cd; color:#8a6d00; }
.tag.delete { background:#f8d7da; color:#842029; }
.src-pill { background:#eef1f6; color:#334155; padding:3px 10px; border-radius:6px; font-size:.8rem; }
.btn-view { border:1px solid #0f1b2d; color:#0f1b2d; padding:5px 12px; border-radius:6px; text-decoration:none; font-size:.82rem; }
.btn-view:hover { background:#0f1b2d; color:#fff; }
.pager { margin-top:16px; display:flex; gap:6px; }
.pager a, .pager .active { padding:6px 12px; border:1px solid #e0dcd0; border-radius:6px; text-decoration:none; color:#0f1b2d; font-size:.85rem; }
.pager .active { background:#c9a227; color:#fff; border-color:#c9a227; }
[data-bs-theme="dark"] body { background:#11161f; }
[data-bs-theme="dark"] .topbar { background:#1a2233; border-bottom:1px solid rgba(255,255,255,.06); }
[data-bs-theme="dark"] .page-heading { color:#e0c468; }
[data-bs-theme="dark"] .panel-card { background:#1a2233; color:#cfd3da; }
[data-bs-theme="dark"] .al-table td { color:#cfd3da; border-bottom:1px solid rgba(255,255,255,.06); }
[data-bs-theme="dark"] .al-search input, [data-bs-theme="dark"] .al-search select { background:#141d2e; border-color:rgba(255,255,255,.12); color:#cfd3da; }
[data-bs-theme="dark"] .btn-clear { background:#242e42; color:#cfd3da; }
[data-bs-theme="dark"] .src-pill { background:#242e42; color:#cfd3da; }
[data-bs-theme="dark"] .btn-view { border-color:#e0c468; color:#e0c468; }
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
    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
        <i class="fa-solid fa-users"></i> <span class="text">Users</span>
    </a>
    <a href="<?= $this->Url->build(['controller' => 'AuditLogs', 'action' => 'index']) ?>" class="active">
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
    <h3 class="page-heading">Audit Logs</h3>

    <div class="panel-card">
        <?php $q = $this->request->getQueryParams(); ?>
        <form method="get" class="al-search">
            <input type="text" name="search" value="<?= h($q['search'] ?? '') ?>" placeholder="Search by user or source...">
            <select name="type">
                <option value="">All Types</option>
                <option value="create" <?= (($q['type'] ?? '') === 'create') ? 'selected' : '' ?>>Create</option>
                <option value="update" <?= (($q['type'] ?? '') === 'update') ? 'selected' : '' ?>>Update</option>
                <option value="delete" <?= (($q['type'] ?? '') === 'delete') ? 'selected' : '' ?>>Delete</option>
            </select>
            <button type="submit" class="btn-gold"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            <?php if (!empty($q['search']) || !empty($q['type'])): ?>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-clear">Clear</a>
            <?php endif; ?>
        </form>

        <table class="al-table">
            <thead>
                <tr>
                    <th>Date / Time</th>
                    <th>Action</th>
                    <th>Source</th>
                    <th>Record ID</th>
                    <th>Performed By</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auditLogs as $log): ?>
                    <?php
                        $type = strtolower((string)$log->type);
                        $meta = json_decode((string)($log->meta ?? '{}'), true) ?: [];
                        $actor = $log->slug ?: ($meta['username'] ?? 'System');
                    ?>
                    <tr>
                        <td><?= $log->created ? $log->created->format('d/m/Y g:i A') : '-' ?></td>
                        <td><span class="tag <?= h($type) ?>"><?= h($type) ?></span></td>
                        <td><span class="src-pill"><?= h($log->source) ?></span></td>
                        <td>#<?= h($log->primary_key) ?></td>
                        <td><?= h($actor) ?></td>
                        <td>
                            <?= $this->Html->link('View', ['action' => 'view', $log->id], ['class' => 'btn-view']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if ($auditLogs->isEmpty()): ?>
                    <tr><td colspan="6" style="text-align:center; padding:30px; color:#9a9486;">No audit logs found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pager">
            <?= $this->Paginator->numbers() ?>
        </div>
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