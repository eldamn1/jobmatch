<?php
$this->assign('title', 'My Profile | JobMatch');
$su = $this->request->getSession()->read('user');
$isAdmin = ((int)($su->role_id ?? 0) === 1);
?>
<h3 class="page-heading">My Profile</h3>

<div class="panel-card">
    <?= $this->Form->create($member, ['type' => 'file']) ?>

    <div class="text-center mb-4">
        <?php if (!empty($profileUser->avatar)): ?>
            <img src="<?= $this->Url->image('avatars/' . $profileUser->avatar) ?>" alt="Profile picture"
                 style="height:120px;width:120px;border-radius:50%;object-fit:cover;border:3px solid #c9a227;">
        <?php else: ?>
            <div style="height:120px;width:120px;border-radius:50%;background:#0f1b2d;color:#e0c468;display:inline-flex;align-items:center;justify-content:center;font-size:2.6rem;">
                <i class="fa-solid fa-user"></i>
            </div>
        <?php endif; ?>
        <div class="mt-3" style="max-width:360px;margin:0 auto;">
            <label class="form-label">Profile Picture</label>
            <?= $this->Form->file('avatar', ['class' => 'form-control', 'accept' => 'image/*']) ?>
            <small class="text-muted">JPG or PNG. Leave empty to keep current.</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Full Name</label>
            <?= $this->Form->text('name', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Phone Number</label>
            <?= $this->Form->text('phone_number', ['class' => 'form-control']) ?>
        </div>

        <?php if ($isAdmin): ?>

           
            <div class="col-md-6 mb-3">
                <label class="form-label">Position / Title</label>
                <?= $this->Form->text('preferred_job_position', ['class' => 'form-control', 'placeholder' => 'e.g. System Administrator']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Department</label>
                <?= $this->Form->text('certificate_skill', ['class' => 'form-control', 'placeholder' => 'e.g. IT Department']) ?>
            </div>

        <?php else: ?>

            <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <?= $this->Form->text('address', ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Location</label>
                <?= $this->Form->text('location', ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Preferred Job Position</label>
                <?= $this->Form->text('preferred_job_position', ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Certificate / Skills</label>
                <?= $this->Form->textarea('certificate_skill', [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => "Enter one skill or certificate per line, e.g.\nMicrosoft Office Certified\nBasic Web Development\nCustomer Service Training",
                ]) ?>
                <small class="text-muted">Tip: write each skill or certificate on a new line.</small>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Resume</label>
                <?php if (!empty($member->resume)): ?>
                    <div class="mb-2">
                        <a href="<?= $this->Url->build('/' . rtrim((string)$member->resume_dir, '/') . '/' . $member->resume) ?>" target="_blank"
                           class="btn btn-sm btn-outline-dark">
                            <i class="fa-solid fa-file-lines"></i> View current resume
                        </a>
                    </div>
                <?php endif; ?>
                <?= $this->Form->file('resume', ['class' => 'form-control']) ?>
                <small class="text-muted">Any file type accepted, max 5 MB. Leave empty to keep current.</small>
            </div>

        <?php endif; ?>
    </div>

    <?= $this->Form->button('<i class="fa-solid fa-floppy-disk"></i> Save Profile',
        ['class' => 'btn btn-gold', 'escapeTitle' => false]) ?>
    <?= $this->Form->end() ?>
</div>