<?php
/**
 * @var \App\View\AppView 
 * @var \App\Model\Entity\Member 
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Members'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="members form content">
            <?= $this->Form->create($member) ?>
            <fieldset>
                <legend><?= __('Add Member') ?></legend>
                <?php
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('name');
                    echo $this->Form->control('address');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('resume');
                    echo $this->Form->control('resume_dir');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>