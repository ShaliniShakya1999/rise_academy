<!-- Page Header -->
<div class="mb-12 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Project Submissions</h2>
        <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Review final projects to unlock certificates</p>
    </div>
</div>

<?php if ($this->session->flashdata('project_ok')): ?>
    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold animate-in">
        <i class="fa-solid fa-circle-check mr-2"></i>
        <?= $this->session->flashdata('project_ok') ?>
    </div>
<?php endif; ?>

<!-- Submissions Table -->
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Student</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Course / Domain</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Project Link</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php foreach ($submissions as $sub): ?>
            <tr class="hover:bg-gray-50/50 transition-colors group">
                <td class="px-8 py-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-rise-dark rounded-xl flex items-center justify-center text-white font-black text-xs">
                            <?= strtoupper(substr($sub->full_name, 0, 1)) ?>
                        </div>
                        <div>
                            <p class="font-black text-[#00204a] leading-none"><?= htmlspecialchars($sub->full_name) ?></p>
                            <p class="text-[10px] text-gray-400 font-bold mt-1"><?= htmlspecialchars($sub->email) ?></p>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-6">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase border border-blue-100">
                        <?= htmlspecialchars($sub->applied_for ?: 'N/A') ?>
                    </span>
                </td>
                <td class="px-8 py-6">
                    <a href="<?= htmlspecialchars($sub->project_link) ?>" target="_blank" class="text-sm font-bold text-blue-500 hover:underline max-w-[200px] truncate block" title="<?= htmlspecialchars($sub->project_link) ?>">
                        <i class="fa-solid fa-arrow-up-right-from-square mr-1 text-xs"></i> View Project
                    </a>
                    <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase">Sub: <?= date('d M Y', strtotime($sub->submitted_at)) ?></p>
                </td>
                <td class="px-8 py-6">
                    <?php
                    $color = 'amber';
                    if ($sub->status === 'approved') $color = 'emerald';
                    if ($sub->status === 'rejected') $color = 'rose';
                    ?>
                    <span class="px-3 py-1 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-lg text-[10px] font-black uppercase border border-<?= $color ?>-100">
                        <?= $sub->status ?>
                    </span>
                </td>
                <td class="px-8 py-6 text-right">
                    <?php if ($sub->status === 'pending'): ?>
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?= site_url('projects/admin/approve_certificate_project/' . $sub->id) ?>" 
                               class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white transition-all shadow-sm border border-emerald-100" title="Approve & Unlock Certificate">
                                <i class="fa-solid fa-check"></i>
                            </a>
                            <a href="<?= site_url('projects/admin/reject_certificate_project/' . $sub->id) ?>" 
                               class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm border border-rose-100" title="Reject Submission">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            No Actions
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($submissions)): ?>
            <tr>
                <td colspan="5" class="px-8 py-20 text-center">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">No project submissions yet</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
