<!-- Alert Note -->
<div class="mb-8 p-6 bg-amber-50 border border-amber-100 rounded-[2rem] flex items-start gap-5 shadow-sm">
    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
        <i class="fa-solid fa-circle-info text-amber-600"></i>
    </div>
    <p class="text-sm text-amber-900 leading-relaxed font-medium">
        <span class="font-black text-amber-600 uppercase tracking-wider text-xs block mb-1">Important Note</span>
        Projects can be deleted from the Submitted Projects section after submission, but only if the project status is marked as "Evaluation in Progress". Once a project has been evaluated, it becomes locked and cannot be deleted.
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
            <div class="h-full min-h-[320px] bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 flex flex-col items-center justify-center p-8 text-center relative overflow-hidden group border-b-4 border-b-[#d4af37]">
                <h3 class="text-xl font-black text-[#00204a] mb-2 tracking-tight">Project Selection</h3>
                <p class="text-[10px] text-gray-400 font-black px-4 leading-relaxed mb-6 uppercase tracking-wide">
                    wait for few hours your project will be assigned soon !
                </p>
                
                <!-- Hourglass Animation -->
                <div class="w-32 h-32 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-amber-50 rounded-full animate-pulse opacity-40 scale-125"></div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3563/3563417.png" alt="Hourglass" class="w-20 h-20 object-contain animate-[bounce_3s_infinite] drop-shadow-xl">
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
            <div class="h-full min-h-[320px] bg-gray-400 rounded-[2rem] relative overflow-hidden group shadow-inner border border-gray-300/50">
                <div class="absolute inset-0 bg-gray-500/40 backdrop-blur-md flex flex-col items-center justify-center p-8 text-center z-10">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4 border border-white/30 shadow-2xl">
                        <i class="fa-solid fa-lock text-2xl text-white"></i>
                    </div>
                    <p class="text-white font-black text-sm leading-snug px-4 drop-shadow-md">
                        Unlock this project by upgrading your internship duration
                    </p>
                </div>
                <div class="p-10 opacity-30 filter blur-sm">
                    <div class="w-12 h-12 bg-white rounded-2xl mb-6"></div>
                    <div class="h-4 bg-white rounded w-3/4 mb-4"></div>
                    <div class="h-4 bg-white rounded w-1/2 mb-4"></div>
                    <div class="h-24 bg-white rounded-2xl w-full"></div>
                </div>
            </div>

        <?php elseif ($p->status === 'assigned'): ?>
            <!-- Assigned Project Card (User is working on this) -->
            <div class="h-full min-h-[320px] bg-white rounded-[2rem] border-2 border-[#d4af37] shadow-2xl shadow-blue-900/10 relative overflow-hidden flex flex-col group">
                <div class="absolute top-0 right-0 bg-[#d4af37] text-white text-[9px] font-black uppercase tracking-widest px-4 py-1.5 rounded-bl-xl z-10">
                    Assigned Active
                </div>
                <!-- Card Content -->
                <div class="p-8 h-full flex flex-col relative z-20">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-[#00204a] rounded-2xl flex items-center justify-center text-[#d4af37] shadow-inner border border-gray-100">
                            <i class="fa-solid fa-code text-2xl"></i>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-black text-[#00204a] mb-3 line-clamp-2 leading-tight tracking-tight"><?= htmlspecialchars($p->project_title) ?></h3>
                    <p class="text-xs text-gray-500 font-medium line-clamp-3 mb-4"><?= htmlspecialchars($p->description) ?></p>
                    
                    <div class="mt-auto bg-blue-50/50 p-4 rounded-xl border border-blue-100 mb-6">
                        <p class="text-xs text-blue-800 font-bold mb-1"><i class="fa-solid fa-circle-info mr-1"></i> Action Required</p>
                        <p class="text-[10px] text-blue-600 font-medium">Complete this project and submit the live URL or GitHub repo in the Final Evaluation section below to unlock your certificate.</p>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-between">
                        <p class="text-[10px] text-gray-400 font-black flex items-center gap-2 uppercase tracking-[0.1em]">
                            <i class="fa-solid fa-user-clock text-[#d4af37] text-sm"></i>
                            Assigned on: <?= date('d M Y', strtotime($p->updated_at)) ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Other status card (completed, etc) -->
            <div class="h-full min-h-[320px] bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 relative overflow-hidden group flex flex-col">
                <div class="p-8 h-full flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-[#00204a] shadow-inner border border-gray-100">
                            <i class="fa-solid fa-briefcase text-xl"></i>
                        </div>
                        <?php
                        $status_class = 'bg-gray-100 text-gray-500 border-gray-200';
                        if ($p->status === 'approved') $status_class = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                        if ($p->status === 'rejected') $status_class = 'bg-rose-50 text-rose-600 border-rose-100';
                        if ($p->status === 'pending') $status_class = 'bg-amber-50 text-amber-600 border-amber-100';
                        ?>
                        <span class="px-5 py-2 <?= $status_class ?> rounded-full text-[10px] font-black uppercase tracking-widest border">
                            <?= $p->status ?>
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-black text-[#00204a] mb-4 line-clamp-2 leading-tight tracking-tight"><?= htmlspecialchars($p->project_title) ?></h3>
                    <p class="text-sm text-gray-400 font-medium line-clamp-3 mb-8"><?= htmlspecialchars($p->description) ?></p>
                    
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <p class="text-[10px] text-gray-300 font-black flex items-center gap-2 uppercase tracking-[0.1em]">
                            <i class="fa-regular fa-calendar text-[#d4af37] text-sm"></i>
                            <?= date('d M Y', strtotime($p->created_at)) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Start New Project Card (Always show) -->
    <button onclick="document.getElementById('projectModal').classList.remove('hidden')" 
            class="h-full min-h-[320px] bg-gray-50 border-4 border-dashed border-gray-100 rounded-[2rem] flex flex-col items-center justify-center gap-4 hover:border-[#d4af37]/30 hover:bg-white hover:shadow-2xl transition-all duration-500 group p-8">
        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:bg-[#d4af37] group-hover:text-white transition-all duration-500 shadow-xl shadow-blue-900/5">
            <i class="fa-solid fa-plus text-2xl group-hover:rotate-90 transition-transform duration-500"></i>
        </div>
        <span class="font-black text-gray-400 group-hover:text-[#00204a] uppercase tracking-[0.2em] text-[10px]">Start New Project</span>
    </button>
</div>

<!-- ========================================== -->
<!-- FINAL PROJECT SUBMISSION & CERTIFICATE -->
<!-- ========================================== -->
<div class="mt-16">
    <div class="mb-10">
        <h2 class="text-3xl font-black text-[#00204a] tracking-tight">Final Evaluation</h2>
        <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Submit your project to unlock your certificate</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Submission Form -->
        <div class="bg-white rounded-[3rem] p-10 border border-gray-100 shadow-xl shadow-blue-900/5">
            <h3 class="text-xl font-black text-[#00204a] mb-6">Submit Project URL</h3>
            
            <?php if (!$internship_project): ?>
                <form action="<?= site_url('projects/user/submit_certificate_project') ?>" method="post" class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 ml-2">Live URL or GitHub Repository</label>
                        <div class="relative group">
                            <i class="fa-solid fa-link absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                            <input type="url" name="project_link" required placeholder="https://github.com/your-username/repo" 
                                   class="w-full pl-14 pr-6 py-5 bg-gray-50 border border-gray-100 rounded-2xl text-gray-700 font-bold outline-none focus:ring-4 focus:ring-[#d4af37]/10 focus:border-[#d4af37] transition-all">
                        </div>
                    </div>
                    <button type="submit" class="w-full py-5 bg-[#00204a] hover:bg-[#d4af37] text-white font-black rounded-2xl transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                        Submit for Evaluation
                    </button>
                </form>
            <?php else: ?>
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <?php if ($internship_project->status === 'approved'): ?>
                            <i class="fa-solid fa-check text-2xl text-emerald-500"></i>
                        <?php elseif ($internship_project->status === 'rejected'): ?>
                            <i class="fa-solid fa-xmark text-2xl text-rose-500"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-clock text-2xl text-amber-500 animate-pulse"></i>
                        <?php endif; ?>
                    </div>
                    <h4 class="font-black text-lg text-[#00204a] mb-2">Project Submitted</h4>
                    <p class="text-sm font-bold text-gray-500 mb-4 truncate"><a href="<?= htmlspecialchars($internship_project->project_link) ?>" target="_blank" class="text-blue-500 hover:underline"><?= htmlspecialchars($internship_project->project_link) ?></a></p>
                    
                    <?php if ($internship_project->status === 'approved'): ?>
                        <span class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 font-black text-xs uppercase tracking-widest rounded-xl">Approved</span>
                        <p class="mt-4 text-xs font-bold text-gray-400">Your certificate is now unlocked!</p>
                    <?php elseif ($internship_project->status === 'rejected'): ?>
                        <span class="inline-block px-4 py-2 bg-rose-100 text-rose-700 font-black text-xs uppercase tracking-widest rounded-xl">Rejected</span>
                        <form action="<?= site_url('projects/user/submit_certificate_project') ?>" method="post" class="mt-6">
                            <input type="url" name="project_link" required placeholder="Submit a new link..." class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl mb-3 text-sm font-bold outline-none focus:border-[#d4af37]">
                            <button type="submit" class="w-full py-3 bg-[#00204a] text-white font-black rounded-xl text-sm hover:bg-[#d4af37]">Resubmit Project</button>
                        </form>
                    <?php else: ?>
                        <span class="inline-block px-4 py-2 bg-amber-100 text-amber-700 font-black text-xs uppercase tracking-widest rounded-xl">Under Review</span>
                        <p class="mt-4 text-xs font-bold text-gray-400">Please wait for admin approval to unlock your certificate.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Certificate Display -->
        <div class="relative rounded-[3rem] bg-gray-100 overflow-hidden shadow-inner border border-gray-200 flex items-center justify-center p-8">
            <?php 
                $is_unlocked = ($internship_project && $internship_project->status === 'approved');
            ?>
            
            <?php if (!$is_unlocked): ?>
                <!-- Lock Overlay -->
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center bg-[#00204a]/40 backdrop-blur-sm">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mb-4 border border-white/30 shadow-2xl">
                        <i class="fa-solid fa-lock text-4xl text-white"></i>
                    </div>
                    <p class="text-white font-black text-xl tracking-wide drop-shadow-md">Certificate Locked</p>
                    <p class="text-white/80 font-bold text-sm mt-2 max-w-xs text-center">Submit your project and wait for approval to unlock.</p>
                </div>
            <?php endif; ?>

            <!-- The Certificate Itself -->
            <div class="bg-white p-8 w-full max-w-lg shadow-2xl relative <?= !$is_unlocked ? 'filter blur-[6px] opacity-60 pointer-events-none' : '' ?>" style="border: 10px solid #00204a; border-radius: 4px;">
                <div class="absolute top-0 left-0 w-16 h-16 border-t-4 border-l-4 border-[#d4af37] m-2"></div>
                <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-[#d4af37] m-2"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-[#d4af37] m-2"></div>
                <div class="absolute bottom-0 right-0 w-16 h-16 border-b-4 border-r-4 border-[#d4af37] m-2"></div>
                
                <div class="text-center py-6">
                    <h1 class="text-3xl font-serif text-[#00204a] font-bold uppercase tracking-widest mb-1">Certificate</h1>
                    <p class="text-xs uppercase tracking-[0.3em] text-[#d4af37] font-bold mb-8">Of Completion</p>
                    
                    <p class="text-xs text-gray-500 font-medium italic mb-2">This is proudly presented to</p>
                    <h2 class="text-2xl font-black text-gray-900 mb-6 font-serif border-b pb-2 inline-block px-10"><?= htmlspecialchars($user_data->full_name) ?></h2>
                    
                    <p class="text-xs text-gray-500 font-medium leading-relaxed max-w-[280px] mx-auto mb-6">
                        For successfully completing the internship program and project in<br>
                        <strong class="text-[#00204a] mt-1 block text-sm"><?= htmlspecialchars($user_data->applied_for) ?></strong>
                    </p>
                    
                    <div class="flex justify-between items-end mt-12 px-6">
                        <div class="text-center">
                            <div class="border-b border-gray-400 w-24 mb-1"></div>
                            <p class="text-[9px] font-bold text-gray-500 uppercase">Date</p>
                            <p class="text-[10px] font-black text-gray-800"><?= $is_unlocked ? date('d M, Y', strtotime($internship_project->updated_at)) : '---' ?></p>
                        </div>
                        
                        <div class="w-16 h-16 rounded-full border-2 border-[#d4af37] flex items-center justify-center relative">
                            <i class="fa-solid fa-award text-2xl text-[#00204a]"></i>
                            <div class="absolute -bottom-2 bg-white px-1">
                                <i class="fa-solid fa-star text-[8px] text-[#d4af37]"></i>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="border-b border-gray-400 w-24 mb-1"></div>
                            <p class="text-[9px] font-bold text-gray-500 uppercase">Director</p>
                            <p class="text-[10px] font-black text-gray-800">Internmo</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if ($is_unlocked): ?>
                <!-- Download Button Overlay when unlocked -->
                <button class="absolute top-6 right-6 w-12 h-12 bg-[#00204a] hover:bg-[#d4af37] text-white rounded-full flex items-center justify-center shadow-xl hover:-translate-y-1 transition-all z-30" title="Download Certificate">
                    <i class="fa-solid fa-download"></i>
                </button>
            <?php endif; ?>
        </div>
    </div>
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
                        <input type="text" readonly value="<?= htmlspecialchars($user_data->applied_for) ?>" 
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
                        <option value="Aatmanirbhar Nari  -  Home Business Enablement Portal">Aatmanirbhar Nari  -  Home Business Enablement Portal</option>
                        <option value="Farmer-to-Consumer Agri Marketplace">Farmer-to-Consumer Agri Marketplace</option>
                        <option value="GreenNest  -  Online Nursery & Gardening Services Platform">GreenNest  -  Online Nursery & Gardening Services Platform</option>
                        <option value="HomeFeast  -  Homemade Tiffin & Food Service Platform">HomeFeast  -  Homemade Tiffin & Food Service Platform</option>
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




