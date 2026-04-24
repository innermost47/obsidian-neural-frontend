<aside id="sidebar"
    class="fixed top-0 left-0 h-full w-[280px] z-[1102] flex flex-col overflow-y-auto
           bg-gradient-to-b from-[#1a1a1a] to-[#2d2d2d] shadow-[4px_0_24px_rgba(0,0,0,0.4)]
           -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="px-6 py-8 border-b border-primary/20">
        <a href="index.php" class="flex items-center gap-3 text-white no-underline hover:translate-x-1 transition-transform">
            <img src="assets/images/logo.png" alt="logo" class="h-8 w-auto" />
            <span id="sidebar-plugin-name" class="font-mono font-black text-lg tracking-widest">OBSIDIAN NEURAL</span>
        </a>
    </div>

    <nav class="flex-1 py-6">

        <div class="mb-6">
            <p class="px-6 mb-3 text-[0.7rem] font-bold uppercase tracking-[0.1em] text-white/40">Menu</p>
            <div class="space-y-1 px-4">
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all active bg-gradient-to-r from-primary to-[#a04840] text-white shadow-[0_4px_12px_rgba(184,96,92,0.4)]" data-section="overview"><i class="fas fa-th-large w-6 text-center"></i><span>Overview</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="subscription"><i class="fas fa-crown w-6 text-center"></i><span>Subscription</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="usage"><i class="fas fa-chart-bar w-6 text-center"></i><span>Usage &amp; Credits</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="gift"><i class="fas fa-gift w-6 text-center"></i><span>Gift Cards</span></a>
            </div>
        </div>

        <div class="mb-6">
            <p class="px-6 mb-3 text-[0.7rem] font-bold uppercase tracking-[0.1em] text-white/40">Settings</p>
            <div class="space-y-1 px-4">
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="api"><i class="fas fa-key w-6 text-center"></i><span>API Configuration</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="security"><i class="fas fa-shield-alt w-6 text-center"></i><span>Security</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="preferences"><i class="fas fa-cog w-6 text-center"></i><span>Preferences</span></a>
            </div>
        </div>

        <div class="mb-6">
            <p class="px-6 mb-3 text-[0.7rem] font-bold uppercase tracking-[0.1em] text-white/40">Resources</p>
            <div class="space-y-1 px-4">
                <a id="nav-download" href="#" target="_blank" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all"><i class="fas fa-download w-6 text-center"></i><span>Download Plugin</span></a>
                <a id="nav-support" href="#" target="_blank" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all"><i class="fas fa-life-ring w-6 text-center"></i><span>Support</span></a>
            </div>
        </div>

        <div class="mb-6 hidden" id="provider-nav-section">
            <p class="px-6 mb-3 text-[0.7rem] font-bold uppercase tracking-[0.1em] text-white/40">Provider</p>
            <div class="space-y-1 px-4">
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="provider-stats"><i class="fas fa-server w-6 text-center"></i><span>My Provider</span></a>
            </div>
        </div>

        <div class="mb-6 hidden" id="admin-nav-section">
            <p class="px-6 mb-3 text-[0.7rem] font-bold uppercase tracking-[0.1em] text-white/40">Admin</p>
            <div class="space-y-1 px-4">
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="admin"><i class="fas fa-users-cog w-6 text-center"></i><span>Admin Panel</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="email-broadcast"><i class="fas fa-envelope w-6 text-center"></i><span>Email Broadcast</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="email-logs"><i class="fas fa-envelope-open-text w-6 text-center"></i><span>Email Logs</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="analytics"><i class="fas fa-chart-line w-6 text-center"></i><span>Analytics</span></a>
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="providers"><i class="fas fa-server w-6 text-center"></i><span>GPU Providers</span></a>
            </div>
        </div>

        <div class="mb-6">
            <p class="px-6 mb-3 text-[0.7rem] font-bold uppercase tracking-[0.1em] text-white/40">Account</p>
            <div class="space-y-1 px-4">
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 font-medium hover:bg-primary/10 hover:text-white hover:translate-x-1 transition-all" data-section="danger"><i class="fas fa-exclamation-triangle w-6 text-center"></i><span>Danger Zone</span></a>
            </div>
        </div>

    </nav>

    <div class="px-4 pb-6 border-t border-primary/20 pt-4">
        <div class="flex items-center gap-3 p-3 bg-primary/10 rounded-xl mb-3 hover:bg-primary/20 transition-colors">
            <div id="user-avatar-initial" class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-[#a04840] flex items-center justify-center text-white font-black text-lg shrink-0">U</div>
            <div class="flex-1 min-w-0">
                <p id="user-name" class="text-white font-semibold text-sm truncate m-0">Loading...</p>
                <p id="user-email" class="text-white/50 text-[0.6rem] truncate m-0">Loading...</p>
            </div>
        </div>
        <button onclick="logout()" class="w-full px-4 py-2.5 rounded-xl bg-primary/10 border border-primary/30 text-primary font-bold text-sm hover:bg-gradient-to-r hover:from-primary hover:to-[#a04840] hover:text-white hover:border-transparent transition-all">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
        </button>
    </div>

</aside>