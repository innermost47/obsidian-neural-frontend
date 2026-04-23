<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 pb-24">

    <div class="lg:col-span-2 bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 md:p-8">
        <div id="alert-container" class="mb-6"></div>

        <h2 class="text-2xl font-bold mb-6 text-white"><i class="fas fa-paper-plane mr-2 text-primary"></i>Send us a Message</h2>

        <form id="contactForm">
            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" />
            <input type="email" name="email_confirm" class="hidden" tabindex="-1" autocomplete="off" />
            <input type="hidden" name="timestamp" id="timestamp" value="" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-400 mb-2">Full Name *</label>
                    <input type="text" id="name" name="name" required maxlength="100" placeholder="John Doe"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors">
                </div>
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-400 mb-2">Email *</label>
                    <input type="email" id="email" name="email" required maxlength="100" placeholder="john@example.com"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors">
                </div>
            </div>

            <div class="mb-4">
                <label for="subject" class="block text-sm font-bold text-gray-400 mb-2">Subject *</label>
                <select id="subject" name="subject" required
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors">
                    <option value="" class="bg-black">Select a subject...</option>
                    <option value="support" class="bg-black">Technical Support</option>
                    <option value="billing" class="bg-black">Billing / Subscription</option>
                    <option value="feature" class="bg-black">Feature Request</option>
                    <option value="bug" class="bg-black">Report a Bug</option>
                    <option value="partnership" class="bg-black">Partnership</option>
                    <option value="other" class="bg-black">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-bold text-gray-400 mb-2">Message *</label>
                <textarea id="message" name="message" rows="6" required maxlength="2000" placeholder="Describe your request in detail..."
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors resize-none"></textarea>
                <small class="text-xs text-gray-500 mt-1 block"><span id="charCount">0</span> / 2000 characters</small>
            </div>

            <div class="mb-6">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" id="consent" name="consent" required class="mt-1 w-4 h-4 rounded border-white/20 bg-white/5 text-primary focus:ring-primary cursor-pointer">
                    <span class="text-sm text-gray-400">I agree that my data will be used to process my request *</span>
                </label>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full md:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-105 transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]">
                <i class="fas fa-paper-plane mr-2"></i>
                <span id="btnText">Send Message</span>
                <span id="btnSpinner" class="hidden ml-2 w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
            </button>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="space-y-4">
        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
            <h4 class="font-bold mb-4 text-white"><i class="fas fa-info-circle mr-2 text-primary"></i>Information</h4>

            <div class="p-4 rounded-xl bg-primary/10 border border-primary/20 mb-4">
                <div class="flex items-center gap-3">
                    <i class="fas fa-clock text-primary text-xl"></i>
                    <div>
                        <h5 class="font-bold text-sm text-white">Response Time</h5>
                        <p class="text-xs text-gray-400">Within 24-48 hours on business days</p>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <a id="contact-email-link" href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                    <div class="w-10 h-10 rounded-full bg-primary/20 text-primary flex items-center justify-center shrink-0"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="text-[10px] text-gray-500 font-bold uppercase">Email</div>
                        <div class="text-sm text-gray-300 ct-value">—</div>
                    </div>
                </a>

                <a id="contact-github-link" href="#" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                    <div class="w-10 h-10 rounded-full bg-white/10 text-gray-400 flex items-center justify-center shrink-0"><i class="fab fa-github"></i></div>
                    <div>
                        <div class="text-[10px] text-gray-500 font-bold uppercase">GitHub</div>
                        <div class="text-sm text-gray-300 ct-value">—</div>
                    </div>
                </a>

                <a id="contact-docs-link" href="#" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                    <div class="w-10 h-10 rounded-full bg-track2/20 text-track2 flex items-center justify-center shrink-0"><i class="fas fa-book"></i></div>
                    <div>
                        <div class="text-[10px] text-gray-500 font-bold uppercase">Documentation</div>
                        <div class="text-sm text-gray-300">View Documentation</div>
                    </div>
                </a>

                <a id="contact-issues-link" href="#" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                    <div class="w-10 h-10 rounded-full bg-warning/20 text-warning flex items-center justify-center shrink-0"><i class="fas fa-bug"></i></div>
                    <div>
                        <div class="text-[10px] text-gray-500 font-bold uppercase">Bug Reports</div>
                        <div class="text-sm text-gray-300">GitHub Issues</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>