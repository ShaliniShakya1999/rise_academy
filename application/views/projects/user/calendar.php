<div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden" x-data="calendarApp()">
    <!-- Tabs Header -->
    <div class="px-10 pt-8 border-b border-gray-50 flex items-center gap-10">
        <button class="pb-5 border-b-4 border-[#00204a] text-[#00204a] font-black text-sm transition-all">Calendar View</button>
        <button class="pb-5 border-b-4 border-transparent text-gray-400 font-bold text-sm hover:text-gray-600 transition-all">Kanban View</button>
    </div>

    <!-- Calendar Controls -->
    <div class="p-10 flex items-center justify-between">
        <div class="flex items-center gap-5">
            <div class="flex items-center bg-gray-50 rounded-2xl p-1.5 border border-gray-100 shadow-inner">
                <button @click="prevMonth()" class="w-11 h-11 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-md text-[#00204a] transition-all">
                    <i class="fa-solid fa-chevron-left text-sm"></i>
                </button>
                <button @click="nextMonth()" class="w-11 h-11 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-md text-[#00204a] transition-all">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </button>
            </div>
            <button @click="resetToToday()" class="px-8 py-3 bg-[#00204a] text-white rounded-2xl font-black text-sm shadow-xl shadow-blue-900/10 hover:scale-105 active:scale-95 transition-all">
                Today
            </button>
        </div>

        <h2 class="text-4xl font-black text-[#00204a] tracking-tight" x-text="monthName + ' ' + year"></h2>

        <div class="bg-gray-50 rounded-2xl p-1.5 border border-gray-100 flex gap-1.5 shadow-inner">
            <button class="px-6 py-2.5 bg-white text-[#00204a] rounded-xl shadow-md font-black text-xs transition-all">Month</button>
            <button class="px-6 py-2.5 text-gray-400 rounded-xl font-bold text-xs hover:bg-white/50 transition-all">Week</button>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div class="px-10 pb-10">
        <div class="grid grid-cols-7 border border-gray-100 rounded-[2rem] overflow-hidden shadow-sm">
            <!-- Day Labels -->
            <template x-for="day in ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']">
                <div class="bg-gray-50/80 py-5 text-center text-xs font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                    <span x-text="day"></span>
                </div>
            </template>

            <!-- Calendar Cells -->
            <template x-for="blank in blanks">
                <div class="aspect-video p-4 border-r border-b border-gray-50 bg-gray-50/20 min-h-[130px]"></div>
            </template>

            <template x-for="date in daysInMonth">
                <div class="aspect-video p-5 border-r border-b border-gray-100 min-h-[130px] bg-white hover:bg-blue-50/30 transition-colors group relative"
                     :class="{'bg-amber-50/30': isToday(date)}">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-black transition-colors" 
                              :class="isToday(date) ? 'text-[#d4af37]' : 'text-gray-500 group-hover:text-[#00204a]'" 
                              x-text="date"></span>
                        <template x-if="isToday(date)">
                            <span class="w-1.5 h-1.5 bg-[#d4af37] rounded-full animate-pulse"></span>
                        </template>
                    </div>
                    
                    <!-- Example Project Event -->
                    <template x-if="date === 9 && month === 4 && year === 2026">
                        <div class="mt-2 p-2.5 bg-[#d4af37] rounded-xl shadow-lg shadow-amber-900/10 border-l-4 border-[#00204a] transform hover:scale-105 transition-transform cursor-pointer">
                            <p class="text-[10px] font-black text-white leading-tight truncate">HomeFeast Project</p>
                            <p class="text-[8px] font-bold text-white/80 mt-1 uppercase tracking-tighter">Evaluation Due</p>
                        </div>
                    </template>

                    <template x-if="date === 22 && month === 4 && year === 2026">
                        <div class="mt-2 p-2.5 bg-[#00204a] rounded-xl shadow-lg shadow-blue-900/10 border-l-4 border-[#d4af37] transform hover:scale-105 transition-transform cursor-pointer">
                            <p class="text-[10px] font-black text-white leading-tight truncate">Mentor Meeting</p>
                            <p class="text-[8px] font-bold text-white/60 mt-1 uppercase tracking-tighter">04:00 PM</p>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
function calendarApp() {
    return {
        month: new Date().getMonth(),
        year: new Date().getFullYear(),
        monthName: '',
        daysInMonth: [],
        blanks: [],
        
        init() {
            this.render();
        },
        
        render() {
            const date = new Date(this.year, this.month, 1);
            this.monthName = date.toLocaleString('default', { month: 'long' });
            
            const firstDay = new Date(this.year, this.month, 1).getDay();
            const totalDays = new Date(this.year, this.month + 1, 0).getDate();
            
            this.blanks = Array.from({ length: firstDay }, (_, i) => i);
            this.daysInMonth = Array.from({ length: totalDays }, (_, i) => i + 1);
        },
        
        prevMonth() {
            if (this.month === 0) {
                this.month = 11;
                this.year--;
            } else {
                this.month--;
            }
            this.render();
        },
        
        nextMonth() {
            if (this.month === 11) {
                this.month = 0;
                this.year++;
            } else {
                this.month++;
            }
            this.render();
        },
        
        resetToToday() {
            this.month = new Date().getMonth();
            this.year = new Date().getFullYear();
            this.render();
        },
        
        isToday(d) {
            const today = new Date();
            return d === today.getDate() && this.month === today.getMonth() && this.year === today.getFullYear();
        }
    }
}
</script>




