<div class="data-panel hidden" id="panel-network">
    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-white mb-1">
                <i class="fas fa-network-wired mr-2 text-primary"></i>Provider Network
            </h2>
            <p class="text-xs text-gray-500">Active GPU nodes contributing to the OBSIDIAN Neural network.</p>
        </div>

        <div class="flex items-start gap-3 p-4 rounded-xl bg-primary/[0.06] border border-primary/20 mb-6 text-sm text-gray-400">
            <i class="fas fa-shield-check text-primary mt-0.5 shrink-0"></i>
            <div>
                <strong class="text-white">Reference node.</strong>
                The provider marked <em>Trusted</em> is the network's proof-of-work reference — its audio fingerprints serve as the ground truth for periodic verification rounds. All other providers are compared against it to ensure they run a genuine, unmodified model.
            </div>
        </div>

        <div id="network-grid" class="flex flex-col gap-3">
            <div class="text-center py-12 text-gray-600">
                <i class="fas fa-spinner fa-spin text-2xl mb-3 block"></i>Loading…
            </div>
        </div>

    </div>
</div>