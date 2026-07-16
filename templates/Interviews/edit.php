<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interview $interview
 * @var string[]|\Cake\Collection\CollectionInterface $applications
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $interview->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $interview->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Interviews'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="interviews form content">
            <?= $this->Form->create($interview) ?>
            <fieldset>
                <legend><?= __('Edit Interview') ?></legend>
                <?php
                    echo $this->Form->control('application_id', ['options' => $applications]);
                    echo $this->Form->control('interview_date', ['empty' => true]);
                    echo $this->Form->control('interview_time', ['empty' => true]);
                    echo $this->Form->control('mode');
                    echo $this->Form->control('location');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
