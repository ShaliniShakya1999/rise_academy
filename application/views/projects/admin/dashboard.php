<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-500 uppercase mb-2">Total Submissions</p>
        <p class="text-3xl font-black text-gray-900"><?= $stats['total'] ?></p>
    </div>
    <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 shadow-sm">
        <p class="text-xs font-bold text-blue-600 uppercase mb-2">Total Internships</p>
        <p class="text-3xl font-black text-blue-700"><?= $intern_stats['total_internships'] ?></p>
    </div>
    <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100 shadow-sm">
        <p class="text-xs font-bold text-emerald-600 uppercase mb-2">Total Applications</p>
        <p class="text-3xl font-black text-emerald-700"><?= $intern_stats['total_applications'] ?></p>
    </div>
    <div class="bg-amber-50 p-6 rounded-2xl border border-amber-100 shadow-sm">
        <p class="text-xs font-bold text-amber-600 uppercase mb-2">Recent Project Requests</p>
        <p class="text-3xl font-black text-amber-700"><?= $stats['pending'] ?></p>
    </div>
</div>

<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Project Management</h2>
</div>

<?php if ($this->session->flashdata('project_ok')): ?>
    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl flex items-center gap-3">
        <i class="fa-solid fa-circle-check"></i>
        <?= $this->session->flashdata('project_ok') ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Student / Project</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php foreach ($projects as $p): ?>
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-bold text-gray-900"><?= htmlspecialchars($p->project_title) ?></p>
                    <p class="text-xs text-gray-500"><?= htmlspecialchars($p->full_name) ?> (<?= htmlspecialchars($p->email) ?>)</p>
                </td>
                <td class="px-6 py-4">
                    <?php
                    $color = 'gray';
                    if ($p->status === 'approved') $color = 'emerald';
                    elseif ($p->status === 'rejected') $color = 'rose';
                    elseif ($p->status === 'assigned') $color = 'purple';
                    elseif ($p->status === 'pending') $color = 'amber';
                    elseif ($p->status === 'requested') $color = 'blue';
                    ?>
                    <span class="px-3 py-1 bg-<?= $color ?>-50 text-<?= $color ?>-700 border border-<?= $color ?>-100 rounded-full text-[10px] font-black uppercase tracking-widest">
                        <?= $p->status ?>
                    </span>
                </td>
                <td class="px-6 py-4 text-xs text-gray-400">
                    <?= date('d M, Y', strtotime($p->created_at)) ?>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <form action="<?= site_url('projects/admin/update_status/' . $p->id) ?>" method="post">
                            <select name="status" onchange="this.form.submit()" class="text-xs bg-gray-100 border-none rounded-lg px-3 py-1.5 outline-none focus:ring-2 focus:ring-black font-bold">
                                <option value="requested" <?= $p->status === 'requested' ? 'selected' : '' ?>>Requested</option>
                                <option value="assigned" <?= $p->status === 'assigned' ? 'selected' : '' ?>>Assigned (Working)</option>
                                <option value="pending" <?= $p->status === 'pending' ? 'selected' : '' ?>>Pending Review</option>
                                <option value="approved" <?= $p->status === 'approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="rejected" <?= $p->status === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                        </form>
                        <a href="<?= site_url('projects/admin/delete/' . $p->id) ?>" class="text-gray-300 hover:text-rose-500 transition-colors">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
