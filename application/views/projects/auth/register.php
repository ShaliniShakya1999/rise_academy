<div class="min-h-screen flex items-center justify-center bg-[#f8fafc] px-4 py-12">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-block p-2 bg-white rounded-2xl shadow-xl shadow-blue-900/5 mb-6 border border-gray-50">
                <img src="<?= base_url('assets/website/images/rise_logo.png') ?>" alt="Rise Academy" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-3xl font-black text-[#00204a] mb-2 tracking-tight">Rise <span class="text-[#d4af37]">Academy</span></h1>
            <p class="text-slate-500 font-medium">Internship Registration</p>
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

            <form action="<?= site_url('projects/register') ?>" method="post" class="space-y-6">
                <?php 
                $internship = $this->input->get('internship');
                if ($internship): 
                ?>
                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                        <p class="text-[10px] font-black uppercase tracking-widest text-blue-400 mb-1">Applying for</p>
                        <p class="text-sm font-bold text-blue-900"><?= htmlspecialchars($internship) ?></p>
                        <input type="hidden" name="applied_for" value="<?= htmlspecialchars($internship) ?>">
                    </div>
                <?php endif; ?>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Full Name</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#00204a] transition-colors">
                            <i class="far fa-user"></i>
                        </span>
                        <input type="text" name="full_name" value="<?= htmlspecialchars($old_data['full_name'] ?? '') ?>" required
                               class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-[#00204a]/5 focus:border-[#00204a] outline-none transition-all font-semibold"
                               placeholder="John Doe">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#00204a] transition-colors">
                            <i class="far fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="<?= htmlspecialchars($old_data['email'] ?? '') ?>" required
                               class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-[#00204a]/5 focus:border-[#00204a] outline-none transition-all font-semibold"
                               placeholder="name@example.com">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Mobile Number</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#00204a] transition-colors">
                            <i class="far fa-phone"></i>
                        </span>
                        <input type="text" name="mobile" value="<?= htmlspecialchars($old_data['mobile'] ?? '') ?>"
                               class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-[#00204a]/5 focus:border-[#00204a] outline-none transition-all font-semibold"
                               placeholder="+91 00000 00000">
                    </div>
                </div>

                <!-- Info Notice -->
                <div class="p-4 bg-amber-50 border border-amber-100 rounded-2xl flex items-start gap-3">
                    <i class="fa-solid fa-circle-info text-amber-500 mt-0.5 flex-shrink-0"></i>
                    <p class="text-xs text-amber-700 font-semibold leading-relaxed">
                        After registration, your account will be reviewed by admin. Your <strong>login credentials will be sent to your email</strong> once approved.
                    </p>
                </div>

                <button type="submit" 
                        class="w-full py-4.5 bg-[#00204a] hover:bg-[#00306a] text-white font-black rounded-2xl shadow-xl shadow-blue-900/20 transition-all flex items-center justify-center gap-3 py-4 group active:scale-[0.98]">
                    Submit Application
                    <i class="fas fa-paper-plane text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </div>

        <p class="text-center mt-10 text-sm text-slate-500 font-medium">
            Already have an account? <a href="<?= site_url('projects/login') ?>" class="text-[#d4af37] font-black hover:underline ml-1">Sign In</a>
        </p>
    </div>
</div>
