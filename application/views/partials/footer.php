<footer class="bg-slate-950 text-slate-300 <?= (isset($compact_top) && $compact_top) ? 'mt-6' : 'mt-16'; ?>">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid gap-8 md:grid-cols-4">
            <div class="md:col-span-2">
                <a href="<?= base_url(); ?>" class="flex items-center gap-2">
                    <img src="<?= base_url('assets/website/images/rise_logo.png'); ?>" alt="Rise Academy Logo" class="h-10 w-auto">
                </a>
                <p class="mt-4 text-sm text-slate-400 max-w-md">
                    Build a professional, ATS-friendly resume in minutes. Modern templates, live preview, instant PDF download.
                </p>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-3 text-sm uppercase tracking-wide">Explore</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?= base_url('jobs'); ?>" class="hover:text-white">Jobs</a></li>
                    <li><a href="<?= base_url('internship'); ?>" class="hover:text-white">Internship</a></li>
                    <li><a href="<?= base_url('resume-checker'); ?>" class="hover:text-white">Resume Checker</a></li>
                    <li><a href="<?= base_url('project-submission'); ?>" class="hover:text-white">Project Submission</a></li>
                    <li><a href="<?= base_url('templates'); ?>" class="hover:text-white">Templates</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-3 text-sm uppercase tracking-wide">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?= base_url('register'); ?>" class="hover:text-white">Get started</a></li>
                    <li><a href="<?= base_url('about'); ?>" class="hover:text-white">About</a></li>
                    <li><a href="mailto:hello@riseacademy.test" class="hover:text-white">Contact</a></li>
                    <li><a href="<?= base_url('privacy'); ?>" class="hover:text-white">Privacy</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-500">
            <p>© <?= date('Y'); ?> Rise Academy. All rights reserved.</p>
            <p>Made for jobseekers worldwide.</p>
        </div>
    </div>
</footer>
