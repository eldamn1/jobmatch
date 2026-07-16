<?php
$this->assign('title', 'Add Job | JobMatch');
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-heading mb-0">Add Job Position</h3>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left"></i> Back',
        ['action' => 'index'], ['class' => 'btn btn-outline-dark', 'escape' => false]) ?>
</div>

<div class="panel-card">
    <?= $this->Form->create($advertisement, ['type' => 'file']) ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Job Title</label>
            <?= $this->Form->text('title', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Job Type</label>
            <?= $this->Form->text('job_type', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>
            <?= $this->Form->text('category', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Location</label>
            <?= $this->Form->text('location', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Salary (RM)</label>
            <?= $this->Form->number('salary', ['class' => 'form-control', 'step' => '0.01']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Deadline</label>
            <?= $this->Form->date('deadlines', ['class' => 'form-control']) ?>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Job Description</label>
        <?= $this->Form->textarea('description', ['class' => 'form-control', 'rows' => 4]) ?>
    </div>
    <div class="mb-3">
        <label class="form-label">Job Requirements</label>
        <?= $this->Form->textarea('requirements', ['class' => 'form-control', 'rows' => 3]) ?>
    </div>
    <div class="mb-3">
        <label class="form-label">Poster (Image)</label>
        <?= $this->Form->file('poster', ['class' => 'form-control', 'accept' => 'image/*']) ?>
        <small class="text-muted">Optional. JPG or PNG recommended.</small>
    </div>

    <?= $this->Form->button('<i class="fa-solid fa-floppy-disk"></i> Save',
        ['class' => 'btn btn-gold', 'escapeTitle' => false]) ?>
    <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
    <?= $this->Form->end() ?>
</div>