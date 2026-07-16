<?php
$this->assign('title', 'Application | JobMatch');

$statusLabels = [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'];
$statusColors = [0 => 'warning text-dark', 1 => 'success', 2 => 'danger'];
$ivLabels = [0 => 'Interview Scheduled', 1 => 'Passed', 2 => 'Not Qualified', 3 => 'Failed Interview'];
$ivColors = [0 => 'info text-dark', 1 => 'success', 2 => 'danger', 3 => 'danger'];
?>
<h3 class="page-heading">Job Application</h3>

<?php if ($selectedJob): ?>
    <div class="panel-card accent">
        <h5 class="mb-1" style="font-family:'Playfair Display',serif;color:#0f1b2d;">
            <i class="fa-solid fa-briefcase"></i> Applying for: <?= h($selectedJob->title) ?>
        </h5>
        <div class="text-muted mb-3">
            <?= h($selectedJob->job_type) ?> &middot; <?= h($selectedJob->category) ?> &middot; <?= h($selectedJob->location) ?>
        </div>

        <?= $this->Form->create(null, ['type' => 'file']) ?>
        <?= $this->Form->hidden('advertisement_id', ['value' => $selectedJob->id]) ?>

        <p class="text-muted" style="font-size:0.85rem;">
            <i class="fa-solid fa-circle-info"></i> The details below are taken from your profile.
            To change them, update your <?= $this->Html->link('profile', ['controller' => 'Members', 'action' => 'myProfile']) ?>.
        </p>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" value="<?= h($member->name ?? '') ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" value="<?= h($member->phone_number ?? '') ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" value="<?= h($member->location ?? '') ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Preferred Job Position</label>
                <input type="text" class="form-control" value="<?= h($member->preferred_job_position ?? '') ?>" readonly>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Certificate / Skills</label>
                <input type="text" class="form-control" value="<?= h($member->certificate_skill ?? '') ?>" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Resume</label>
            <?php if (!empty($member->resume)): ?>
                <div class="mb-2">
                    <span class="badge bg-success"><i class="fa-solid fa-check"></i> Resume on file</span>
                    <small class="text-muted ms-1"><?= h($member->resume) ?></small>
                </div>
                <small class="text-muted">Upload a new file only if you want to replace it.</small>
                <?= $this->Form->file('resume', ['class' => 'form-control mt-1', 'accept' => '.pdf,.doc,.docx,.png,.jpg,.jpeg']) ?>
            <?php else: ?>
                <?= $this->Form->file('resume', ['class' => 'form-control', 'accept' => '.pdf,.doc,.docx,.png,.jpg,.jpeg', 'required' => true]) ?>
                <small class="text-muted">Required. Accepted: PDF, DOC, DOCX, PNG, JPG (max 5 MB).</small>
            <?php endif; ?>
        </div>

        <?= $this->Form->button('<i class="fa-solid fa-paper-plane"></i> Confirm & Submit Application',
            ['class' => 'btn btn-gold', 'escapeTitle' => false]) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Users', 'action' => 'dashboard'],
            ['class' => 'btn btn-outline-secondary']) ?>
        <?= $this->Form->end() ?>
    </div>
<?php else: ?>
    <div class="panel-card">
        <i class="fa-solid fa-circle-info text-muted btn btn-gold"></i>
        To apply for a job, go to the Dashboard or a job listing and click <strong>Apply</strong>.
    </div>
<?php endif; ?>

<h4 class="page-heading" style="font-size:1.35rem;">My Applications</h4>
<?php $count = (is_countable($myApplications) ? count($myApplications) : iterator_count($myApplications)); ?>
<?php if ($count > 0): ?>
    <div class="row mb-3">
        <div class="col-md-8 mb-2">
            <input type="text" id="appSearch" class="form-control" placeholder="Search by job position...">
        </div>
        <div class="col-md-4 mb-2">
            <select id="appStatusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="0">Pending</option>
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
            </select>
        </div>
    </div>
    <table class="table jm-table">
        <thead>
            <tr><th>#</th><th>Position</th><th>Applied Date</th><th>Interview</th><th>Status</th><th>Offer Letter</th></tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($myApplications as $app): ?>
                <?php $st = (int)$app->status; if (!empty($app->offer_letter)) { $st = 1; } ?>
                <tr class="app-row" data-title="<?= h(strtolower($app->advertisement->title ?? '')) ?>" data-status="<?= $st ?>">
                    <td><?= $no++ ?></td>
                    <td><?= h($app->advertisement->title ?? '-') ?></td>
                    <td><?= $app->created ? $app->created->format('d/m/Y') : '-' ?></td>
                    <td>
                        <?php
                            $iv = $interviews[$app->id] ?? null;
                            $ivSt = $iv ? (int)$iv->status : null;
                        ?>
                        <?php if ($iv): ?>
                            <span class="badge bg-<?= $ivColors[$ivSt] ?? 'secondary' ?>"><?= $ivLabels[$ivSt] ?? '-' ?></span>
                            <?php if ($iv->interview_date): ?>
                                <div class="small text-muted mt-1">
                                    <?= h($iv->interview_date->format('d/m/Y')) ?>
                                    <?= ($iv->interview_time && is_object($iv->interview_time)) ? h($iv->interview_time->format('g:i A')) : '' ?>
                                    <br><?= h($iv->location) ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($iv->letter)): ?>
                                <?= $this->Html->link('<i class="fa-solid fa-file-lines"></i> Invitation',
                                    ['controller' => 'Interviews', 'action' => 'letter', $iv->id],
                                    ['class' => 'btn btn-sm btn-outline-dark mt-1', 'escape' => false, 'target' => '_blank']) ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-<?= $statusColors[$st] ?? 'secondary' ?>">
                            <?= $statusLabels[$st] ?? 'Unknown' ?>
                        </span>
                    </td>
                    <td>
                        <?php if (!empty($app->offer_letter)): ?>
                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="toggleRow('myoffer<?= $app->id ?>')">
                                <i class="fa-solid fa-envelope-open-text"></i> View
                            </button>
                            <?= $this->Html->link('<i class="fa-solid fa-file-arrow-down"></i> A4',
                                ['controller' => 'Applications', 'action' => 'letter', $app->id],
                                ['class' => 'btn btn-sm btn-gold', 'escape' => false, 'target' => '_blank']) ?>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if (!empty($app->offer_letter)): ?>
                    <tr id="myoffer<?= $app->id ?>" style="display:none;">
                        <td colspan="6" style="background:#faf8f2;">
                            <strong><i class="fa-solid fa-envelope-open-text"></i> Offer Letter — <?= h($app->advertisement->title ?? '') ?></strong>
                            <div style="white-space:pre-wrap; margin-top:8px; color:#3a3a3a;"><?= h($app->offer_letter) ?></div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="panel-card">You haven't applied for any position yet.</div>
<?php endif; ?>

<script>
function toggleRow(id){
    var r = document.getElementById(id);
    if (!r) return;
    r.style.display = (r.style.display === 'none' || r.style.display === '') ? 'table-row' : 'none';
}
</script>

<script>
(function(){
    var search = document.getElementById('appSearch');
    var filter = document.getElementById('appStatusFilter');
    function applyFilter(){
        var q = (search && search.value ? search.value : '').toLowerCase().trim();
        var st = filter ? filter.value : '';
        document.querySelectorAll('.app-row').forEach(function(row){
            var title = row.getAttribute('data-title') || '';
            var rstatus = row.getAttribute('data-status') || '';
            var okText = !q || title.indexOf(q) !== -1;
            var okStatus = (st === '') || (rstatus === st);
            row.style.display = (okText && okStatus) ? '' : 'none';
        });
    }
    if (search) search.addEventListener('input', applyFilter);
    if (filter) filter.addEventListener('change', applyFilter);
})();
</script>