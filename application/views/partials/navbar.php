<?php
$is_logged_in = (bool) $this->session->userdata('logged_in');
$user_name    = $this->session->userdata('full_name') ?: 'Account';
$is_admin     = (int) $this->session->userdata('role_id') === 1;

$s1 = $this->uri->segment(1);
$is_home = ($s1 === null || $s1 === '' || $s1 === false);
$nav_active = function ($segment) use ($s1, $is_home) {
    if ($segment === '') {
        return $is_home;
    }
    return (string) $s1 === $segment;
};
?>
<header x-data="{ open: false, profile: false }" class="fixed inset-x-0 top-0 z-50 bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 text-white shadow-lg shadow-black/20">
    <div class="bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 text-white border-b border-white/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-14 sm:h-16 items-center justify-between gap-4">

                <!-- Logo -->
                <a href="<?= base_url(); ?>" class="flex shrink-0 items-center gap-2 group">
                    <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="" class="h-11 w-auto object-contain" style="filter: invert(1) hue-rotate(180deg) saturate(2.5) brightness(1.2);">
                    <!-- <span class="font-bold text-xl text-white">Internmo</span> -->
                </a>

                <!-- Desktop main menu -->
                <nav class="hidden lg:flex items-center justify-center flex-1 gap-1 xl:gap-2 text-sm font-medium">
                    <a href="<?= base_url(); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('') ? 'is-active' : ''; ?>">Home</a>
                    
                    <!-- Courses Dropdown Menu -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="px-3 py-2 rounded-md text-white/90 hover:text-white flex items-center gap-1">
                            Courses <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="open ? 'rotate-180 text-white' : ''"></i>
                        </button>
                        <!-- Mega Menu Dropdown -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-[560px] bg-slate-900 border border-white/10 shadow-2xl rounded-2xl p-6 grid grid-cols-2 gap-4 z-50 text-left"
                             x-cloak>
                            
                            <!-- Col 1 -->
                            <div class="space-y-1">
                                <a href="<?= base_url('courses/full-stack-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-brand-500/10 text-brand-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-laptop-code text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-brand-500 transition-colors">Full Stack Dev</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Frontend & Backend</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/app-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-mobile-screen-button text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-indigo-400 transition-colors">App Development</div>
                                        <div class="text-[10px] text-slate-400 font-medium">iOS & Android Apps</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/cyber-security'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-shield-halved text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-emerald-400 transition-colors">Cyber Security</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Hacking & InfoSec</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/devops'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-server text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-sky-400 transition-colors">DevOps</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Cloud Infrastructure</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-brain text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-purple-400 transition-colors">Artificial Intelligence</div>
                                        <div class="text-[10px] text-slate-400 font-medium">ML & Generative AI</div>
                                    </div>
                                </a>
                            </div>

                            <!-- Col 2 -->
                            <div class="space-y-1">
                                <a href="<?= base_url('courses/java-developer'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-red-500/10 text-red-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-brands fa-java text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-red-400 transition-colors">Java Developer</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Enterprise Java APIs</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/ui-ux'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-pink-500/10 text-pink-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-palette text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-pink-400 transition-colors">UI/UX Design</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Product & Figma UI</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/data-science'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-violet-500/10 text-violet-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-chart-line text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-violet-400 transition-colors">Data Science</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Modeling & Big Data</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/data-analyst'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-teal-500/10 text-teal-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-magnifying-glass-chart text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-teal-400 transition-colors">Data Analyst</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Power BI & Dashboards</div>
                                    </div>
                                </a>

                                <a href="<?= base_url('courses/digital-marketing'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                                    <div class="w-9 h-9 rounded-lg bg-orange-500/10 text-orange-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-bullhorn text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-xs text-white group-hover:text-orange-400 transition-colors">Digital Marketing</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Growth & Search Ads</div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    <a href="<?= base_url('resume-builder'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('resume-builder') ? 'is-active' : ''; ?>">Resume Builder</a>
                    <a href="<?= base_url('job'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('job') ? 'is-active' : ''; ?>">Jobs</a>
                    <a href="<?= base_url('internship'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('internship') ? 'is-active' : ''; ?>">Internship</a>
                    <a href="<?= base_url('resume-checker'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('resume-checker') ? 'is-active' : ''; ?>">Resume Checker</a>
                    <a href="<?= base_url('projects/login'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('projects/login') ? 'is-active' : ''; ?>">Project Submission</a>
                    <a href="<?= base_url('contact'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('contact') ? 'is-active' : ''; ?>">Contact Us</a>
                </nav>

                <!-- Right: secondary + auth -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <a href="<?= base_url('templates'); ?>" class="hidden md:inline text-xs sm:text-sm font-medium text-white/70 hover:text-white transition">Templates</a>

                    <?php if ($is_logged_in): ?>
                        <a href="<?= base_url('wishlist'); ?>" title="My wishlist" class="relative inline-flex items-center gap-1.5 rounded-full bg-white/10 hover:bg-white/15 ring-1 ring-white/20 px-2 sm:px-3 py-1.5 text-white/90 hover:text-white transition <?= $nav_active('wishlist') ? 'bg-white/20 text-white' : ''; ?>">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </a>
                        <a href="<?= base_url('dashboard'); ?>" class="hidden sm:inline text-xs sm:text-sm font-semibold text-white/90 hover:text-white transition">Dashboard</a>
                        <div class="relative" @click.outside="profile = false">
                            <button @click="profile = !profile" type="button" class="flex items-center gap-1.5 rounded-full bg-white/10 hover:bg-white/15 ring-1 ring-white/20 px-2 py-1 transition">
                                <span class="grid place-items-center w-7 h-7 rounded-full bg-amber-500 text-white font-bold text-xs"><?= strtoupper(substr($user_name, 0, 1)); ?></span>
                                <svg class="w-3 h-3 text-white/70 hidden sm:block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                            </button>
                            <div x-show="profile" x-transition x-cloak class="absolute right-0 mt-2 w-52 rounded-xl border border-white/10 bg-zinc-900 shadow-xl p-1 text-sm text-white">
                                <a href="<?= base_url('dashboard'); ?>" class="block px-3 py-2 rounded-lg hover:bg-white/10">My Resumes</a>
                                <a href="<?= base_url('wishlist'); ?>" class="block px-3 py-2 rounded-lg hover:bg-white/10">My Wishlist</a>
                                <?php if ($is_admin): ?>
                                    <a href="<?= base_url('admin'); ?>" class="block px-3 py-2 rounded-lg hover:bg-white/10 text-violet-200 font-semibold">Admin</a>
                                <?php endif; ?>
                                <a href="<?= base_url('logout'); ?>" class="block px-3 py-2 rounded-lg hover:bg-rose-500/20 text-rose-300">Sign out</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('login'); ?>" class="hidden sm:inline text-xs sm:text-sm font-semibold text-white/90 hover:text-white transition">Sign in</a>
                        <a href="<?= base_url('register'); ?>" class="inline-flex items-center gap-1 rounded-lg bg-white text-zinc-950 hover:bg-slate-100 text-xs sm:text-sm font-bold px-3 sm:px-4 py-1.5 sm:py-2 shadow transition">
                            Get started
                        </a>
                    <?php endif; ?>

                    <button type="button" @click="open = !open" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white/10 ring-1 ring-white/20 text-white" aria-label="Menu">
                        <svg x-show="!open" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                        <svg x-show="open" x-cloak width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            </div>

            <!-- Mobile + tablet menu -->
            <div x-show="open" x-cloak x-transition class="lg:hidden border-t border-white/10 py-3 space-y-0.5 text-sm font-medium">
                <a href="<?= base_url(); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('') ? 'bg-white/15 font-bold' : ''; ?>">Home</a>
                
                <!-- Courses Collapsible Menu for mobile -->
                <div x-data="{ coursesOpen: false }">
                    <button @click="coursesOpen = !coursesOpen" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg hover:bg-white/10 text-white/95">
                        <span>Courses</span>
                        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="coursesOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="coursesOpen" x-cloak x-transition class="pl-4 space-y-1 bg-white/5 py-1.5 rounded-lg mt-1">
                        <a href="<?= base_url('courses/full-stack-development'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Full Stack Dev</a>
                        <a href="<?= base_url('courses/app-development'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">App Development</a>
                        <a href="<?= base_url('courses/cyber-security'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Cyber Security</a>
                        <a href="<?= base_url('courses/devops'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">DevOps</a>
                        <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Artificial Intelligence</a>
                        <a href="<?= base_url('courses/java-developer'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Java Developer</a>
                        <a href="<?= base_url('courses/ui-ux'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">UI/UX Design</a>
                        <a href="<?= base_url('courses/data-science'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Data Science</a>
                        <a href="<?= base_url('courses/data-analyst'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Data Analyst</a>
                        <a href="<?= base_url('courses/digital-marketing'); ?>" class="block px-3 py-1.5 text-xs text-white/80 hover:text-white">Digital Marketing</a>
                    </div>
                </div>

                <a href="<?= base_url('job'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('job') ? 'bg-white/15 font-bold' : ''; ?>">Jobs</a>
                <a href="<?= base_url('internship'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('internship') ? 'bg-white/15 font-bold' : ''; ?>">Internship</a>
                <a href="<?= base_url('resume-checker'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('resume-checker') ? 'bg-white/15 font-bold' : ''; ?>">Resume Checker</a>
                <a href="<?= base_url('projects/login'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('projects/login') ? 'bg-white/15 font-bold' : ''; ?>">Project Submission</a>
                <a href="<?= base_url('contact'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('contact') ? 'bg-white/15 font-bold' : ''; ?>">Contact Us</a>
                <div class="border-t border-white/10 my-2 pt-2 space-y-0.5">
                    <a href="<?= base_url('templates'); ?>" class="block px-3 py-2 rounded-lg hover:bg-white/10 text-white/80">Templates</a>
                    <?php if ($is_logged_in): ?>
                        <a href="<?= base_url('wishlist'); ?>" class="block px-3 py-2 rounded-lg hover:bg-white/10 text-white/80 <?= $nav_active('wishlist') ? 'bg-white/15 text-white' : ''; ?>">My Wishlist</a>
                    <?php endif; ?>
                </div>
                <?php if (!$is_logged_in): ?>
                    <div class="flex gap-2 pt-2 px-1">
                        <a href="<?= base_url('login'); ?>" class="flex-1 text-center py-2 rounded-lg border border-white/30 text-white">Sign in</a>
                        <a href="<?= base_url('register'); ?>" class="flex-1 text-center py-2 rounded-lg bg-white text-[#2d1b4e] font-bold">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>




