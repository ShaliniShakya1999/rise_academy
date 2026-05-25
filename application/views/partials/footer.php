<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- SITE FOOTER — Rich Dark Footer matching Landing Page -->
<footer class="bg-[#0a0f1a] relative">
    <div class="max-w-[1400px] mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">

        <!-- Brand -->
        <div class="lg:col-span-2 space-y-5 pr-10">
            <a href="<?= base_url(); ?>" class="flex items-center gap-2 mb-2 group">
                <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="Internmo Logo" class="h-10 w-auto object-contain group-hover:opacity-90 transition-all">
            </a>
            <p class="text-slate-400 text-[12px] leading-relaxed max-w-xs">We help students build in-demand skills, work on real projects and get placed at top tech companies. Transform your career with us.</p>
            <div class="flex gap-3 pt-2">
                <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-amber-500 hover:border-amber-500 hover:text-white transition-all text-sm"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-red-500 hover:border-red-500 hover:text-white transition-all text-sm"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:border-pink-600 hover:text-white transition-all text-sm"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:border-sky-500 hover:text-white transition-all text-sm"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>

        <!-- Courses -->
        <div>
            <h4 class="font-bold text-white text-[11px] mb-5 uppercase tracking-widest border-l-2 border-amber-500 pl-2">Courses</h4>
            <ul class="space-y-3.5 text-[12px] text-slate-400">
                <li><a href="<?= base_url('courses/full-stack-development'); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Full Stack Dev</a></li>
                <li><a href="<?= base_url('courses/data-science'); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Data Science &amp; AI</a></li>
                <li><a href="<?= base_url('courses/artificial-intelligence'); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Artificial Intelligence</a></li>
                <li><a href="<?= base_url('courses/digital-marketing'); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Digital Marketing</a></li>
            </ul>
        </div>

        <!-- Resources -->
        <div>
            <h4 class="font-bold text-white text-[11px] mb-5 uppercase tracking-widest border-l-2 border-emerald-500 pl-2">Resources</h4>
            <ul class="space-y-3.5 text-[12px] text-slate-400">
                <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Blogs &amp; Articles</a></li>
                <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Placement Report</a></li>
                <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Free AI Tools</a></li>
                <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Interview Guides</a></li>
            </ul>
        </div>

        <!-- Company -->
        <div>
            <h4 class="font-bold text-white text-[11px] mb-5 uppercase tracking-widest border-l-2 border-purple-500 pl-2">Company</h4>
            <ul class="space-y-3.5 text-[12px] text-slate-400">
                <li><a href="<?= base_url('about'); ?>" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> About Us</a></li>
                <li><a href="#" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Careers</a></li>
                <li><a href="<?= base_url('contact'); ?>" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Contact Support</a></li>
                <li><a href="<?= base_url('privacy'); ?>" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Privacy Policy</a></li>
            </ul>
        </div>

    </div>

    <div class="border-t border-slate-800/50 py-6">
        <div class="max-w-[1400px] mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-slate-500">
            <span>&copy; <?= date('Y') ?> Internmo. All rights reserved.</span>
            <span>Learn &bull; Build &bull; Get Hired</span>
        </div>
    </div>
</footer>
