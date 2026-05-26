<!-- Page Header -->
<div class="mb-12 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Internship Management</h2>
        <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Review applications and issue formal offer letters</p>
    </div>
</div>

<?php if ($this->session->flashdata('project_ok')): ?>
    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold animate-in">
        <i class="fa-solid fa-circle-check mr-2"></i>
        <?= $this->session->flashdata('project_ok') ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('project_error')): ?>
    <div class="mb-8 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl text-sm font-bold animate-in">
        <i class="fa-solid fa-circle-exclamation mr-2"></i>
        <?= $this->session->flashdata('project_error') ?>
    </div>
<?php endif; ?>

<?php if ($letter = $this->session->flashdata('last_letter')): ?>
    <div class="mb-12 p-8 bg-white border border-blue-100 rounded-[2rem] shadow-xl shadow-blue-900/5">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div>
                <h3 class="text-lg font-black text-[#00204a]">Last Email Sent: <?= $letter['type'] ?></h3>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Preview for student: <?= $letter['name'] ?></p>
            </div>
        </div>
        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 font-serif text-gray-800 leading-relaxed relative overflow-hidden">
            <p class="mb-4"><strong>To:</strong> <?= $letter['to'] ?></p>
            <p class="mb-4"><strong>Subject:</strong> <?= $letter['type'] ?> - Internmo</p>
            
            <?php if ($letter['type'] === 'Offer Letter'): ?>
                <p class="mb-2"><strong>UNID:</strong> <span class="text-blue-600 font-bold"><?= $letter['unid'] ?></span></p>
                <p class="mb-4">Dear <?= $letter['name'] ?>,</p>
                <p class="mb-4">We are pleased to offer you the <strong><?= $letter['role'] ?></strong> internship at Internmo.</p>
                <p class="mb-4 text-sm text-gray-500">The formal offer letter document was rendered and sent via HTML email.</p>
            <?php else: ?>
                <p class="mb-4">Dear <?= $letter['name'] ?>,</p>
                <p class="mb-4 text-blue-600 font-sans font-bold bg-blue-50 p-4 rounded-xl border border-blue-100">
                    Portal Access Credentials:<br>
                    User ID: <?= $letter['to'] ?><br>
                    Temporary Password: <?= $letter['pass'] ?>
                </p>
            <?php endif; ?>
            
            <p>Best Regards,<br><strong>HR Department, Internmo</strong></p>
        </div>
    </div>
<?php endif; ?>

<!-- Users Table -->
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Student</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Applied For</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Registered At</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php foreach ($users as $u): if($u->role_id == 1) continue; ?>
            <tr class="hover:bg-gray-50/50 transition-colors group">
                <td class="px-8 py-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-rise-dark rounded-xl flex items-center justify-center text-white font-black text-xs">
                            <?= strtoupper(substr($u->full_name, 0, 1)) ?>
                        </div>
                        <div>
                            <p class="font-black text-[#00204a] leading-none"><?= htmlspecialchars($u->full_name) ?></p>
                            <p class="text-[10px] text-gray-400 font-bold mt-1"><?= htmlspecialchars($u->email) ?></p>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-6">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase border border-blue-100">
                        <?= htmlspecialchars($u->applied_for ?: 'Not specified') ?>
                    </span>
                </td>
                <td class="px-8 py-6">
                    <?php
                    $color = 'amber';
                    if ($u->status === 'approved') $color = 'emerald';
                    if ($u->status === 'rejected') $color = 'rose';
                    ?>
                    <span class="px-3 py-1 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-lg text-[10px] font-black uppercase border border-<?= $color ?>-100">
                        <?= $u->status ?>
                    </span>
                </td>
                <td class="px-8 py-6 text-sm font-bold text-gray-400">
                    <?= date('d M, Y', strtotime($u->created_at)) ?>
                </td>
                <td class="px-8 py-6 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="<?= site_url('projects/admin/send_offer_letter_action/' . $u->id) ?>" 
                           class="inline-flex items-center gap-1 px-3 py-2 bg-rise-dark text-white rounded-xl text-[9px] font-black uppercase tracking-wider hover:bg-[#003a8c] transition-all border border-blue-900/10"
                           title="Send Selection/Offer Letter">
                            <i class="fa-solid fa-paper-plane"></i>
                            Send Offer
                        </a>
                        <a href="<?= site_url('projects/admin/approve_user/' . $u->id) ?>" 
                           class="inline-flex items-center gap-1 px-3 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-[9px] font-black uppercase tracking-wider hover:bg-emerald-600 hover:text-white transition-all border border-emerald-100"
                           title="Approve & Send Credentials">
                            <i class="fa-solid fa-check"></i>
                            <?= $u->status === 'approved' ? 'Resend Join' : 'Approve & Join' ?>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
            <tr>
                <td colspan="5" class="px-8 py-20 text-center">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">No users found</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>




