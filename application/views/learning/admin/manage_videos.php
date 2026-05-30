<div class="space-y-8 max-w-6xl mx-auto">
    <!-- Header banner -->
    <div class="bg-gradient-to-r from-[#00204a] to-[#0b3366] rounded-3xl p-8 md:p-10 text-white shadow-2xl relative overflow-hidden">
        <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none transform translate-x-12 translate-y-12">
            <i class="fa-solid fa-video text-[15rem]"></i>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-black tracking-tight mb-2">Manage Course Videos</h1>
            <p class="text-xs text-[#d4af37] uppercase tracking-widest font-black">Admin Panel & Curriculum Builder</p>
            <p class="text-sm text-gray-300 mt-3 max-w-xl leading-relaxed">
                Add, organize, and update dynamic learning modules mapped to your internships. Students will gain instant access to these video lessons in their personal dashboard once approved.
            </p>
        </div>
    </div>

    <!-- Feedback messages -->
    <?php if ($this->session->flashdata('project_ok')): ?>
        <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 text-emerald-800 text-sm font-semibold">
            <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
            <span><?= $this->session->flashdata('project_ok') ?></span>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('project_error')): ?>
        <div class="p-4 bg-rose-50 border border-rose-100 rounded-2xl flex items-center gap-3 text-rose-800 text-sm font-semibold">
            <i class="fa-solid fa-circle-exclamation text-rose-500 text-lg"></i>
            <span><?= $this->session->flashdata('project_error') ?></span>
        </div>
    <?php endif; ?>

    <!-- Internship Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($internships as $i): ?>
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-xl shadow-blue-900/5 flex flex-col justify-between hover:shadow-2xl transition-all duration-300 group">
                <div>
                    <!-- Top row -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-[#d4af37] border border-amber-100 group-hover:bg-[#d4af37] group-hover:text-white transition-colors">
                            <i class="fa-solid fa-film text-xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-blue-50 text-[#00204a] rounded-full text-[10px] font-black uppercase tracking-wider">
                            <?= $i->video_count ?> Videos
                        </span>
                    </div>

                    <!-- Title / Details -->
                    <h3 class="text-lg font-black text-[#00204a] group-hover:text-[#d4af37] transition-colors line-clamp-1 mb-2">
                        <?= htmlspecialchars($i->title) ?>
                    </h3>
                    <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed mb-6 font-medium">
                        <?= htmlspecialchars($i->description ?: 'No curriculum details provided yet.') ?>
                    </p>
                </div>

                <!-- Footer Action -->
                <div class="border-t border-gray-50 pt-4 mt-auto">
                    <a href="<?= site_url('learning/admin/internship_videos/' . $i->id) ?>" 
                       class="w-full flex items-center justify-center gap-2 bg-[#00204a] hover:bg-[#d4af37] text-white py-3 px-4 rounded-xl text-xs font-black transition-all shadow-lg active:scale-95">
                        <i class="fa-solid fa-video-camera text-sm"></i>
                        Manage Videos
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
