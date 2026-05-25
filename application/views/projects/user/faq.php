<div class="max-w-4xl mx-auto" x-data="{ activeTab: 'offer', activeQuestion: null }">
    <!-- Tabs Header -->
    <div class="bg-gray-100/50 p-2 rounded-2xl flex items-center justify-between mb-12 shadow-inner border border-gray-100">
        <button @click="activeTab = 'offer'" 
                :class="activeTab === 'offer' ? 'bg-white text-[#00204a] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-3.5 rounded-xl font-black text-sm transition-all outline-none">
            Offer Letter
        </button>
        <button @click="activeTab = 'portal'" 
                :class="activeTab === 'portal' ? 'bg-white text-[#00204a] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-3.5 rounded-xl font-black text-sm transition-all outline-none">
            Portal Access
        </button>
        <button @click="activeTab = 'certificate'" 
                :class="activeTab === 'certificate' ? 'bg-white text-[#00204a] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-3.5 rounded-xl font-black text-sm transition-all outline-none">
            Certificate
        </button>
        <button @click="activeTab = 'assignment'" 
                :class="activeTab === 'assignment' ? 'bg-white text-[#00204a] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-3.5 rounded-xl font-black text-sm transition-all outline-none">
            Assignment
        </button>
    </div>

    <!-- Questions List -->
    <div class="space-y-6">
        <!-- FAQ Item 1 -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <button @click="activeQuestion = (activeQuestion === 1 ? null : 1)" 
                    class="w-full p-8 text-left flex items-center justify-between gap-6 outline-none group">
                <h3 class="text-lg font-bold text-[#00204a] group-hover:text-[#d4af37] transition-colors leading-relaxed">
                    I have registered but have not received my offer letter yet. When will I get access to my offer letter and the learning/project portal?
                </h3>
                <i class="fa-solid fa-chevron-down text-gray-300 transition-transform duration-300" :class="activeQuestion === 1 ? 'rotate-180 text-[#d4af37]' : ''"></i>
            </button>
            <div x-show="activeQuestion === 1" x-collapse class="px-8 pb-8 text-slate-500 leading-loose font-medium">
                Offer letters are typically sent within 24-48 hours of successful registration. Please check your spam folder. Portal access is granted along with the offer letter details. If you still haven't received it, please contact our support team.
            </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <button @click="activeQuestion = (activeQuestion === 2 ? null : 2)" 
                    class="w-full p-8 text-left flex items-center justify-between gap-6 outline-none group">
                <h3 class="text-lg font-bold text-[#00204a] group-hover:text-[#d4af37] transition-colors leading-relaxed">
                    I have completed the registration. What is the next process?
                </h3>
                <i class="fa-solid fa-chevron-down text-gray-300 transition-transform duration-300" :class="activeQuestion === 2 ? 'rotate-180 text-[#d4af37]' : ''"></i>
            </button>
            <div x-show="activeQuestion === 2" x-collapse class="px-8 pb-8 text-slate-500 leading-loose font-medium">
                Once registered, our academic team will verify your details. You will receive an onboarding email containing your internship schedule, mentor details, and project guidelines within 3 working days.
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <button @click="activeQuestion = (activeQuestion === 3 ? null : 3)" 
                    class="w-full p-8 text-left flex items-center justify-between gap-6 outline-none group">
                <h3 class="text-lg font-bold text-[#00204a] group-hover:text-[#d4af37] transition-colors leading-relaxed">
                    What should I do if I did not receive the offer letter or other information after the batch started?
                </h3>
                <i class="fa-solid fa-chevron-down text-gray-300 transition-transform duration-300" :class="activeQuestion === 3 ? 'rotate-180 text-[#d4af37]' : ''"></i>
            </button>
            <div x-show="activeQuestion === 3" x-collapse class="px-8 pb-8 text-slate-500 leading-loose font-medium">
                Please raise a ticket through the Chat Support section or email us at support@internmo.com with your registered email ID and transaction details. We will resolve it within 4 hours.
            </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <button @click="activeQuestion = (activeQuestion === 4 ? null : 4)" 
                    class="w-full p-8 text-left flex items-center justify-between gap-6 outline-none group">
                <h3 class="text-lg font-bold text-[#00204a] group-hover:text-[#d4af37] transition-colors leading-relaxed">
                    My UNID is not shown. What should I do?
                </h3>
                <i class="fa-solid fa-chevron-down text-gray-300 transition-transform duration-300" :class="activeQuestion === 4 ? 'rotate-180 text-[#d4af37]' : ''"></i>
            </button>
            <div x-show="activeQuestion === 4" x-collapse class="px-8 pb-8 text-slate-500 leading-loose font-medium">
                Your Unique ID (UNID) is generated after the final verification of your documents. If your dashboard doesn't show it after 5 days of joining, please reach out to your assigned mentor.
            </div>
        </div>
    </div>

    <!-- Helpful Footer -->
    <div class="mt-12 bg-white rounded-3xl border border-gray-100 p-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <p class="text-gray-500 font-bold">
            Was this helpful? If not, click <a href="<?= site_url('projects/user/chat') ?>" class="text-rose-500 underline underline-offset-4 decoration-2">NO</a> to chat with support.
        </p>
        <div class="flex gap-4">
            <button class="px-8 py-3 rounded-2xl border border-blue-100 text-blue-600 font-black hover:bg-blue-50 transition-all active:scale-95">Yes</button>
            <a href="<?= site_url('projects/user/chat') ?>" class="px-8 py-3 rounded-2xl bg-rose-50 text-rose-600 font-black border border-rose-100 hover:bg-rose-100 transition-all active:scale-95">No</a>
        </div>
    </div>
</div>




