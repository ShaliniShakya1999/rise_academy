<div class="min-h-screen flex items-center justify-center bg-[#f8fafc] px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-block mb-4">
                <a href="<?= base_url() ?>" class="flex items-center justify-center">
                    <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="Internmo Logo" class="h-12 w-auto object-contain" onerror="this.style.display='none'; this.nextElementSibling.removeAttribute('style');">
                    <span class="text-3xl font-black text-[#00204a] tracking-tight" style="display: none;">Intern<span class="text-[#d4af37]">mo</span></span>
                </a>
            </div>
            <p class="text-slate-500 font-medium mt-1">Reset your password</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-2xl shadow-blue-900/10 border border-gray-50 relative overflow-hidden">
            <!-- Decorative accent -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#00204a] via-[#d4af37] to-[#00204a]"></div>

            <?php if (isset($error) && $error): ?>
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl text-sm flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-rose-500"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success) && $success): ?>
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl text-sm space-y-3">
                    <div class="flex items-center gap-3 font-semibold text-emerald-900">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                        <span><?= htmlspecialchars($success) ?></span>
                    </div>
                    <?php if (isset($reset_link) && $reset_link): ?>
                        <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs space-y-2">
                            <p class="font-bold text-amber-800">
                                <i class="fa-solid fa-flask mr-1"></i> Local Dev Reset Simulator:
                            </p>
                            <a href="<?= $reset_link ?>" class="block text-center bg-[#00204a] hover:bg-[#d4af37] text-white py-2 px-4 rounded-lg font-black transition-colors">
                                Reset Password Now
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('projects/forgot_password') ?>" method="post" class="space-y-6">
                <p class="text-xs text-slate-500 leading-relaxed font-medium">
                    Enter the email address associated with your account, and we will generate a password reset link for you.
                </p>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#00204a] transition-colors">
                            <i class="far fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="<?= htmlspecialchars($old_email ?? '') ?>" required
                               class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-[#00204a]/5 focus:border-[#00204a] outline-none transition-all font-semibold"
                               placeholder="name@example.com">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-4.5 bg-[#00204a] hover:bg-[#00306a] text-white font-black rounded-2xl shadow-xl shadow-blue-900/20 transition-all flex items-center justify-center gap-3 py-4 group active:scale-[0.98]">
                    Send Reset Link
                    <i class="fas fa-paper-plane text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </div>

        <p class="text-center mt-10 text-sm text-slate-500 font-medium">
            Remembered your password? <a href="<?= site_url('projects/login') ?>" class="text-[#d4af37] font-black hover:underline ml-1">Back to sign in</a>
        </p>
    </div>
</div>
