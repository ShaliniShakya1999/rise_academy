<div class="relative overflow-hidden bg-gradient-to-b from-brand-50 via-white to-slate-50 min-h-[70vh]">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 left-1/4 w-72 h-72 rounded-full bg-brand-300/30 blur-3xl ra-float-slow"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full bg-brand-200/25 blur-3xl"></div>
    </div>

    <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
        <div class="ra-animate-in text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 text-brand-800 text-xs font-bold px-3 py-1">Portfolio &amp; projects</span>
            <h1 class="mt-4 font-display text-4xl sm:text-5xl font-extrabold text-slate-900">Project Submission</h1>
            <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">
                Submit your project, assignment, or GitHub repository here. Our internship and hiring teams will review it. A clear description and a live demo link improve your chances of approval.
            </p>
        </div>

        <div class="ra-animate-in ra-animate-in-delay-1 mt-12 rounded-3xl border border-slate-200 bg-white/90 backdrop-blur shadow-xl p-6 sm:p-10">
            <?php if (validation_errors()): ?>
                <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 text-sm">
                    <?= validation_errors('<div>', '</div>'); ?>
                </div>
            <?php endif; ?>
            <?= form_open(base_url('project-submission'), ['class' => 'space-y-6', 'enctype' => 'multipart/form-data']); ?>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Full name *</label>
                        <input type="text" name="full_name" required class="mt-1.5 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 px-4 py-2.5" placeholder="Your name" value="<?= set_value('full_name'); ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Email *</label>
                        <input type="email" name="email" required class="mt-1.5 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 px-4 py-2.5" placeholder="you@email.com" value="<?= set_value('email'); ?>">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Project title *</label>
                    <input type="text" name="project_title" required class="mt-1.5 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 px-4 py-2.5" placeholder="e.g. Resume Builder  -  MERN stack" value="<?= set_value('project_title'); ?>">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Description *</label>
                    <textarea name="description" rows="4" required class="mt-1.5 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 px-4 py-2.5" placeholder="Tech stack, your role, challenges solved, results (numbers)..."><?= set_value('description'); ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Live demo / GitHub link</label>
                    <input type="url" name="project_url" class="mt-1.5 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 px-4 py-2.5" placeholder="https://github.com/... or https://..." value="<?= set_value('project_url'); ?>">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Attachment (optional)</label>
                    <input type="file" name="attachment" accept=".pdf,.zip" class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-brand-100 file:text-brand-800 hover:file:bg-brand-200">
                    <p class="mt-1 text-xs text-slate-500">PDF or ZIP, max 10MB (storage wiring can be added later).</p>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                        <input type="checkbox" name="agree" value="1" required class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                        I confirm this is my original work.
                    </label>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold px-8 py-3 shadow-lg transition transform hover:scale-[1.02] active:scale-[0.98]">
                        Submit project
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                </div>
            <?= form_close(); ?>

            <?php if ($this->session->flashdata('project_ok')): ?>
                <div class="mt-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium">
                    <?= htmlspecialchars($this->session->flashdata('project_ok'), ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </div>

        <p class="ra-animate-in ra-animate-in-delay-2 mt-8 text-center text-sm text-slate-500">
            Response time: typically <strong class="text-slate-700">5 - 7 business days</strong>. Important updates will be sent to your email.
        </p>
    </div>
</div>




