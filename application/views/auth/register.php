<div class="space-y-2">
    <h1 class="font-display text-3xl font-extrabold text-slate-900">Create your account</h1>
    <p class="text-slate-500">Build unlimited resumes. Free forever.</p>
</div>

<?php if (!empty($errors) && is_array($errors)): ?>
    <div class="mt-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-sm">
        <ul class="list-disc list-inside space-y-0.5">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?= form_open(base_url('register'), ['class' => 'mt-8 space-y-5', 'autocomplete' => 'off']); ?>
    <div>
        <label class="block text-sm font-medium text-slate-700">Full name</label>
        <input type="text" name="full_name" required
               value="<?= htmlspecialchars(isset($old['full_name']) ? $old['full_name'] : '', ENT_QUOTES, 'UTF-8'); ?>"
               class="mt-1.5 block w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-3 py-2.5"
               placeholder="John Doe">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700">Email address</label>
        <input type="email" name="email" required
               value="<?= htmlspecialchars(isset($old['email']) ? $old['email'] : '', ENT_QUOTES, 'UTF-8'); ?>"
               class="mt-1.5 block w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-3 py-2.5"
               placeholder="you@example.com">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700">Mobile <span class="text-slate-400 font-normal">(optional)</span></label>
        <input type="tel" name="mobile"
               value="<?= htmlspecialchars(isset($old['mobile']) ? $old['mobile'] : '', ENT_QUOTES, 'UTF-8'); ?>"
               class="mt-1.5 block w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-3 py-2.5"
               placeholder="9999999999">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700">Password</label>
        <input type="password" name="password" required minlength="6"
               class="mt-1.5 block w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-3 py-2.5"
               placeholder="Min 6 characters">
    </div>

    <button type="submit"
            class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-brand-600 hover:bg-brand-700 text-white font-semibold px-4 py-3 transition shadow-sm">
        Create my account
    </button>
<?= form_close(); ?>

<p class="mt-6 text-sm text-center text-slate-500">
    Already have an account?
    <a href="<?= base_url('login'); ?>" class="font-semibold text-brand-600 hover:text-brand-700">Sign in</a>
</p>




