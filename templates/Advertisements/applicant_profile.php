<?php
$this->assign('title', 'Applicant Profile | JobMatch');
$member = $application->member;
$user = $member->user ?? null;
$statusLabels = [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'];
$statusColors = [0 => 'warning text-dark', 1 => 'success', 2 => 'danger'];
$st = (int)$application->status;
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-heading mb-0">Applicant Profile</h3>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left"></i> Back to Applicants',
        ['action' => 'manage', $application->advertisement_id],
        ['class' => 'btn btn-outline-dark', 'escape' => false]) ?>
</div>

<div class="panel-card accent">
    <div class="d-flex align-items-center gap-3 mb-4">
        <?php if (!empty($user->avatar)): ?>
            <img src="<?= $this->Url->image('avatars/' . $user->avatar) ?>" alt="avatar"
                 style="height:90px;width:90px;border-radius:50%;object-fit:cover;border:3px solid #c9a227;">
        <?php else: ?>
            <div style="height:90px;width:90px;border-radius:50%;background:#0f1b2d;color:#e0c468;display:inline-flex;align-items:center;justify-content:center;font-size:2rem;">
                <i class="fa-solid fa-user"></i>
            </div>
        <?php endif; ?>
        <div>
            <h4 style="margin:0;font-family:'Playfair Display',serif;color:#0f1b2d;"><?= h($member->name ?? '-') ?></h4>
            <div class="text-muted"><?= h($user->email ?? '') ?></div>
            <span class="badge bg-<?= $statusColors[$st] ?? 'secondary' ?> mt-1">
                Applied for: <?= h($application->advertisement->title ?? '-') ?> — <?= $statusLabels[$st] ?? '' ?>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label text-muted">Phone Number</label>
            <div><?= h($member->phone_number ?: '-') ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label text-muted">Location</label>
            <div><?= h($member->location ?: '-') ?></div>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label text-muted">Address</label>
            <div><?= h($member->address ?: '-') ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label text-muted">Preferred Job Position</label>
            <div><?= h($member->preferred_job_position ?: '-') ?></div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label text-muted">Certificate / Skills</label>
            <?php
                $skills = preg_split('/\r\n|\r|\n/', (string)$member->certificate_skill);
                $skills = array_filter(array_map('trim', $skills), fn($v) => $v !== '');
            ?>
            <?php if (!empty($skills)): ?>
                <ul style="margin:0; padding-left:18px;">
                    <?php foreach ($skills as $skill): ?>
                        <li><?= h($skill) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div>-</div>
            <?php endif; ?>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label text-muted">Applied Date</label>
            <div><?= $application->created ? $application->created->format('d/m/Y g:i A') : '-' ?></div>
        </div>
    </div>

    <hr>
    <div class="d-flex gap-2 flex-wrap">
        <?php if (!empty($member->resume)): ?>
            <?= $this->Html->link('<i class="fa-solid fa-file-arrow-down"></i> Download Resume',
                ['action' => 'downloadResume', $application->id],
                ['class' => 'btn btn-gold', 'escape' => false, 'target' => '_blank']) ?>
        <?php else: ?>
            <span class="text-muted">No resume uploaded.</span>
        <?php endif; ?>

        <?= $this->Form->postLink('<i class="fa-solid fa-check"></i> Approve',
            ['action' => 'changeStatus', $application->id, 1],
            ['class' => 'btn btn-success', 'escape' => false]) ?>
        <?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i> Reject',
            ['action' => 'changeStatus', $application->id, 2],
            ['class' => 'btn btn-danger', 'escape' => false]) ?>
    </div>
</div>