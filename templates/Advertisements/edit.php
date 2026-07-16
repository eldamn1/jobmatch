<?php
$this->assign('title', 'Edit Job | JobMatch');
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-heading mb-0">Edit Job Position</h3>
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

        <?php if (!empty($advertisement->poster)): ?>
            <div class="mb-2">
                <img src="<?= $this->Url->build('/' . rtrim((string)$advertisement->poster_dir, "/") . "/" . $advertisement->poster) ?>"
                     alt="Current poster" style="max-height:120px;border-radius:6px;border:1px solid #e0dcd0;">
            </div>
        <?php endif; ?>

        <input type="file" name="poster" id="posterInput" accept="image/*" style="display:none"
               onchange="document.getElementById('posterName').textContent = (this.files && this.files[0]) ? this.files[0].name : 'No file chosen';">

        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-outline-dark"
                    onclick="document.getElementById('posterInput').click();">
                <i class="fa-solid fa-image"></i> Choose Poster
            </button>
            <span id="posterName" class="text-muted">No file chosen</span>
        </div>
        <small class="text-muted">Leave empty to keep the current poster.</small>
    </div>

    <?= $this->Form->button('<i class="fa-solid fa-floppy-disk"></i> Update',
        ['class' => 'btn btn-gold', 'escapeTitle' => false]) ?>
    <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
    <?= $this->Form->end() ?>
</div>