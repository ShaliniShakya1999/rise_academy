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
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 13px;
    }
    .site-btn-primary {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        color: white !important;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    .site-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
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
    .nav-link {
        position: relative;
        color: #475569;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.3s;
    }
    .nav-link:hover,
    .nav-link.active {
        color: #f59e0b;
    }
    .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        height: 2px;
        width: 0;
        background-color: #f59e0b;
        transition: all 0.3s;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
</style>

<nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-[#fffdf8]/90 backdrop-blur-md border-b border-amber-100 shadow-sm">
  <div class="max-w-[1400px] mx-auto px-4 lg:px-6 h-20 flex items-center justify-between">

    <!-- Left: Logo + Brand -->
    <a href="<?= base_url(); ?>" class="flex items-center gap-2 group shrink-0">
        <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="Internmo"
             class="h-10 w-auto object-contain group-hover:opacity-90 transition">
    </a>

    <!-- Center: Desktop Menu -->
    <div class="hidden lg:flex items-center gap-6">
        <a href="<?= base_url(); ?>" class="nav-link <?= $is_home ? 'active' : '' ?>">Home</a>
        
        <!-- Courses Dropdown Menu -->
        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" class="text-sm font-medium text-slate-600 hover:text-[#f59e0b] transition-colors py-2 flex items-center gap-1">
                Courses <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="open ? 'rotate-180 text-[#f59e0b]' : ''"></i>
            </button>
            
            <!-- Mega Menu Dropdown -->
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
                        <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-laptop-code text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-[#f59e0b] transition-colors">Full Stack Dev</div>
                            <div class="text-[10px] text-slate-500 font-medium">Frontend & Backend</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/app-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-indigo-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-mobile-screen-button text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-indigo-600 transition-colors">App Development</div>
                            <div class="text-[10px] text-slate-500 font-medium">iOS & Android Apps</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/cyber-security'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-shield-halved text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-emerald-600 transition-colors">Cyber Security</div>
                            <div class="text-[10px] text-slate-500 font-medium">Hacking & InfoSec</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/devops'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-sky-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-server text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-sky-600 transition-colors">DevOps</div>
                            <div class="text-[10px] text-slate-500 font-medium">Cloud Infrastructure</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-purple-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-brain text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-purple-600 transition-colors">Artificial Intelligence</div>
                            <div class="text-[10px] text-slate-500 font-medium">ML & Generative AI</div>
                        </div>
                    </a>
                </div>

                <!-- Col 2 -->
                <div class="space-y-1">
                    <a href="<?= base_url('courses/java-developer'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-red-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-brands fa-java text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-red-600 transition-colors">Java Developer</div>
                            <div class="text-[10px] text-slate-500 font-medium">Enterprise Java APIs</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/ui-ux'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-pink-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-palette text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-pink-600 transition-colors">UI/UX Design</div>
                            <div class="text-[10px] text-slate-500 font-medium">Product & Figma UI</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/data-science'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-violet-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-chart-line text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-violet-600 transition-colors">Data Science</div>
                            <div class="text-[10px] text-slate-500 font-medium">Modeling & Big Data</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/data-analyst'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-teal-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-magnifying-glass-chart text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-teal-600 transition-colors">Data Analyst</div>
                            <div class="text-[10px] text-slate-500 font-medium">Power BI & Dashboards</div>
                        </div>
                    </a>

                    <a href="<?= base_url('courses/digital-marketing'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-orange-50/50 transition-colors group">
                        <div class="w-9 h-9 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-bullhorn text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800 group-hover:text-orange-600 transition-colors">Digital Marketing</div>
                            <div class="text-[10px] text-slate-500 font-medium">Growth & Search Ads</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        <?php if ($is_home): ?>
            <!-- Menu 1 (Home Page) -->
            <a href="<?= base_url('internship'); ?>" class="nav-link <?= ($s1 === 'internship') ? 'active' : '' ?>">Internships</a>
            <a href="<?= base_url('#placements'); ?>" class="nav-link">Placements</a>
            <a href="<?= base_url('#ai-tools'); ?>" class="nav-link <?= ($s1 === 'resume-checker') ? 'active' : '' ?>">AI Tools</a>
            <a href="<?= base_url('#projects'); ?>" class="nav-link <?= ($s1 === 'project-submission' || $s1 === 'projects') ? 'active' : '' ?>">Projects</a>
            <a href="<?= base_url('contact'); ?>" class="nav-link <?= ($s1 === 'contact') ? 'active' : '' ?>">Contact Us</a>
        <?php else: ?>
            <!-- Menu 2 (Jobs/Resume/Subpages) -->
            <a href="<?= base_url('jobs'); ?>" class="nav-link <?= ($s1 === 'jobs') ? 'active' : '' ?>">Jobs</a>
            <a href="<?= base_url('internship'); ?>" class="nav-link <?= ($s1 === 'internship') ? 'active' : '' ?>">Internship</a>
            
            <!-- Resume Tools Dropdown -->
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button @click="open = !open" class="text-sm font-medium text-slate-600 hover:text-[#f59e0b] transition-colors py-2 flex items-center gap-1">
                    Resume Tools <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="open ? 'rotate-180 text-[#f59e0b]' : ''"></i>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-[260px] bg-white border border-slate-100 shadow-2xl rounded-2xl p-3 z-50 flex flex-col gap-1"
                     x-cloak>
                     <a href="<?= base_url('resume-builder'); ?>" class="flex items-start gap-3 p-2 rounded-xl hover:bg-amber-50/50 group">
                         <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0"><i class="fa-solid fa-file-invoice text-sm"></i></div>
                         <div>
                             <div class="font-bold text-xs text-slate-800 group-hover:text-[#f59e0b] transition-colors">Resume Builder</div>
                             <div class="text-[9px] text-slate-500 font-medium">Create ATS-friendly resumes</div>
                         </div>
                     </a>
                     <a href="<?= base_url('resume-checker'); ?>" class="flex items-start gap-3 p-2 rounded-xl hover:bg-emerald-50/50 group">
                         <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0"><i class="fa-solid fa-circle-check text-sm"></i></div>
                         <div>
                             <div class="font-bold text-xs text-slate-800 group-hover:text-emerald-600 transition-colors">Resume Checker</div>
                             <div class="text-[9px] text-slate-500 font-medium">Get instant AI ATS review</div>
                         </div>
                     </a>
                     <a href="<?= base_url('templates'); ?>" class="flex items-start gap-3 p-2 rounded-xl hover:bg-indigo-50/50 group">
                         <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0"><i class="fa-solid fa-cubes text-sm"></i></div>
                         <div>
                             <div class="font-bold text-xs text-slate-800 group-hover:text-indigo-600 transition-colors">Templates</div>
                             <div class="text-[9px] text-slate-500 font-medium">Explore modern layout styles</div>
                         </div>
                     </a>
                </div>
            </div>

            <a href="<?= base_url('project-submission'); ?>" class="nav-link <?= ($s1 === 'project-submission') ? 'active' : '' ?>">Project Submission</a>
            <a href="<?= base_url('contact'); ?>" class="nav-link <?= ($s1 === 'contact') ? 'active' : '' ?>">Contact Us</a>
        <?php endif; ?>
    </div>

    <!-- Right Side Actions -->
    <div class="flex items-center gap-3 shrink-0">
        <?php if (isset($is_logged_in) && $is_logged_in): ?>
            <!-- Wishlist (visible after login) -->
            <a href="<?= base_url('wishlist'); ?>" aria-label="Wishlist" class="flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition">
                <i class="fas fa-heart text-sm"></i>
            </a>
            <!-- Dashboard link -->
            <a href="<?= base_url('dashboard'); ?>" class="text-xs font-semibold text-slate-700 hover:text-amber-500 transition px-2">Dashboard</a>
            <!-- Profile dropdown -->
            <div class="relative group">
                <button class="flex items-center gap-2 bg-amber-500 text-white rounded-full py-1 pr-3 pl-1 hover:bg-amber-600 transition focus:outline-none">
                    <span class="h-7 w-7 rounded-full bg-amber-600 flex items-center justify-center text-white text-xs font-bold">
                        <i class="fas fa-user text-xs"></i>
                    </span>
                    <i class="fas fa-chevron-down text-[9px]"></i>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 before:content-[''] before:absolute before:-top-2 before:left-0 before:right-0 before:h-2">
                    <a href="<?= base_url('dashboard'); ?>" class="flex items-center gap-2 px-4 py-2.5 text-xs text-slate-700 hover:bg-slate-50 rounded-t-xl"><i class="fas fa-file-alt text-slate-400"></i> My Resume</a>
                    <a href="<?= base_url('logout'); ?>" class="flex items-center gap-2 px-4 py-2.5 text-xs text-red-600 hover:bg-red-50 rounded-b-xl"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Guest buttons -->
            <a href="<?= base_url('login'); ?>" class="site-btn site-btn-outline !hidden sm:!inline-flex">Login</a>
            <a href="<?= base_url('register'); ?>" class="site-btn site-btn-primary group !hidden sm:!inline-flex">
                Apply Now 
                <i class="fa-solid fa-arrow-right text-[10px] opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all"></i>
            </a>
        <?php endif; ?>
        
        <!-- Mobile hamburger toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors" aria-label="Toggle menu">
            <i class="fa-solid fa-bars text-sm"></i>
        </button>
    </div>
  </div>

  <!-- Mobile Menu Panel -->
  <div x-show="mobileMenuOpen" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-4"
       class="lg:hidden bg-[#fffdf8] border-t border-amber-100 px-4 py-4 space-y-2 shadow-inner max-h-[calc(100vh-4.5rem)] overflow-y-auto"
       x-cloak>
      
      <a href="<?= base_url(); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Home</a>
      
      <!-- Courses Collapsible -->
      <div x-data="{ coursesOpen: false }">
          <button @click="coursesOpen = !coursesOpen" class="w-full flex items-center justify-between py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">
              <span>Courses</span>
              <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="coursesOpen ? 'rotate-180' : ''"></i>
          </button>
          <div x-show="coursesOpen" class="pl-4 space-y-1 mt-1" x-cloak>
              <a href="<?= base_url('courses/full-stack-development'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Full Stack Dev</a>
              <a href="<?= base_url('courses/app-development'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">App Development</a>
              <a href="<?= base_url('courses/cyber-security'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Cyber Security</a>
              <a href="<?= base_url('courses/devops'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">DevOps</a>
              <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Artificial Intelligence</a>
              <a href="<?= base_url('courses/java-developer'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Java Developer</a>
              <a href="<?= base_url('courses/ui-ux'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">UI/UX Design</a>
              <a href="<?= base_url('courses/data-science'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Data Science</a>
              <a href="<?= base_url('courses/data-analyst'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Data Analyst</a>
              <a href="<?= base_url('courses/digital-marketing'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Digital Marketing</a>
          </div>
      </div>

      <?php if ($is_home): ?>
          <!-- Menu 1 (Home Page) Mobile -->
          <a href="<?= base_url('internship'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Internships</a>
          <a href="<?= base_url('#placements'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Placements</a>
          <a href="<?= base_url('#ai-tools'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">AI Tools</a>
          <a href="<?= base_url('#projects'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Projects</a>
          <a href="<?= base_url('contact'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Contact Us</a>
      <?php else: ?>
          <!-- Menu 2 (Jobs/Resume/Subpages) Mobile -->
          <!-- Resume Tools Collapsible -->
          <div x-data="{ toolsOpen: false }">
              <button @click="toolsOpen = !toolsOpen" class="w-full flex items-center justify-between py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">
                  <span>Resume Tools</span>
                  <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="toolsOpen ? 'rotate-180' : ''"></i>
              </button>
              <div x-show="toolsOpen" class="pl-4 space-y-1 mt-1" x-cloak>
                  <a href="<?= base_url('resume-builder'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Resume Builder</a>
                  <a href="<?= base_url('resume-checker'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Resume Checker</a>
                  <a href="<?= base_url('templates'); ?>" class="block py-1.5 px-3 rounded text-xs text-slate-600 hover:bg-slate-50">Templates</a>
              </div>
          </div>

          <a href="<?= base_url('jobs'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Jobs</a>
          <a href="<?= base_url('internship'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Internship</a>
          <a href="<?= base_url('project-submission'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Project Submission</a>
          <a href="<?= base_url('contact'); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Contact Us</a>
      <?php endif; ?>

      <!-- Logged-in / Logged-out specific options for mobile -->
      <div class="border-t border-slate-100 pt-3 mt-2">
          <?php if (isset($is_logged_in) && $is_logged_in): ?>
              <a href="<?= base_url('wishlist'); ?>" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors"><i class="fas fa-heart mr-2 text-rose-500"></i> Wishlist</a>
              <a href="<?= base_url('dashboard'); ?>" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors"><i class="fas fa-table-columns mr-2 text-amber-500"></i> Dashboard</a>
              <a href="<?= base_url('logout'); ?>" class="block py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 transition-colors"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
          <?php else: ?>
              <div class="flex gap-2 pt-2">
                  <a href="<?= base_url('login'); ?>" class="flex-1 site-btn site-btn-outline py-2 text-xs text-center">Login</a>
                  <a href="<?= base_url('register'); ?>" class="flex-1 site-btn site-btn-primary py-2 text-xs text-center">Apply Now</a>
              </div>
          <?php endif; ?>
      </div>
  </div>
</nav>
