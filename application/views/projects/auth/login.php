<div class="min-h-screen flex items-center justify-center bg-[#f8fafc] px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-block mb-6">
                <a href="<?= base_url() ?>" class="flex items-center gap-3 justify-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-md">I</div>
                    <span class="text-[#00204a] font-black text-2xl tracking-tight">Internmo</span>
                </a>
            </div>
            <h1 class="text-3xl font-black text-[#00204a] mb-2 tracking-tight">Intern<span class="text-[#d4af37]">mo</span></h1>
            <p class="text-slate-500 font-medium">Project Portal Access</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-2xl shadow-blue-900/10 border border-gray-50 relative overflow-hidden">
            <!-- Decorative accent -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#00204a] via-[#d4af37] to-[#00204a]"></div>

            <?php if (isset($error) && $error): ?>
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl text-sm flex items-center gap-3 animate-pulse">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('reg_success')): ?>
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-sm flex items-start gap-3">
                    <i class="fa-solid fa-circle-check mt-0.5 flex-shrink-0"></i>
                    <span><?= $this->session->flashdata('reg_success') ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('projects/login') ?>" method="post" class="space-y-6">
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

                <div>
                    <div class="flex items-center justify-between mb-2 ml-1">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Password</label>
                    </div>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#00204a] transition-colors">
                            <i class="far fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                               class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-[#00204a]/5 focus:border-[#00204a] outline-none transition-all font-semibold"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-4.5 bg-[#00204a] hover:bg-[#00306a] text-white font-black rounded-2xl shadow-xl shadow-blue-900/20 transition-all flex items-center justify-center gap-3 py-4 group active:scale-[0.98]">
                    Sign In
                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </div>

        <p class="text-center mt-10 text-sm text-slate-500 font-medium">
            Don't have an account? <a href="<?= site_url('projects/register') ?>" class="text-[#d4af37] font-black hover:underline ml-1">Get started</a>
        </p>
    </div>
</div>




