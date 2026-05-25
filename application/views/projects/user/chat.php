<div class="h-[calc(100vh-120px)] bg-white rounded-3xl border border-gray-100 shadow-sm flex overflow-hidden">
    <!-- Chat Sidebar -->
    <div class="w-80 border-r border-gray-50 flex flex-col">
        <div class="p-6 border-b border-gray-50">
            <h2 class="text-xl font-black text-[#00204a] flex items-center gap-3">
                <i class="fa-solid fa-comments text-[#d4af37]"></i>
                Chats
            </h2>
        </div>
        
        <div class="p-4 border-b border-gray-50">
            <div class="relative group">
                <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#00204a] transition-colors"></i>
                <input type="text" placeholder="Search conversations..." class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-transparent rounded-2xl outline-none focus:bg-white focus:border-[#d4af37]/30 transition-all text-sm font-medium">
            </div>
        </div>

        <div class="flex-1 overflow-y-auto">
            <!-- Active Filter Tabs -->
            <div class="flex gap-2 p-4 pb-2">
                <button class="px-4 py-1.5 bg-[#00204a] text-white rounded-full text-xs font-black">All</button>
                <button class="px-4 py-1.5 bg-gray-50 text-gray-500 rounded-full text-xs font-black hover:bg-gray-100 transition-colors">Unread</button>
                <button class="px-4 py-1.5 bg-gray-50 text-gray-500 rounded-full text-xs font-black hover:bg-gray-100 transition-colors">Groups</button>
            </div>

            <!-- Contact List -->
            <div class="p-2">
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-blue-50/50 cursor-pointer border border-blue-100/50">
                    <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <i class="fa-solid fa-user-tie text-xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h3 class="font-black text-[#00204a] truncate">Project Admin</h3>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">04:16 PM</span>
                        </div>
                        <p class="text-xs text-blue-600 font-bold truncate">No messages yet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="flex-1 bg-gray-50/30 flex flex-col items-center justify-center text-center p-12">
        <div class="max-w-md">
            <!-- Illustration Placeholder -->
            <div class="w-64 h-64 mx-auto mb-8 bg-white rounded-full flex items-center justify-center shadow-2xl shadow-blue-900/5 relative">
                <div class="absolute inset-0 bg-blue-50 rounded-full animate-pulse opacity-50 scale-110 -z-10"></div>
                <img src="https://cdn-icons-png.flaticon.com/512/6106/6106414.png" alt="Chat Illustration" class="w-40 h-40 object-contain opacity-80">
            </div>
            
            <h2 class="text-3xl font-black text-[#00204a] mb-4">Start a conversation</h2>
            <p class="text-gray-500 font-medium leading-relaxed">
                Select a chat from the left sidebar to start messaging with your project mentors or support team.
            </p>
            
            <button class="mt-8 px-8 py-3 bg-[#00204a] text-white rounded-2xl font-black text-sm shadow-xl shadow-blue-900/20 hover:scale-105 transition-transform active:scale-95">
                New Conversation
            </button>
        </div>
    </div>
</div>




