<?php
$this->assign('title', 'Manage Applicants | JobMatch');

$statusLabels = [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'];
$statusColors = [0 => 'warning text-dark', 1 => 'success', 2 => 'danger'];

$buildOfferLetter = function ($name, $position, $jobType = '') {
    $today = date('j F Y');
    $name = $name !== '' ? $name : 'Applicant';
    $position = $position !== '' ? $position : 'the position';
    $jobType = $jobType !== '' ? $jobType : 'Full Time';
    $POS = strtoupper($position);
    return "To      : {$name}\n"
        . "From    : Human Resource Department, JobMatch\n"
        . "Date    : {$today}\n"
        . "Subject : Offer of Employment — {$POS}\n\n"
        . "Dear {$name},\n\n"
        . "I am pleased to inform you, on behalf of JobMatch, that following the review of your "
        . "application, qualifications, and interview, you have been selected for the position of "
        . "{$position}. We were impressed with your background and are confident that you will be a "
        . "valuable addition to our team.\n\n"
        . "This letter serves as a formal offer of employment. The key details of your appointment "
        . "are as follows:\n\n"
        . "   1. Position          : {$position}\n"
        . "   2. Employment Type    : {$jobType}\n"
        . "   3. Reporting To       : Head of Department\n"
        . "   4. Commencement Date  : To be mutually agreed upon\n"
        . "   5. Remuneration       : As stated in your employment contract\n\n"
        . "We would be grateful if you could confirm your acceptance of this offer in writing at your "
        . "earliest convenience.\n\n"
        . "We look forward to welcoming you to JobMatch.\n\n"
        . "Yours sincerely,\n\n\n"
        . "_______________________\n"
        . "Human Resource Department\n"
        . "JobMatch\n"
        . "Connect · Match · Succeed";
};
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-heading mb-0">Manage Applicants — <?= h($advertisement->title) ?></h3>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left"></i> Back',
        ['action' => 'index'], ['class' => 'btn btn-outline-dark', 'escape' => false]) ?>
</div>

<div class="count-card">
    <div class="count-number"><?= $applicantCount ?></div>
    <div>
        <h5 class="mb-0">people applied for this position</h5>
        <small class="text-muted">review each applicant below</small>
    </div>
</div>

<?php if ($applicantCount > 0): ?>
    <div class="row mb-3">
        <div class="col-md-7 mb-2">
            <input type="text" id="apSearch" class="form-control" placeholder="Search applicant name...">
        </div>
        <div class="col-md-5 mb-2">
            <select id="apStatusFilter" class="form-select">
                <option value="">All Decisions</option>
                <option value="pending">Pending decision</option>
                <option value="0">Invited to Interview</option>
                <option value="1">Passed Interview</option>
                <option value="2">Not Qualified</option>
                <option value="3">Failed Interview</option>
            </select>
        </div>
    </div>
    <table class="table jm-table">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Applied</th><th>Resume</th>
                <th>Interview Decision</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($advertisement->applications as $i => $application): ?>
                <?php
                    $applicantName = $application->member->name ?? '';
                    $iv = $interviews[$application->id] ?? null;
                    $ivStatus = $iv ? (int)$iv->status : null;
                    $decided      = ($iv !== null);
                    $invited      = ($ivStatus === 0);  
                    $passed       = ($ivStatus === 1);  
                    $notQualified = ($ivStatus === 2);  
                    $failedIv     = ($ivStatus === 3);  

                    $ivDate = ($iv && $iv->interview_date) ? $iv->interview_date->format('d/m/Y') : '';
                    $ivTime = '';
                    if ($iv && $iv->interview_time) {
                        $ivTime = is_object($iv->interview_time) ? $iv->interview_time->format('g:i A') : (string)$iv->interview_time;
                    }

                    $letterValue = !empty($application->offer_letter)
                        ? $application->offer_letter
                        : $buildOfferLetter($applicantName, $advertisement->title, $advertisement->job_type);
                    $rowStatus = $decided ? (string)$ivStatus : 'pending';
                ?>
                <tr class="applicant-row" data-app="<?= $application->id ?>" data-name="<?= h(strtolower($applicantName)) ?>" data-status="<?= $rowStatus ?>">
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?= $this->Html->link(h($applicantName ?: '-'),
                            ['action' => 'applicantProfile', $application->id],
                            ['escape' => false, 'style' => 'color:#0f1b2d;font-weight:600;text-decoration:none;']) ?>
                    </td>
                    <td><?= $application->created ? $application->created->format('d/m/Y') : '-' ?></td>
                    <td>
                        <?php if (!empty($application->member->resume)): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-download"></i>',
                                ['action' => 'downloadResume', $application->id],
                                ['class' => 'btn btn-sm btn-gold', 'escape' => false, 'target' => '_blank', 'title' => 'Download']) ?>
                        <?php else: ?>
                            <span class="text-muted">None</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!$decided): ?>
                            <span class="text-muted">Pending decision</span>
                        <?php elseif ($invited): ?>
                            <span class="badge bg-info text-dark">Invited to Interview</span>
                            <?php if ($ivDate): ?>
                                <div class="small text-muted mt-1"><?= h($ivDate) ?> <?= h($ivTime) ?><br><?= h($iv->location) ?></div>
                            <?php endif; ?>
                        <?php elseif ($passed): ?>
                            <span class="badge bg-success">Passed Interview</span>
                        <?php elseif ($notQualified): ?>
                            <span class="badge bg-danger">Not Qualified</span>
                        <?php elseif ($failedIv): ?>
                            <span class="badge bg-danger">Failed Interview</span>
                        <?php endif; ?>
                    </td>
                    <td style="white-space:nowrap;">
                        <?php if (!$decided): ?>
                            <button type="button" class="btn btn-sm btn-success"
                                    onclick="toggleRow('sched<?= $application->id ?>')">
                                <i class="fa-solid fa-check"></i> Pass — Set Interview
                            </button>
                            <?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i> Fail — Not Qualified',
                                ['controller' => 'Interviews', 'action' => 'reject', $application->id],
                                ['class' => 'btn btn-sm btn-danger', 'escape' => false,
                                 'confirm' => 'Reject this applicant as not qualified for interview?']) ?>

                        <?php elseif ($invited): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-file-lines"></i> IV Letter',
                                ['controller' => 'Interviews', 'action' => 'letter', $iv->id],
                                ['class' => 'btn btn-sm btn-outline-dark', 'escape' => false, 'target' => '_blank']) ?>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                    onclick="toggleRow('sched<?= $application->id ?>')" title="Reschedule">
                                <i class="fa-solid fa-calendar-days"></i>
                            </button>
                            <?= $this->Form->postLink('<i class="fa-solid fa-check"></i> Passed',
                                ['controller' => 'Interviews', 'action' => 'result', $iv->id, 1],
                                ['class' => 'btn btn-sm btn-success', 'escape' => false,
                                 'confirm' => 'Mark this candidate as PASSED the interview?']) ?>
                            <?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i> Failed',
                                ['controller' => 'Interviews', 'action' => 'result', $iv->id, 3],
                                ['class' => 'btn btn-sm btn-danger', 'escape' => false,
                                 'confirm' => 'Mark this candidate as FAILED the interview?']) ?>

                        <?php elseif ($passed): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-file-lines"></i> IV Letter',
                                ['controller' => 'Interviews', 'action' => 'letter', $iv->id],
                                ['class' => 'btn btn-sm btn-outline-dark', 'escape' => false, 'target' => '_blank']) ?>
                            <button type="button" class="btn btn-sm btn-gold"
                                    onclick="toggleRow('offer<?= $application->id ?>')">
                                <i class="fa-solid fa-envelope-open-text"></i> Offer Letter
                            </button>

                        <?php elseif ($notQualified): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-file-lines"></i> Rejection Letter',
                                ['controller' => 'Interviews', 'action' => 'letter', $iv->id],
                                ['class' => 'btn btn-sm btn-outline-dark', 'escape' => false, 'target' => '_blank']) ?>

                        <?php elseif ($failedIv): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-file-lines"></i> Result Letter',
                                ['controller' => 'Interviews', 'action' => 'letter', $iv->id],
                                ['class' => 'btn btn-sm btn-outline-dark', 'escape' => false, 'target' => '_blank']) ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <?php if (!$decided || $invited): ?>
                    <tr id="sched<?= $application->id ?>" class="applicant-extra" data-app="<?= $application->id ?>" style="display:none;">
                        <td colspan="6" style="background:#eef4fb;">
                            <?= $this->Form->create(null, ['url' => ['controller' => 'Interviews', 'action' => 'schedule', $application->id]]) ?>
                            <label class="form-label mb-2"><strong><i class="fa-solid fa-calendar-days"></i> Interview Details</strong> for <?= h($applicantName) ?></label>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="interview_date" class="form-control"
                                           value="<?= $ivDate ? ($iv->interview_date->format('Y-m-d')) : '' ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">Time</label>
                                    <input type="time" name="interview_time" class="form-control"
                                           value="<?= ($iv && is_object($iv->interview_time)) ? $iv->interview_time->format('H:i') : '' ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Venue</label>
                                    <input type="text" name="location" class="form-control"
                                           placeholder="e.g. Meeting Room A / Google Meet"
                                           value="<?= h($iv->location ?? '') ?>">
                                </div>
                            </div>
                            <?= $this->Form->button('<i class="fa-solid fa-paper-plane"></i> Save & Send Interview Invitation',
                                ['class' => 'btn btn-sm btn-gold', 'escapeTitle' => false]) ?>
                            <?= $this->Form->end() ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php if ($passed): ?>
                    <tr id="offer<?= $application->id ?>" class="applicant-extra" data-app="<?= $application->id ?>" style="display:none;">
                        <td colspan="6" style="background:#faf8f2;">
                            <?= $this->Form->create(null, ['url' => ['action' => 'offerLetter', $application->id]]) ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label mb-0"><strong>Offer Letter</strong> for <?= h($applicantName) ?></label>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                            onclick="resetLetter('letter<?= $application->id ?>')">
                                        <i class="fa-solid fa-rotate-left"></i> Reset to template
                                    </button>
                                    <?php if (!empty($application->offer_letter)): ?>
                                        <?= $this->Html->link('<i class="fa-solid fa-file-arrow-down"></i> Download A4',
                                            ['controller' => 'Applications', 'action' => 'letter', $application->id],
                                            ['class' => 'btn btn-sm btn-outline-dark', 'escape' => false, 'target' => '_blank']) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?= $this->Form->textarea('offer_letter', [
                                'id' => 'letter' . $application->id,
                                'class' => 'form-control mb-2', 'rows' => 16,
                                'value' => $letterValue,
                                'data-template' => $buildOfferLetter($applicantName, $advertisement->title, $advertisement->job_type),
                                'style' => 'font-family:Inter,sans-serif; font-size:0.9rem;',
                            ]) ?>
                            <?= $this->Form->button('<i class="fa-solid fa-paper-plane"></i> Save & Send Offer Letter',
                                ['class' => 'btn btn-sm btn-gold', 'escapeTitle' => false]) ?>
                            <?php if (!empty($application->offer_letter)): ?>
                                <span class="text-success ms-2"><i class="fa-solid fa-circle-check"></i> Offer letter sent</span>
                            <?php endif; ?>
                            <?= $this->Form->end() ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="panel-card">No one has applied for this position yet.</div>
<?php endif; ?>

<script>
(function(){
    var search = document.getElementById('apSearch');
    var filter = document.getElementById('apStatusFilter');
    function applyFilter(){
        var q = (search && search.value ? search.value : '').toLowerCase().trim();
        var st = filter ? filter.value : '';
        document.querySelectorAll('.applicant-row').forEach(function(row){
            var name = row.getAttribute('data-name') || '';
            var rstatus = row.getAttribute('data-status') || '';
            var appId = row.getAttribute('data-app');
            var ok = (!q || name.indexOf(q) !== -1) && (st === '' || rstatus === st);
            row.style.display = ok ? '' : 'none';
            if (!ok) {
                document.querySelectorAll('.applicant-extra[data-app="' + appId + '"]').forEach(function(ex){
                    ex.style.display = 'none';
                });
            }
        });
    }
    if (search) search.addEventListener('input', applyFilter);
    if (filter) filter.addEventListener('change', applyFilter);
})();
</script>

<script>
function toggleRow(id){
    var r = document.getElementById(id);
    if (!r) return;
    r.style.display = (r.style.display === 'none' || r.style.display === '') ? 'table-row' : 'none';
}
function resetLetter(id){
    var t = document.getElementById(id);
    if (t && t.dataset.template) { t.value = t.dataset.template; }
}
</script>