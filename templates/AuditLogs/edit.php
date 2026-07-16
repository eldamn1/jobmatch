<?php
/**
 * @var \App\View\AppView 
 * @var \App\Model\Entity\AuditLog 
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $auditLog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $auditLog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Audit Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="auditLogs form content">
            <?= $this->Form->create($auditLog) ?>
            <fieldset>
                <legend><?= __('Edit Audit Log') ?></legend>
                <?php
                    echo $this->Form->control('transaction');
                    echo $this->Form->control('type');
                    echo $this->Form->control('primary_key');
                    echo $this->Form->control('source');
                    echo $this->Form->control('parent_source');
                    echo $this->Form->control('original');
                    echo $this->Form->control('changed');
                    echo $this->Form->control('meta');
                    echo $this->Form->control('status');
                    echo $this->Form->control('slug');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
