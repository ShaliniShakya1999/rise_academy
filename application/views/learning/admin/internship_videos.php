<!-- Breadcrumb -->
<div class="mb-8">
    <a href="<?= site_url('learning/admin/manage_videos') ?>" class="inline-flex items-center gap-2 text-sm text-[#00204a] hover:text-[#d4af37] font-bold transition-colors">
        <i class="fa-solid fa-arrow-left-long"></i>
        Back to Manage Videos
    </a>
</div>

<!-- Page Header -->
<div class="mb-12">
    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Manage Videos</h2>
    <p class="text-sm text-gray-400 font-bold uppercase tracking-widest mt-1">Internship: <?= htmlspecialchars($internship->title) ?> (<?= htmlspecialchars($internship->category) ?>)</p>
</div>

<!-- Success/Error Alerts -->
<?php if ($this->session->flashdata('project_ok')): ?>
    <div class="mb-8 p-5 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 text-emerald-800 text-sm font-semibold shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
        <span><?= $this->session->flashdata('project_ok') ?></span>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('project_error')): ?>
    <div class="mb-8 p-5 bg-rose-50 border border-rose-100 rounded-2xl flex items-center gap-4 text-rose-800 text-sm font-semibold shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
        <i class="fa-solid fa-triangle-exclamation text-rose-500 text-lg"></i>
        <span><?= $this->session->flashdata('project_error') ?></span>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Left Column: Video List (2/3 width on desktop) -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
            <div class="p-8 border-b border-gray-50 bg-gray-50/20">
                <h3 class="font-black text-[#00204a] text-lg">Existing Videos (<?= count($videos) ?>)</h3>
            </div>
            
            <div class="divide-y divide-gray-50">
                <?php foreach ($videos as $v): ?>
                    <div class="p-8 hover:bg-gray-50/40 transition-colors flex items-start gap-6 group">
                        <!-- Play Indicator / Video Icon -->
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-[#d4af37] shadow-inner flex-shrink-0 border border-amber-100">
                            <?php if (strpos($v->video_url, 'youtube.com') !== false || strpos($v->video_url, 'youtu.be') !== false): ?>
                                <i class="fa-brands fa-youtube text-2xl"></i>
                            <?php else: ?>
                                <i class="fa-solid fa-file-video text-2xl"></i>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Video Meta -->
                        <div class="flex-grow min-w-0">
                            <div class="flex items-center gap-3">
                                <h4 class="font-black text-[#00204a] group-hover:text-[#d4af37] transition-colors truncate"><?= htmlspecialchars($v->title) ?></h4>
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded text-[9px] font-black uppercase tracking-wider">Order: <?= $v->order_no ?></span>
                            </div>
                            <p class="text-xs text-gray-400 mt-2 font-medium leading-relaxed"><?= htmlspecialchars($v->description ?: 'No description provided.') ?></p>
                            
                            <div class="flex items-center gap-4 mt-4 text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-amber-500"></i> <?= htmlspecialchars($v->duration) ?></span>
                                <span class="text-gray-200">|</span>
                                <span class="truncate max-w-[200px]" title="<?= htmlspecialchars($v->video_url) ?>">
                                    <i class="fa-solid fa-link"></i> <?= htmlspecialchars(basename($v->video_url)) ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Delete Action -->
                        <div class="flex-shrink-0">
                            <a href="<?= site_url('learning/admin/delete_internship_video/' . $internship->id . '/' . $v->id) ?>" 
                               onclick="return confirm('Are you sure you want to delete this video?')"
                               class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <?php if (empty($videos)): ?>
                    <div class="py-24 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center text-gray-300 mx-auto mb-6">
                            <i class="fa-solid fa-video-slash text-3xl"></i>
                        </div>
                        <p class="text-gray-400 font-black uppercase tracking-widest text-xs">No videos added yet</p>
                        <p class="text-gray-300 text-xs mt-2">Use the form to add the first instructional module.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Right Column: Add Video Form (1/3 width on desktop) -->
    <div class="space-y-6">
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden p-8">
            <h3 class="font-black text-[#00204a] text-xl mb-6">Add New Video</h3>
            
            <form action="<?= site_url('learning/admin/add_internship_video/' . $internship->id) ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Video Title</label>
                    <input type="text" name="title" required class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all font-bold text-sm" placeholder="e.g. Introduction to Figma">
                </div>
                
                <!-- Description -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Description</label>
                    <textarea name="description" rows="3" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all font-bold text-sm" placeholder="Brief overview of what students will learn..."></textarea>
                </div>
                
                <!-- Video Source Toggle -->
                <div x-data="{ source: 'youtube' }">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Video Source</label>
                    <select name="video_source" x-model="source" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all font-bold text-sm appearance-none mb-6">
                        <option value="youtube">YouTube Video / Embed Link</option>
                        <option value="upload">Local Video File Upload</option>
                    </select>
                    
                    <!-- YouTube Field -->
                    <div x-show="source === 'youtube'" class="space-y-2 animate-in fade-in duration-300">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">YouTube URL</label>
                        <input type="url" name="youtube_url" ::required="source === 'youtube'" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all font-bold text-sm" placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                    
                    <!-- File Upload Field -->
                    <div x-show="source === 'upload'" class="space-y-2 animate-in fade-in duration-300" style="display: none;">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Select Video File (.mp4, .webm)</label>
                        <div class="relative w-full border border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100/50 transition-colors p-6 text-center cursor-pointer">
                            <input type="file" name="video_file" ::required="source === 'upload'" accept="video/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="updateFileName(this)">
                            <i class="fa-solid fa-cloud-arrow-up text-gray-300 text-2xl mb-2"></i>
                            <p id="file-label" class="text-xs font-bold text-gray-400">Click to choose or drag video</p>
                        </div>
                    </div>
                </div>
                
                <!-- Duration and Order -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Duration</label>
                        <input type="text" name="duration" value="10:00" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all font-bold text-sm" placeholder="e.g. 15:30">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Order No</label>
                        <input type="number" name="order_no" value="<?= count($videos) + 1 ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all font-bold text-sm">
                    </div>
                </div>
                
                <!-- Submit -->
                <button type="submit" class="w-full py-5 bg-[#00204a] hover:bg-[#d4af37] text-white font-black text-base rounded-2xl transition-all shadow-xl shadow-blue-900/10 active:scale-[0.98]">
                    Upload & Add Video
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files.length > 0) {
        label.innerText = input.files[0].name;
        label.classList.remove('text-gray-400');
        label.classList.add('text-emerald-500');
    } else {
        label.innerText = 'Click to choose or drag video';
        label.classList.remove('text-emerald-500');
        label.classList.add('text-gray-400');
    }
}
</script>
