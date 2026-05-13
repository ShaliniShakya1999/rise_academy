<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rise Academy — Bridge the Gap Between College & Career</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/website/images/rise_logo.png'); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --brand-gold: #d4af37;
            --brand-gold-light: #f3d88a;
            --brand-dark: #00204a;
            --brand-light: #f8fafc;
            --brand-purple: #1e104e;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            overflow-x: hidden;
        }
        .text-gradient {
            background: linear-gradient(135deg, var(--brand-dark) 30%, var(--brand-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
        }
        .glass-card:hover {
            background: #ffffff;
            border-color: var(--brand-gold);
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .portal-btn {
            background: linear-gradient(135deg, var(--brand-gold) 0%, #b8860b 100%);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.1;
            pointer-events: none;
        }
        .marquee {
            display: flex;
            overflow: hidden;
            user-select: none;
            gap: 2rem;
        }
        .marquee-content {
            flex-shrink: 0;
            display: flex;
            justify-content: space-around;
            min-width: 100%;
            gap: 2rem;
            animation: scroll 30s linear infinite;
        }
        @keyframes scroll {
            from { transform: translateX(0); }
            to { transform: translateX(-100%); }
        }
        .stat-card {
            border-left: 2px solid var(--brand-gold);
            padding-left: 1.5rem;
        }
    </style>
</head>
<body class="selection:bg-[#d4af37] selection:text-white">

    <!-- Background Elements -->
    <div class="orb w-[600px] h-[600px] bg-violet-900/40 top-[-200px] left-[-200px]"></div>
    <div class="orb w-[500px] h-[500px] bg-blue-900/30 bottom-[10%] right-[-100px]"></div>

    <!-- Standalone Header -->
    <header class="relative z-50 w-full px-6 py-6 border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="<?= base_url(); ?>" class="flex items-center gap-3">
                <img src="<?= base_url('assets/website/images/rise_logo.png'); ?>" alt="Rise Academy" class="h-10 md:h-14 w-auto object-contain">
            </a>
            
            <nav class="hidden md:flex items-center gap-10 text-[13px] font-bold uppercase tracking-widest text-slate-500">
                <a href="#features" class="hover:text-[#d4af37] transition-colors">Why Choose Us</a>
                <a href="#services" class="hover:text-[#d4af37] transition-colors">Our Services</a>
                <a href="#partners" class="hover:text-[#d4af37] transition-colors">Placement</a>
                <a href="<?= base_url('job'); ?>" target="_blank" class="px-6 py-2.5 bg-[#00204a] rounded-full text-white hover:bg-[#d4af37] transition-all duration-300">Enter Portal</a>
            </nav>

            <button class="md:hidden text-2xl text-slate-900">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8 relative z-10">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-gray-50 border border-gray-100 rounded-full">
                    <span class="w-2 h-2 bg-[#d4af37] rounded-full animate-pulse"></span>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-500">🚀 Transform Your Career Today</span>
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black leading-[0.95] tracking-tighter text-gradient">
                    BRIDGE THE GAP <br>
                    <span class="text-[#d4af37]">BETWEEN COLLEGE</span> <br>
                    & YOUR CAREER
                </h1>
                
                <p class="text-xl text-slate-500 font-medium leading-relaxed max-w-xl">
                    Live Learning with Industry Experts, Jobs at Leading Tech Companies, and Real-World Project Experience.
                </p>
                
                <div class="flex flex-wrap gap-5">
                    <a href="<?= base_url('job'); ?>" target="_blank" class="portal-btn px-10 py-5 rounded-2xl text-white font-black text-lg flex items-center gap-3 transition-all">
                        🎯 Explore Programs <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="<?= base_url('internship'); ?>" target="_blank" class="px-10 py-5 bg-white/5 border border-white/10 rounded-2xl text-white font-black text-lg hover:bg-white/10 transition-all">
                        💼 Apply for Internship
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-8 pt-6 border-t border-gray-100">
                    <div class="stat-card">
                        <div class="text-3xl font-black text-slate-900">1,00,000+</div>
                        <div class="text-[10px] font-bold text-[#d4af37] uppercase tracking-widest">Students</div>
                    </div>
                    <div class="stat-card">
                        <div class="text-3xl font-black text-slate-900">95%</div>
                        <div class="text-[10px] font-bold text-[#d4af37] uppercase tracking-widest">Success Rate</div>
                    </div>
                    <div class="stat-card">
                        <div class="text-3xl font-black text-slate-900">100+</div>
                        <div class="text-[10px] font-bold text-[#d4af37] uppercase tracking-widest">Companies</div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Mockup -->
            <div class="relative group">
                <div class="absolute -inset-10 bg-[#d4af37]/20 blur-[100px] rounded-full opacity-50 group-hover:opacity-80 transition duration-1000"></div>
                <div class="relative glass-card rounded-[2.5rem] p-8 border-gray-100 shadow-xl overflow-hidden">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="font-bold text-lg text-slate-900">Your Program Dashboard</h3>
                        <div class="flex gap-2">
                            <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                            <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="flex justify-between text-sm mb-3">
                                <span class="text-slate-500">Web Dev</span>
                                <span class="font-black text-[#d4af37]">85%</span>
                            </div>
                            <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-[#d4af37] w-[85%] rounded-full shadow-[0_0_15px_rgba(212,175,55,0.4)]"></div>
                            </div>
                        </div>

                        <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="flex justify-between text-sm mb-3">
                                <span class="text-slate-500">Data Science</span>
                                <span class="font-black text-blue-500">72%</span>
                            </div>
                            <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 w-[72%] rounded-full shadow-[0_0_15px_rgba(59,130,246,0.4)]"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 rounded-xl text-center border border-gray-100">
                                <div class="text-2xl font-black text-slate-900">80%</div>
                                <div class="text-[9px] uppercase tracking-widest text-slate-400 mt-1">Profile Completed</div>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl text-center border border-gray-100">
                                <div class="text-2xl font-black text-slate-900">75%</div>
                                <div class="text-[9px] uppercase tracking-widest text-slate-400 mt-1">Assignment Done</div>
                            </div>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-[#d4af37]/10 to-transparent rounded-2xl border border-[#d4af37]/20 flex items-center gap-4">
                            <div class="w-10 h-10 bg-[#d4af37] rounded-lg flex items-center justify-center text-white">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-xs font-bold">Certificate Issued</div>
                                <div class="text-[10px] text-white/50">90% Progress achieved</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Mini Cards -->
                <div class="absolute -right-6 top-10 bg-white text-slate-900 rounded-2xl p-4 shadow-2xl animate-bounce duration-[3000ms] hidden lg:block">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-black uppercase opacity-60">Success</div>
                            <div class="text-xs font-extrabold">Project Submitted</div>
                        </div>
                    </div>
                </div>

                <div class="absolute -left-10 bottom-20 bg-slate-900 text-white rounded-2xl p-4 border border-white/10 shadow-2xl animate-pulse hidden lg:block">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-violet-500 flex items-center justify-center">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-black uppercase opacity-60">Mentor Match</div>
                            <div class="text-xs font-extrabold">Sarah - Sr. Developer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certification Bar -->
    <div class="bg-gray-50 border-y border-gray-100 py-8 overflow-hidden">
        <div class="marquee">
            <div class="marquee-content uppercase text-[10px] font-black tracking-[0.4em] text-slate-400 flex items-center">
                <span>ISO 9001 Certified</span> <span class="mx-10">•</span>
                <span>Approved by MSME</span> <span class="mx-10">•</span>
                <span>Ministry of Corporate Affairs</span> <span class="mx-10">•</span>
                <span>Startup India Initiative</span> <span class="mx-10">•</span>
                <span>NASSCOM Membership</span> <span class="mx-10">•</span>
                <span>ISO 9001 Certified</span> <span class="mx-10">•</span>
                <span>Approved by MSME</span> <span class="mx-10">•</span>
                <span>Ministry of Corporate Affairs</span> <span class="mx-10">•</span>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <section id="services" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center space-y-4 mb-20">
                <h2 class="text-sm font-black text-[#d4af37] uppercase tracking-[0.4em]">What we have for you</h2>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900">Learn the skills employers <br> are looking for</h3>
                <p class="max-w-2xl mx-auto text-slate-500">At Rise Academy, we focus on delivering career-focused courses and internships that help you gain practical skills and land real jobs quickly.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Fellowship -->
                <div class="glass-card p-10 rounded-[3rem] space-y-6 group">
                    <div class="w-14 h-14 bg-[#d4af37]/10 rounded-2xl flex items-center justify-center text-[#d4af37] border border-[#d4af37]/20 group-hover:bg-[#d4af37] group-hover:text-white transition-all">
                        <i class="fa-solid fa-user-graduate text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-black">Fellowship</h4>
                    <p class="text-white/50 text-sm leading-relaxed">Get dedicated career guidance and mentoring from our experts to enhance your professional profile.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-[#d4af37] group-hover:gap-4 transition-all">Explore Fellowship <i class="fa-solid fa-chevron-right"></i></a>
                </div>

                <!-- ATS Checker -->
                <div class="glass-card p-10 rounded-[3rem] space-y-6 group">
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-400 border border-blue-500/20 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-magnifying-glass-chart text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-black">AI ATS Suite</h4>
                    <p class="text-white/50 text-sm leading-relaxed">Optimize your resume with our AI-powered Resume Checker to meet global industry standards.</p>
                    <a href="<?= base_url('resume-checker') ?>" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-blue-400 group-hover:gap-4 transition-all">Explore ATS <i class="fa-solid fa-chevron-right"></i></a>
                </div>

                <!-- Resume Builder -->
                <div class="glass-card p-10 rounded-[3rem] space-y-6 group">
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-400 border border-emerald-500/20 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-file-invoice text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-black">Resume Builder</h4>
                    <p class="text-white/50 text-sm leading-relaxed">Build professional resumes that stand out and land you your dream role with our templates.</p>
                    <a href="<?= base_url('resume-builder') ?>" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-emerald-400 group-hover:gap-4 transition-all">Build Resume <i class="fa-solid fa-chevron-right"></i></a>
                </div>

                <!-- Job Portal -->
                <div class="glass-card p-10 rounded-[3rem] space-y-6 group">
                    <div class="w-14 h-14 bg-violet-500/10 rounded-2xl flex items-center justify-center text-violet-400 border border-violet-500/20 group-hover:bg-violet-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-briefcase text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-black">Job Portal</h4>
                    <p class="text-white/50 text-sm leading-relaxed">Find your dream job with our expert-curated job portal featuring 100+ partner companies.</p>
                    <a href="<?= base_url('job') ?>" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-violet-400 group-hover:gap-4 transition-all">Explore Jobs <i class="fa-solid fa-chevron-right"></i></a>
                </div>

                <!-- Internship -->
                <div class="glass-card p-10 rounded-[3rem] space-y-6 group">
                    <div class="w-14 h-14 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-400 border border-rose-500/20 group-hover:bg-rose-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-rocket text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-black">Internship</h4>
                    <p class="text-white/50 text-sm leading-relaxed">Work on real-world projects and gain experience that recruiters value most in freshers.</p>
                    <a href="<?= base_url('internship') ?>" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-rose-400 group-hover:gap-4 transition-all">Apply Now <i class="fa-solid fa-chevron-right"></i></a>
                </div>

                <!-- CTC Optimizer -->
                <div class="glass-card p-10 rounded-[3rem] space-y-6 group">
                    <div class="w-14 h-14 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-400 border border-amber-500/20 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-coins text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-black">Know your CTC</h4>
                    <p class="text-white/50 text-sm leading-relaxed">Get insights into industry salaries and optimize your profile to maximize your earning potential.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-amber-400 group-hover:gap-4 transition-all">Check CTC <i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="features" class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-8">
                    <h2 class="text-[#d4af37] font-black uppercase tracking-[0.4em] text-sm">Why Choose Rise Academy?</h2>
                    <h3 class="text-4xl md:text-5xl font-black leading-tight text-slate-900">Bridge the gap between <br> college and your career</h3>
                    
                    <div class="space-y-10">
                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-[#d4af37] shrink-0 border border-gray-200">
                                <i class="fa-solid fa-headset text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2 text-slate-900">Live Learning with Experts</h4>
                                <p class="text-slate-500 text-sm">Personalized mentorship and real-time guidance from professionals in top tech companies.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 shrink-0 border border-blue-100">
                                <i class="fa-solid fa-code text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2 text-slate-900">Real-World Projects</h4>
                                <p class="text-slate-500 text-sm">Hands-on experience building production-ready applications that you can proudly showcase.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500 shrink-0 border border-emerald-100">
                                <i class="fa-solid fa-handshake-simple text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2 text-slate-900">Placements & Career Support</h4>
                                <p class="text-slate-500 text-sm">Direct placement into top tech roles with comprehensive interview preparation support.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -inset-10 bg-violet-600/20 blur-[100px] rounded-full"></div>
                    <div class="relative grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="glass-card p-8 rounded-[2rem] text-center">
                                <div class="text-3xl font-black text-[#d4af37] mb-2">100K+</div>
                                <div class="text-[9px] uppercase tracking-widest text-white/40">Active Users</div>
                            </div>
                            <div class="glass-card p-8 rounded-[2rem] text-center">
                                <div class="text-3xl font-black text-blue-400 mb-2">150+</div>
                                <div class="text-[9px] uppercase tracking-widest text-white/40">Hiring Partners</div>
                            </div>
                        </div>
                        <div class="space-y-4 pt-10">
                            <div class="glass-card p-8 rounded-[2rem] text-center">
                                <div class="text-3xl font-black text-emerald-400 mb-2">10K+</div>
                                <div class="text-[9px] uppercase tracking-widest text-white/40">Job Listings</div>
                            </div>
                            <div class="glass-card p-8 rounded-[2rem] text-center">
                                <div class="text-3xl font-black text-rose-400 mb-2">50+</div>
                                <div class="text-[9px] uppercase tracking-widest text-white/40">Campus Partners</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hiring Partners Marquee -->
    <section id="partners" class="py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-16 text-center">
            <h3 class="text-3xl font-black text-slate-900">Our Learners Work at Top Tech Giants</h3>
        </div>
        <div class="marquee py-10 grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-700">
            <div class="marquee-content flex items-center gap-20">
                <span class="text-4xl font-black text-slate-900">IBM</span>
                <span class="text-4xl font-black text-slate-900 italic">amazon</span>
                <span class="text-4xl font-black text-slate-900">Google</span>
                <span class="text-4xl font-black text-slate-900">accenture</span>
                <span class="text-4xl font-black text-slate-900">TCS</span>
                <span class="text-4xl font-black text-slate-900 tracking-widest uppercase">PwC</span>
                <span class="text-4xl font-black text-slate-900">Microsoft</span>
                <span class="text-4xl font-black text-slate-900 font-serif">EY</span>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <div class="space-y-4">
                    <h2 class="text-[#d4af37] font-black uppercase tracking-[0.4em] text-sm">Success Stories</h2>
                    <h3 class="text-4xl font-black text-slate-900">This is what Google Reviews say about Us</h3>
                </div>
                <div class="hidden md:flex gap-4">
                    <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-[#d4af37] hover:text-white transition-all"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-[#d4af37] hover:text-white transition-all"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-white p-8 rounded-[2rem] space-y-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-1 text-[#d4af37] text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed italic">"My time with the program was nothing short of exceptional. The mentors throw you into the deep end with a high-quality life jacket of knowledge."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-indigo-600 rounded-full"></div>
                        <div>
                            <div class="text-sm font-bold text-slate-900">Saini Sarkar</div>
                            <div class="text-[10px] text-slate-400 uppercase font-black">Google Review</div>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="bg-white p-8 rounded-[2rem] space-y-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-1 text-[#d4af37] text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed italic">"Worked with the team and had a wonderful time learning so many new things. As a fresher, the Frontend course was perfectly beginner-friendly."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full"></div>
                        <div>
                            <div class="text-sm font-bold text-slate-900">Gauri Aggarwal</div>
                            <div class="text-[10px] text-slate-400 uppercase font-black">Google Review</div>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="bg-white p-8 rounded-[2rem] space-y-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-1 text-[#d4af37] text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed italic">"The program helped me improve my practical skills and understand real-world projects. Mentors were very supportive throughout the journey."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-orange-600 rounded-full"></div>
                        <div>
                            <div class="text-sm font-bold text-slate-900">Akash Kumar</div>
                            <div class="text-[10px] text-slate-400 uppercase font-black">Google Review</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-32 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-20 space-y-4">
                <h2 class="text-[#d4af37] font-black uppercase tracking-[0.4em] text-sm">Got Questions?</h2>
                <h3 class="text-4xl font-black text-slate-900">Frequently Asked Questions</h3>
            </div>

            <div class="space-y-4">
                <details class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm open:border-[#d4af37]/50 transition-all">
                    <summary class="flex justify-between items-center cursor-pointer list-none font-bold text-lg text-slate-900">
                        What is Rise Academy?
                        <i class="fa-solid fa-plus group-open:rotate-45 transition-transform text-[#d4af37]"></i>
                    </summary>
                    <div class="mt-4 text-slate-500 text-sm leading-relaxed">
                        Rise Academy is a comprehensive career ecosystem providing live learning, mentorship, AI tools, and placement support to bridge the gap between education and employment.
                    </div>
                </details>

                <details class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm open:border-[#d4af37]/50 transition-all">
                    <summary class="flex justify-between items-center cursor-pointer list-none font-bold text-lg text-slate-900">
                        Are the courses self-paced?
                        <i class="fa-solid fa-plus group-open:rotate-45 transition-transform text-[#d4af37]"></i>
                    </summary>
                    <div class="mt-4 text-white/50 text-sm leading-relaxed">
                        We offer a mix of live sessions with industry experts and high-quality recorded modules to provide both flexibility and real-time interaction.
                    </div>
                </details>

                <details class="group glass-card p-6 rounded-2xl open:border-[#d4af37]/50 transition-all">
                    <summary class="flex justify-between items-center cursor-pointer list-none font-bold text-lg">
                        Is technical support available?
                        <i class="fa-solid fa-plus group-open:rotate-45 transition-transform text-[#d4af37]"></i>
                    </summary>
                    <div class="mt-4 text-white/50 text-sm leading-relaxed">
                        Yes, our support team and mentors are available to assist you with technical hurdles or course-related queries throughout your journey.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-gradient-to-br from-[#1e104e] to-[#00204a] rounded-[4rem] p-16 md:p-24 text-center space-y-10 relative overflow-hidden border border-white/5 shadow-2xl">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-[#d4af37]/10 blur-[100px] rounded-full"></div>
                <div class="relative z-10 space-y-6">
                    <h2 class="text-4xl md:text-6xl font-black tracking-tight text-white">Join 100K+ Learners Growing with Us</h2>
                    <p class="text-white/70 text-lg max-w-2xl mx-auto font-medium">Acquire new skills, enhance your career, or pursue a passion. Benefit from expert instructors and a supportive community.</p>
                    <div class="pt-6">
                        <a href="<?= base_url('register') ?>" class="portal-btn inline-flex items-center gap-4 px-12 py-6 rounded-2xl text-white font-black text-xl active:scale-95 transition-transform">
                            Start Your Journey Today <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Standalone Footer -->
    <footer class="bg-gray-50 border-t border-gray-100 pt-24 pb-10 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <img src="<?= base_url('assets/website/images/rise_logo.png'); ?>" alt="Rise Academy" class="h-12 w-auto object-contain">
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Join thousands who have transformed their lives with our high-quality online courses and programs.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center hover:bg-[#d4af37] hover:text-white transition-all shadow-sm"><i class="fa-brands fa-linkedin-in text-sm"></i></a>
                    <a href="#" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center hover:bg-[#d4af37] hover:text-white transition-all shadow-sm"><i class="fa-brands fa-twitter text-sm"></i></a>
                    <a href="#" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center hover:bg-[#d4af37] hover:text-white transition-all shadow-sm"><i class="fa-brands fa-instagram text-sm"></i></a>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-slate-900 mb-8 uppercase tracking-widest text-xs">Our Services</h4>
                <ul class="space-y-4 text-sm text-slate-500">
                    <li><a href="#" class="hover:text-[#d4af37] transition-colors">Fellowship Program</a></li>
                    <li><a href="<?= base_url('resume-builder') ?>" class="hover:text-[#d4af37] transition-colors">Resume Builder</a></li>
                    <li><a href="<?= base_url('resume-checker') ?>" class="hover:text-[#d4af37] transition-colors">AI Resume ATS</a></li>
                    <li><a href="<?= base_url('job') ?>" class="hover:text-[#d4af37] transition-colors">Curated Job Portal</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-slate-900 mb-8 uppercase tracking-widest text-xs">Quick Links</h4>
                <ul class="space-y-4 text-sm text-slate-500">
                    <li><a href="<?= base_url('about') ?>" class="hover:text-[#d4af37] transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-[#d4af37] transition-colors">Success Stories</a></li>
                    <li><a href="#" class="hover:text-[#d4af37] transition-colors">Placement Partners</a></li>
                    <li><a href="#" class="hover:text-[#d4af37] transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="space-y-6">
                <h4 class="font-bold text-slate-900 mb-8 uppercase tracking-widest text-xs">Get In Touch</h4>
                <div class="space-y-4 text-sm text-slate-500">
                    <p class="flex items-center gap-3"><i class="fa-solid fa-phone text-[#d4af37]"></i> +91 08645 322947</p>
                    <p class="flex items-center gap-3"><i class="fa-solid fa-envelope text-[#d4af37]"></i> hello@riseacademy.com</p>
                    <p class="flex items-start gap-3"><i class="fa-solid fa-location-dot text-[#d4af37] mt-1"></i> Cyber City, WeWork DLF Forum, DLF Phase 3, Gurugram, 122002</p>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto border-t border-gray-100 pt-10 text-center text-slate-300 text-[10px] font-bold uppercase tracking-[0.3em]">
            &copy; 2025-2026 Rise Academy Pvt. Ltd. Crafted with Passion for Indian Talent.
        </div>
    </footer>

    <!-- Floating Whatsapp -->
    <a href="https://wa.me/9108645322947" target="_blank" class="fixed bottom-8 right-8 w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center text-2xl shadow-2xl hover:scale-110 transition-transform z-[100] animate-bounce">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

</body>
</html>
