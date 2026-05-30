<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$title       = htmlspecialchars($course['title']);
$subtitle    = htmlspecialchars($course['subtitle']);
$description = htmlspecialchars($course['description']);
$icon        = htmlspecialchars($course['icon']);
$duration    = htmlspecialchars($course['duration']);
$format      = htmlspecialchars($course['format']);
$emi         = htmlspecialchars($course['emi']);
$gradient    = htmlspecialchars($course['gradient']);
$color_theme = htmlspecialchars($course['color_theme']);
?>

<style>
/* ── Course Page Styles ─────────────────────────── */
.cd-hero {
    background: linear-gradient(135deg, #0a0f1a 0%, #111827 60%, #1a0e00 100%);
    position: relative;
    overflow: hidden;
}
.cd-hero::before {
    content: '';
    position: absolute;
    top: -100px; right: -100px;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(245,158,11,0.18) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.cd-hero::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -80px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(251,146,60,0.10) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.cd-badge {
    background: rgba(245,158,11,0.15);
    border: 1px solid rgba(245,158,11,0.35);
    color: #fbbf24;
}
.cd-spec-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 16px 20px;
    text-align: center;
    backdrop-filter: blur(10px);
}
.cd-stat-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 20px;
    backdrop-filter: blur(10px);
}
.cd-module {
    border: 1px solid #f1f5f9;
    border-left: 3px solid #f59e0b;
    border-radius: 12px;
    padding: 18px 20px;
    background: #fff;
    transition: all 0.25s ease;
}
.cd-module:hover {
    border-left-color: #d97706;
    box-shadow: 0 4px 20px rgba(245,158,11,0.08);
    transform: translateX(4px);
}
.cd-module-num {
    width: 34px; height: 34px;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    font-weight: 800;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    font-size: 13px;
}
.cd-highlight {
    background: linear-gradient(135deg, #fffbeb, #fef9ee);
    border: 1px solid #fde68a;
    border-radius: 12px;
    padding: 14px 16px;
    display: flex; align-items: flex-start; gap: 10px;
    transition: all 0.2s ease;
}
.cd-highlight:hover {
    border-color: #f59e0b;
    box-shadow: 0 4px 15px rgba(245,158,11,0.1);
}
.cd-enroll-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.08);
}
.cd-enroll-header {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    padding: 22px 24px;
    color: white;
    text-align: center;
}
.cd-input {
    width: 100%;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 11px 16px;
    font-size: 13px;
    color: #0f172a;
    transition: all 0.2s ease;
    outline: none;
}
.cd-input:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245,158,11,0.15);
    background: #fff;
}
.cd-input::placeholder { color: #94a3b8; }
.cd-submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white;
    font-weight: 800;
    font-size: 14px;
    padding: 14px 20px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    box-shadow: 0 4px 20px rgba(245,158,11,0.35);
}
.cd-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245,158,11,0.45);
}
.cd-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: #fffbeb;
    border: 1px solid #fde68a;
    color: #92400e;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
}
.cd-section-label {
    display: flex; align-items: center; gap: 10px;
    font-size: 20px; font-weight: 800; color: #0f172a;
    margin-bottom: 20px;
}
.cd-section-bar {
    width: 4px; height: 22px;
    background: linear-gradient(to bottom, #f59e0b, #f97316);
    border-radius: 4px;
    flex-shrink: 0;
}
.cd-sticky-bar {
    position: fixed; bottom: 0; left: 0; right: 0;
    background: linear-gradient(90deg, #0a0f1a, #1a1200);
    border-top: 1px solid rgba(245,158,11,0.3);
    padding: 12px 16px;
    display: flex; align-items: center; justify-content: center; gap: 16px;
    z-index: 100;
    flex-wrap: wrap;
    box-shadow: 0 -10px 30px rgba(245,158,11,0.1);
}
</style>

<div class="bg-slate-50 min-h-screen" style="padding-bottom: 70px;">

    <!-- ═══════════════════════════════════════════ -->
    <!-- 1. HERO BANNER                              -->
    <!-- ═══════════════════════════════════════════ -->
    <section class="cd-hero py-20 lg:py-28">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mb-8">
                <a href="<?= base_url(); ?>" class="hover:text-amber-400 transition-colors">Home</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i>
                <a href="<?= base_url(); ?>#courses" class="hover:text-amber-400 transition-colors">Courses</a>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i>
                <span class="text-amber-400"><?= $title; ?></span>
            </div>

            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- Left: Course Info -->
                <div class="lg:col-span-8 space-y-7">

                    <!-- Badge Row -->
                    <div class="flex flex-wrap gap-2">
                        <span class="cd-badge inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold">
                            <i class="<?= $icon; ?>"></i> Professional Certification Track
                        </span>
                        <span class="cd-badge inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold">
                            <i class="fa-solid fa-indian-rupee-sign"></i> EMI from <?= $emi; ?>
                        </span>
                    </div>

                    <!-- Title -->
                    <div>
                        <h1 class="text-4xl sm:text-5xl lg:text-[58px] font-black text-white tracking-tight leading-[1.08] mb-4">
                            <?= $title; ?>
                        </h1>
                        <p class="text-lg text-amber-300 font-semibold mb-3"><?= $subtitle; ?></p>
                        <p class="text-base text-slate-400 max-w-2xl leading-relaxed"><?= $description; ?></p>
                    </div>

                    <!-- Fast Specs Row -->
                    <div class="grid grid-cols-3 gap-4 max-w-lg">
                        <div class="cd-spec-card">
                            <div class="text-amber-400 text-xl mb-1"><i class="fa-regular fa-clock"></i></div>
                            <div class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">Duration</div>
                            <div class="text-sm font-bold text-white mt-1"><?= $duration; ?></div>
                        </div>
                        <div class="cd-spec-card">
                            <div class="text-amber-400 text-xl mb-1"><i class="fa-solid fa-laptop"></i></div>
                            <div class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">Format</div>
                            <div class="text-sm font-bold text-white mt-1"><?= $format; ?></div>
                        </div>
                        <div class="cd-spec-card">
                            <div class="text-amber-400 text-xl mb-1"><i class="fa-solid fa-credit-card"></i></div>
                            <div class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">EMI From</div>
                            <div class="text-sm font-bold text-white mt-1"><?= $emi; ?></div>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex flex-wrap gap-3 pt-2">
                        <span class="cd-pill"><i class="fa-solid fa-certificate"></i> ISO Certified Program</span>
                        <span class="cd-pill"><i class="fa-solid fa-users"></i> 2L+ Alumni</span>
                        <span class="cd-pill"><i class="fa-solid fa-briefcase"></i> 800+ Hiring Partners</span>
                        <span class="cd-pill"><i class="fa-solid fa-star"></i> 4.9 / 5.0 Rating</span>
                    </div>
                </div>

                <!-- Right: Batch Stats Card -->
                <div class="lg:col-span-4">
                    <div class="cd-stat-card space-y-4">
                        <div class="text-xs text-amber-400 uppercase font-bold tracking-wider mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-dot animate-pulse text-amber-500"></i> Current Batch Status
                        </div>
                        <div class="flex items-center justify-between border-b border-white/8 pb-3">
                            <span class="text-sm text-slate-400">Enrollment Limit</span>
                            <span class="text-sm font-bold text-white">60 Seats/Batch</span>
                        </div>
                        <div class="flex items-center justify-between border-b border-white/8 pb-3">
                            <span class="text-sm text-slate-400">Next Cohort Starts</span>
                            <span class="text-sm font-bold text-amber-400">June 4, 2026</span>
                        </div>
                        <div class="flex items-center justify-between border-b border-white/8 pb-3">
                            <span class="text-sm text-slate-400">Seats Remaining</span>
                            <span class="text-sm font-bold text-red-400">Only 12 Left!</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-400">Placement Rate</span>
                            <span class="text-sm font-bold text-emerald-400">98.4% Hired</span>
                        </div>
                        <!-- Urgency Progress Bar -->
                        <div class="pt-3">
                            <div class="flex justify-between text-[10px] text-slate-500 mb-1.5">
                                <span>Seats Filling Fast</span>
                                <span class="text-amber-400 font-bold">80% Filled</span>
                            </div>
                            <div class="w-full bg-white/10 rounded-full h-1.5">
                                <div class="h-1.5 rounded-full bg-gradient-to-r from-amber-400 to-orange-400" style="width: 80%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════ -->
    <!-- 2. MAIN CONTENT                             -->
    <!-- ═══════════════════════════════════════════ -->
    <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-12 grid lg:grid-cols-12 gap-10 items-start">

        <!-- ── Left Column ───────────────────────── -->
        <div class="lg:col-span-8 space-y-8">

            <!-- Curriculum Modules -->
            <div class="bg-white border border-slate-100 rounded-2xl p-8 shadow-sm">
                <div class="cd-section-label">
                    <span class="cd-section-bar"></span>
                    Curriculum Modules
                </div>
                <div class="space-y-3">
                    <?php foreach ($course['curriculum'] as $index => $module): ?>
                    <div class="cd-module flex items-start gap-4">
                        <span class="cd-module-num"><?= $index + 1; ?></span>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-0.5">Module <?= $index + 1; ?></div>
                            <p class="text-slate-700 text-sm font-medium leading-relaxed"><?= htmlspecialchars($module); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Program Highlights -->
            <div class="bg-white border border-slate-100 rounded-2xl p-8 shadow-sm">
                <div class="cd-section-label">
                    <span class="cd-section-bar" style="background: linear-gradient(to bottom, #10b981, #059669);"></span>
                    Program Benefits &amp; Support
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <?php foreach ($course['highlights'] as $highlight): ?>
                    <div class="cd-highlight">
                        <div class="mt-0.5 w-5 h-5 rounded-full bg-amber-400 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-check text-white text-[9px]"></i>
                        </div>
                        <span class="text-slate-700 text-sm font-semibold leading-normal"><?= htmlspecialchars($highlight); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Why Internmo Section -->
            <div class="bg-gradient-to-br from-[#0a0f1a] to-[#1a1200] rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="cd-section-label" style="color: white;">
                    <span class="cd-section-bar"></span>
                    Why Choose Internmo?
                </div>
                <div class="grid sm:grid-cols-3 gap-5 relative z-10">
                    <div class="text-center p-4 bg-white/5 rounded-xl border border-white/8">
                        <div class="text-3xl font-black text-amber-400 mb-1">4,500+</div>
                        <div class="text-xs text-slate-400 font-medium">Students Placed</div>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-xl border border-white/8">
                        <div class="text-3xl font-black text-amber-400 mb-1">800+</div>
                        <div class="text-xs text-slate-400 font-medium">Hiring Companies</div>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-xl border border-white/8">
                        <div class="text-3xl font-black text-amber-400 mb-1">₹1.5 Cr</div>
                        <div class="text-xs text-slate-400 font-medium">Highest Package</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Right Column: Enrollment Card ─────── -->
        <div class="lg:col-span-4 sticky top-24">
            <div class="cd-enroll-card">

                <!-- Card Header -->
                <div class="cd-enroll-header">
                    <div class="text-white/80 text-xs font-bold uppercase tracking-widest mb-1">Next Batch: June 4, 2026</div>
                    <h3 class="text-xl font-black text-white mb-1">Apply for Admission</h3>
                    <p class="text-white/75 text-xs">Reserve your seat  -  only 12 spots remaining!</p>
                </div>

                <!-- Card Body -->
                <div class="p-7 space-y-5">

                    <form action="#" method="POST" class="space-y-4" onsubmit="event.preventDefault(); alert('Application submitted! Our counsellor will call you within 2 hours. 🎉');">

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Full Name *</label>
                            <input type="text" required class="cd-input" placeholder="e.g. Rahul Sharma">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Email Address *</label>
                            <input type="email" required class="cd-input" placeholder="e.g. rahul@gmail.com">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Phone Number *</label>
                            <input type="tel" required class="cd-input" placeholder="e.g. +91 9876543210">
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-500">Course Price</span>
                                <div class="text-right">
                                    <span class="font-black text-slate-800">₹24,999 Only</span>
                                    <span class="text-slate-400 line-through ml-1.5 text-[10px]">₹59,999</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-500">No-Cost EMI</span>
                                <span class="font-bold text-amber-600">from <?= $emi; ?></span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-500">Placement Support</span>
                                <span class="font-bold text-emerald-600">100% Guaranteed</span>
                            </div>
                        </div>

                        <button type="submit" class="cd-submit-btn">
                            Apply &amp; Get Brochure <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </form>

                    <div class="flex items-center gap-3 text-center justify-center pt-1">
                        <a href="https://wa.me/9108645322947" target="_blank" class="flex items-center gap-2 text-xs text-emerald-600 font-bold hover:text-emerald-700 transition-colors">
                            <svg class="w-4 h-4 fill-current text-emerald-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.588 1.45 5.621 1.451 5.398 0 9.794-4.394 9.798-9.792.002-2.615-1.012-5.074-2.857-6.92C17.317 2.047 14.86 1.03 12.245 1.03c-5.398 0-9.793 4.393-9.797 9.791-.001 2.07.543 4.09 1.573 5.883L3.082 20.77l4.565-1.196zm11.387-5.464c-.31-.156-1.834-.905-2.11-.1-.277.104-.476.516-.584.641-.108.124-.216.186-.526.03-1.293-.647-2.14-1.161-2.986-2.613-.223-.383-.021-.592.134-.746.14-.139.31-.361.464-.541.154-.18.206-.305.31-.51.103-.206.052-.386-.026-.541-.077-.156-.688-1.66-.943-2.274-.249-.597-.502-.516-.688-.526-.178-.009-.382-.01-.587-.01-.205 0-.539.077-.82.386-.282.309-1.077 1.051-1.077 2.562 0 1.511 1.098 2.978 1.253 3.184.154.206 2.16 3.298 5.232 4.622.73.315 1.3.504 1.743.645.736.23 1.406.199 1.935.12.589-.088 1.834-.751 2.09-1.477.256-.725.256-1.346.18-1.477-.077-.13-.282-.206-.592-.361z"/>
                            </svg> Chat on WhatsApp
                        </a>
                        <span class="text-slate-300">|</span>
                        <a href="<?= base_url(); ?>#courses" class="text-xs text-slate-400 hover:text-amber-500 transition-colors font-semibold">
                            <i class="fa-solid fa-chevron-left text-[9px] mr-1"></i> All Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>

<!-- ─── Fixed Bottom Sticky CTA Bar ───────────────── -->
<div class="cd-sticky-bar">
    <span class="text-white text-[13px] font-bold flex items-center gap-2">
        🚀 <span class="hidden sm:inline"><?= $title; ?>  -  </span>Next Batch: <span class="text-amber-400">June 4, 2026</span>
    </span>
    <a href="<?= base_url('register'); ?>" class="bg-gradient-to-r from-amber-400 to-orange-400 text-white px-6 py-2 rounded-lg text-[13px] font-black hover:from-amber-500 hover:to-orange-500 transition-all shadow-md">
        Apply Now
    </a>
    <a href="https://wa.me/9108645322947" target="_blank" class="bg-emerald-500 text-white px-5 py-2 rounded-lg text-[13px] font-bold hover:bg-emerald-600 transition-all flex items-center gap-1.5">
        <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.588 1.45 5.621 1.451 5.398 0 9.794-4.394 9.798-9.792.002-2.615-1.012-5.074-2.857-6.92C17.317 2.047 14.86 1.03 12.245 1.03c-5.398 0-9.793 4.393-9.797 9.791-.001 2.07.543 4.09 1.573 5.883L3.082 20.77l4.565-1.196zm11.387-5.464c-.31-.156-1.834-.905-2.11-.1-.277.104-.476.516-.584.641-.108.124-.216.186-.526.03-1.293-.647-2.14-1.161-2.986-2.613-.223-.383-.021-.592.134-.746.14-.139.31-.361.464-.541.154-.18.206-.305.31-.51.103-.206.052-.386-.026-.541-.077-.156-.688-1.66-.943-2.274-.249-.597-.502-.516-.688-.526-.178-.009-.382-.01-.587-.01-.205 0-.539.077-.82.386-.282.309-1.077 1.051-1.077 2.562 0 1.511 1.098 2.978 1.253 3.184.154.206 2.16 3.298 5.232 4.622.73.315 1.3.504 1.743.645.736.23 1.406.199 1.935.12.589-.088 1.834-.751 2.09-1.477.256-.725.256-1.346.18-1.477-.077-.13-.282-.206-.592-.361z"/>
        </svg> <span class="hidden sm:inline">WhatsApp</span>
    </a>
</div>
