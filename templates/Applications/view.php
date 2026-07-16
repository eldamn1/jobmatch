<?php
/**
 * @var \App\View\AppView 
 * @var \App\Model\Entity\Application
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Application'), ['action' => 'edit', $application->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Application'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Applications'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Application'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="applications view content">
            <h3><?= h($application->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Member') ?></th>
                    <td><?= $application->hasValue('member') ? $this->Html->link($application->member->name, ['controller' => 'Members', 'action' => 'view', $application->member->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Advertisement') ?></th>
                    <td><?= $application->hasValue('advertisement') ? $this->Html->link($application->advertisement->title, ['controller' => 'Advertisements', 'action' => 'view', $application->advertisement->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($application->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($application->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($application->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($application->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>