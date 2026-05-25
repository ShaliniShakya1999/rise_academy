<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// Detect active first URI segment for nav highlighting
$s1 = $this->uri->segment(1);
$is_home = ($s1 === null || $s1 === '' || $s1 === false);
$is_logged_in = $this->session->has_userdata('user_id');
?>
<style>
    /* Site navbar button styles */
    .site-btn {
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
    }
    .site-btn-primary {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        color: white;
        box-shadow: 0 4px 15px rgba(245,158,11,0.3);
    }
    .site-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245,158,11,0.4);
    }
    .site-btn-outline {
        background-color: transparent;
        color: #0F172A;
        border: 1px solid #CBD5E1;
    }
    .site-btn-outline:hover {
        border-color: #f59e0b;
        color: #f59e0b;
        background-color: #F8FAFC;
        transform: translateY(-2px);
    }
    /* Mobile nav overlay */
    #site-mobile-menu {
        display: none;
    }
    #site-mobile-menu.open {
  .nav-link { @apply relative text-gray-800 font-medium transition-colors; }
  .nav-link::after { content:""; @apply absolute left-0 bottom-0 h-[2px] w-0 bg-amber-500 transition-all duration-300; }
  .nav-link:hover::after,
  .nav-link.active::after { @apply w-full; }
</style>

<nav class="sticky top-0 z-50 bg-[#fffdf8] backdrop-blur-sm border-b border-amber-100 shadow-sm">
  <div class="max-w-[1400px] mx-auto px-4 lg:px-6 h-20 flex items-center justify-between">

    <!-- Left: Logo + Brand -->
    <a href="<?= base_url(); ?>" class="flex items-center gap-2 group">
        <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="Internmo"
             class="h-10 w-auto object-contain group-hover:opacity-90 transition">
    </a>

    <!-- Center: Desktop Menu -->
    <div class="hidden lg:flex items-center gap-8">
        <a href="<?= base_url(); ?>" class="nav-link <?= $is_home ? 'active' : '' ?>">Home</a>
        <a href="<?= base_url('resume-builder'); ?>" class="nav-link">Resume Builder</a>
        <a href="<?= base_url('jobs'); ?>" class="nav-link">Jobs</a>
        <a href="<?= base_url('internship'); ?>" class="nav-link">Internship</a>
        <a href="<?= base_url('resume-checker'); ?>" class="nav-link">Resume Checker</a>
        <a href="<?= base_url('project-submission'); ?>" class="nav-link">Project Submission</a>
        <a href="<?= base_url('templates'); ?>" class="nav-link">Templates</a>
    </div>

    <!-- Right: Actions -->
<?php if (isset($is_logged_in) && $is_logged_in): ?>
    <!-- Wishlist (visible after login) -->
    <a href="<?= base_url('wishlist'); ?>" aria-label="Wishlist" class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-amber-100 transition">
        <i class="fas fa-heart"></i>
    </a>
    <!-- Dashboard link -->
    <a href="<?= base_url('dashboard'); ?>" class="text-sm font-medium text-gray-800 hover:text-amber-600 transition">Dashboard</a>
    <!-- Profile dropdown -->
    <div class="relative group">
        <button class="flex items-center gap-2 bg-amber-500 text-white rounded-full py-1 px-3 hover:bg-amber-600 transition">
            <span class="h-8 w-8 rounded-full bg-amber-600 flex items-center justify-center">
    <i class="fas fa-user text-white"></i>
</span>
            <i class="fas fa-chevron-down text-xs"></i>
        </button>
        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 before:content-[''] before:absolute before:-top-2 before:left-0 before:right-0 before:h-2">
            <a href="<?= base_url('dashboard'); ?>" class="flex items-center gap-2 px-4 py-2 text-gray-800 hover:bg-gray-50"><i class="fas fa-file-alt"></i> My Resume</a>
            <a href="<?= base_url('logout'); ?>" class="flex items-center gap-2 px-4 py-2 text-gray-800 hover:bg-red-50 hover:text-red-600"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
<?php else: ?>
    <!-- Login / Register buttons for guests -->
    <a href="<?= base_url('login'); ?>" class="site-btn site-btn-outline py-2 px-5 text-xs">Login</a>
    <a href="<?= base_url('register'); ?>" class="site-btn site-btn-primary py-2 px-5 text-xs">Register</a>
<?php endif; ?>
<!-- Mobile Hamburger -->
<button id="nav-toggle" class="lg:hidden flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:bg-amber-100 transition"><i class="fas fa-bars"></i></button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden lg:hidden bg-[#fffdf8] border-t border-amber-100 pt-4 pb-6">
    <div class="flex flex-col space-y-1 px-4">
        <a href="<?= base_url(); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Home</a>
        <a href="<?= base_url('resume-builder'); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Resume Builder</a>
        <a href="<?= base_url('jobs'); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Jobs</a>
        <a href="<?= base_url('internship'); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Internship</a>
        <a href="<?= base_url('resume-checker'); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Resume Checker</a>
        <a href="<?= base_url('project-submission'); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Project Submission</a>
        <a href="<?= base_url('templates'); ?>" class="block py-2 px-2 rounded hover:bg-amber-100">Templates</a>
        <div class="border-t border-amber-100 mt-3 pt-3 space-y-2">
            <a href="<?= base_url('wishlist'); ?>" class="w-full flex items-center gap-2 py-2 px-2 rounded hover:bg-amber-100"><i class="fas fa-heart"></i> Wishlist</a>
            <a href="<?= base_url('dashboard'); ?>" class="block w-full text-left py-2 px-2 rounded hover:bg-amber-100">Dashboard</a>
            <div class="relative">
                <button id="mobile-profile-toggle" class="flex w-full items-center gap-2 py-2 px-2 rounded hover:bg-amber-100">
                    <span class="h-8 w-8 rounded-full bg-amber-600 flex items-center justify-center text-white">S</span>
                    <span>Profile</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <!-- Mega Menu -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-[600px] bg-white border border-slate-100 shadow-2xl rounded-2xl p-6 grid grid-cols-2 gap-4 z-50"
                     x-cloak>

                    <!-- Col 1 -->
                    <div class="space-y-1">
                        <a href="<?= base_url('courses/full-stack-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-amber-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-laptop-code text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-amber-600 transition-colors">Full Stack Dev</div><div class="text-[10px] text-slate-500 font-medium">Frontend &amp; Backend</div></div>
                        </a>
                        <a href="<?= base_url('courses/app-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-indigo-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-mobile-screen-button text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-indigo-600 transition-colors">App Development</div><div class="text-[10px] text-slate-500 font-medium">iOS &amp; Android Apps</div></div>
                        </a>
                        <a href="<?= base_url('courses/cyber-security'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-shield-halved text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-emerald-600 transition-colors">Cyber Security</div><div class="text-[10px] text-slate-500 font-medium">Hacking &amp; InfoSec</div></div>
                        </a>
                        <a href="<?= base_url('courses/devops'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-sky-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-server text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-sky-600 transition-colors">DevOps</div><div class="text-[10px] text-slate-500 font-medium">Cloud Infrastructure</div></div>
                        </a>
                        <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-purple-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-brain text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-purple-600 transition-colors">Artificial Intelligence</div><div class="text-[10px] text-slate-500 font-medium">ML &amp; Generative AI</div></div>
                        </a>
                    </div>

                    <!-- Col 2 -->
                    <div class="space-y-1">
                        <a href="<?= base_url('courses/java-developer'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-red-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-brands fa-java text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-red-600 transition-colors">Java Developer</div><div class="text-[10px] text-slate-500 font-medium">Enterprise Java APIs</div></div>
                        </a>
                        <a href="<?= base_url('courses/ui-ux'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-pink-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-palette text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-pink-600 transition-colors">UI/UX Design</div><div class="text-[10px] text-slate-500 font-medium">Product &amp; Figma UI</div></div>
                        </a>
                        <a href="<?= base_url('courses/data-science'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-violet-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-chart-line text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-violet-600 transition-colors">Data Science</div><div class="text-[10px] text-slate-500 font-medium">Modeling &amp; Big Data</div></div>
                        </a>
                        <a href="<?= base_url('courses/data-analyst'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-teal-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-magnifying-glass-chart text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-teal-600 transition-colors">Data Analyst</div><div class="text-[10px] text-slate-500 font-medium">Power BI &amp; Dashboards</div></div>
                        </a>
                        <a href="<?= base_url('courses/digital-marketing'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-orange-50/50 transition-colors group">
                            <div class="w-9 h-9 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"><i class="fa-solid fa-bullhorn text-sm"></i></div>
                            <div><div class="font-bold text-xs text-slate-800 group-hover:text-orange-600 transition-colors">Digital Marketing</div><div class="text-[10px] text-slate-500 font-medium">Growth &amp; Search Ads</div></div>
                        </a>
                    </div>

                </div>
            </div>

            <a href="<?= base_url(); ?>#internships" class="text-sm font-medium text-slate-600 hover:text-amber-500 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-amber-500 after:transition-all hover:after:w-full">Internships</a>
            <a href="<?= base_url(); ?>#placements" class="text-sm font-medium text-slate-600 hover:text-amber-500 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-amber-500 after:transition-all hover:after:w-full">Placements</a>
            <a href="<?= base_url(); ?>#ai-tools" class="text-sm font-medium text-slate-600 hover:text-amber-500 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-amber-500 after:transition-all hover:after:w-full">AI Tools</a>
            <a href="<?= base_url(); ?>#projects" class="text-sm font-medium text-slate-600 hover:text-amber-500 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-amber-500 after:transition-all hover:after:w-full">Projects</a>
            <a href="<?= base_url('contact'); ?>" class="text-sm font-medium text-slate-600 hover:text-amber-500 transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-amber-500 after:transition-all hover:after:w-full">Contact Us</a>
        </div>

        <!-- Right: Auth Buttons + Mobile Hamburger -->
        <div class="flex items-center gap-3">
            <a href="<?= base_url('login'); ?>" class="site-btn site-btn-outline py-2 px-5 text-xs hidden sm:inline-flex">Login</a>
            <a href="<?= base_url('register'); ?>" class="site-btn site-btn-primary py-2 px-5 text-xs group hidden sm:inline-flex">Apply Now <i class="fa-solid fa-arrow-right text-[10px] opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all"></i></a>

            <!-- Mobile hamburger -->
            <button id="site-nav-toggle" class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg border border-slate-200 text-slate-700" aria-label="Open menu">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>
        </div>

    </div>

    <!-- Mobile Menu -->
    <div id="site-mobile-menu" class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-2">
        <a href="<?= base_url(); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Home</a>
        <div class="py-1 px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mt-2">Courses</div>
        <a href="<?= base_url('courses/full-stack-development'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Full Stack Dev</a>
        <a href="<?= base_url('courses/app-development'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">App Development</a>
        <a href="<?= base_url('courses/cyber-security'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Cyber Security</a>
        <a href="<?= base_url('courses/devops'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">DevOps</a>
        <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition-colors">Artificial Intelligence</a>
        <a href="<?= base_url('courses/java-developer'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors">Java Developer</a>
        <a href="<?= base_url('courses/ui-ux'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-pink-50 hover:text-pink-600 transition-colors">UI/UX Design</a>
        <a href="<?= base_url('courses/data-science'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-600 transition-colors">Data Science</a>
        <a href="<?= base_url('courses/data-analyst'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-teal-50 hover:text-teal-600 transition-colors">Data Analyst</a>
        <a href="<?= base_url('courses/digital-marketing'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">Digital Marketing</a>
        <div class="border-t border-slate-100 pt-3 mt-2 space-y-2">
            <a href="<?= base_url(); ?>#internships" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Internships</a>
            <a href="<?= base_url(); ?>#placements" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Placements</a>
            <a href="<?= base_url(); ?>#ai-tools" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">AI Tools</a>
            <a href="<?= base_url('contact'); ?>" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Contact Us</a>
        </div>
        <div class="flex gap-2 pt-3 border-t border-slate-100">
            <a href="<?= base_url('login'); ?>" class="flex-1 site-btn site-btn-outline py-2.5 text-xs text-center">Login</a>
            <a href="<?= base_url('register'); ?>" class="flex-1 site-btn site-btn-primary py-2.5 text-xs text-center">Apply Now</a>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('site-nav-toggle').addEventListener('click', function() {
        var menu = document.getElementById('site-mobile-menu');
        menu.classList.toggle('open');
    });
</script>
