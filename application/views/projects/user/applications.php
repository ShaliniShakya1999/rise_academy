<!-- Page Header -->
<div class="mb-12">
    <h2 class="text-3xl font-black text-gray-900 tracking-tight">My Applications</h2>
    <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Track the status of your internship applications</p>
</div>

<div class="grid grid-cols-1 gap-6">
    <?php foreach ($applications as $a): ?>
    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-blue-900/5 flex items-center justify-between group hover:border-[#d4af37]/30 transition-all">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-[#d4af37] group-hover:text-white transition-all">
                <i class="fa-solid fa-briefcase text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-black text-[#00204a] mb-1"><?= htmlspecialchars($a->internship_title) ?></h3>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Applied on <?= date('d M, Y', strtotime($a->applied_at)) ?></p>
            </div>
        </div>

        <div class="flex items-center gap-8">
            <div class="text-right">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Current Status</p>
                <?php
                $color = 'amber';
                if ($a->status === 'shortlisted') $color = 'emerald';
                if ($a->status === 'rejected') $color = 'rose';
                ?>
                <span class="px-4 py-2 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-xl text-xs font-black uppercase border border-<?= $color ?>-100">
                    <?= $a->status ?>
                </span>
            </div>
            
            <a href="#" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-400 hover:bg-[#00204a] hover:text-white transition-all shadow-sm">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($applications)): ?>
    <div class="bg-white rounded-[3rem] p-20 border border-dashed border-gray-200 text-center">
        <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center text-gray-300 mx-auto mb-6">
            <i class="fa-solid fa-paper-plane text-4xl"></i>
        </div>
        <h3 class="text-2xl font-black text-gray-400 uppercase tracking-tighter mb-2">No Applications Found</h3>
        <p class="text-gray-400 font-bold text-sm">You haven't applied for any internships yet.</p>
        <a href="<?= base_url('internship') ?>" class="inline-block mt-8 px-8 py-4 bg-[#00204a] text-white rounded-2xl font-black hover:bg-[#d4af37] transition-all">Browse Internships</a>
    </div>
    <?php endif; ?>
</div>




