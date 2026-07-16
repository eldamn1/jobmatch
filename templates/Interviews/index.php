<?php
$this->assign('title', 'Interviews | JobMatch');
$ivLabels = [0 => 'Invited to Interview', 1 => 'Passed Interview', 2 => 'Not Qualified', 3 => 'Failed Interview'];
$ivColors = [0 => 'info text-dark', 1 => 'success', 2 => 'danger', 3 => 'danger'];
?>
<h3 class="page-heading">Interview Management</h3>

<?php $count = (is_countable($interviews) ? count($interviews) : iterator_count($interviews)); ?>
<?php if ($count > 0): ?>
    <div class="row mb-3">
        <div class="col-md-7 mb-2">
            <input type="text" id="ivSearch" class="form-control" placeholder="Search by candidate name or position...">
        </div>
        <div class="col-md-5 mb-2">
            <select id="ivStatusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="0">Invited to Interview</option>
                <option value="1">Passed Interview</option>
                <option value="2">Not Qualified</option>
                <option value="3">Failed Interview</option>
            </select>
        </div>
    </div>
    <table class="table jm-table">
        <thead>
            <tr>
                <th>#</th><th>Candidate</th><th>Position</th>
                <th>Date &amp; Time</th><th>Venue</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($interviews as $iv): ?>
                <?php
                    $ivSt = (int)$iv->status;
                    $app = $iv->application;
                    $name = $app->member->name ?? '-';
                    $position = $app->advertisement->title ?? '-';
                    $dateFmt = $iv->interview_date ? $iv->interview_date->format('d/m/Y') : '-';
                    $timeFmt = ($iv->interview_time && is_object($iv->interview_time)) ? $iv->interview_time->format('g:i A') : '';
                ?>
                <tr class="iv-row" data-name="<?= h(strtolower($name . ' ' . $position)) ?>" data-status="<?= $ivSt ?>">
                    <td><?= $no++ ?></td>
                    <td><?= h($name) ?></td>
                    <td><?= h($position) ?></td>
                    <td><?= h($dateFmt) ?> <?= h($timeFmt) ?></td>
                    <td><?= h($iv->location ?: '-') ?></td>
                    <td><span class="badge bg-<?= $ivColors[$ivSt] ?? 'secondary' ?>"><?= $ivLabels[$ivSt] ?? '-' ?></span></td>
                    <td style="white-space:nowrap;">
                        <?php if (!empty($iv->letter)): ?>
                            <?= $this->Html->link('<i class="fa-solid fa-file-lines"></i> Letter',
                                ['action' => 'letter', $iv->id],
                                ['class' => 'btn btn-sm btn-gold', 'escape' => false, 'target' => '_blank']) ?>
                        <?php endif; ?>
                        <?= $this->Html->link('<i class="fa-solid fa-users"></i>',
                            ['controller' => 'Advertisements', 'action' => 'manage', $app->advertisement_id],
                            ['class' => 'btn btn-sm btn-outline-dark', 'escape' => false, 'title' => 'Go to applicants']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="panel-card">
        No interviews scheduled yet. Go to <strong>Advertisement → Manage</strong> a job, then schedule an interview for an applicant.
    </div>
<?php endif; ?>

<script>
(function(){
    var search = document.getElementById('ivSearch');
    var filter = document.getElementById('ivStatusFilter');
    function applyFilter(){
        var q = (search && search.value ? search.value : '').toLowerCase().trim();
        var st = filter ? filter.value : '';
        document.querySelectorAll('.iv-row').forEach(function(row){
            var name = row.getAttribute('data-name') || '';
            var rstatus = row.getAttribute('data-status') || '';
            var okText = !q || name.indexOf(q) !== -1;
            var okStatus = (st === '') || (rstatus === st);
            row.style.display = (okText && okStatus) ? '' : 'none';
        });
    }
    if (search) search.addEventListener('input', applyFilter);
    if (filter) filter.addEventListener('change', applyFilter);
})();
</script>