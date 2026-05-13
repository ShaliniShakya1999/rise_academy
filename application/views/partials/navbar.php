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
<header x-data="{ open: false, profile: false }" class="sticky top-0 z-50 shadow-lg shadow-blue-950/20">
    <div class="bg-gradient-to-r from-[#050A34] via-[#092676] to-[#050A34] text-white border-b border-white/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-14 sm:h-16 items-center justify-between gap-4">

                <!-- Logo -->
                <a href="<?= base_url(); ?>" class="flex shrink-0 items-center gap-3">
                    <img src="<?= base_url('assets/website/images/rise_logo.png'); ?>" alt="Rise Academy" class="h-10 sm:h-12 w-auto object-contain">
                </a>

                <!-- Desktop main menu -->
                <nav class="hidden lg:flex items-center justify-center flex-1 gap-1 xl:gap-2 text-sm font-medium">
                    <a href="<?= base_url(); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('') ? 'is-active' : ''; ?>">Home</a>
                    <a href="<?= base_url('resume-builder'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('resume-builder') ? 'is-active' : ''; ?>">Resume Builder</a>
                    <a href="<?= base_url('job'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('job') ? 'is-active' : ''; ?>">Jobs</a>
                    <a href="<?= base_url('internship'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('internship') ? 'is-active' : ''; ?>">Internship</a>
                    <a href="<?= base_url('resume-checker'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('resume-checker') ? 'is-active' : ''; ?>">Resume Checker</a>
                    <a href="<?= base_url('projects/login'); ?>" class="ra-nav-dark-link px-3 py-2 rounded-md text-white/90 hover:text-white <?= $nav_active('projects/login') ? 'is-active' : ''; ?>">Project Submission</a>
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
                                <span class="grid place-items-center w-7 h-7 rounded-full bg-blue-500 text-white font-bold text-xs"><?= strtoupper(substr($user_name, 0, 1)); ?></span>
                                <svg class="w-3 h-3 text-white/70 hidden sm:block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                            </button>
                            <div x-show="profile" x-transition x-cloak class="absolute right-0 mt-2 w-52 rounded-xl border border-white/10 bg-[#092676] shadow-xl p-1 text-sm text-white">
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
                        <a href="<?= base_url('register'); ?>" class="inline-flex items-center gap-1 rounded-lg bg-white text-[#050A34] hover:bg-blue-50 text-xs sm:text-sm font-bold px-3 sm:px-4 py-1.5 sm:py-2 shadow transition">
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
                <a href="<?= base_url('job'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('job') ? 'bg-white/15 font-bold' : ''; ?>">Jobs</a>
                <a href="<?= base_url('internship'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('internship') ? 'bg-white/15 font-bold' : ''; ?>">Internship</a>
                <a href="<?= base_url('resume-checker'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('resume-checker') ? 'bg-white/15 font-bold' : ''; ?>">Resume Checker</a>
                <a href="<?= base_url('projects/login'); ?>" class="block px-3 py-2.5 rounded-lg hover:bg-white/10 <?= $nav_active('projects/login') ? 'bg-white/15 font-bold' : ''; ?>">Project Submission</a>
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
