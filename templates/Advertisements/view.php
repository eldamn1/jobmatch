<?php
/**
 * @var \App\View\AppView 
 * @var \App\Model\Entity\Advertisement 
 * @var int 
 */
$this->assign('title', 'View Position | JobMatch');

$statusLabels = [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'];
$statusColors = [0 => 'warning text-dark', 1 => 'success', 2 => 'danger'];
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-heading mb-0"><?= h($advertisement->title) ?></h3>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left"></i> Back',
        ['action' => 'index'], ['class' => 'btn btn-outline-dark', 'escape' => false]) ?>
</div>

<div class="panel-card accent">
    <div class="row">
        <div class="col-md-4 mb-2"><strong>Job Type:</strong> <?= h($advertisement->job_type) ?></div>
        <div class="col-md-4 mb-2"><strong>Category:</strong> <?= h($advertisement->category) ?></div>
        <div class="col-md-4 mb-2"><strong>Location:</strong> <?= h($advertisement->location) ?></div>
        <div class="col-md-4 mb-2"><strong>Salary:</strong> RM <?= number_format((float)$advertisement->salary, 2) ?></div>
        <div class="col-md-4 mb-2"><strong>Deadline:</strong> <?= h($advertisement->deadlines) ?></div>
    </div>
    <hr>
    <p class="mb-1"><strong>Description:</strong></p>
    <p><?= nl2br(h($advertisement->description)) ?></p>
    <p class="mb-1"><strong>Requirements:</strong></p>
    <p class="mb-0"><?= nl2br(h($advertisement->requirements)) ?></p>
</div>

<div class="count-card">
    <div class="count-number"><?= $applicantCount ?></div>
    <div>
        <h5 class="mb-0">people interested &amp; submitted resume</h5>
        <small class="text-muted">for this position</small>
    </div>
</div>

<h4 class="page-heading" style="font-size:1.35rem;">Applicant List</h4>
<?php if ($applicantCount > 0): ?>
    <table class="table jm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Applied Date</th>
                <th>Resume</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($advertisement->applications as $i => $application): ?>
                <?php $st = (int)$application->status; ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= h($application->member->name ?? '-') ?></td>
                    <td><?= $application->created ? $application->created->format('d/m/Y') : '-' ?></td>
                    <td>
                        <?php if (!empty($application->member->resume)): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-download"></i>',
                                '/' . $application->member->resume_dir . $application->member->resume,
                                ['class' => 'btn btn-sm btn-gold', 'escape' => false, 'target' => '_blank', 'title' => 'Download']) ?>
                        <?php else: ?>
                            <span class="text-muted">None</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-<?= $statusColors[$st] ?? 'secondary' ?>">
                            <?= $statusLabels[$st] ?? 'Unknown' ?>
                        </span>
                    </td>
                    <td>
                        <?= $this->Form->postLink('<i class="fa-solid fa-check"></i>',
                            ['controller' => 'Applications', 'action' => 'changeStatus', $application->id, 1],
                            ['class' => 'btn btn-sm btn-success', 'escape' => false, 'title' => 'Approve']) ?>
                        <?= $this->Form->postLink('<i class="fa-solid fa-clock"></i>',
                            ['controller' => 'Applications', 'action' => 'changeStatus', $application->id, 0],
                            ['class' => 'btn btn-sm btn-warning text-dark', 'escape' => false, 'title' => 'Pending']) ?>
                        <?= $this->Form->postLink('<i class="fa-solid fa-xmark"></i>',
                            ['controller' => 'Applications', 'action' => 'changeStatus', $application->id, 2],
                            ['class' => 'btn btn-sm btn-danger', 'escape' => false, 'title' => 'Reject']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="panel-card">No one has applied for this position yet.</div>
<?php endif; ?>