<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Immersive Course Player</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: #f8fafc; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
</head>
<body class="bg-slate-50 overflow-hidden" x-data="{ showSidebar: true, showAiChat: false }">

    <?php if (empty($videos)): ?>
        <!-- Zero State (No videos assigned yet) -->
        <div class="min-h-screen flex flex-col items-center justify-center p-8 bg-slate-50">
            <div class="max-w-md w-full bg-white rounded-3xl border border-slate-100 shadow-2xl p-10 text-center">
                <div class="w-20 h-20 bg-amber-50 rounded-2xl flex items-center justify-center text-[#d4af37] mx-auto mb-6 border border-amber-100">
                    <i class="fa-solid fa-graduation-cap text-3xl animate-bounce"></i>
                </div>
                <h3 class="text-xl font-black text-[#00204a] mb-2">Modules Under Review</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto leading-relaxed mb-6">
                    Welcome to your Learning Portal! Educational modules and reference guides mapped to your applied domain (<strong><?= htmlspecialchars($user_data->applied_for ?: 'your internship') ?></strong>) will be unlocked and updated here shortly.
                </p>
                <a href="<?= site_url('projects/user') ?>" class="inline-flex items-center gap-2 bg-[#00204a] text-white px-6 py-3 rounded-xl font-black hover:bg-[#d4af37] transition-all shadow-lg active:scale-95 text-xs">
                    <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    <?php else: ?>
        <!-- Setup Prev/Next Links -->
        <?php
        $prev_video = NULL;
        $next_video = NULL;
        $current_index = 0;
        foreach ($videos as $idx => $v) {
            if ($v->id == $selected_video->id) {
                $current_index = $idx;
                if ($idx > 0) $prev_video = $videos[$idx - 1];
                if ($idx < count($videos) - 1) $next_video = $videos[$idx + 1];
                break;
            }
        }
        
        // Progress Calculation
        $progress_percent = count($videos) > 0 ? round((($current_index) / count($videos)) * 100) : 0;
        ?>

        <div class="h-screen flex flex-col">
            <!-- Immersive Header -->
            <header class="h-16 bg-white border-b border-slate-100 px-4 flex items-center justify-between flex-shrink-0 z-30 shadow-sm">
                <!-- Left controls -->
                <div class="flex items-center">
                    <a href="<?= site_url('projects/user') ?>" class="w-9 h-9 rounded-xl hover:bg-slate-50 flex items-center justify-center text-[#00204a] border border-slate-100 transition-colors" title="Back to Dashboard">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                    </a>
                    
                    <div class="h-6 w-px bg-slate-200 mx-4"></div>
                    
                    <button @click="showSidebar = !showSidebar" class="w-9 h-9 rounded-xl hover:bg-slate-50 flex items-center justify-center text-[#00204a] border border-slate-100 transition-colors" title="Toggle Course Outline">
                        <i class="fa-solid fa-bars-staggered text-sm"></i>
                    </button>
                    
                    <span class="ml-4 font-black text-[#00204a] text-xs md:text-sm tracking-tight hidden sm:inline">
                        <?= htmlspecialchars($selected_video->internship_title ?: 'Internship Course') ?>
                    </span>
                </div>

                <!-- Right controls -->
                <div class="flex items-center gap-4">
                    <!-- Discussion link -->
                    <a href="#discuss-section" class="flex items-center gap-2 text-xs font-black text-[#00204a] hover:text-[#d4af37] transition-colors bg-slate-50 border border-slate-100 py-2 px-4 rounded-xl">
                        <i class="fa-regular fa-comments text-base text-[#d4af37]"></i>
                        <span>Discuss (<?= count($comments) ?>)</span>
                    </a>

                    <!-- Navigation Action Buttons -->
                    <div class="flex items-center gap-2">
                        <?php if ($prev_video): ?>
                            <a href="<?= site_url('learning/user/learning/' . $prev_video->id) ?>" class="text-[11px] font-black text-[#00204a] border border-slate-200 hover:bg-slate-50 px-4 py-2.5 rounded-xl transition-all flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-left text-[9px]"></i> Previous
                            </a>
                        <?php else: ?>
                            <button disabled class="text-[11px] font-black text-slate-300 border border-slate-100 px-4 py-2.5 rounded-xl cursor-not-allowed flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-left text-[9px]"></i> Previous
                            </button>
                        <?php endif; ?>

                        <?php if ($next_video): ?>
                            <a href="<?= site_url('learning/user/learning/' . $next_video->id) ?>" class="text-[11px] font-black bg-[#00204a] hover:bg-[#d4af37] text-white px-5 py-2.5 rounded-xl transition-all shadow-md flex items-center gap-1.5">
                                Complete and Continue <i class="fa-solid fa-chevron-right text-[9px]"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('projects/user') ?>" class="text-[11px] font-black bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl transition-all shadow-md flex items-center gap-1.5">
                                Finish Course <i class="fa-solid fa-circle-check text-[11px]"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Main Split Body -->
            <div class="flex-1 flex overflow-hidden relative">
                
                <!-- Course Outline Sidebar -->
                <aside x-show="showSidebar" 
                       x-transition:enter="transition ease-out duration-300 transform"
                       x-transition:enter-start="-translate-x-full"
                       x-transition:enter-end="translate-x-0"
                       x-transition:leave="transition ease-in duration-200 transform"
                       x-transition:leave-start="translate-x-0"
                       x-transition:leave-end="-translate-x-full"
                       class="w-[320px] bg-white border-r border-slate-100 flex flex-col flex-shrink-0 z-20 shadow-xl lg:shadow-none">
                    
                    <!-- Progress Card -->
                    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-black text-[#00204a] tracking-tight">Course Progress</span>
                            <span class="text-[11px] font-bold text-gray-400"><?= $progress_percent ?>% Completed</span>
                        </div>
                        <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
                            <div class="bg-[#d4af37] h-full rounded-full transition-all duration-500" style="width: <?= $progress_percent ?>%;"></div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 font-semibold">Keep going! You're making progress.</p>
                    </div>

                    <!-- Lectures Accordion -->
                    <div class="flex-1 overflow-y-auto scrollbar-thin divide-y divide-slate-50">
                        <!-- Chapter 1 (Active Database Videos) -->
                        <div x-data="{ expanded: true }" class="border-b border-slate-50">
                            <button @click="expanded = !expanded" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                                <div>
                                    <span class="text-[9px] font-black text-[#d4af37] uppercase tracking-widest block">Chapter 1</span>
                                    <span class="text-xs font-bold text-[#00204a] tracking-tight">Core Curriculum</span>
                                </div>
                                <i class="fa-solid text-[10px] text-gray-400" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>

                            <div x-show="expanded" class="bg-slate-50/20 py-2">
                                <?php foreach ($videos as $idx => $v): ?>
                                    <?php $is_active = ($v->id == $selected_video->id); ?>
                                    <a href="<?= site_url('learning/user/learning/' . $v->id) ?>" 
                                       class="flex items-start gap-3 px-6 py-3 hover:bg-slate-50/80 transition-colors border-l-4 <?= $is_active ? 'border-[#d4af37] bg-amber-50/20' : 'border-transparent' ?>">
                                        <div class="w-6 h-6 rounded-lg flex items-center justify-center flex-shrink-0 <?= $is_active ? 'bg-[#d4af37] text-white' : 'bg-slate-100 text-gray-400' ?>">
                                            <?php if ($is_active): ?>
                                                <i class="fa-solid fa-play text-[8px]"></i>
                                            <?php else: ?>
                                                <span class="text-[9px] font-bold"><?= $idx + 1 ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs font-semibold leading-snug <?= $is_active ? 'text-[#00204a]' : 'text-gray-500' ?> truncate">
                                                <?= htmlspecialchars($v->title) ?>
                                            </p>
                                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-wider block mt-0.5">
                                                <i class="fa-regular fa-clock mr-1"></i><?= htmlspecialchars($v->duration) ?>
                                            </span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Mockup Locked Chapters to replicate the screenshot layout -->
                        <div x-data="{ expanded: false }" class="border-b border-slate-50">
                            <button @click="expanded = !expanded" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                                <div>
                                    <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest block">Chapter 2</span>
                                    <span class="text-xs font-bold text-gray-400 tracking-tight">Virtual Lab Setup & Tools</span>
                                </div>
                                <i class="fa-solid fa-lock text-[10px] text-gray-300"></i>
                            </button>
                        </div>

                        <div x-data="{ expanded: false }" class="border-b border-slate-50">
                            <button @click="expanded = !expanded" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                                <div>
                                    <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest block">Chapter 3</span>
                                    <span class="text-xs font-bold text-gray-400 tracking-tight">Assignments & Submissions</span>
                                </div>
                                <i class="fa-solid fa-lock text-[10px] text-gray-300"></i>
                            </button>
                        </div>
                    </div>
                </aside>

                <!-- Video Area and Details Panel -->
                <main class="flex-1 overflow-y-auto scrollbar-thin bg-slate-50 flex flex-col">
                    <!-- Video Wrapper with aspect video -->
                    <div class="w-full bg-black relative aspect-video flex-shrink-0">
                        <?php if (strpos($selected_video->video_url, 'youtube.com') !== false || strpos($selected_video->video_url, 'youtu.be') !== false): ?>
                            <!-- YouTube Player -->
                            <iframe class="absolute inset-0 w-full h-full" 
                                    src="<?= htmlspecialchars($selected_video->video_url) ?>?rel=0&showinfo=0&autoplay=0" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        <?php else: ?>
                            <!-- Local Upload HTML5 Video Player -->
                            <video class="absolute inset-0 w-full h-full object-contain" controls>
                                <source src="<?= base_url(htmlspecialchars($selected_video->video_url)) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                    </div>

                    <!-- Details and Discussion container -->
                    <div class="max-w-4xl w-full mx-auto p-6 md:p-8 space-y-8 flex-1">
                        <!-- Module description details -->
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-blue-900/5 p-6 md:p-8">
                            <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                                <span class="px-3.5 py-1 bg-[#d4af37]/15 text-[#d4af37] border border-[#d4af37]/35 rounded-full text-[10px] font-black uppercase tracking-widest">
                                    <?= htmlspecialchars($selected_video->internship_title ?: 'Core Module') ?>
                                </span>
                                <div class="flex items-center gap-1.5 text-xs text-gray-400 font-bold uppercase tracking-wider">
                                    <i class="fa-regular fa-clock text-[#d4af37]"></i>
                                    <span><?= htmlspecialchars($selected_video->duration) ?></span>
                                </div>
                            </div>
                            
                            <h2 class="text-xl md:text-2xl font-black text-[#00204a] tracking-tight leading-tight mb-4">
                                <?= htmlspecialchars($selected_video->title) ?>
                            </h2>
                            
                            <?php if (!empty($selected_video->description)): ?>
                                <div class="border-t border-slate-50 pt-5 mt-4">
                                    <h4 class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-2">Lesson Description</h4>
                                    <p class="text-xs text-gray-500 leading-relaxed font-medium">
                                        <?= nl2br(htmlspecialchars($selected_video->description)) ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Discussions Panel (Directly matches screenshot 2 styling) -->
                        <div id="discuss-section" class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-blue-900/5 p-6 md:p-8 space-y-6">
                            <div class="border-b border-slate-50 pb-4">
                                <h3 class="text-lg font-black text-[#00204a]">Discuss</h3>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Q&A and student study board</p>
                            </div>

                            <!-- Comment Input Form -->
                            <form action="<?= site_url('learning/user/add_comment') ?>" method="post" class="space-y-4">
                                <input type="hidden" name="video_id" value="<?= $selected_video->id ?>">
                                <textarea name="comment" required placeholder="Add to the discussion or ask a question about this module..." 
                                          class="w-full border border-slate-200 rounded-2xl p-4 text-xs font-medium focus:ring-2 focus:ring-[#00204a]/10 focus:border-[#00204a] transition-all outline-none resize-none h-24"
                                ></textarea>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-[#00204a] hover:bg-[#d4af37] text-white py-2.5 px-6 rounded-xl text-xs font-black shadow-md transition-all active:scale-95">
                                        Comment
                                    </button>
                                </div>
                            </form>

                            <!-- Comments Thread -->
                            <div class="space-y-4 pt-4 divide-y divide-slate-50">
                                <?php if (empty($comments)): ?>
                                    <div class="text-center py-6 text-gray-400">
                                        <i class="fa-regular fa-comments text-2xl mb-2 block"></i>
                                        <p class="text-xs font-bold">No comments yet. Start the conversation!</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($comments as $c): ?>
                                        <div class="pt-4 flex gap-4">
                                            <!-- Rounded initial avatar -->
                                            <div class="w-10 h-10 rounded-full bg-[#00204a]/10 text-[#00204a] font-black text-sm flex items-center justify-center flex-shrink-0">
                                                <?= strtoupper(substr($c->user_name ?: 'S', 0, 1)) ?>
                                            </div>
                                            <!-- Message content -->
                                            <div class="flex-1 space-y-1">
                                                <div class="flex items-baseline justify-between">
                                                    <span class="text-xs font-black text-[#00204a]"><?= htmlspecialchars($c->user_name) ?></span>
                                                    <span class="text-[10px] text-gray-400 font-bold">
                                                        <?= date('d M, Y', strtotime($c->created_at)) ?>
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                    <?= nl2br(htmlspecialchars($c->comment)) ?>
                                                </p>
                                                <!-- Action replies bar -->
                                                <div class="pt-1.5 flex items-center gap-3">
                                                    <button type="button" @click="document.querySelector('textarea').focus()" class="text-[10px] font-black text-gray-400 hover:text-[#d4af37] uppercase tracking-wider flex items-center gap-1.5">
                                                        <i class="fa-solid fa-reply"></i> Reply
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <!-- Floating Ask me anything search pill at the bottom -->
            <div class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-40">
                <button @click="showAiChat = true" class="bg-white border border-slate-200/80 shadow-2xl rounded-full px-6 py-3 flex items-center gap-3 hover:scale-105 active:scale-95 transition-all group">
                    <span class="w-6 h-6 rounded-full bg-gradient-to-r from-[#00204a] to-[#d4af37] flex items-center justify-center text-white text-[10px] font-black shadow-inner">
                        AI
                    </span>
                    <span class="text-xs font-bold text-slate-500 tracking-tight group-hover:text-[#00204a] transition-colors">Ask me anything</span>
                    <i class="fa-solid fa-magnifying-glass text-xs text-slate-400 group-hover:text-[#d4af37] transition-colors ml-2"></i>
                </button>
            </div>

            <!-- Mockup AI Chat Modal Overlay -->
            <div x-show="showAiChat" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                
                <div @click.outside="showAiChat = false" class="bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden flex flex-col h-[500px]">
                    <!-- Header -->
                    <div class="bg-[#00204a] text-white p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#d4af37] flex items-center justify-center text-white">
                                <i class="fa-solid fa-robot text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-sm tracking-tight">Rise Academy AI Agent</h4>
                                <span class="text-[9px] text-emerald-400 font-bold uppercase tracking-widest">Active Assistant</span>
                            </div>
                        </div>
                        <button @click="showAiChat = false" class="w-8 h-8 rounded-lg hover:bg-white/10 flex items-center justify-center text-white transition-colors">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>

                    <!-- Chat stream -->
                    <div class="flex-1 p-6 overflow-y-auto space-y-4 scrollbar-thin">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#00204a]/10 text-[#00204a] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                AI
                            </div>
                            <div class="bg-slate-100 rounded-2xl rounded-tl-none p-4 text-xs font-semibold text-slate-700 leading-relaxed max-w-[85%]">
                                Hello! I'm your AI learning assistant. Ask me anything about this chapter, search the syllabus, or resolve a coding query. What can I do for you today?
                            </div>
                        </div>
                    </div>

                    <!-- Input footer -->
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex gap-2">
                        <input type="text" placeholder="Type your query..." class="flex-1 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs outline-none focus:ring-1 focus:ring-[#00204a]">
                        <button class="bg-[#00204a] text-white rounded-xl w-10 h-10 flex items-center justify-center hover:bg-[#d4af37] transition-all"><i class="fa-solid fa-paper-plane text-xs"></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
