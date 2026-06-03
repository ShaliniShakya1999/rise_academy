<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-blue-900/5 border border-gray-50 overflow-hidden">
        <div class="p-12 border-b border-gray-50 bg-gray-50/30">
            <h2 class="text-4xl font-black text-[#00204a] tracking-tighter mb-2">Submit New Project</h2>
            <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Select a project to start your evaluation</p>
        </div>

        <form action="<?= site_url('projects/user/submit') ?>" method="post" enctype="multipart/form-data" class="p-12 space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Project Title</label>
                    <div class="relative group">
                        <i class="fa-solid fa-folder-open absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                        <select name="project_title" required class="w-full pl-14 pr-6 py-6 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-700 text-sm shadow-sm appearance-none">
                            <option value="">---Select Project---</option>
                            <option value="Aatmanirbhar Nari  -  Home Business Enablement Portal">Aatmanirbhar Nari  -  Home Business Enablement Portal</option>
                            <option value="Farmer-to-Consumer Agri Marketplace">Farmer-to-Consumer Agri Marketplace</option>
                            <option value="GreenNest  -  Online Nursery & Gardening Services Platform">GreenNest  -  Online Nursery & Gardening Services Platform</option>
                            <option value="HomeFeast  -  Homemade Tiffin & Food Service Platform">HomeFeast  -  Homemade Tiffin & Food Service Platform</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Your Domain</label>
                    <div class="relative group">
                        <i class="fa-solid fa-user-tag absolute left-6 top-6 text-gray-300 group-focus-within:text-[#00204a] transition-colors"></i>
                        <input type="text" readonly value="<?= htmlspecialchars($user_data->applied_for) ?>" 
                               class="w-full pl-14 pr-6 py-6 bg-gray-50 border border-gray-100 rounded-2xl text-gray-500 font-black outline-none shadow-inner text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Sub Domain</label>
                    <div class="relative group">
                        <i class="fa-solid fa-layer-group absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                        <select name="sub_domain" required class="w-full pl-14 pr-6 py-6 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-700 text-sm shadow-sm appearance-none">
                            <option value="">---Select sub domain---</option>
                            <option value="Automotive & Transportation">Automotive & Transportation</option>
                            <option value="Digital Marketplace">Digital Marketplace</option>
                            <option value="E-commerce">E-commerce</option>
                            <option value="Edtech">Edtech</option>
                            <option value="Fintech">Fintech</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Project File (PDF, ZIP, RAR, DOC, DOCX)</label>
                    <div class="relative group">
                        <i class="fa-solid fa-cloud-arrow-up absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                        <input type="file" name="project_file" required 
                               class="w-full pl-14 pr-6 py-[14px] bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-500 text-xs shadow-sm
                                      file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-[#00204a]/10 file:text-[#00204a] hover:file:bg-[#00204a]/20 file:transition-all">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 ml-2">Description</label>
                <div class="relative group">
                    <i class="fa-solid fa-pen-to-square absolute left-6 top-6 text-gray-300 group-focus-within:text-[#d4af37] transition-colors"></i>
                    <textarea name="description" rows="4" required class="w-full pl-14 pr-6 py-6 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-8 focus:ring-[#d4af37]/5 focus:border-[#d4af37] transition-all font-black text-gray-700 text-sm shadow-sm" placeholder="Briefly describe your approach..."></textarea>
                </div>
            </div>

            <button type="submit" class="w-full py-7 bg-[#00204a] hover:bg-[#d4af37] text-white font-black text-xl rounded-3xl transition-all shadow-2xl shadow-blue-900/20 active:scale-[0.98] flex items-center justify-center gap-4 group">
                Submit Project Request
                <i class="fa-solid fa-chevron-right text-sm group-hover:translate-x-2 transition-transform"></i>
            </button>
        </form>
    </div>
</div>




