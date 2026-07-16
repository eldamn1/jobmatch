<?php
$this->assign('title', 'Advertisement | JobMatch');
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-heading mb-0">Job Positions</h3>
    <?= $this->Html->link('<i class="fa-solid fa-plus"></i> Add Job',
        ['action' => 'add'], ['class' => 'btn btn-gold', 'escape' => false]) ?>
</div>

<form method="get" class="mb-3">
    <div class="row g-2 align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Search title or location..." value="<?= h($search) ?>">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= h($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>><?= h($cat) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="job_type" class="form-select">
                <option value="">All Job Types</option>
                <?php foreach ($jobTypes as $jt): ?>
                    <option value="<?= h($jt) ?>" <?= $jobType === $jt ? 'selected' : '' ?>><?= h($jt) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-1">
            <button class="btn btn-gold flex-grow-1" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            <?php if ($search !== '' || $category !== '' || $jobType !== ''): ?>
                <?= $this->Html->link('<i class="fa-solid fa-xmark"></i>', ['action' => 'index'],
                    ['class' => 'btn btn-outline-secondary', 'escape' => false, 'title' => 'Clear']) ?>
            <?php endif; ?>
        </div>
    </div>
</form>

<table class="table jm-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Job Type</th>
            <th>Category</th>
            <th>Location</th>
            <th>Salary (RM)</th>
            <th>Applicants</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($advertisements as $advertisement): ?>
            <tr>
                <td><?= h($advertisement->title) ?></td>
                <td><?= h($advertisement->job_type) ?></td>
                <td><?= h($advertisement->category) ?></td>
                <td><?= h($advertisement->location) ?></td>
                <td><?= number_format((float)$advertisement->salary, 2) ?></td>
                <td>
                    <span class="badge rounded-pill status-badge">
                        <?= count($advertisement->applications ?? []) ?> applicants
                    </span>
                </td>
                <td>
                    <?= $this->Html->link('<i class="fa-solid fa-users"></i> Manage',
                        ['action' => 'manage', $advertisement->id],
                        ['class' => 'btn btn-sm btn-dark', 'escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa-solid fa-pen"></i>',
                        ['action' => 'edit', $advertisement->id],
                        ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false, 'title' => 'Edit']) ?>
                    <?= $this->Form->postLink('<i class="fa-solid fa-trash"></i>',
                        ['action' => 'delete', $advertisement->id],
                        ['confirm' => 'Delete this position?', 'class' => 'btn btn-sm btn-outline-danger', 'escape' => false, 'title' => 'Delete']) ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if (count($advertisements) === 0): ?>
            <tr><td colspan="7" class="text-center text-muted py-4">No job positions found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="mt-3"><?= $this->Paginator->numbers() ?></div>