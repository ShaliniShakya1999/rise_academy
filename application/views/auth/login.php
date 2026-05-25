<div class="space-y-2">
    <h1 class="font-display text-3xl font-extrabold text-slate-900">Welcome back</h1>
    <p class="text-slate-500">Sign in to continue building your resume.</p>
</div>

<?php if (!empty($error)): ?>
    <div class="mt-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-sm">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>
<?php if ($flash = $this->session->flashdata('success')): ?>
    <div class="mt-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
        <?= htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<?= form_open(base_url('login'), ['class' => 'mt-8 space-y-5', 'autocomplete' => 'off']); ?>
    <div>
        <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
        <input id="email" type="email" name="email" required
               value="<?= htmlspecialchars(isset($old_email) ? $old_email : '', ENT_QUOTES, 'UTF-8'); ?>"
               class="mt-1.5 block w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-3 py-2.5"
               placeholder="you@example.com">
    </div>
    <div>
        <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <a href="#" class="text-xs font-medium text-brand-600 hover:text-brand-700">Forgot password?</a>
        </div>
        <input id="password" type="password" name="password" required
               class="mt-1.5 block w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-3 py-2.5"
               placeholder="••••••••">
    </div>

    <button type="submit"
            class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-brand-600 hover:bg-brand-700 text-white font-semibold px-4 py-3 transition shadow-sm">
        Sign in
    </button>
<?= form_close(); ?>

<p class="mt-6 text-sm text-center text-slate-500">
    Don't have an account?
    <a href="<?= base_url('register'); ?>" class="font-semibold text-brand-600 hover:text-brand-700">Create one  -  free</a>
</p>




