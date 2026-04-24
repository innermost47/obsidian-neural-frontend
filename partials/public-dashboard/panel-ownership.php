<div class="data-panel block" id="panel-ownership">
    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">

        <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-bold text-white mb-1">
                    <i class="fas fa-shield-halved mr-2 text-primary"></i>Generation Logs
                </h2>
                <p class="text-xs text-gray-500">Immutable Mel Spectrogram fingerprint proof-of-work — one row per audio generation.</p>
            </div>
            <div class="min-w-[220px]">
                <input
                    id="search-user-id"
                    type="text"
                    placeholder="Filter by public user ID…"
                    oninput="debounceOwnership()"
                    class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-xs font-mono placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs font-mono border-separate border-spacing-0">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap">Public user ID</th>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap">Provider</th>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap">Prompt hash</th>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap">Audio hash</th>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap">Duration</th>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap">Generated at</th>
                    </tr>
                </thead>
                <tbody id="ownership-tbody">
                    <tr>
                        <td colspan="6">
                            <div class="text-center py-12 text-gray-600">
                                <i class="fas fa-spinner fa-spin text-2xl mb-3 block"></i>Loading…
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 mt-4">
            <div class="text-xs text-gray-500" id="ownership-count-label">—</div>
            <div class="flex items-center gap-2">
                <button id="own-prev" onclick="ownershipPage(-1)" disabled
                    class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs font-bold text-gray-400 hover:border-primary hover:text-primary transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="text-xs text-gray-500 px-1" id="own-page-info">—</span>
                <button id="own-next" onclick="ownershipPage(1)" disabled
                    class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs font-bold text-gray-400 hover:border-primary hover:text-primary transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>
</div>