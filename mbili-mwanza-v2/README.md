# Mbili Mwanza — screenshot-directed layout V2

This is the **new dark/olive layout**, supplied separately from the original package. The original downloads remain in `downloads/mbili-mwanza/`.

## Downloads in this folder

- `mbili-reference-child.zip` — installable child theme with the new visual system.
- `mbili-layout-v2.zip` — installable layout plugin with native Elementor pages, shared templates, featured-work slider, and a reversible setup screen.
- `mbili-layout-v2-complete.zip` — both new components, source, instructions, and an offline visual preview.

**Dependencies:** the original **Mbili Editorial** parent theme, **Mbili Platform** plugin, and **Elementor Free**. The new files extend those tested content models. They do not replace the Case Studies/Resources system or require an Elementor Pro license.

## Installation

1. Back up the database and wp-content, and use staging.
2. Install the original parent theme and Mbili Platform plugin from [the original folder](../downloads/mbili-mwanza/), and install Elementor Free. If starting fresh, run the original **Tools → Mbili setup** first so the privacy page and starter case-study drafts exist.
3. Upload `mbili-reference-child.zip` through Appearance → Themes → Add New. Keep the parent theme installed.
4. Upload `mbili-layout-v2.zip` through Plugins → Add New, then activate the plugin.
5. Open **Tools → Mbili Layout V2 → Create V2 preview layouts**. New pages are drafts; existing content and live template assignments are preserved.
6. Activate the **Mbili Reference Layout** child theme on staging to see the new styling. Open the new pages using the setup screen's Elementor and Preview links.
7. Replace the labeled portrait outline and resource-background illustration with your own photography. The illustrations are placeholders, not images of Mbili or project evidence.
8. Review the shared templates under Templates → Saved Templates. Update the footer's real social links in Appearance → Customize → Mbili identity & social links. Recheck the inquiry recipient under the child theme's Customizer settings; theme modifications may differ from those saved under the parent theme.
9. Once reviewed, check the backup/authorization checkbox and click **Activate V2 page and template assignments**. This publishes the new pages, changes the front/posts pages and shared templates, and creates/assigns a V2 Primary menu.
10. Confirm Settings → Permalinks, mail delivery, privacy, metadata, responsive layouts, and all links before production.

The new About, Contact, and Writing pages initially use `/about-v2/`, `/contact-v2/`, and `/writing-v2/` to avoid replacing existing pages. Work and Resources remain the existing CPT archives at `/work/` and `/resources/`. If you later move the V2 pages to canonical slugs, update menu/button links, form-cache exclusions, redirects, and metadata deliberately.

## Editing and publishing

- Home/About/Contact: ordinary native Elementor Heading, Text Editor, Image, Button, and Container widgets.
- Global layout: the new shared header/footer, Work, Resources, Writing, case-study, article, resource, and 404 templates.
- Case-study content: keep using WordPress → Case Studies and the original structured publishing fields. Featured published case studies feed the highlight slider automatically.
- Work archive: large title rows with optional hover/focus image previews. No draft project content is exposed. The six supplied names are explicit editable placeholder settings shown only while no case studies are published.
- Resources: dynamic dark cards from the existing Resource content model.
- Slider: manual previous/next/dot controls, keyboard arrow support, no autoplay.
- Newsletter: clearly inactive until a real service is integrated.
- Reading and field data remain in WordPress. No whole-page HTML widget is used.

## Reversal

Tools → Mbili Layout V2 → **Restore saved assignments** restores the Reading settings, template slots, and Primary menu captured before activation. New V2 pages are retained. Switch to the parent theme to restore the original visual styling. For a complete rollback, restore your database and wp-content backup together.

## Visual preview

Open `preview/index.html` locally to review the design direction. It is a static visual preview with clearly marked imagery/resource placeholders, not a running WordPress site or a form-delivery test.

## Verification status

The failed execution workspace prevented WordPress/PHP/browser runtime testing for this revision. The JavaScript was syntax-checked in the available JavaScript engine; native Elementor data structure conventions and installation safety were reviewed; ZIP structure, CRCs, and file manifests were checked programmatically.

**Do not treat this revision as production-validated.** Run the staging checklist in `QA-CHECKLIST.md`. The original version's test results do not automatically apply to V2.

No GitHub Actions workflow, production deployment, DNS change, credentials, fabricated metrics, testimonials, or third-party photographs are included.
