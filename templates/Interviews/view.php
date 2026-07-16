<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interview $interview
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Interview'), ['action' => 'edit', $interview->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Interview'), ['action' => 'delete', $interview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $interview->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Interviews'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Interview'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="interviews view content">
            <h3><?= h($interview->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Application') ?></th>
                    <td><?= $interview->hasValue('application') ? $this->Html->link($interview->application->id, ['controller' => 'Applications', 'action' => 'view', $interview->application->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Mode') ?></th>
                    <td><?= h($interview->mode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= h($interview->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($interview->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $interview->status === null ? '' : $this->Number->format($interview->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Interview Date') ?></th>
                    <td><?= h($interview->interview_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Interview Time') ?></th>
                    <td><?= h($interview->interview_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($interview->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($interview->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($interview->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>