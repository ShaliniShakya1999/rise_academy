<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// Detect active first URI segment for nav highlighting
$s1 = $this->uri->segment(1);
function nav_active($segment) {
    global $s1;
    return $s1 === $segment ? 'active' : '';
}
?>
<!-- Premium Tailwind Navbar -->
<nav class="w-full bg-black border-b border-[#f2e6c9] sticky top-0 z-50">
  <div class="max-w-[1500px] mx-auto px-6">
    <div class="flex items-center justify-between h-[82px]">
      <!-- Left Logo -->
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
          <div class="text-[#ffb400] text-5xl font-extrabold leading-none">im</div>
          <div><h1 class="text-white text-[20px] font-bold">Internmo</h1></div>
        </div>
      </div>
      <!-- Desktop Menu -->
      <div class="hidden xl:flex items-center gap-10">
        <a href="<?php echo base_url(); ?>" class="nav-link text-white font-semibold <?php echo nav_active(''); ?>">Home</a>
        <a href="<?php echo base_url('resume-builder'); ?>" class="nav-link text-gray-300 font-semibold leading-5 <?php echo nav_active('resume-builder'); ?>">Resume <br> Builder</a>
        <a href="<?php echo base_url('jobs'); ?>" class="nav-link text-gray-300 font-semibold <?php echo nav_active('jobs'); ?>">Jobs</a>
        <a href="<?php echo base_url('internship'); ?>" class="nav-link text-gray-300 font-semibold <?php echo nav_active('internship'); ?>">Internship</a>
        <a href="<?php echo base_url('resume-checker'); ?>" class="nav-link text-gray-300 font-semibold leading-5 <?php echo nav_active('resume-checker'); ?>">Resume <br> Checker</a>
        <a href="<?php echo base_url('project-submission'); ?>" class="nav-link text-gray-300 font-semibold leading-5 <?php echo nav_active('project-submission'); ?>">Project <br> Submission</a>
        <a href="<?php echo base_url('templates'); ?>" class="nav-link text-gray-300 font-semibold <?php echo nav_active('templates'); ?>">Templates</a>
      </div>
      <!-- Right Side -->
      <div class="flex items-center gap-4">
        <button class="w-14 h-14 rounded-full border border-gray-700 bg-[#171717] flex items-center justify-center text-white text-xl hover:bg-[#222] transition">
          <i class="ri-heart-line"></i>
        </button>
        <button class="text-white font-semibold text-lg hidden md:block">Dashboard</button>
        <div class="flex items-center gap-3 bg-[#171717] border border-gray-700 rounded-full px-3 py-2 cursor-pointer hover:bg-[#222] transition">
          <div class="w-11 h-11 rounded-full bg-[#f5a400] flex items-center justify-center text-white font-bold">S</div>
          <i class="ri-arrow-down-s-line text-white"></i>
        </div>
        <button id="menuBtn" class="xl:hidden text-white text-3xl"><i class="ri-menu-line"></i></button>
      </div>
    </div>
  </div>
  <!-- Mobile Menu -->
  <div id="mobileMenu" class="hidden xl:hidden bg-black border-t border-gray-800">
    <div class="flex flex-col px-6 py-5 gap-5">
      <a href="<?php echo base_url(); ?>" class="text-white font-medium">Home</a>
      <a href="<?php echo base_url('courses'); ?>" class="text-white font-medium">Courses</a>
      <a href="<?php echo base_url('resume-builder'); ?>" class="text-white font-medium">Resume Builder</a>
      <a href="<?php echo base_url('jobs'); ?>" class="text-white font-medium">Jobs</a>
      <a href="<?php echo base_url('internship'); ?>" class="text-white font-medium">Internship</a>
      <a href="<?php echo base_url('resume-checker'); ?>" class="text-white font-medium">Resume Checker</a>
      <a href="<?php echo base_url('project-submission'); ?>" class="text-white font-medium">Project Submission</a>
      <a href="<?php echo base_url('contact'); ?>" class="text-white font-medium">Contact Us</a>
      <a href="<?php echo base_url('templates'); ?>" class="text-white font-medium">Templates</a>
    </div>
  </div>
</nav>
<script>
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  menuBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); });
</script>
