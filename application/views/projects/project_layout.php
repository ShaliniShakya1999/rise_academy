<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title'] ?? 'Project Portal' ?> â€” Internmo</title>
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

        html, body { height: 100%; }

        /* Sidebar */
        #sidebar {
            width: 80px;
            min-height: 100vh;
            height: 100%;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            white-space: nowrap;
        }
        #sidebar.expanded { width: 240px; }

        /* Main content margin */
        #main-content {
            margin-left: 80px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }
        #main-content.expanded { margin-left: 240px; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 13px;
            font-weight: 700;
        }
        .sidebar-link:hover { color: white; background: rgba(255,255,255,0.05); }
        .sidebar-link.active {
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.1);
            color: #d4af37 !important;
        }
        .sidebar-link i { min-width: 20px; text-align: center; font-size: 18px; flex-shrink: 0; }

        .sidebar-label {
            opacity: 0;
            transition: opacity 0.2s;
            overflow: hidden;
            font-size: 12px;
            letter-spacing: 0.03em;
        }
        #sidebar.expanded .sidebar-label { opacity: 1; }

        .toggle-btn {
            position: fixed;
            top: 24px;
            left: 68px;
            width: 24px;
            height: 24px;
            background: #d4af37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .toggle-btn.expanded { left: 228px; }
        .toggle-btn i { transition: transform 0.3s; font-size: 10px; }
        .toggle-btn.expanded i { transform: rotate(180deg); }

        .bg-rise-dark { background-color: #00204a; }
        .text-rise-gold { color: #d4af37; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-rise-dark flex flex-col py-8 fixed top-0 left-0 z-50">

            <!-- Logo -->
            <div class="mb-10 px-4">
                <a href="<?= base_url() ?>" class="flex items-center gap-3">
                    <img src="<?= base_url('assets/website/images/previews/internmo.jpeg'); ?>" alt="Logo" class="h-10 w-auto object-contain shadow-sm flex-shrink-0">
                    <span class="sidebar-label text-white font-black text-sm tracking-tight">Internmo</span>
                </a>
            </div>

            <!-- Nav Icons -->
            <nav class="flex flex-col gap-2 flex-1 px-3">
                <?php if ($this->session->userdata('role_id') == 1): ?>
                    <a href="<?= site_url('projects/admin') ?>" class="sidebar-link <?= ($this->uri->segment(2) == 'admin' && !$this->uri->segment(3)) ? 'active' : '' ?>">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="sidebar-label">Project Requests</span>
                    </a>
                    <a href="<?= site_url('projects/admin/internships') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'internships') ? 'active' : '' ?>">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="sidebar-label">Manage Internships</span>
                    </a>
                    <a href="<?= site_url('projects/admin/users') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'users') ? 'active' : '' ?>">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span class="sidebar-label">Internship Users</span>
                    </a>
                    <a href="<?= site_url('projects/admin/project_submissions') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'project_submissions') ? 'active' : '' ?>">
                        <i class="fa-solid fa-file-code"></i>
                        <span class="sidebar-label">Project Submissions</span>
                    </a>
                    <a href="<?= site_url('projects/admin/revenue') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'revenue') ? 'active' : '' ?>">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span class="sidebar-label">Revenue Analytics</span>
                    </a>
                <?php else: ?>
                    <!-- Student Sidebar -->
                    <a href="<?= site_url('projects/user') ?>" class="sidebar-link <?= ($this->uri->segment(2) == 'user' && !$this->uri->segment(3)) ? 'active' : '' ?>">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span class="sidebar-label">Dashboard</span>
                    </a>
                    <a href="<?= site_url('projects/user/chat') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'chat') ? 'active' : '' ?>">
                        <i class="fa-solid fa-comment-dots"></i>
                        <span class="sidebar-label">Messages</span>
                    </a>
                    <a href="<?= site_url('projects/user/calendar') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'calendar') ? 'active' : '' ?>">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="sidebar-label">Calendar</span>
                    </a>
                    <a href="<?= site_url('projects/user/submit') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'submit') ? 'active' : '' ?>">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span class="sidebar-label">Upload Project</span>
                    </a>
                    <a href="<?= site_url('projects/user/faq') ?>" class="sidebar-link <?= ($this->uri->segment(3) == 'faq') ? 'active' : '' ?>">
                        <i class="fa-solid fa-circle-question"></i>
                        <span class="sidebar-label">Support & FAQs</span>
                    </a>
                <?php endif; ?>
            </nav>

            <!-- Logout -->
            <div class="px-3 mt-4">
                <a href="<?= site_url('projects/logout') ?>" class="sidebar-link hover:!text-rose-400">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="sidebar-label">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Toggle Button (outside sidebar to avoid overflow:hidden clip) -->
        <div id="toggle-btn" class="toggle-btn" onclick="toggleSidebar()">
            <i id="toggle-icon" class="fa-solid fa-chevron-right text-white"></i>
        </div>

        <!-- Main Content Area -->
        <div id="main-content" class="flex-1">
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
                        <div class="w-10 h-10 bg-rise-dark rounded-full flex items-center justify-center text-white font-bold ring-2 ring-[#d4af37] ring-offset-2">
                            <?= strtoupper(substr($this->session->userdata('full_name') ?: 'U', 0, 1)) ?>
                        </div>
                        <div class="hidden md:block text-right">
                            <p class="text-xs font-bold text-gray-900 leading-none"><?= $this->session->userdata('full_name') ?: 'User' ?></p>
                            <p class="text-[10px] text-gray-500 font-medium"><?= $this->session->userdata('email') ?: 'student@internmo.com' ?></p>
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

        <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main-content');
            const btn = document.getElementById('toggle-btn');
            sidebar.classList.toggle('expanded');
            main.classList.toggle('expanded');
            btn.classList.toggle('expanded');
            const isExpanded = sidebar.classList.contains('expanded');
            localStorage.setItem('sidebar_expanded', isExpanded);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const isExpanded = localStorage.getItem('sidebar_expanded') === 'true';
            if (isExpanded) {
                document.getElementById('sidebar').classList.add('expanded');
                document.getElementById('main-content').classList.add('expanded');
                document.getElementById('toggle-btn').classList.add('expanded');
            }
        });
        </script>
</body>
</html>




