<div class="data-panel hidden" id="panel-finances">
    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">

        <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-bold text-white mb-1">
                    <i class="fas fa-euro-sign mr-2 text-primary"></i>Monthly Finance Reports
                </h2>
                <p class="text-xs text-gray-500">85% of subscription revenue is distributed equally among eligible providers each month.</p>
            </div>
            <div class="min-w-[180px]">
                <input
                    id="search-month"
                    type="text"
                    placeholder="Filter month (e.g. 2026-03)"
                    oninput="debounceFinances()"
                    class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-xs font-mono placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
            </div>
        </div>

        <div id="finances-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-full text-center py-12 text-gray-600">
                <i class="fas fa-spinner fa-spin text-2xl mb-3 block"></i>Loading…
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 mt-6">
            <div class="text-xs text-gray-500" id="finances-count-label">—</div>
            <div class="flex items-center gap-2">
                <button id="fin-prev" onclick="financesPage(-1)" disabled
                    class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs font-bold text-gray-400 hover:border-primary hover:text-primary transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="text-xs text-gray-500 px-1" id="fin-page-info">—</span>
                <button id="fin-next" onclick="financesPage(1)" disabled
                    class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs font-bold text-gray-400 hover:border-primary hover:text-primary transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>
</div>