<!-- Page Header -->
<div class="flex items-center justify-between mb-12">
    <div>
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Manage Internships</h2>
        <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Add or remove internship opportunities</p>
    </div>
    <button onclick="document.getElementById('addInternshipModal').classList.remove('hidden')" 
            class="bg-[#00204a] text-white px-8 py-4 rounded-2xl font-black flex items-center gap-3 hover:bg-[#d4af37] transition-all shadow-xl shadow-blue-900/10 active:scale-95 group">
        <i class="fa-solid fa-plus text-xs group-hover:rotate-90 transition-transform"></i>
        Post New Internship
    </button>
</div>

<!-- Internships Table -->
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Internship Details</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Category</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Duration</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Location</th>
                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php foreach ($internships as $i): ?>
            <tr class="hover:bg-gray-50/50 transition-colors group">
                <td class="px-8 py-6">
                    <p class="font-black text-[#00204a] group-hover:text-[#d4af37] transition-colors"><?= htmlspecialchars($i->title) ?></p>
                    <p class="text-xs text-gray-400 mt-1 line-clamp-1"><?= htmlspecialchars($i->description) ?></p>
                </td>
                <td class="px-8 py-6">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase"><?= htmlspecialchars($i->category) ?></span>
                </td>
                <td class="px-8 py-6 text-sm font-bold text-gray-600"><?= htmlspecialchars($i->duration ?? 'N/A') ?></td>
                <td class="px-8 py-6 text-sm font-bold text-gray-500"><?= htmlspecialchars($i->location ?? 'Remote') ?></td>
                <td class="px-8 py-6 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <button onclick='openEditModal(<?= json_encode($i) ?>)'
                                class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </button>
                        <a href="<?= site_url('projects/admin/delete_internship/' . $i->id) ?>" 
                           onclick="return confirm('Are you sure?')"
                           class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($internships)): ?>
            <tr>
                <td colspan="5" class="px-8 py-20 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-300">
                            <i class="fa-solid fa-folder-open text-3xl"></i>
                        </div>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">No internships found</p>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Edit Internship Modal -->
<div id="editInternshipModal" class="hidden fixed inset-0 bg-[#00204a]/70 backdrop-blur-md z-[100] flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-500">
        <div class="p-10 flex items-center justify-between border-b border-gray-50 bg-gray-50/30">
            <h3 class="text-3xl font-black text-[#00204a] tracking-tighter">Edit Internship</h3>
            <button onclick="document.getElementById('editInternshipModal').classList.add('hidden')" class="w-12 h-12 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-lg text-gray-300 hover:text-rose-500 transition-all border border-transparent">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <form id="editInternshipForm" action="" method="post" class="p-10 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Job Title</label>
                    <input type="text" id="edit_title" name="title" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Category</label>
                    <select id="edit_category" name="category" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm appearance-none">
                        <option value="Web Development">Web Development</option>
                        <option value="Android Development">Android Development</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Data Science">Data Science</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Design">Design</option>
                        <option value="Engineering">Engineering</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Duration</label>
                    <input type="text" id="edit_duration" name="duration" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Location</label>
                    <input type="text" id="edit_location" name="location" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Stipend</label>
                    <input type="text" id="edit_stipend" name="stipend" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Description</label>
                <textarea id="edit_description" name="description" rows="4" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm"></textarea>
            </div>

            <button type="submit" class="w-full py-5 bg-[#d4af37] hover:bg-[#00204a] text-white font-black text-lg rounded-2xl transition-all shadow-xl shadow-blue-900/20 active:scale-[0.98]">
                Update Internship
            </button>
        </form>
    </div>
</div>

<script>
function openEditModal(data) {
    document.getElementById('edit_title').value = data.title || '';
    document.getElementById('edit_category').value = data.category || '';
    document.getElementById('edit_duration').value = data.duration || '';
    document.getElementById('edit_location').value = data.location || '';
    document.getElementById('edit_stipend').value = data.stipend || '';
    document.getElementById('edit_description').value = data.description || '';
    
    document.getElementById('editInternshipForm').action = "<?= site_url('projects/admin/edit_internship/') ?>" + data.id;
    document.getElementById('editInternshipModal').classList.remove('hidden');
}
</script>

<!-- Add Internship Modal -->
<div id="addInternshipModal" class="hidden fixed inset-0 bg-[#00204a]/70 backdrop-blur-md z-[100] flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-500">
        <div class="p-10 flex items-center justify-between border-b border-gray-50 bg-gray-50/30">
            <h3 class="text-3xl font-black text-[#00204a] tracking-tighter">Post New Internship</h3>
            <button onclick="document.getElementById('addInternshipModal').classList.add('hidden')" class="w-12 h-12 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-lg text-gray-300 hover:text-rose-500 transition-all border border-transparent">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <form action="<?= site_url('projects/admin/add_internship') ?>" method="post" class="p-10 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Job Title</label>
                    <input type="text" name="title" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm" placeholder="e.g. Web Development Intern">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Category</label>
                    <select name="category" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm appearance-none">
                        <option value="Web Development">Web Development</option>
                        <option value="Android Development">Android Development</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Data Science">Data Science</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Duration</label>
                    <input type="text" name="duration" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm" placeholder="e.g. 3 Months">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Location</label>
                    <input type="text" name="location" value="Remote" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Stipend</label>
                    <input type="text" name="stipend" value="Unpaid" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Description</label>
                <textarea name="description" rows="4" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#00204a] transition-all font-bold text-sm" placeholder="Tell students about the role..."></textarea>
            </div>

            <button type="submit" class="w-full py-5 bg-[#00204a] hover:bg-[#d4af37] text-white font-black text-lg rounded-2xl transition-all shadow-xl shadow-blue-900/20 active:scale-[0.98]">
                Post Internship
            </button>
        </form>
    </div>
</div>
