<!-- Alert Note -->
<div class="mb-8 p-6 bg-amber-50 border border-amber-100 rounded-[2rem] flex items-start gap-5 shadow-sm">
    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
        <i class="fa-solid fa-circle-info text-amber-600"></i>
    </div>
    <p class="text-sm text-amber-900 leading-relaxed font-medium">
        <span class="font-black text-amber-600 uppercase tracking-wider text-xs block mb-1">Important Note</span>
        Projects can be deleted from the Submitted Projects section after submission, but only if the project status is marked as “Evaluation in Progress”. Once a project has been evaluated, it becomes locked and cannot be deleted.
    </p>
</div>

<!-- Projects Header -->
<div class="flex items-center justify-between mb-10">
    <div>
        <h2 class="text-3xl font-black text-[#00204a] tracking-tight">Projects</h2>
        <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">List of Enrolled Projects for Internship</p>
    </div>
    <button onclick="document.getElementById('projectModal').classList.remove('hidden')" 
            class="bg-[#00204a] text-white px-8 py-4 rounded-2xl font-black flex items-center gap-3 hover:bg-[#d4af37] transition-all shadow-xl shadow-blue-900/10 active:scale-95 group">
        <i class="fa-solid fa-plus text-xs group-hover:rotate-90 transition-transform"></i>
        Start new Project
    </button>
</div>

<!-- Project Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    <!-- Existing Projects & Selection Status -->
    <?php foreach ($projects as $p): ?>
        <?php if ($p->status === 'requested'): ?>
            <!-- Project Selection Timer Card -->
            <div class="aspect-square bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-blue-900/5 flex flex-col items-center justify-center p-10 text-center relative overflow-hidden group border-b-4 border-b-[#d4af37]">
                <h3 class="text-2xl font-black text-[#00204a] mb-2 tracking-tight">Project Selection</h3>
                <p class="text-[11px] text-gray-400 font-black px-6 leading-relaxed mb-8 uppercase tracking-wide">
                    wait for few hours your project will be assigned soon !
                </p>
                
                <!-- Hourglass Animation -->
                <div class="w-40 h-40 mb-8 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-amber-50 rounded-full animate-pulse opacity-40 scale-125"></div>
                    <!-- Using a high-quality SVG or Image for the hourglass as requested -->
                    <img src="https://cdn-icons-png.flaticon.com/512/3563/3563417.png" alt="Hourglass" class="w-24 h-24 object-contain animate-[bounce_3s_infinite] drop-shadow-xl">
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Time Left</p>
                    <div class="text-2xl font-black text-[#00204a] tracking-widest flex items-center gap-1" id="timer-<?= $p->id ?>">
                        01:59:07
                    </div>
                </div>

                <script>
                    (function() {
                        const createdAt = new Date("<?= $p->created_at ?>").getTime();
                        const targetTime = createdAt + (2 * 60 * 60 * 1000); // 2 hours
                        const timerId = "timer-<?= $p->id ?>";
                        
                        function updateTimer() {
                            const now = new Date().getTime();
                            const distance = targetTime - now;
                            
                            if (distance < 0) {
                                document.getElementById(timerId).innerHTML = "Processing...";
                                return;
                            }
                            
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            document.getElementById(timerId).innerHTML = 
                                (hours < 10 ? "0" + hours : hours) + ":" + 
                                (minutes < 10 ? "0" + minutes : minutes) + ":" + 
                                (seconds < 10 ? "0" + seconds : seconds);
                        }
                        
                        setInterval(updateTimer, 1000);
                        updateTimer();
                    })();
                </script>
            </div>

            <!-- Locked Project Card (Shown next to requested) -->
            <div class="aspect-square bg-gray-400 rounded-[2.5rem] relative overflow-hidden group shadow-inner border border-gray-300/50">
                <div class="absolute inset-0 bg-gray-500/40 backdrop-blur-md flex flex-col items-center justify-center p-10 text-center z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6 border border-white/30 shadow-2xl">
                        <i class="fa-solid fa-lock text-3xl text-white"></i>
                    </div>
                    <p class="text-white font-black text-lg leading-snug px-4 drop-shadow-md">
                        Unlock this project by upgrading your internship duration
                    </p>
                </div>
                <!-- Blurred background content -->
                <div class="p-10 opacity-30 filter blur-sm">
                    <div class="w-12 h-12 bg-white rounded-2xl mb-6"></div>
                    <div class="h-4 bg-white rounded w-3/4 mb-4"></div>
                    <div class="h-4 bg-white rounded w-1/2 mb-4"></div>
                    <div class="h-24 bg-white rounded-2xl w-full"></div>
                </div>
            </div>

        <?php else: ?>
            <!-- Normal Project Card -->
            <div class="aspect-square bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-blue-900/5 relative overflow-hidden group hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-500 flex flex-col">
                <!-- Background Overlay / Status -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#00204a]/95 to-[#00204a] opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center p-10 text-center z-20 translate-y-full group-hover:translate-y-0">
                    <?php if ($p->status !== 'pending'): ?>
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6 border border-white/20">
                            <i class="fa-solid fa-lock text-2xl text-[#d4af37]"></i>
                        </div>
                        <p class="text-white font-black text-lg">
                            Project <?= ucfirst($p->status) ?>
                        </p>
                        <p class="text-white/60 text-xs mt-2 font-medium">This project is locked and cannot be edited.</p>
                    <?php else: ?>
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6 border border-white/20 animate-pulse">
                            <i class="fa-solid fa-clock-rotate-left text-2xl text-amber-400"></i>
                        </div>
                        <p class="text-white font-black text-lg">
                            Evaluation in Progress
                        </p>
                        <div class="flex gap-4 mt-8">
                            <a href="<?= site_url('projects/user/delete/' . $p->id) ?>" onclick="return confirm('Are you sure?')" class="px-8 py-3 bg-rose-500 hover:bg-rose-600 text-white rounded-xl text-xs font-black transition-all shadow-lg shadow-rose-900/20 active:scale-95">Delete Project</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Card Content -->
                <div class="p-10 h-full flex flex-col">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-[#00204a] shadow-inner border border-gray-100">
                            <i class="fa-solid fa-briefcase text-2xl"></i>
                        </div>
                        <?php
                        $status_class = 'bg-gray-100 text-gray-500 border-gray-200';
                        if ($p->status === 'approved') $status_class = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                        if ($p->status === 'rejected') $status_class = 'bg-rose-50 text-rose-600 border-rose-100';
                        if ($p->status === 'pending') $status_class = 'bg-amber-50 text-amber-600 border-amber-100';
                        ?>
                        <span class="px-5 py-2 <?= $status_class ?> rounded-full text-[10px] font-black uppercase tracking-widest border">
                            <?= ($p->status === 'pending') ? 'In Review' : $p->status ?>
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-black text-[#00204a] mb-4 line-clamp-2 leading-tight tracking-tight"><?= htmlspecialchars($p->project_title) ?></h3>
                    <p class="text-sm text-gray-400 font-medium line-clamp-3 mb-8"><?= htmlspecialchars($p->description) ?></p>
                    
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <p class="text-[10px] text-gray-300 font-black flex items-center gap-2 uppercase tracking-[0.1em]">
                            <i class="fa-regular fa-calendar text-[#d4af37] text-sm"></i>
                            <?= date('d M Y', strtotime($p->created_at)) ?>
                        </p>
                        <i class="fa-solid fa-arrow-right-long text-gray-200"></i>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Start New Project Card (Always show) -->
    <button onclick="document.getElementById('projectModal').classList.remove('hidden')" 
            class="aspect-square bg-gray-50 border-4 border-dashed border-gray-100 rounded-[2.5rem] flex flex-col items-center justify-center gap-6 hover:border-[#d4af37]/30 hover:bg-white hover:shadow-2xl transition-all duration-500 group">
        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center group-hover:scale-110 group-hover:bg-[#d4af37] group-hover:text-white transition-all duration-500 shadow-xl shadow-blue-900/5">
            <i class="fa-solid fa-plus text-3xl group-hover:rotate-90 transition-transform duration-500"></i>
        </div>
        <span class="font-black text-gray-400 group-hover:text-[#00204a] uppercase tracking-[0.2em] text-[10px]">Start New Project</span>
    </button>
</div>

<!-- New Project Selection Modal -->
<div id="projectModal" class="hidden fixed inset-0 bg-[#00204a]/70 backdrop-blur-md z-[100] flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-500">
        <!-- Modal Header -->
        <div class="p-12 flex items-center justify-between border-b border-gray-50 bg-gray-50/30">
            <div>
                <h3 class="text-4xl font-black text-[#00204a] tracking-tighter mb-1">New Project Selection</h3>
                <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Select a project to start your evaluation</p>
            </div>
            <button onclick="document.getElementById('projectModal').classList.add('hidden')" class="w-14 h-14 flex items-center justify-center rounded-2xl hover:bg-white hover:shadow-xl text-gray-300 hover:text-rose-500 transition-all border border-transparent hover:border-rose-100">
                <i class="fa-solid fa-xmark text-3xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="<?= site_url('projects/user/submit') ?>" method="post" class="p-12 space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Your Domain</label>
                    <div class="relative group">
                        <i class="fa-solid fa-user-tag absolute left-6 top-6 text-gray-300 group-focus-within:text-[#00204a] transition-colors"></i>
                        <input type="text" readonly value="Frontend Development Intern" 
                               class="w-full pl-14 pr-6 py-6 bg-gray-50 border border-gray-100 rounded-2xl text-gray-500 font-black outline-none shadow-inner text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Sub Domain</label>
                    <div class="relative group">
                        <i class="fa-solid fa-layer-group absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                        <select name="sub_domain" class="w-full pl-14 pr-6 py-6 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-700 text-sm shadow-sm appearance-none">
                            <option value="">---Select sub domain---</option>
                            <option value="Automotive & Transportation">Automotive & Transportation</option>
                            <option value="Digital Marketplace">Digital Marketplace</option>
                            <option value="E-commerce">E-commerce</option>
                            <option value="Edtech">Edtech</option>
                            <option value="Fintech">Fintech</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Select Project</label>
                <div class="relative group">
                    <i class="fa-solid fa-folder-open absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                    <select name="project_title" class="w-full pl-14 pr-6 py-6 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-700 text-sm shadow-sm appearance-none">
                        <option value="">---Select Project---</option>
                        <option value="Aatmanirbhar Nari – Home Business Enablement Portal">Aatmanirbhar Nari – Home Business Enablement Portal</option>
                        <option value="Farmer-to-Consumer Agri Marketplace">Farmer-to-Consumer Agri Marketplace</option>
                        <option value="GreenNest – Online Nursery & Gardening Services Platform">GreenNest – Online Nursery & Gardening Services Platform</option>
                        <option value="HomeFeast – Homemade Tiffin & Food Service Platform">HomeFeast – Homemade Tiffin & Food Service Platform</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Description</label>
                <div class="relative group">
                    <i class="fa-solid fa-pen-to-square absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                    <textarea name="description" rows="3" class="w-full pl-14 pr-6 py-6 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-700 text-sm shadow-sm" placeholder="Briefly describe your approach..."></textarea>
                </div>
            </div>

            <button type="submit" class="w-full py-7 bg-[#00204a] hover:bg-[#d4af37] text-white font-black text-xl rounded-3xl transition-all shadow-2xl shadow-blue-900/20 active:scale-[0.98] flex items-center justify-center gap-4 group">
                Add Project
                <i class="fa-solid fa-chevron-right text-sm group-hover:translate-x-2 transition-transform"></i>
            </button>
        </form>
    </div>
</div>
