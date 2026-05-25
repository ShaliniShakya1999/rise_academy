<!-- Page Header -->
<div class="mb-12">
    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Internship Applications</h2>
    <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Review student applications for posted internships</p>
</div>

<!-- Applications Table -->
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Student Info</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Internship Role</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Applied Date</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php foreach ($applications as $a): ?>
            <tr class="hover:bg-gray-50/50 transition-colors group">
                <td class="px-8 py-6">
                    <p class="font-black text-[#00204a]"><?= htmlspecialchars($a->full_name) ?></p>
                    <p class="text-xs text-gray-400 font-bold"><?= htmlspecialchars($a->email) ?></p>
                </td>
                <td class="px-8 py-6">
                    <span class="px-3 py-1 bg-rise-dark/5 text-[#00204a] rounded-lg text-[10px] font-black uppercase border border-rise-dark/10">
                        <?= htmlspecialchars($a->internship_title) ?>
                    </span>
                </td>
                <td class="px-8 py-6 text-sm font-bold text-gray-400">
                    <?= date('d M, Y', strtotime($a->applied_at)) ?>
                </td>
                <td class="px-8 py-6">
                    <?php
                    $color = 'amber';
                    if ($a->status === 'shortlisted') $color = 'emerald';
                    if ($a->status === 'rejected') $color = 'rose';
                    ?>
                    <span class="px-3 py-1 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-lg text-[10px] font-black uppercase border border-<?= $color ?>-100">
                        <?= $a->status ?>
                    </span>
                </td>
                <td class="px-8 py-6 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="#" class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-sm" title="View Resume">
                            <i class="fa-solid fa-file-invoice"></i>
                        </a>
                        <a href="#" class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white transition-all shadow-sm" title="Shortlist">
                            <i class="fa-solid fa-check"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($applications)): ?>
            <tr>
                <td colspan="5" class="px-8 py-20 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-300">
                            <i class="fa-solid fa-users text-3xl"></i>
                        </div>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">No applications yet</p>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>




