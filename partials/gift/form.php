<div class="max-w-2xl mx-auto bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Purchase a Gift Card</h2>
            <p class="text-sm text-gray-500">All fields marked * are required</p>
        </div>

        <form id="giftForm">
            <div class="mb-8">
                <h4 class="text-sm font-bold text-white mb-4 flex items-center gap-2"><i class="fas fa-user text-primary"></i>Recipient Information</h4>
                <div class="space-y-4">
                    <div>
                        <label for="recipientEmail" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Recipient Email *</label>
                        <input type="email" id="recipientEmail" placeholder="their.email@example.com" required
                            class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label for="recipientName" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Recipient Name (optional)</label>
                        <input type="text" id="recipientName" placeholder="John Doe"
                            class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors">
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h4 class="text-sm font-bold text-white mb-4 flex items-center gap-2"><i class="fas fa-gift text-primary"></i>Gift Details</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="tier" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Plan *</label>
                        <select id="tier" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors appearance-none cursor-pointer">
                            <option value="" class="bg-black">Choose a plan...</option>
                            <option value="base" id="opt-base" class="bg-black">Base</option>
                            <option value="starter" id="opt-starter" class="bg-black">Starter</option>
                            <option value="pro" id="opt-pro" class="bg-black">Pro</option>
                        </select>
                    </div>
                    <div>
                        <label for="duration" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Duration *</label>
                        <select id="duration" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors appearance-none cursor-pointer">
                            <option value="" class="bg-black">Choose duration...</option>
                            <option value="1" class="bg-black">1 Month</option>
                            <option value="3" class="bg-black">3 Months</option>
                            <option value="6" class="bg-black">6 Months</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="activationDate" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Activation Date (optional)</label>
                    <input type="date" id="activationDate" min="2025-12-01"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors">
                    <p class="text-[11px] text-gray-500 mt-1.5">Leave empty for immediate availability</p>
                    <p class="text-[11px] text-warning font-bold mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>Gift code must be activated within 1 year from purchase date.</p>
                </div>
                <div>
                    <label for="giftMessage" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Personal Message (optional)</label>
                    <textarea id="giftMessage" rows="3" maxlength="500" placeholder="Happy holidays! Enjoy creating music with AI..."
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors resize-none"></textarea>
                    <p class="text-[11px] text-gray-500 mt-1 text-right"><span id="charCount">0</span> / 500</p>
                </div>
            </div>

            <div class="mb-8">
                <h4 class="text-sm font-bold text-white mb-4 flex items-center gap-2"><i class="fas fa-user-circle text-primary"></i>Your Information</h4>
                <div>
                    <label for="purchaserName" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Your Name (optional)</label>
                    <input type="text" id="purchaserName" placeholder="Your name"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors">
                    <p class="text-[11px] text-gray-500 mt-1.5">Will appear in the gift email</p>
                </div>
            </div>

            <div id="priceDisplay" class="hidden mb-6 p-5 rounded-xl bg-success/10 border border-success/20 text-center">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-300 text-sm">Total:</span>
                    <span class="text-3xl font-black text-white" id="totalPrice">—</span>
                </div>
            </div>

            <div id="errorAlert" class="hidden mb-6 p-4 rounded-xl bg-danger/10 border border-danger/30 text-danger text-sm font-medium">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span id="errorText">Please fill in all required fields.</span>
            </div>

            <button type="button" onclick="handleGiftSubmit()" id="submitBtn"
                class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                <i class="fas fa-credit-card mr-2"></i><span id="btnText">Proceed to Payment</span>
                <span id="btnSpinner" class="hidden ml-2 w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
            </button>
        </form>
    </div>
</div>