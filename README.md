# OBSIDIAN Neural — Frontend

### Related Repositories

| Repository                                                                                             | Description                                  |
| ------------------------------------------------------------------------------------------------------ | -------------------------------------------- |
| [obsidian-neural-central](https://github.com/innermost47/obsidian-neural-central)                      | Central inference server                     |
| [obsidian-neural-provider](https://github.com/innermost47/obsidian-neural-provider)                    | Provider kit — run a GPU node on the network |
| **[obsidian-neural-frontend](https://github.com/innermost47/obsidian-neural-frontend)** ← you are here | Storefront & dashboard                       |
| [obsidian-neural-controller](https://github.com/innermost47/obsidian-neural-controller)                | Mobile MIDI controller app                   |
| [ai-dj](https://github.com/innermost47/ai-dj)                                                          | VST3/AU plugin (client)                      |

---

## Overview

Marketing website and user dashboard for [OBSIDIAN Neural](https://obsidian-neural.com), the open-source VST3/AU plugin for real-time AI music generation in live performance.

Presented at **AES AIMLA 2025** — Queen Mary University London.

---

## What's in here

- **Landing page** — features, demos, press coverage, pricing
- **User dashboard** — API key, credits, subscription management, analytics
- **Documentation** — setup guides for Windows, macOS, Bitwig, Ableton
- **Legal pages** — privacy, terms, cookies

All sensitive values (domain, API URLs, prices, GA IDs, GitHub repo...) are centralized in a single `js/config.js` file — never hardcoded.

## Stack

Vanilla JS · Bootstrap 5 · HTML/CSS · Stripe (via backend) · Google Analytics

## Related

- 🔌 **Plugin** → [innermost47/ai-dj](https://github.com/innermost47/ai-dj)
- 📱 **Mobile controller** → [innermost47/obsidian-neural-controller](https://github.com/innermost47/obsidian-neural-controller)
- 📄 **AES Paper** → [Read it](https://drive.google.com/file/d/1cwqmrV0_qC462LLQgQUz-5Cd422gL-8F/view)
