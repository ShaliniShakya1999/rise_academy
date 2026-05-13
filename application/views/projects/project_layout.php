<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title'] ?? 'Project Portal' ?> — Rise Academy</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-icon-active {
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.1);
            color: #d4af37 !important;
        }
        .bg-rise-dark { background-color: #00204a; }
        .text-rise-gold { color: #d4af37; }
        .bg-rise-gold { background-color: #d4af37; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-20 bg-rise-dark flex flex-col items-center py-8 fixed h-full z-50">
            <!-- Logo -->
            <div class="mb-12 px-2">
                <a href="<?= base_url() ?>" class="block">
                    <img src="<?= base_url('assets/website/images/rise_logo.png') ?>" alt="Rise Logo" class="w-12 h-12 rounded-lg object-contain bg-white p-1 shadow-sm">
                </a>
            </div>

            <!-- Nav Icons -->
            <nav class="flex flex-col gap-8 flex-1">
                <?php if ($this->session->userdata('role_id') == 1): ?>
                    <a href="<?= site_url('projects/admin') ?>" title="Project Requests" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(2) == 'admin' && !$this->uri->segment(3)) ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-briefcase text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/admin/internships') ?>" title="Manage Internships" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'internships') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-layer-group text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/admin/applications') ?>" title="Internship Applications" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'applications') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-users-gear text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/admin/revenue') ?>" title="Revenue Analytics" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'revenue') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-chart-pie text-xl"></i>
                    </a>
                <?php else: ?>
                    <!-- Student Sidebar -->
                    <a href="<?= site_url('projects/user') ?>" title="Dashboard" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(2) == 'user' && !$this->uri->segment(3)) ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-table-cells-large text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/user/chat') ?>" title="Messages" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'chat') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-comment-dots text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/user/calendar') ?>" title="Calendar" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'calendar') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-calendar-days text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/user/applications') ?>" title="My Applications" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'applications') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-file-circle-check text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/user/submit') ?>" title="Upload Project" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'submit') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                    </a>
                    <a href="<?= site_url('projects/user/faq') ?>" title="Support" class="p-3 rounded-xl text-white/50 hover:text-white transition-all <?= ($this->uri->segment(3) == 'faq') ? 'sidebar-icon-active text-white' : '' ?>">
                        <i class="fa-solid fa-circle-question text-xl"></i>
                    </a>
                <?php endif; ?>
            </nav>

            <!-- Logout -->
            <a href="<?= site_url('projects/logout') ?>" title="Logout" class="p-3 rounded-xl text-white/40 hover:text-rose-400 transition-all">
                <i class="fa-solid fa-right-from-bracket text-xl"></i>
            </a>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 ml-20">
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2">
                    <span class="text-gray-400 font-medium">Dashboard</span>
                    <span class="text-gray-300">/</span>
                    <span class="text-gray-900 font-bold">Hello, <?= $this->session->userdata('full_name') ?: 'User' ?></span>
                </div>
                <div class="flex items-center gap-6" x-data="{ notifications: false }">
                    <div class="relative">
                        <button @click="notifications = !notifications" class="text-gray-400 hover:text-[#00204a] transition-colors relative">
                            <i class="fa-regular fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white">2</span>
                        </button>

                        <!-- Notification Dropdown -->
                        <div x-show="notifications" 
                             @click.outside="notifications = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 z-[100] overflow-hidden">
                            <div class="p-4 border-b border-gray-50 flex items-center justify-between">
                                <h3 class="font-black text-[#00204a] text-sm">Notifications</h3>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Mark all as read</span>
                            </div>
                            <div class="max-h-[300px] overflow-y-auto">
                                <!-- Notification Item 1 -->
                                <div class="p-4 hover:bg-gray-50 transition-colors border-b border-gray-50 flex gap-4">
                                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex-shrink-0 flex items-center justify-center text-blue-600">
                                        <i class="fa-solid fa-briefcase"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-900 leading-snug">Project "HomeFeast" has been assigned to you!</p>
                                        <p class="text-[10px] text-gray-400 mt-1">2 minutes ago</p>
                                    </div>
                                </div>
                                <!-- Notification Item 2 -->
                                <div class="p-4 hover:bg-gray-50 transition-colors flex gap-4">
                                    <div class="w-10 h-10 bg-amber-50 rounded-xl flex-shrink-0 flex items-center justify-center text-amber-600">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-900 leading-snug">New message from Project Admin regarding your task.</p>
                                        <p class="text-[10px] text-gray-400 mt-1">1 hour ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 bg-gray-50 text-center">
                                <a href="#" class="text-[10px] font-black text-[#00204a] uppercase tracking-widest hover:text-[#d4af37] transition-colors">View All Notifications</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-rise-dark rounded-full flex items-center justify-center text-white font-bold ring-2 ring-rise-gold ring-offset-2">
                            <?= strtoupper(substr($this->session->userdata('full_name') ?: 'U', 0, 1)) ?>
                        </div>
                        <div class="hidden md:block text-right">
                            <p class="text-xs font-bold text-gray-900 leading-none"><?= $this->session->userdata('full_name') ?: 'User' ?></p>
                            <p class="text-[10px] text-gray-500 font-medium"><?= $this->session->userdata('email') ?: 'student@rise.com' ?></p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                    </div>
                </div>
            </header>

            <!-- View Content -->
            <main class="p-8">
                <?php $this->load->view($view, $data); ?>
            </main>
        </div>
    </div>
</body>
</html>
