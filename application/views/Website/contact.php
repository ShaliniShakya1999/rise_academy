<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="relative overflow-hidden bg-slate-900 text-white min-h-[calc(100vh-4rem)] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
    <!-- Abstract Glowing Blurs -->
    <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/10 w-[500px] h-[500px] bg-orange-500/10 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-6xl w-full mx-auto grid lg:grid-cols-12 gap-12 items-stretch relative z-10">
        
        <!-- Info Column -->
        <div class="lg:col-span-5 flex flex-col justify-between space-y-10" data-aos="fade-right">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 text-amber-400 px-4 py-1.5 rounded-full text-xs font-bold shadow-inner">
                    <span>✉️</span> Reach Out to Us
                </div>
                <h1 class="text-4xl sm:text-5xl font-black tracking-tight leading-none bg-gradient-to-r from-white via-slate-100 to-slate-400 bg-clip-text text-transparent">
                    Let’s start a <br>
                    <span class="bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">conversation.</span>
                </h1>
                <p class="text-slate-400 text-base leading-relaxed max-w-sm">
                    Have questions about our courses, internship tracks, or placement programs? Our team is here to help you guide your next career milestone.
                </p>
            </div>

            <!-- Contact Cards -->
            <div class="space-y-6">
                <!-- Card 1: Phone -->
                <div class="flex items-center gap-4 bg-white/5 border border-white/10 p-5 rounded-2xl hover:bg-white/10 hover:border-white/20 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-phone text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Call Us Today</div>
                        <div class="text-sm font-bold text-white mt-0.5">+91 (808) 645-3229</div>
                    </div>
                </div>

                <!-- Card 2: Email -->
                <div class="flex items-center gap-4 bg-white/5 border border-white/10 p-5 rounded-2xl hover:bg-white/10 hover:border-white/20 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-envelope text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Email Support</div>
                        <div class="text-sm font-bold text-white mt-0.5">admissions@internmo.com</div>
                    </div>
                </div>

                <!-- Card 3: Location -->
                <div class="flex items-center gap-4 bg-white/5 border border-white/10 p-5 rounded-2xl hover:bg-white/10 hover:border-white/20 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-location-dot text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">HQ Campus</div>
                        <div class="text-sm font-bold text-white mt-0.5">Innovate Hub, Sector 62, Noida, UP - 201301</div>
                    </div>
                </div>
            </div>

            <!-- Socials & Badge -->
            <div class="flex items-center justify-between border-t border-white/10 pt-6">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-widest">Connect with us</span>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-full bg-white/5 hover:bg-blue-500 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white transition-all text-sm"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-white/5 hover:bg-red-500 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white transition-all text-sm"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-white/5 hover:bg-pink-600 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white transition-all text-sm"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <!-- Form Column -->
        <div class="lg:col-span-7" data-aos="fade-left">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden flex flex-col justify-between h-full">
                <!-- Glow Line on Top -->
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600"></div>

                <div class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Send a Message</h2>
                        <p class="text-slate-400 text-xs mt-1">We typically respond back within 2-4 hours.</p>
                    </div>

                    <!-- Contact Form -->
                    <form action="#" method="POST" class="space-y-5" onsubmit="event.preventDefault(); alert('Thank you for contacting us! Our team will get back to you shortly.');">
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text" id="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors" placeholder="e.g. Rahul Sharma">
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                                <input type="email" id="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors" placeholder="e.g. rahul@gmail.com">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Phone Number</label>
                                <input type="tel" id="phone" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors" placeholder="e.g. +91 9876543210">
                            </div>
                            <div>
                                <label for="course" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Course of Interest</label>
                                <select id="course" class="w-full bg-slate-800 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
                                    <option value="" class="bg-slate-900 text-slate-400">Select a course (Optional)</option>
                                    <option value="full-stack-dev" class="bg-slate-900 text-white">Full Stack Development</option>
                                    <option value="app-dev" class="bg-slate-900 text-white">App Development</option>
                                    <option value="cyber-security" class="bg-slate-900 text-white">Cyber Security</option>
                                    <option value="devops" class="bg-slate-900 text-white">DevOps</option>
                                    <option value="ai" class="bg-slate-900 text-white">Artificial Intelligence (AI)</option>
                                    <option value="java-dev" class="bg-slate-900 text-white">Java Developer</option>
                                    <option value="ui-ux" class="bg-slate-900 text-white">UI/UX Design</option>
                                    <option value="data-science" class="bg-slate-900 text-white">Data Science</option>
                                    <option value="data-analyst" class="bg-slate-900 text-white">Data Analyst</option>
                                    <option value="digital-marketing" class="bg-slate-900 text-white">Digital Marketing</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Your Message</label>
                            <textarea id="message" rows="4" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors" placeholder="How can we help you?"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/25 hover:shadow-amber-500/35 hover:-translate-y-0.5 active:translate-y-0">
                            Send Message <i class="fa-solid fa-paper-plane ml-2 text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
