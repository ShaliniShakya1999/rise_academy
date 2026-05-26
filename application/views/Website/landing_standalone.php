<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$bu = base_url();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internmo  -  Practical Learning Platform</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/website/images/logo.png'); ?>">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#F59E0B',
                        'primary-dark': '#D97706',
                        dark: '#0B1120',
                        light: '#F8FAFC',
                        cta: '#10B981',
                        border: '#E2E8F0',
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'card': '0 20px 40px -5px rgba(0, 0, 0, 0.08)',
                        'glow': '0 0 30px -5px rgba(245, 158, 11, 0.3)',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #0F172A;
            overflow-x: hidden;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }
        .btn-outline {
            background-color: transparent;
            color: #0F172A;
            border: 1px solid #CBD5E1;
        }
        .btn-outline:hover {
            border-color: #f59e0b;
            color: #f59e0b;
            background-color: #F8FAFC;
            transform: translateY(-2px);
        }

        /* Timeline Dashboard styling */
        .dashed-line {
            background-image: linear-gradient(to right, #cbd5e1 50%, transparent 50%);
            background-size: 12px 2px;
            background-repeat: repeat-x;
        }
        
        .bar-chart-col {
            transition: height 1s ease-out;
        }

        .accordion-content {
            display: none;
        }
        .accordion-open .accordion-content {
            display: block;
        }
        .accordion-open .fa-plus {
            transform: rotate(45deg);
        }
        
        /* Floating animations for hero */
        @keyframes float-slow {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float-slow {
            animation: float-slow 5s ease-in-out infinite;
        }
        @keyframes float-fast {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float-fast {
            animation: float-fast 3s ease-in-out infinite;
        }

        /* Glow effects */
        .glow-bg {
            position: absolute;
            background: radial-gradient(circle, rgba(22,101,245,0.4) 0%, rgba(22,101,245,0) 70%);
            border-radius: 50%;
            filter: blur(40px);
            animation: pulse-glow 4s infinite alternate;
            z-index: 0;
        }
        @keyframes pulse-glow {
            0% { opacity: 0.5; transform: scale(1); }
            100% { opacity: 0.8; transform: scale(1.2); }
        }

        /* Infinite Marquee */
        .marquee-container {
            overflow: hidden;
            width: 100%;
            position: relative;
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: scrollLeft 35s linear infinite;
        }
        .marquee-track:hover {
            animation-play-state: paused;
        }
        @keyframes scrollLeft {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Card Hover Elevations */
        .card-hover-fx {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-hover-fx:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="antialiased">

    <!-- 1. TOP NAVBAR -->
    <nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 w-full bg-white/90 backdrop-blur-md border-b border-gray-100 z-50 transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-4 h-16 flex items-center justify-between">
            <!-- Left Side -->
            <a href="<?= base_url(); ?>" class="flex items-center gap-2 group">
                <img src="<?= base_url('assets/website/images/logo.png'); ?>" alt="Internmo Logo" class="h-11 w-auto object-contain group-hover:shadow-glow transition-all">
            </a>

            <!-- Center Menu -->
            <div class="hidden lg:flex items-center gap-6">
                <a href="<?= base_url(); ?>" class="text-sm font-semibold text-primary relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-primary">Home</a>
                
                <!-- Courses Dropdown Menu -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors py-2 flex items-center gap-1">
                        Courses <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="open ? 'rotate-180 text-primary' : ''"></i>
                    </button>
                    <!-- Mega Menu Dropdown -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-[600px] bg-white border border-slate-100 shadow-2xl rounded-2xl p-6 grid grid-cols-2 gap-4 z-50"
                         x-cloak>
                        
                        <!-- Col 1 -->
                        <div class="space-y-1">
                            <a href="<?= base_url('courses/full-stack-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-amber-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-laptop-code text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-primary transition-colors">Full Stack Dev</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Frontend & Backend</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/app-development'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-indigo-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-mobile-screen-button text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-indigo-600 transition-colors">App Development</div>
                                    <div class="text-[10px] text-slate-500 font-medium">iOS & Android Apps</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/cyber-security'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-shield-halved text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-emerald-600 transition-colors">Cyber Security</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Hacking & InfoSec</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/devops'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-sky-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-server text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-sky-600 transition-colors">DevOps</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Cloud Infrastructure</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-purple-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-brain text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-purple-600 transition-colors">Artificial Intelligence</div>
                                    <div class="text-[10px] text-slate-500 font-medium">ML & Generative AI</div>
                                </div>
                            </a>
                        </div>

                        <!-- Col 2 -->
                        <div class="space-y-1">
                            <a href="<?= base_url('courses/java-developer'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-red-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-brands fa-java text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-red-600 transition-colors">Java Developer</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Enterprise Java APIs</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/ui-ux'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-pink-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-palette text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-pink-600 transition-colors">UI/UX Design</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Product & Figma UI</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/data-science'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-violet-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-chart-line text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-violet-600 transition-colors">Data Science</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Modeling & Big Data</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/data-analyst'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-teal-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-magnifying-glass-chart text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-teal-600 transition-colors">Data Analyst</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Power BI & Dashboards</div>
                                </div>
                            </a>

                            <a href="<?= base_url('courses/digital-marketing'); ?>" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-orange-50/50 transition-colors group">
                                <div class="w-9 h-9 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-bullhorn text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-dark group-hover:text-orange-600 transition-colors">Digital Marketing</div>
                                    <div class="text-[10px] text-slate-500 font-medium">Growth & Search Ads</div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <a href="#internships" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-primary after:transition-all hover:after:w-full">Internships</a>
                <a href="#placements" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-primary after:transition-all hover:after:w-full">Placements</a>
                <a href="#ai-tools" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-primary after:transition-all hover:after:w-full">AI Tools</a>
                <a href="#projects" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-primary after:transition-all hover:after:w-full">Projects</a>
                <a href="<?= base_url('contact'); ?>" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-primary after:transition-all hover:after:w-full">Contact Us</a>
            </div>

            <!-- Right Side Buttons -->
            <div class="flex items-center gap-3">
                <a href="<?= base_url('login'); ?>" class="btn btn-outline py-2 px-5 text-xs hidden sm:inline-flex">Login</a>
                <a href="<?= base_url('register'); ?>" class="btn btn-primary py-2 px-5 text-xs group hidden sm:inline-flex">Apply Now <i class="fa-solid fa-arrow-right text-[10px] opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all"></i></a>
                
                <!-- Mobile hamburger toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors" aria-label="Toggle menu">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-2 shadow-inner"
             x-cloak>
            <a href="<?= base_url(); ?>" class="block py-2 px-3 rounded-lg text-sm font-semibold text-slate-800 hover:bg-amber-50 hover:text-amber-600 transition-colors">Home</a>
            <div class="py-1 px-3 text-xs font-bold text-slate-400 uppercase tracking-wider mt-2">Courses</div>
            <a href="<?= base_url('courses/full-stack-development'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Full Stack Dev</a>
            <a href="<?= base_url('courses/app-development'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">App Development</a>
            <a href="<?= base_url('courses/cyber-security'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Cyber Security</a>
            <a href="<?= base_url('courses/devops'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">DevOps</a>
            <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition-colors">Artificial Intelligence</a>
            <a href="<?= base_url('courses/java-developer'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors">Java Developer</a>
            <a href="<?= base_url('courses/ui-ux'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-pink-50 hover:text-pink-600 transition-colors">UI/UX Design</a>
            <a href="<?= base_url('courses/data-science'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-600 transition-colors">Data Science</a>
            <a href="<?= base_url('courses/data-analyst'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-teal-50 hover:text-teal-600 transition-colors">Data Analyst</a>
            <a href="<?= base_url('courses/digital-marketing'); ?>" class="block py-2 px-4 rounded-lg text-sm text-slate-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">Digital Marketing</a>
            <div class="border-t border-slate-100 pt-3 mt-2 space-y-2">
                <a href="#internships" @click="mobileMenuOpen = false" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Internships</a>
                <a href="#placements" @click="mobileMenuOpen = false" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Placements</a>
                <a href="#ai-tools" @click="mobileMenuOpen = false" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">AI Tools</a>
                <a href="<?= base_url('contact'); ?>" class="block py-2 px-3 rounded-lg text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors">Contact Us</a>
            </div>
            <div class="flex gap-2 pt-3 border-t border-slate-100">
                <a href="<?= base_url('login'); ?>" class="flex-1 btn btn-outline py-2 text-xs text-center">Login</a>
                <a href="<?= base_url('register'); ?>" class="flex-1 btn btn-primary py-2 text-xs text-center">Apply Now</a>
            </div>
        </div>
    </nav>

    <!-- 2. HERO SECTION -->
    <section class="pt-16 pb-12 overflow-hidden bg-white relative">
        <!-- Abstract Background Elements -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-b from-amber-50/50 to-transparent -z-10"></div>
        <div class="glow-bg top-20 right-40 w-[400px] h-[400px]"></div>

        <div class="max-w-[1400px] mx-auto px-4 grid lg:grid-cols-2 gap-12 items-center relative z-10">
            
            <!-- Left Side -->
            <div class="space-y-6 lg:pr-10" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 text-primary px-4 py-1.5 rounded-full text-xs font-bold shadow-sm" data-aos="fade-down" data-aos-delay="100">
                    <span class="text-orange-500 animate-pulse">🔥</span> India's Most Practical Tech Program
                </div>
                
                <h1 class="text-4xl lg:text-[54px] font-black text-dark leading-[1.1] tracking-tight" data-aos="fade-up" data-aos-delay="200">
                    Become Job Ready with <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-600">Real Projects & AI Learning</span>
                </h1>
                
                <p class="text-[16px] text-slate-600 leading-relaxed max-w-lg" data-aos="fade-up" data-aos-delay="300">
                    Master Full Stack Development, AI Tools & Real Industry Skills with Live Mentorship and Internship Support.
                </p>
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-start gap-2 group cursor-pointer">
                        <div class="mt-1 text-primary text-sm group-hover:scale-125 transition-transform"><i class="fa-solid fa-rocket"></i></div>
                        <div>
                            <div class="font-black text-dark text-sm group-hover:text-primary transition-colors">4500+</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase">Placements</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 group cursor-pointer">
                        <div class="mt-1 text-emerald-500 text-sm group-hover:scale-125 transition-transform"><i class="fa-solid fa-building"></i></div>
                        <div>
                            <div class="font-black text-dark text-sm group-hover:text-emerald-500 transition-colors">800+</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase">Hiring Companies</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 group cursor-pointer">
                        <div class="mt-1 text-green-500 text-sm group-hover:scale-125 transition-transform"><i class="fa-solid fa-chart-line"></i></div>
                        <div>
                            <div class="font-black text-dark text-sm group-hover:text-green-500 transition-colors">₹1.5 Cr</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase">Highest Package</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 group cursor-pointer">
                        <div class="mt-1 text-purple-500 text-sm group-hover:scale-125 transition-transform"><i class="fa-solid fa-users"></i></div>
                        <div>
                            <div class="font-black text-dark text-sm group-hover:text-purple-500 transition-colors">2L+</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase">Students Trained</div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-2" data-aos="fade-up" data-aos-delay="500">
                    <a href="#courses" class="btn btn-primary text-[15px] px-8 py-3.5 shadow-glow">Explore Courses <i class="fa-solid fa-arrow-right text-xs"></i></a>
                    <a href="#" class="btn btn-outline border-slate-300 text-[15px] px-8 py-3.5 bg-white text-dark hover:bg-slate-50 hover:shadow-md">Watch Demo <i class="fa-regular fa-circle-play ml-1 text-primary"></i></a>
                </div>
            </div>

            <!-- Right Side (Complex Collage) -->
            <div class="relative z-10 h-[550px] w-full hidden lg:block" data-aos="zoom-in-left" data-aos-duration="1000">
                <!-- Background Blob -->
                <div class="absolute inset-0 bg-gradient-to-tr from-[#eef2ff] to-[#e0e7ff] rounded-[50px] transform rotate-3 scale-105 opacity-80 z-0"></div>
                
                <!-- Collage Container -->
                <div class="absolute inset-0 z-10">
                    
                    <!-- Top Left Student -->
                    <div class="absolute top-4 left-4 w-32 h-40 rounded-2xl overflow-hidden shadow-2xl border-4 border-white animate-float-slow hover:z-20 transition-all cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?auto=format&fit=crop&w=300&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                    </div>

                    <!-- Dashboard Card -->
                    <div class="absolute top-8 left-40 right-10 bg-white/90 backdrop-blur-md rounded-2xl shadow-card p-5 border border-white animate-float-fast hover:scale-105 transition-transform cursor-pointer" style="animation-delay: 1s;">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-2 h-2 rounded-full bg-red-400"></div>
                            <div class="w-2 h-2 rounded-full bg-amber-400"></div>
                            <div class="w-2 h-2 rounded-full bg-green-400"></div>
                            <div class="text-xs font-bold text-slate-800 ml-2">Your Learning Dashboard</div>
                        </div>
                        <div class="flex justify-between gap-3">
                            <div class="bg-amber-50/80 p-3 rounded-xl flex-1 group hover:bg-primary transition-colors">
                                <div class="text-[10px] text-slate-500 mb-1 group-hover:text-amber-100 transition-colors">Courses</div>
                                <div class="font-black text-xl group-hover:text-white transition-colors">4</div>
                            </div>
                            <div class="bg-emerald-50/80 p-3 rounded-xl flex-1 group hover:bg-emerald-500 transition-colors">
                                <div class="text-[10px] text-slate-500 mb-1 group-hover:text-emerald-100 transition-colors">Projects</div>
                                <div class="font-black text-xl group-hover:text-white transition-colors">12</div>
                            </div>
                            <div class="bg-orange-50/80 p-3 rounded-xl flex-1 group hover:bg-orange-500 transition-colors">
                                <div class="text-[10px] text-slate-500 mb-1 group-hover:text-orange-100 transition-colors">Mock Int.</div>
                                <div class="font-black text-xl group-hover:text-white transition-colors">32</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Left Student -->
                    <div class="absolute bottom-12 left-16 w-36 h-48 rounded-2xl overflow-hidden shadow-2xl border-4 border-white animate-float-slow hover:z-20 transition-all cursor-pointer" style="animation-delay: 1.5s;">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 bg-emerald-500 text-white text-[10px] font-bold px-3 py-1 rounded shadow-lg whitespace-nowrap flex items-center gap-1"><i class="fa-solid fa-check-circle text-[8px]"></i> Got Placed</div>
                    </div>

                    <!-- Bottom Right Student -->
                    <div class="absolute bottom-4 right-4 w-44 h-56 rounded-2xl overflow-hidden shadow-2xl border-4 border-white animate-float-fast hover:z-20 transition-all cursor-pointer" style="animation-delay: 0.5s;">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover object-top hover:scale-110 transition-transform duration-700">
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-[11px] font-bold px-4 py-1.5 rounded-full shadow-lg whitespace-nowrap flex items-center gap-1"><i class="fa-solid fa-briefcase text-[9px]"></i> Internship Secured</div>
                    </div>

                    <!-- Placement Highlights Graph -->
                    <div class="absolute bottom-20 left-60 right-32 bg-white/95 backdrop-blur-md rounded-2xl shadow-card p-5 border border-white animate-float-slow hover:scale-105 transition-transform cursor-pointer" style="animation-delay: 2.5s;">
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-[11px] font-bold text-slate-800">Placement Highlights</div>
                            <div class="w-6 h-6 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-[10px]"><i class="fa-solid fa-arrow-trend-up"></i></div>
                        </div>
                        <div class="flex gap-4 mb-2">
                            <div>
                                <div class="font-black text-base text-dark">4,500+</div>
                                <div class="text-[9px] text-slate-500 uppercase font-semibold">Total Offers</div>
                            </div>
                            <div>
                                <div class="font-black text-base text-dark">₹1.5 Cr</div>
                                <div class="text-[9px] text-slate-500 uppercase font-semibold">Highest Pkg</div>
                            </div>
                            <div>
                                <div class="font-black text-base text-emerald-500">92%</div>
                                <div class="text-[9px] text-slate-500 uppercase font-semibold">Placements</div>
                            </div>
                        </div>
                        <!-- Animated SVG Sparkline -->
                        <div class="h-10 w-full mt-3 relative overflow-hidden">
                            <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
                                <path d="M0 25 L10 20 L20 22 L30 15 L40 18 L50 10 L60 12 L70 5 L80 8 L90 2 L100 0" fill="none" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <animate attributeName="stroke-dasharray" from="0, 500" to="500, 0" dur="2s" fill="freeze" />
                                </path>
                                <path d="M0 25 L10 20 L20 22 L30 15 L40 18 L50 10 L60 12 L70 5 L80 8 L90 2 L100 0 L100 30 L0 30 Z" fill="url(#grad)" opacity="0.3">
                                    <animate attributeName="opacity" values="0;0.3" dur="2s" fill="freeze" />
                                </path>
                                <defs>
                                    <linearGradient id="grad" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#10B981"/>
                                        <stop offset="100%" stop-color="white" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Animated Logos Below Hero -->
        <div class="max-w-[1400px] mx-auto px-4 mt-16 pb-12 border-t border-slate-100 pt-16 text-center relative overflow-hidden" data-aos="fade-up" data-aos-offset="0">
            <h2 class="text-3xl md:text-4xl font-bold text-dark mb-12 text-center uppercase tracking-tight">Get experienced and job ready for <span class="text-primary">800+</span> top companies</h2>
            
            <!-- Row 1 -->
            <div class="marquee-container mb-8">
                <div class="marquee-track">
                    <!-- Set 1 -->
                    <div class="flex gap-16 lg:gap-24 items-center pl-16">
                        <div class="font-black text-black text-3xl tracking-tight hover:scale-110 transition-transform cursor-pointer">amazon</div>
                        <div class="flex items-center gap-2 font-bold text-[#0668E1] text-2xl hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-meta"></i> Meta</div>
                        <div class="font-bold text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer"><span class="text-[#4285F4]">G</span><span class="text-[#EA4335]">o</span><span class="text-[#FBBC05]">o</span><span class="text-[#4285F4]">g</span><span class="text-[#34A853]">l</span><span class="text-[#EA4335]">e</span></div>
                        <div class="flex items-center gap-2 font-semibold text-[#737373] text-2xl hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-microsoft text-[#00a4ef]"></i> Microsoft</div>
                        <div class="font-bold text-[#5e239d] text-2xl tracking-tight flex items-center gap-1 hover:scale-110 transition-transform cursor-pointer"><i class="fa-solid fa-p"></i>PhonePe</div>
                        <div class="font-black text-[#E23744] text-3xl tracking-tight italic hover:scale-110 transition-transform cursor-pointer">zomato</div>
                        <div class="font-bold text-[#0052FF] text-2xl tracking-tight hover:scale-110 transition-transform cursor-pointer">coinbase</div>
                        <div class="font-black text-3xl hover:scale-110 transition-transform cursor-pointer"><span class="text-[#002970]">pay</span><span class="text-[#00baf2]">tm</span></div>
                        <div class="font-bold text-black text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer">Uber</div>
                        <div class="font-black text-[#00A1E0] text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer"><i class="fa-solid fa-cloud"></i> salesforce</div>
                    </div>
                    <!-- Set 2 -->
                    <div class="flex gap-16 lg:gap-24 items-center pl-16">
                        <div class="font-black text-black text-3xl tracking-tight hover:scale-110 transition-transform cursor-pointer">amazon</div>
                        <div class="flex items-center gap-2 font-bold text-[#0668E1] text-2xl hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-meta"></i> Meta</div>
                        <div class="font-bold text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer"><span class="text-[#4285F4]">G</span><span class="text-[#EA4335]">o</span><span class="text-[#FBBC05]">o</span><span class="text-[#4285F4]">g</span><span class="text-[#34A853]">l</span><span class="text-[#EA4335]">e</span></div>
                        <div class="flex items-center gap-2 font-semibold text-[#737373] text-2xl hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-microsoft text-[#00a4ef]"></i> Microsoft</div>
                        <div class="font-bold text-[#5e239d] text-2xl tracking-tight flex items-center gap-1 hover:scale-110 transition-transform cursor-pointer"><i class="fa-solid fa-p"></i>PhonePe</div>
                        <div class="font-black text-[#E23744] text-3xl tracking-tight italic hover:scale-110 transition-transform cursor-pointer">zomato</div>
                        <div class="font-bold text-[#0052FF] text-2xl tracking-tight hover:scale-110 transition-transform cursor-pointer">coinbase</div>
                        <div class="font-black text-3xl hover:scale-110 transition-transform cursor-pointer"><span class="text-[#002970]">pay</span><span class="text-[#00baf2]">tm</span></div>
                        <div class="font-bold text-black text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer">Uber</div>
                        <div class="font-black text-[#00A1E0] text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer"><i class="fa-solid fa-cloud"></i> salesforce</div>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="marquee-container mb-12" style="direction: rtl;">
                <div class="marquee-track" style="direction: ltr; animation-direction: reverse;">
                    <!-- Set 1 -->
                    <div class="flex gap-16 lg:gap-24 items-center pr-16">
                        <div class="font-black text-[#635BFF] text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer">stripe</div>
                        <div class="font-black text-[#E50914] text-3xl tracking-tight hover:scale-110 transition-transform cursor-pointer">NETFLIX</div>
                        <div class="font-black text-2xl flex items-center gap-1 text-[#2874F0] hover:scale-110 transition-transform cursor-pointer">Flipkart <span class="text-yellow-400 text-sm"><i class="fa-solid fa-bag-shopping"></i></span></div>
                        <div class="font-black text-[#0c2858] text-2xl tracking-tight border-l-4 border-[#3395ff] pl-1 hover:scale-110 transition-transform cursor-pointer">Razorpay</div>
                        <div class="font-black text-[#1a1f71] text-3xl tracking-widest italic hover:scale-110 transition-transform cursor-pointer">VISA</div>
                        <div class="font-bold text-[#0052CC] text-2xl tracking-tight flex items-center gap-2 hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-atlassian"></i> ATLASSIAN</div>
                        <div class="font-black text-[#003087] text-2xl tracking-tight italic flex items-center gap-1 hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-paypal text-[#009cde]"></i> PayPal</div>
                        <div class="font-black text-dark text-2xl tracking-widest border border-dark px-2 py-0.5 rounded hover:scale-110 transition-transform cursor-pointer">CRED</div>
                        <div class="font-black text-[#049fd9] text-2xl tracking-widest hover:scale-110 transition-transform cursor-pointer">CISCO</div>
                    </div>
                    <!-- Set 2 -->
                    <div class="flex gap-16 lg:gap-24 items-center pr-16">
                        <div class="font-black text-[#635BFF] text-3xl tracking-tighter hover:scale-110 transition-transform cursor-pointer">stripe</div>
                        <div class="font-black text-[#E50914] text-3xl tracking-tight hover:scale-110 transition-transform cursor-pointer">NETFLIX</div>
                        <div class="font-black text-2xl flex items-center gap-1 text-[#2874F0] hover:scale-110 transition-transform cursor-pointer">Flipkart <span class="text-yellow-400 text-sm"><i class="fa-solid fa-bag-shopping"></i></span></div>
                        <div class="font-black text-[#0c2858] text-2xl tracking-tight border-l-4 border-[#3395ff] pl-1 hover:scale-110 transition-transform cursor-pointer">Razorpay</div>
                        <div class="font-black text-[#1a1f71] text-3xl tracking-widest italic hover:scale-110 transition-transform cursor-pointer">VISA</div>
                        <div class="font-bold text-[#0052CC] text-2xl tracking-tight flex items-center gap-2 hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-atlassian"></i> ATLASSIAN</div>
                        <div class="font-black text-[#003087] text-2xl tracking-tight italic flex items-center gap-1 hover:scale-110 transition-transform cursor-pointer"><i class="fa-brands fa-paypal text-[#009cde]"></i> PayPal</div>
                        <div class="font-black text-dark text-2xl tracking-widest border border-dark px-2 py-0.5 rounded hover:scale-110 transition-transform cursor-pointer">CRED</div>
                        <div class="font-black text-[#049fd9] text-2xl tracking-widest hover:scale-110 transition-transform cursor-pointer">CISCO</div>
                    </div>
                </div>
            </div>

            <a href="#placements" class="btn bg-primary hover:bg-primary-dark text-white px-8 py-3.5 shadow-glow inline-block text-[15px] rounded-lg">See Placement Report</a>
        </div>
    </section>

    <!-- 3.5 WHAT WE HAVE FOR YOU -->
    <section class="py-24 bg-white relative">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-5xl font-black text-dark mb-6">What we have for you</h2>
                <p class="text-slate-500 text-[15px] leading-relaxed">At Internmo, we focus on delivering career-focused courses that help you gain practical skills and land real jobs quickly. Learn the skills employers are looking for and accelerate your career growth today.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Card 1 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-[0_20px_40px_-15px_rgba(245,158,11,0.15)] hover:border-amber-200 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-amber-50 text-primary rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all"><i class="fa-solid fa-users-gear"></i></div>
                    <h3 class="text-xl font-bold text-dark mb-3">Fellowship</h3>
                    <p class="text-slate-500 text-[14px] leading-relaxed mb-8">Get dedicated career guidance and mentoring from our mentors to enhance your resume using our builder.</p>
                    <a href="#" class="text-primary font-bold text-[14px] flex items-center gap-2 group-hover:gap-3 transition-all">Explore <i class="fa-solid fa-arrow-right text-[12px]"></i></a>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.15)] hover:border-emerald-200 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all"><i class="fa-solid fa-laptop-code"></i></div>
                    <h3 class="text-xl font-bold text-dark mb-3">Courses</h3>
                    <p class="text-slate-500 text-[14px] leading-relaxed mb-8">Get dedicated career guidance and mentoring from our mentors to enhance your resume using our builder.</p>
                    <a href="#courses" class="text-emerald-500 font-bold text-[14px] flex items-center gap-2 group-hover:gap-3 transition-all">Explore <i class="fa-solid fa-arrow-right text-[12px]"></i></a>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-[0_20px_40px_-15px_rgba(249,115,22,0.15)] hover:border-orange-200 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-orange-500 group-hover:text-white transition-all"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                    <h3 class="text-xl font-bold text-dark mb-3">ATS</h3>
                    <p class="text-slate-500 text-[14px] leading-relaxed mb-8">Get dedicated career guidance and mentoring from our mentors to enhance your resume using our builder.</p>
                    <a href="#" class="text-orange-500 font-bold text-[14px] flex items-center gap-2 group-hover:gap-3 transition-all">Explore <i class="fa-solid fa-arrow-right text-[12px]"></i></a>
                </div>

                <!-- Card 4 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-[0_20px_40px_-15px_rgba(168,85,247,0.15)] hover:border-purple-200 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-purple-500 group-hover:text-white transition-all"><i class="fa-solid fa-file-signature"></i></div>
                    <h3 class="text-xl font-bold text-dark mb-3">Resume Builder</h3>
                    <p class="text-slate-500 text-[14px] leading-relaxed mb-8">Get dedicated career guidance and mentoring from our mentors to enhance your resume using our builder.</p>
                    <a href="#" class="text-purple-500 font-bold text-[14px] flex items-center gap-2 group-hover:gap-3 transition-all">Explore <i class="fa-solid fa-arrow-right text-[12px]"></i></a>
                </div>

                <!-- Card 5 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-[0_20px_40px_-15px_rgba(236,72,153,0.15)] hover:border-pink-200 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-14 h-14 bg-pink-50 text-pink-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-pink-500 group-hover:text-white transition-all"><i class="fa-solid fa-briefcase"></i></div>
                    <h3 class="text-xl font-bold text-dark mb-3">Job Portal</h3>
                    <p class="text-slate-500 text-[14px] leading-relaxed mb-8">Get dedicated career guidance and mentoring from our mentors to improve your job prospects on our portal.</p>
                    <a href="#" class="text-pink-500 font-bold text-[14px] flex items-center gap-2 group-hover:gap-3 transition-all">Explore <i class="fa-solid fa-arrow-right text-[12px]"></i></a>
                </div>

                <!-- Card 6 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-[0_20px_40px_-15px_rgba(14,165,233,0.15)] hover:border-sky-200 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-14 h-14 bg-sky-50 text-sky-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-sky-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Know your CTC</h3>
                    <p class="text-slate-500 text-[14px] leading-relaxed mb-8">Optimize your resume with our AI-powered Resume Checker to meet industry standards.</p>
                    <a href="#" class="text-sky-500 font-bold text-[14px] flex items-center gap-2 group-hover:gap-3 transition-all">Explore <i class="fa-solid fa-arrow-right text-[12px]"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. WHY CHOOSE US (6 Cards Grid) -->
    <section class="py-20 bg-gradient-to-b from-slate-50 to-white relative">
        <div class="max-w-[1400px] mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-black text-center text-dark mb-12" data-aos="fade-up">Why Choose <span class="text-primary">Internmo?</span></h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
                <div class="bg-white border border-slate-100/60 rounded-2xl p-6 text-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-amber-50 text-primary rounded-full flex items-center justify-center mx-auto mb-5 text-lg group-hover:scale-110 transition-transform"><i class="fa-solid fa-graduation-cap"></i></div>
                    <h4 class="font-bold text-[13px] text-dark mb-2 leading-tight">Industry-tailored Learning</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Industry-oriented curriculum designed by top tech experts.</p>
                </div>
                
                <div class="bg-white border border-slate-100/60 rounded-2xl p-6 text-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-5 text-lg"><i class="fa-solid fa-robot"></i></div>
                    <h4 class="font-bold text-[13px] text-dark mb-2 leading-tight">AI-powered Learning</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">AI tools, mock interviews, and smart doubt support.</p>
                </div>

                <div class="bg-white border border-slate-100/60 rounded-2xl p-6 text-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5 text-lg"><i class="fa-solid fa-laptop-code"></i></div>
                    <h4 class="font-bold text-[13px] text-dark mb-2 leading-tight">Real-world Projects</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Build industry-grade projects and strong portfolio.</p>
                </div>

                <div class="bg-white border border-slate-100/60 rounded-2xl p-6 text-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-5 text-lg"><i class="fa-solid fa-building-user"></i></div>
                    <h4 class="font-bold text-[13px] text-dark mb-2 leading-tight">Internship Support</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Work on real startup projects with internship guidance.</p>
                </div>

                <div class="bg-white border border-slate-100/60 rounded-2xl p-6 text-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-5 text-lg"><i class="fa-solid fa-microphone"></i></div>
                    <h4 class="font-bold text-[13px] text-dark mb-2 leading-tight">1000+ Mock Interviews</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Unlimited mock interviews with AI feedback.</p>
                </div>

                <div class="bg-white border border-slate-100/60 rounded-2xl p-6 text-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-5 text-lg"><i class="fa-solid fa-handshake-simple"></i></div>
                    <h4 class="font-bold text-[13px] text-dark mb-2 leading-tight">Lifetime Placement Assistance</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">We support you till you get placed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. OUR OFFERINGS (Courses) -->
    <section id="courses" class="py-20 bg-white">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="flex items-end justify-between mb-10" data-aos="fade-up">
                <div>
                    <div class="text-[10px] font-bold text-primary uppercase tracking-widest mb-2 flex items-center gap-2"><div class="w-8 h-px bg-primary"></div> COURSES</div>
                    <h2 class="text-3xl md:text-4xl font-black text-dark">Our Offerings</h2>
                </div>
                <a href="#" class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors group flex items-center gap-1">View all courses <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Card 1: Full Stack Development -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 to-orange-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Full Stack<br>Development</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-amber-50 text-amber-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE / HYBRID</span>
                        <span class="bg-amber-50 text-amber-600 text-[10px] font-bold px-2 py-1 rounded">6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 4, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-primary">₹3,500 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> HTML, CSS, JS & React</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Node.js & Express API</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> SQL & MongoDB Databases</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> 10+ Real-world Projects</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> 100% Placement Support</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=1" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=2" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-amber-100 text-amber-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">2,500+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/full-stack-development'); ?>" class="btn bg-primary hover:bg-primary-dark text-white w-full py-2.5 text-xs shadow-md shadow-amber-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 2: App Development -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">App<br>Development</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">4 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 10, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-emerald-600">₹3,000 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Flutter & Dart Core</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> React Native Architecture</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> iOS & Android Ecosystems</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> App Store Deployment</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Live Client App projects</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=3" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=4" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,800+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/app-development'); ?>" class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 3: Cyber Security -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-rose-500 to-red-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Cyber<br>Security</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-rose-50 text-rose-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-rose-50 text-rose-600 text-[10px] font-bold px-2 py-1 rounded">6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 15, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-rose-600">₹4,000 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Ethical Hacking & Security</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Penetration Testing Labs</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Network Defense Principles</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Cryptographic Protocols</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> OWASP & CEH Training</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=5" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=6" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-rose-100 text-rose-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,200+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/cyber-security'); ?>" class="btn bg-rose-600 hover:bg-rose-700 text-white w-full py-2.5 text-xs shadow-md shadow-rose-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 4: DevOps -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-indigo-500 to-indigo-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">DevOps<br>Engineering</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-indigo-50 text-indigo-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-indigo-50 text-indigo-600 text-[10px] font-bold px-2 py-1 rounded">5 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 12, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-indigo-600">₹3,800 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Docker & Containers</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Kubernetes Orchestration</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> CI/CD Pipelines</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> AWS Cloud & Terraform</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Infrastructure as Code</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=7" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=8" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,400+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/devops'); ?>" class="btn bg-indigo-600 hover:bg-indigo-700 text-white w-full py-2.5 text-xs shadow-md shadow-indigo-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 5: Artificial Intelligence -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-violet-500 to-purple-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-violet-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Artificial<br>Intelligence (AI)</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-violet-50 text-violet-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-violet-50 text-violet-600 text-[10px] font-bold px-2 py-1 rounded">8 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 8, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-violet-600">₹5,000 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Python, Numpy & Pandas</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Deep Learning & NLP</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Computer Vision (CNNs)</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Large Language Models (LLMs)</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> PyTorch & TensorFlow frameworks</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=9" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=10" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-violet-100 text-violet-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">3,200+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/artificial-intelligence'); ?>" class="btn bg-violet-600 hover:bg-violet-700 text-white w-full py-2.5 text-xs shadow-md shadow-violet-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 6: Java Developer -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 to-orange-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Java<br>Developer</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-amber-50 text-amber-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-amber-50 text-amber-600 text-[10px] font-bold px-2 py-1 rounded">5 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 5, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-amber-600">₹2,800 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Core Java & Object Oriented design</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Spring Boot & Microservices</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Hibernate & Database Relational mapping</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Data Structures & Algorithms</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Scalable Backend System Design</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=11" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=12" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-amber-100 text-amber-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">2,100+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/java-developer'); ?>" class="btn bg-amber-600 hover:bg-amber-700 text-white w-full py-2.5 text-xs shadow-md shadow-amber-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 7: UI/UX -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-pink-500 to-rose-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-pink-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">UI/UX<br>Design</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-pink-50 text-pink-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-pink-50 text-pink-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 18, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-pink-600">₹2,500 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> User Research & Personas</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Figma Prototyping & Layouts</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Color Theory & Layout Grids</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Comprehensive Design Systems</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Usability Testing & Portfolios</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=13" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=14" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-pink-100 text-pink-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,500+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/ui-ux'); ?>" class="btn bg-pink-600 hover:bg-pink-700 text-white w-full py-2.5 text-xs shadow-md shadow-pink-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 8: Data Science -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-sky-500 to-cyan-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Data<br>Science</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-sky-50 text-sky-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-sky-50 text-sky-600 text-[10px] font-bold px-2 py-1 rounded">7 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 4, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-sky-600">₹4,500 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Python Programming & SQL Queries</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Probability & Applied Statistics</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Predictive Machine Learning Models</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Interactive Data Visualizations</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Feature Engineering & Hypertuning</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=15" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=16" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-sky-100 text-sky-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">2,800+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/data-science'); ?>" class="btn bg-sky-600 hover:bg-sky-700 text-white w-full py-2.5 text-xs shadow-md shadow-sky-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 9: Data Analyst -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-teal-500 to-emerald-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Data<br>Analyst</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-teal-50 text-teal-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-teal-50 text-teal-600 text-[10px] font-bold px-2 py-1 rounded">4 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 14, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-teal-600">₹2,700 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Advanced Excel Data Analysis</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Relational Database SQL queries</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Power BI & Tableau Dashboards</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Business Metrics & Reporting</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Data Cleaning & ETL Pipelines</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=17" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=18" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-teal-100 text-teal-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,900+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/data-analyst'); ?>" class="btn bg-teal-600 hover:bg-teal-700 text-white w-full py-2.5 text-xs shadow-md shadow-teal-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Card 10: Digital Marketing -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-fuchsia-500 to-purple-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-fuchsia-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Digital<br>Marketing</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-fuchsia-50 text-fuchsia-600 text-[10px] font-bold px-2 py-1 rounded">ONLINE</span>
                        <span class="bg-fuchsia-50 text-fuchsia-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Batch Starts</div>
                            <div class="text-xs font-bold text-dark">Jun 20, 2026</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">EMI from</div>
                            <div class="text-xs font-bold text-fuchsia-600">₹1,800 <span class="text-[9px] text-slate-400 font-normal">/month*</span></div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Search Engine Optimization (SEO)</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Google Ads & Paid Search (SEM)</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Social Media Marketing & Ads</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Analytics & Campaign Auditing</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-green-500 mt-0.5 text-sm"></i> Email Marketing & Strategies</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=19" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=20" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-fuchsia-100 text-fuchsia-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">2,400+ Enrolled</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <a href="<?= base_url('courses/digital-marketing'); ?>" class="btn bg-fuchsia-600 hover:bg-fuchsia-700 text-white w-full py-2.5 text-xs shadow-md shadow-fuchsia-500/20">Explore</a>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Brochure <i class="fa-solid fa-download ml-1 text-slate-400"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5.5 INTERNSHIP PROGRAMS -->
    <section id="internships" class="py-20 bg-slate-50/50 border-t border-slate-100">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="flex items-end justify-between mb-10" data-aos="fade-up">
                <div>
                    <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mb-2 flex items-center gap-2"><div class="w-8 h-px bg-emerald-500"></div> INTERNSHIPS</div>
                    <h2 class="text-3xl md:text-4xl font-black text-dark">Internship Opportunities</h2>
                </div>
                <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors group flex items-center gap-1">View all internships <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Internship Card 1: Full Stack Development -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Full Stack<br>Development</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE / HYBRID</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹15,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">15 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Live Client React & Node.js work</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Collaborative Git workflow & PRs</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Agile standups & Sprint tasks</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Expert technical mentor guidance</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=1" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=2" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,200+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 2: App Development -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">App<br>Development</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹12,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">8 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Custom Flutter UI components</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Rest API integrations & testing</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> App & Play Store deployments</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Active code review cycles</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=3" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=4" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">950+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 3: Cyber Security -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Cyber<br>Security</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹18,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">5 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Assist on vulnerability scanning</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Validate system security patches</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Firewall & log monitoring tasks</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Threat intelligence reviews</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=5" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=6" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">600+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 4: DevOps -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">DevOps<br>Engineering</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE / HYBRID</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹15,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">6 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> AWS sandbox infrastructure tasks</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Continuous integration script writes</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Optimize Docker image dimensions</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Kubernetes sandbox tests</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=7" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=8" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">820+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 5: Artificial Intelligence -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Artificial<br>Intelligence (AI)</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹20,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">4 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Large Language Model fine tuning</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Embeddings & RAG architectures</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Dataset cleaning and filtering</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Model training validations</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=9" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=10" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,500+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 6: Java Developer -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Java<br>Developer</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">3-6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹12,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">10 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Spring Boot REST API updates</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Database migrations & schema updates</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Write unit & integration JUnit tests</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Debugging server trace logs</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=11" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=12" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,100+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 7: UI/UX -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">UI/UX<br>Design</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹12,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">7 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Prepare Figma design handoffs</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Assist on user interview schedules</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Run interactive prototyping checks</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Design system component audits</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=13" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=14" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">780+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 8: Data Science -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Data<br>Science</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">6 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹15,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">5 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Validate predictive algorithms</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Run exploratory feature engineering</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Organize Jupyter workflows & charts</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Clean raw inputs & handle outliers</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=15" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=16" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,150+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 9: Data Analyst -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Data<br>Analyst</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹10,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">8 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Construct Power BI visual cards</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Run clean-up SQL query routines</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Assist on weekly reporting summaries</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Build custom pivot tables in Excel</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=17" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=18" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">900+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>

                <!-- Internship Card 10: Digital Marketing -->
                <div class="bg-white border border-slate-200 rounded-2xl p-7 flex flex-col relative overflow-hidden card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 opacity-50"></div>
                    
                    <h3 class="font-bold text-xl text-dark mb-4 leading-tight mt-2 h-14 relative z-10">Digital<br>Marketing</h3>
                    <div class="flex gap-2 mb-6 relative z-10">
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">REMOTE</span>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded">3 MONTHS</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-100 relative z-10">
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Stipend up to</div>
                            <div class="text-xs font-bold text-emerald-600">₹8,000 <span class="text-[9px] text-slate-400 font-normal">/month</span></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-500 mb-1">Openings</div>
                            <div class="text-xs font-bold text-dark">12 Positions</div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-1 relative z-10">
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Help manage social media buffers</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> SEO audits & keyword analysis</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Draft copy & newsletter newsletters</div>
                        <div class="flex gap-3 text-[12px] text-slate-600 font-medium items-start"><i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-sm"></i> Track metrics using Analytics suite</div>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-5 relative z-10 bg-slate-50 p-2 rounded-lg">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/100?img=19" class="w-6 h-6 rounded-full border border-white">
                            <img src="https://i.pravatar.cc/100?img=20" class="w-6 h-6 rounded-full border border-white">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 border border-white flex items-center justify-center text-[8px] font-bold">+</div>
                        </div>
                        <div class="text-[11px] text-slate-600 font-semibold">1,050+ Applied</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 relative z-10">
                        <button class="btn bg-emerald-600 hover:bg-emerald-700 text-white w-full py-2.5 text-xs shadow-md shadow-emerald-500/20">Apply Now</button>
                        <button class="btn btn-outline border-slate-200 w-full py-2.5 text-xs text-dark hover:bg-slate-50">Details <i class="fa-solid fa-circle-info ml-1 text-slate-400"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. HORIZONTAL ROADMAP (Animated) -->
    <section class="py-24 bg-slate-50 overflow-hidden relative">
        <div class="max-w-[1200px] mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-black text-center text-dark mb-20" data-aos="fade-up">From Learning to Internship & Placement</h2>
            
            <div class="relative max-w-5xl mx-auto hidden md:block">
                <!-- Dashed Connecting Line (Animated glow via CSS) -->
                <div class="absolute top-6 left-[5%] right-[5%] h-1 bg-slate-200 rounded-full z-0 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary via-purple-500 to-emerald-500 w-1/2 animate-[scrollLeft_2s_linear_infinite]" style="width: 200%; background-size: 50% 100%;"></div>
                </div>
                
                <div class="grid grid-cols-7 gap-4 relative z-10">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center text-center group" data-aos="zoom-in" data-aos-delay="100">
                        <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-4 shadow-md border-4 border-white group-hover:scale-110 transition-transform duration-300"><i class="fa-solid fa-book-open"></i></div>
                        <div class="text-[13px] font-bold text-dark group-hover:text-primary transition-colors">Learn<br>Fundamentals</div>
                    </div>
                    <!-- Step 2 -->
                    <div class="flex flex-col items-center text-center group" data-aos="zoom-in" data-aos-delay="200">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4 shadow-md border-4 border-white group-hover:scale-110 transition-transform duration-300"><i class="fa-solid fa-code"></i></div>
                        <div class="text-[13px] font-bold text-dark group-hover:text-emerald-500 transition-colors">Build<br>Projects</div>
                    </div>
                    <!-- Step 3 -->
                    <div class="flex flex-col items-center text-center group" data-aos="zoom-in" data-aos-delay="300">
                        <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xl mb-4 shadow-md border-4 border-white group-hover:scale-110 transition-transform duration-300"><i class="fa-solid fa-users"></i></div>
                        <div class="text-[13px] font-bold text-dark group-hover:text-orange-500 transition-colors">Real Team<br>Collaboration</div>
                    </div>
                    <!-- Step 4 -->
                    <div class="flex flex-col items-center text-center group relative" data-aos="zoom-in" data-aos-delay="400">
                        <!-- Pulse Ring -->
                        <div class="absolute top-0 w-12 h-12 rounded-full bg-purple-400 opacity-50 animate-ping"></div>
                        <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl mb-4 shadow-md border-4 border-white group-hover:scale-110 transition-transform duration-300 relative z-10"><i class="fa-solid fa-laptop-file"></i></div>
                        <div class="text-[13px] font-bold text-dark group-hover:text-purple-600 transition-colors">Internship<br>Experience</div>
                    </div>
                    <!-- Step 5 -->
                    <div class="flex flex-col items-center text-center group" data-aos="zoom-in" data-aos-delay="500">
                        <div class="w-12 h-12 rounded-full bg-green-50 text-green-500 border border-green-200 flex items-center justify-center text-xl mb-4 shadow-sm bg-white group-hover:bg-green-100 transition-colors duration-300"><i class="fa-solid fa-microphone"></i></div>
                        <div class="text-[13px] font-bold text-slate-500 group-hover:text-dark transition-colors">Mock Int. &<br>Feedback</div>
                    </div>
                    <!-- Step 6 -->
                    <div class="flex flex-col items-center text-center group" data-aos="zoom-in" data-aos-delay="600">
                        <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-400 border border-orange-200 flex items-center justify-center text-xl mb-4 shadow-sm bg-white group-hover:bg-orange-100 transition-colors duration-300"><i class="fa-solid fa-file-contract"></i></div>
                        <div class="text-[13px] font-bold text-slate-500 group-hover:text-dark transition-colors">Placement<br>Preparation</div>
                    </div>
                    <!-- Step 7 -->
                    <div class="flex flex-col items-center text-center group" data-aos="zoom-in" data-aos-delay="700">
                        <div class="w-12 h-12 rounded-full bg-red-50 text-red-500 border border-red-200 flex items-center justify-center text-xl mb-4 shadow-sm bg-white group-hover:bg-red-100 transition-colors duration-300"><i class="fa-solid fa-trophy"></i></div>
                        <div class="text-[13px] font-bold text-slate-500 group-hover:text-dark transition-colors">Get<br>Hired</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. AI TOOLS -->
    <section id="ai-tools" class="py-20 bg-white">
        <div class="max-w-[1400px] mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-black text-center text-dark mb-12" data-aos="fade-up">AI Tools to Accelerate Your Success</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-6 flex flex-col shadow-sm card-hover-fx relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-2xl mb-5 relative z-10 group-hover:bg-primary group-hover:text-white transition-colors duration-300"><i class="fa-solid fa-user-tie"></i></div>
                    <h4 class="font-bold text-dark text-lg mb-2 relative z-10">AI Mock Interviews</h4>
                    <p class="text-[13px] text-slate-500 mb-6 leading-relaxed relative z-10 flex-1">Real-time AI interviews with smart feedback on communication and technical skills.</p>
                    <a href="#" class="text-[13px] font-bold text-primary hover:text-primary-dark flex items-center gap-1 group-hover:gap-2 transition-all relative z-10">Try Now <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
                <!-- Card 2 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-6 flex flex-col shadow-sm card-hover-fx relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl mb-5 relative z-10 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300"><i class="fa-solid fa-file-signature"></i></div>
                    <h4 class="font-bold text-dark text-lg mb-2 relative z-10">AI Resume Review</h4>
                    <p class="text-[13px] text-slate-500 mb-6 leading-relaxed relative z-10 flex-1">Get ATS score and actionable AI feedback to improve your resume instantly.</p>
                    <a href="<?= base_url('resume-checker') ?>" class="text-[13px] font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1 group-hover:gap-2 transition-all relative z-10">Try Now <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
                <!-- Card 3 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-6 flex flex-col shadow-sm card-hover-fx relative overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-2xl mb-5 relative z-10 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300"><i class="fa-solid fa-code"></i></div>
                    <h4 class="font-bold text-dark text-lg mb-2 relative z-10">AI Coding Assistant</h4>
                    <p class="text-[13px] text-slate-500 mb-6 leading-relaxed relative z-10 flex-1">Solve bugs, understand complex logic and get code suggestions directly in IDE.</p>
                    <a href="#" class="text-[13px] font-bold text-orange-600 hover:text-orange-800 flex items-center gap-1 group-hover:gap-2 transition-all relative z-10">Try Now <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
                <!-- Card 4 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-6 flex flex-col shadow-sm card-hover-fx relative overflow-hidden group" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-2xl mb-5 relative z-10 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300"><i class="fa-solid fa-compass"></i></div>
                    <h4 class="font-bold text-dark text-lg mb-2 relative z-10">AI Career Guidance</h4>
                    <p class="text-[13px] text-slate-500 mb-6 leading-relaxed relative z-10 flex-1">Personalized step-by-step roadmap tailored for your dream tech career.</p>
                    <a href="#" class="text-[13px] font-bold text-purple-600 hover:text-purple-800 flex items-center gap-1 group-hover:gap-2 transition-all relative z-10">Try Now <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. REAL INDUSTRY PROJECTS -->
    <section id="projects" class="py-20 bg-slate-50/50">
        <div class="max-w-[1400px] mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-black text-center text-dark mb-12" data-aos="fade-up">Build Real Industry Projects</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Project 1 -->
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm card-hover-fx group" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-32 bg-slate-100 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark"><i class="fa-solid fa-play"></i></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-dark text-[15px] mb-3 leading-tight group-hover:text-primary transition-colors">Food Delivery App</h4>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span class="px-2 py-0.5 bg-green-50 border border-green-100 text-green-700 text-[10px] font-bold rounded">React</span>
                            <span class="px-2 py-0.5 bg-green-50 border border-green-100 text-green-700 text-[10px] font-bold rounded">Node.js</span>
                            <span class="px-2 py-0.5 bg-green-50 border border-green-100 text-green-700 text-[10px] font-bold rounded">MongoDB</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <a href="#" class="text-[11px] font-bold text-primary hover:text-primary-dark transition-colors"><i class="fa-solid fa-link mr-1"></i> Live Demo</a>
                            <a href="#" class="text-[11px] font-bold text-slate-500 hover:text-dark transition-colors"><i class="fa-brands fa-github mr-1"></i> Source</a>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm card-hover-fx group" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-32 bg-slate-100 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark"><i class="fa-solid fa-play"></i></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-dark text-[15px] mb-3 leading-tight group-hover:text-primary transition-colors">E-commerce Platform</h4>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span class="px-2 py-0.5 bg-amber-50 border border-amber-100 text-amber-700 text-[10px] font-bold rounded">Next.js</span>
                            <span class="px-2 py-0.5 bg-green-50 border border-green-100 text-green-700 text-[10px] font-bold rounded">MongoDB</span>
                            <span class="px-2 py-0.5 bg-purple-50 border border-purple-100 text-purple-700 text-[10px] font-bold rounded">Stripe</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <a href="#" class="text-[11px] font-bold text-primary hover:text-primary-dark transition-colors"><i class="fa-solid fa-link mr-1"></i> Live Demo</a>
                            <a href="#" class="text-[11px] font-bold text-slate-500 hover:text-dark transition-colors"><i class="fa-brands fa-github mr-1"></i> Source</a>
                        </div>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm card-hover-fx group" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-32 bg-slate-100 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark"><i class="fa-solid fa-play"></i></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-dark text-[15px] mb-3 leading-tight group-hover:text-primary transition-colors">AI Chat Application</h4>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span class="px-2 py-0.5 bg-yellow-50 border border-yellow-100 text-yellow-700 text-[10px] font-bold rounded">Python</span>
                            <span class="px-2 py-0.5 bg-amber-50 border border-amber-100 text-amber-700 text-[10px] font-bold rounded">Langchain</span>
                            <span class="px-2 py-0.5 bg-slate-100 border border-slate-200 text-slate-700 text-[10px] font-bold rounded">OpenAI</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <a href="#" class="text-[11px] font-bold text-primary hover:text-primary-dark transition-colors"><i class="fa-solid fa-link mr-1"></i> Live Demo</a>
                            <a href="#" class="text-[11px] font-bold text-slate-500 hover:text-dark transition-colors"><i class="fa-brands fa-github mr-1"></i> Source</a>
                        </div>
                    </div>
                </div>

                <!-- Project 4 -->
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm card-hover-fx group" data-aos="fade-up" data-aos-delay="400">
                    <div class="h-32 bg-slate-100 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark"><i class="fa-solid fa-play"></i></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-dark text-[15px] mb-3 leading-tight group-hover:text-primary transition-colors">Travel Booking App</h4>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span class="px-2 py-0.5 bg-amber-50 border border-amber-100 text-amber-700 text-[10px] font-bold rounded">React</span>
                            <span class="px-2 py-0.5 bg-green-50 border border-green-100 text-green-700 text-[10px] font-bold rounded">Node.js</span>
                            <span class="px-2 py-0.5 bg-orange-50 border border-orange-100 text-orange-700 text-[10px] font-bold rounded">MySQL</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <a href="#" class="text-[11px] font-bold text-primary hover:text-primary-dark transition-colors"><i class="fa-solid fa-link mr-1"></i> Live Demo</a>
                            <a href="#" class="text-[11px] font-bold text-slate-500 hover:text-dark transition-colors"><i class="fa-brands fa-github mr-1"></i> Source</a>
                        </div>
                    </div>
                </div>

                <!-- Project 5 -->
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm card-hover-fx group" data-aos="fade-up" data-aos-delay="500">
                    <div class="h-32 bg-slate-100 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark"><i class="fa-solid fa-play"></i></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-dark text-[15px] mb-3 leading-tight group-hover:text-primary transition-colors">Job Portal Platform</h4>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span class="px-2 py-0.5 bg-slate-100 border border-slate-200 text-slate-700 text-[10px] font-bold rounded">MERN</span>
                            <span class="px-2 py-0.5 bg-slate-100 border border-slate-200 text-slate-700 text-[10px] font-bold rounded">JWT</span>
                            <span class="px-2 py-0.5 bg-amber-50 border border-amber-100 text-amber-700 text-[10px] font-bold rounded">Cloudinary</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <a href="#" class="text-[11px] font-bold text-primary hover:text-primary-dark transition-colors"><i class="fa-solid fa-link mr-1"></i> Live Demo</a>
                            <a href="#" class="text-[11px] font-bold text-slate-500 hover:text-dark transition-colors"><i class="fa-brands fa-github mr-1"></i> Source</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. PLACEMENT REPORT (Dark Banner) -->
    <section id="placements" class="py-20 bg-white relative overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-4 relative z-10" data-aos="zoom-in" data-aos-duration="1000">
            <div class="bg-[#0a192f] rounded-[2rem] p-10 lg:p-14 flex flex-col lg:flex-row items-center justify-between gap-12 relative overflow-hidden shadow-[0_20px_50px_rgba(10,25,47,0.3)] hover:shadow-[0_20px_50px_rgba(22,101,245,0.2)] transition-shadow duration-500">
                
                <!-- Abstract Glow inside banner -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-[100px] pointer-events-none"></div>

                <!-- Left Content -->
                <div class="w-full lg:w-1/3 text-left relative z-10">
                    <div class="inline-block bg-primary/10 border border-primary/20 text-primary text-[10px] font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-widest"><i class="fa-solid fa-star text-amber-400 mr-1"></i> Verified Outcomes</div>
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-4 leading-tight">Our Placement<br>Report</h2>
                    <p class="text-[13px] text-slate-400 mb-8 leading-relaxed max-w-sm">Transparent statistics of our learners' success, backed by real hiring data and verified offers.</p>
                    <button class="btn bg-white text-dark hover:bg-slate-100 text-[13px] px-8 py-3 group shadow-lg shadow-white/10">
                        Download Full Report <i class="fa-solid fa-arrow-down ml-1 group-hover:translate-y-1 transition-transform"></i>
                    </button>
                </div>

                <!-- Middle Stats -->
                <div class="w-full lg:w-1/3 grid grid-cols-2 gap-8 relative z-10">
                    <div class="absolute right-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-slate-700 to-transparent hidden lg:block"></div>
                    <div class="absolute bottom-1/2 left-0 right-0 h-px bg-gradient-to-r from-transparent via-slate-700 to-transparent hidden lg:block translate-y-4"></div>
                    
                    <div class="group cursor-pointer">
                        <div class="text-3xl font-black text-primary mb-1 group-hover:scale-110 transition-transform origin-left">4,500+</div>
                        <div class="text-[11px] text-slate-400 font-medium">Job Offers <span class="text-primary ml-1 bg-primary/10 px-1 rounded">+</span></div>
                    </div>
                    <div class="group cursor-pointer">
                        <div class="text-3xl font-black text-white mb-1 group-hover:scale-110 transition-transform origin-left">₹1.5 Cr</div>
                        <div class="text-[11px] text-slate-400 font-medium">Highest Package <span class="text-emerald-500 ml-1 bg-emerald-500/10 px-1 rounded">↑</span></div>
                    </div>
                    <div class="pt-8 border-t border-slate-800 lg:border-t-0 group cursor-pointer">
                        <div class="text-3xl font-black text-white mb-1 group-hover:scale-110 transition-transform origin-left">800+</div>
                        <div class="text-[11px] text-slate-400 font-medium">Hiring Companies</div>
                    </div>
                    <div class="pt-8 border-t border-slate-800 lg:border-t-0 group cursor-pointer">
                        <div class="text-3xl font-black text-emerald-400 mb-1 group-hover:scale-110 transition-transform origin-left">92%</div>
                        <div class="text-[11px] text-slate-400 font-medium">Placement Rate</div>
                    </div>
                </div>

                <!-- Right Bar Chart -->
                <div class="w-full lg:w-1/3 relative z-10 bg-slate-800/30 p-6 rounded-2xl border border-slate-700/50">
                    <div class="text-[11px] font-bold text-slate-300 mb-8 flex justify-between items-center">
                        Package Distribution (LPA)
                        <i class="fa-solid fa-chart-column text-slate-500"></i>
                    </div>
                    <div class="flex items-end justify-between gap-2 h-32 w-full border-b border-l border-slate-700 pb-1 px-2 group">
                        <!-- Bar 1 -->
                        <div class="relative flex flex-col items-center flex-1 h-full justify-end cursor-pointer group/bar">
                            <span class="absolute -top-6 text-[10px] text-white opacity-0 group-hover/bar:opacity-100 transition-opacity font-bold bg-slate-800 px-2 py-0.5 rounded shadow">34%</span>
                            <div class="w-full bg-gradient-to-t from-amber-700 to-amber-500 rounded-t-sm group-hover/bar:brightness-125 transition-all bar-chart-col" style="height: 0%;" data-height="85%"></div>
                            <span class="absolute -bottom-6 text-[9px] text-slate-400 font-medium">0-4</span>
                        </div>
                        <!-- Bar 2 -->
                        <div class="relative flex flex-col items-center flex-1 h-full justify-end cursor-pointer group/bar">
                            <span class="absolute -top-6 text-[10px] text-white opacity-0 group-hover/bar:opacity-100 transition-opacity font-bold bg-slate-800 px-2 py-0.5 rounded shadow">38%</span>
                            <div class="w-full bg-gradient-to-t from-amber-600 to-amber-400 rounded-t-sm group-hover/bar:brightness-125 transition-all bar-chart-col shadow-[0_0_15px_rgba(245,158,11,0.3)]" style="height: 0%;" data-height="95%"></div>
                            <span class="absolute -bottom-6 text-[9px] text-slate-400 font-medium">4-8</span>
                        </div>
                        <!-- Bar 3 -->
                        <div class="relative flex flex-col items-center flex-1 h-full justify-end cursor-pointer group/bar">
                            <span class="absolute -top-6 text-[10px] text-white opacity-0 group-hover/bar:opacity-100 transition-opacity font-bold bg-slate-800 px-2 py-0.5 rounded shadow">16%</span>
                            <div class="w-full bg-gradient-to-t from-amber-800 to-amber-600 rounded-t-sm group-hover/bar:brightness-125 transition-all bar-chart-col" style="height: 0%;" data-height="40%"></div>
                            <span class="absolute -bottom-6 text-[9px] text-slate-400 font-medium">8-12</span>
                        </div>
                        <!-- Bar 4 -->
                        <div class="relative flex flex-col items-center flex-1 h-full justify-end cursor-pointer group/bar">
                            <span class="absolute -top-6 text-[10px] text-white opacity-0 group-hover/bar:opacity-100 transition-opacity font-bold bg-slate-800 px-2 py-0.5 rounded shadow">12%</span>
                            <div class="w-full bg-gradient-to-t from-slate-700 to-amber-800 rounded-t-sm group-hover/bar:brightness-125 transition-all bar-chart-col" style="height: 0%;" data-height="30%"></div>
                            <span class="absolute -bottom-6 text-[9px] text-slate-400 font-medium">12-20</span>
                        </div>
                        <!-- Bar 5 -->
                        <div class="relative flex flex-col items-center flex-1 h-full justify-end cursor-pointer group/bar">
                            <span class="absolute -top-6 text-[10px] text-white opacity-0 group-hover/bar:opacity-100 transition-opacity font-bold bg-slate-800 px-2 py-0.5 rounded shadow">8%</span>
                            <div class="w-full bg-gradient-to-t from-slate-700 to-slate-500 rounded-t-sm group-hover/bar:brightness-125 transition-all bar-chart-col" style="height: 0%;" data-height="20%"></div>
                            <span class="absolute -bottom-6 text-[9px] text-slate-400 font-medium">20+</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- 11. INDUSTRY EXPERTS -->
    <section class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="flex items-end justify-between mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-black text-dark">Learn from <span class="text-primary">Industry Experts</span></h2>
                <a href="#" class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors group hidden md:flex items-center gap-1 border-b border-transparent hover:border-primary pb-1">View All Mentors <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white border border-slate-100 rounded-2xl p-5 flex gap-4 items-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://i.pravatar.cc/150?img=11" class="w-14 h-14 rounded-full object-cover border-2 border-slate-100 shadow-sm">
                    <div>
                        <h4 class="font-bold text-[15px] text-dark leading-tight">Vishal Sharma</h4>
                        <div class="text-[11px] text-slate-500 mb-1.5 font-medium">SDE-2</div>
                        <div class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 bg-slate-50 w-max px-2 py-0.5 rounded"><i class="fa-brands fa-microsoft text-[#00a4ef]"></i> Microsoft</div>
                    </div>
                </div>
                
                <div class="bg-white border border-slate-100 rounded-2xl p-5 flex gap-4 items-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://i.pravatar.cc/150?img=12" class="w-14 h-14 rounded-full object-cover border-2 border-slate-100 shadow-sm">
                    <div>
                        <h4 class="font-bold text-[15px] text-dark leading-tight">Gladden Ramac</h4>
                        <div class="text-[11px] text-slate-500 mb-1.5 font-medium">Technical Instructor</div>
                        <div class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 bg-slate-50 w-max px-2 py-0.5 rounded"><span class="text-[#4285F4]">G</span><span class="text-[#EA4335]">o</span><span class="text-[#FBBC05]">o</span><span class="text-[#4285F4]">g</span><span class="text-[#34A853]">l</span><span class="text-[#EA4335]">e</span></div>
                    </div>
                </div>

                <div class="bg-white border border-slate-100 rounded-2xl p-5 flex gap-4 items-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://i.pravatar.cc/150?img=13" class="w-14 h-14 rounded-full object-cover border-2 border-slate-100 shadow-sm">
                    <div>
                        <h4 class="font-bold text-[15px] text-dark leading-tight">Bhavesh Bansal</h4>
                        <div class="text-[11px] text-slate-500 mb-1.5 font-medium">Sr. Software Engineer</div>
                        <div class="text-[11px] font-bold text-[#2874F0] flex items-center gap-1.5 bg-slate-50 w-max px-2 py-0.5 rounded">Flipkart</div>
                    </div>
                </div>

                <div class="bg-white border border-slate-100 rounded-2xl p-5 flex gap-4 items-center shadow-soft card-hover-fx" data-aos="fade-up" data-aos-delay="400">
                    <img src="https://i.pravatar.cc/150?img=14" class="w-14 h-14 rounded-full object-cover border-2 border-slate-100 shadow-sm">
                    <div>
                        <h4 class="font-bold text-[15px] text-dark leading-tight">Priya Gurjar</h4>
                        <div class="text-[11px] text-slate-500 mb-1.5 font-medium">Program Manager</div>
                        <div class="text-[11px] font-bold text-slate-700 flex items-center gap-1.5 bg-slate-50 w-max px-2 py-0.5 rounded"><i class="fa-solid fa-building text-slate-400"></i> IIT</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 12. FAQ & CTA -->
    <section class="py-20 bg-slate-50 relative overflow-hidden">
        <!-- Abstract Shapes -->
        <div class="absolute top-0 right-0 w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
        
        <div class="max-w-[1400px] mx-auto px-4 grid lg:grid-cols-[1fr_450px] gap-12 lg:gap-20 items-center">
            
            <!-- Left: FAQ -->
            <div data-aos="fade-right">
                <h2 class="text-2xl md:text-3xl font-black text-dark mb-8">Frequently Asked Questions</h2>
                
                <div class="space-y-3">
                    <div class="bg-white border border-slate-200 rounded-xl group cursor-pointer accordion-item shadow-sm hover:border-primary transition-colors overflow-hidden">
                        <div class="flex justify-between items-center p-5">
                            <span class="font-bold text-[14px] text-dark group-hover:text-primary transition-colors">Is this course beginner friendly?</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-primary transition-colors">
                                <i class="fa-solid fa-plus transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div class="accordion-content px-5 pb-5 pt-0">
                            <p class="text-[13px] text-slate-500 leading-relaxed border-t border-slate-100 pt-4 mt-1">Yes, our curriculum starts from the absolute basics and scales up to advanced industry-level concepts. No prior coding experience is required.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl group cursor-pointer accordion-item shadow-sm hover:border-primary transition-colors overflow-hidden">
                        <div class="flex justify-between items-center p-5">
                            <span class="font-bold text-[14px] text-dark group-hover:text-primary transition-colors">Will I get internship opportunities?</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-primary transition-colors">
                                <i class="fa-solid fa-plus transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl group cursor-pointer accordion-item shadow-sm hover:border-primary transition-colors overflow-hidden">
                        <div class="flex justify-between items-center p-5">
                            <span class="font-bold text-[14px] text-dark group-hover:text-primary transition-colors">Do you provide placement guarantee?</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-primary transition-colors">
                                <i class="fa-solid fa-plus transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl group cursor-pointer accordion-item shadow-sm hover:border-primary transition-colors overflow-hidden">
                        <div class="flex justify-between items-center p-5">
                            <span class="font-bold text-[14px] text-dark group-hover:text-primary transition-colors">Are EMI options available?</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-primary transition-colors">
                                <i class="fa-solid fa-plus transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Blue CTA Card -->
            <div class="bg-gradient-to-br from-primary via-orange-600 to-primary-dark rounded-[2rem] p-8 lg:p-12 text-white relative overflow-hidden shadow-[0_20px_50px_rgba(245,158,11,0.3)] transform transition-transform hover:-translate-y-2 duration-500" data-aos="zoom-in-left">
                <!-- Decorative Circles -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-purple-500/20 rounded-full blur-2xl pointer-events-none"></div>
                
                <h3 class="text-3xl md:text-4xl font-black mb-4 relative z-10 leading-tight">Start Your Tech<br>Career Today!</h3>
                <p class="text-amber-50 text-[13px] mb-10 max-w-[280px] relative z-10 leading-relaxed">Join thousands of learners and become job ready with real projects, AI tools and expert mentorship.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-8 relative z-10">
                    <button class="btn bg-white text-dark py-3.5 px-6 text-[13px] hover:bg-slate-50 hover:shadow-lg font-black w-full sm:w-auto transition-all shadow-md">Book Free Demo</button>
                    <button class="btn bg-transparent border border-amber-400 text-white hover:bg-white/10 hover:border-white py-3.5 px-6 text-[13px] w-full sm:w-auto transition-all flex items-center justify-center gap-2">Apply Now <i class="fa-solid fa-arrow-right text-[10px]"></i></button>
                </div>

                <div class="flex items-center gap-4 relative z-10 pt-6 border-t border-amber-500/30">
                    <div class="flex -space-x-3">
                        <img src="https://i.pravatar.cc/100?img=1" class="w-10 h-10 rounded-full border-2 border-indigo-700 shadow-sm">
                        <img src="https://i.pravatar.cc/100?img=2" class="w-10 h-10 rounded-full border-2 border-indigo-700 shadow-sm">
                        <img src="https://i.pravatar.cc/100?img=3" class="w-10 h-10 rounded-full border-2 border-indigo-700 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md border-2 border-indigo-700 shadow-sm flex items-center justify-center text-xs font-bold">+</div>
                    </div>
                    <span class="text-xs text-amber-50 font-medium">Join <span class="font-bold text-white">2,00,000+</span> learners</span>
                </div>
            </div>

        </div>
    </section>

    <!-- 13. FOOTER -->
    <footer class="bg-[#0a0f1a] relative pb-32">
        <div class="max-w-[1400px] mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            <!-- Brand -->
            <div class="lg:col-span-2 space-y-5 pr-10">
                <a href="<?= base_url(); ?>" class="flex items-center gap-2 mb-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-orange-400 rounded-full flex items-center justify-center text-white font-black text-2xl group-hover:shadow-glow transition-all">I</div>
                    <div class="leading-tight">
                        <div class="font-bold text-xl text-white tracking-tight leading-none">Internmo</div>
                        <div class="text-[9px] uppercase font-bold text-slate-500 tracking-wider">Learn • Build • Get Hired</div>
                    </div>
                </a>
                <p class="text-slate-400 text-[12px] leading-relaxed max-w-xs">We help students build in-demand skills, work on real projects and get placed at top tech companies. Transform your career with us.</p>
                <div class="flex gap-3 pt-2">
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-primary hover:border-primary hover:text-white transition-all text-sm"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-red-500 hover:border-red-500 hover:text-white transition-all text-sm"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:border-pink-600 hover:text-white transition-all text-sm"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:border-sky-500 hover:text-white transition-all text-sm"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-bold text-white text-[11px] mb-5 uppercase tracking-widest border-l-2 border-primary pl-2">Courses</h4>
                <ul class="space-y-3.5 text-[12px] text-slate-400">
                    <li><a href="#" class="hover:text-primary transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> All Courses</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Data Science & AI</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Full Stack Dev</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> GenAI Programs</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-white text-[11px] mb-5 uppercase tracking-widest border-l-2 border-emerald-500 pl-2">Resources</h4>
                <ul class="space-y-3.5 text-[12px] text-slate-400">
                    <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Blogs & Articles</a></li>
                    <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Placement Report</a></li>
                    <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Free AI Tools</a></li>
                    <li><a href="#" class="hover:text-emerald-500 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Interview Guides</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-white text-[11px] mb-5 uppercase tracking-widest border-l-2 border-purple-500 pl-2">Company</h4>
                <ul class="space-y-3.5 text-[12px] text-slate-400">
                    <li><a href="#" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> About Us</a></li>
                    <li><a href="#" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Careers</a></li>
                    <li><a href="#" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Contact Support</a></li>
                    <li><a href="#" class="hover:text-purple-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-slate-600"></i> Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-slate-800/50 py-6">
            <div class="max-w-[1400px] mx-auto px-4 text-center text-[11px] text-slate-500">
                &copy; <?= date('Y') ?> Internmo. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Fixed Bottom Sticky CTA Bar -->
    <div class="fixed bottom-0 left-0 w-full bg-primary text-white text-center py-3.5 px-4 flex flex-wrap items-center justify-center gap-4 shadow-[0_-10px_30px_rgba(245,158,11,0.3)] z-[100]">
        <span class="text-[13px] sm:text-[15px] font-bold tracking-wider flex items-center gap-2">
            🚀 GET EXPERIENCED AND JOB READY FOR 800+ TOP COMPANIES
        </span>
        <a href="<?= base_url('register'); ?>" class="bg-white text-dark px-6 py-2 rounded text-[13px] font-black hover:bg-slate-50 hover:shadow-lg transition-all shadow-sm">Apply Now</a>
    </div>

    <!-- Whatsapp Chat Button (Floating Pulse) -->
    <a href="https://wa.me/9108645322947" target="_blank" class="fixed bottom-20 right-6 bg-[#10B981] text-white rounded-full flex items-center gap-2 pr-4 pl-1.5 py-1.5 shadow-[0_8px_30px_rgba(16,185,129,0.4)] hover:scale-105 hover:-translate-y-1 transition-all z-50 group">
        <div class="w-9 h-9 flex items-center justify-center bg-white/20 rounded-full relative">
            <i class="fa-brands fa-whatsapp text-xl"></i>
            <div class="absolute inset-0 rounded-full border border-white animate-ping opacity-50"></div>
        </div>
        <span class="font-bold text-[11px] leading-tight pr-1">Need help choosing<br><span class="font-medium opacity-90">a course?</span></span>
    </a>

    <!-- Scripts -->
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS Animation Library
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });

            // Initialize Swiper for Alumni Success Stories
            var swiperAlumni = new Swiper(".swiperAlumni", {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiperAlumni .swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 30 },
                }
            });

            // Handle Bar Chart Animations (trigger when in view)
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bars = entry.target.querySelectorAll('.bar-chart-col');
                        bars.forEach((bar, index) => {
                            setTimeout(() => {
                                bar.style.height = bar.getAttribute('data-height');
                            }, index * 150); // Stagger animation
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            const chartContainer = document.querySelector('#placements');
            if(chartContainer) observer.observe(chartContainer);

            // Accordion Toggling
            document.querySelectorAll('.accordion-item').forEach(item => {
                item.addEventListener('click', () => {
                    // Remove from all others
                    document.querySelectorAll('.accordion-item').forEach(other => {
                        if (other !== item) {
                            other.classList.remove('accordion-open');
                        }
                    });
                    // Toggle current
                    item.classList.toggle('accordion-open');
                });
            });
        });
    </script>
</body>
</html>
