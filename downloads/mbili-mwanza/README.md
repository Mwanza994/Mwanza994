# Mbili Mwanza — Editorial WordPress package

A standalone WordPress theme, a separate functionality plugin, native Elementor documents, and installation/editing documentation. Designed for mbilimwanza.com; no domain is hard-coded and no production changes are made by this package.

## Install in this order

1. Make a full database and wp-content backup. Start on staging or a fresh local WordPress installation.
2. Install **Elementor Website Builder (free)** from WordPress.org. Use a current stable version compatible with your WordPress version. No paid plugins or activation keys are included or required.
3. Appearance → Themes → Add New → Upload Theme: select **mbili-editorial.zip**, install, then activate.
4. Plugins → Add New → Upload Plugin: select **mbili-platform.zip**, install, then activate.
5. Tools → **Mbili setup**. Confirm your backup, and choose whether to assign the imported Home and Writing pages in Reading settings and set the site identity to Mbili Mwanza. Choose the optional starter global kit if you want the palette available in Elementor Site Settings. Click **Install starter content** once. Existing matching slugs, templates, and assigned menus are preserved. Review the import notice if any items were skipped.
6. Settings → Permalinks: choose **Post name**, then save. The plugin flushes rules on activation/import; saving again resolves hosting-specific rewrite setup.
7. Elementor → Settings: disable Elementor's default colors and fonts so the theme's palette and typography inherit consistently. In Elementor's Site Settings, you may then create your own global palette using the values in DESIGN.md. Clear/regenerate Elementor CSS/data after changes.
8. Settings → Reading: confirm Home is the front page and Writing is the posts page. The writing archive uses the shared **Mbili · Writing Archive** Elementor template, not the unused posts-page body.
9. Replace both portrait placeholders on Home and About with your real photographs using Elementor's native Image widget. Supply meaningful alternative text in the Media Library. No stock person is represented as Mbili.
10. Appearance → Menus: confirm the Primary menu, labels, and links. Templates → Saved Templates: edit **Mbili · Shared Header** and **Mbili · Shared Footer** for brand and social links. Add only your verified social destinations.
11. Appearance → Customize → **Mbili identity & social links**: set the inquiry recipient and optional social URLs used by Person structured data. An empty inquiry address falls back to the WordPress administrator email. Social URLs in the footer are independently editable in Elementor.
12. Review the **Privacy Policy** draft, replace all review instructions, add the actual privacy contact/provider/retention details, and assign it under Settings → Privacy. Review all pages before allowing public indexing.
13. Configure outgoing mail through your hosting provider or a maintained SMTP plugin. Submit real test inquiries and verify receipt and Reply-To behavior. A successful wp_mail() handoff is not proof of inbox delivery.
14. Keep `/contact/` out of page/CDN caches. The code sends no-cache headers, but an upstream cache must also honor the exclusion. Contact forms must not be copied onto cached pages without adding the same exclusions.
15. Read EDITING-GUIDE.md, DEPLOYMENT.md, and QA-REPORT.md before launch.

## What is included

- Home, About, Writing, Contact, and Privacy Elementor pages.
- Dynamic Work (`/work/`) and Resources (`/resources/`) archives, implemented as true WordPress CPT archives rather than colliding static pages.
- Single case study, article, and resource templates; shared header/footer; 404 template.
- Six **draft** case studies: Prime Paints, Locath Tracks, Jimmy Countrywide, Topgred, African Paints, and Fingen. Only the supplied Prime Paints role/year is prefilled. No projects, metrics, testimonials, images, or articles are invented.
- Dynamic homepage featured-work, recent-writing, and resource grids. An honest empty state displays until you publish content.
- A future newsletter component, visibly inactive. No subscriber data is collected or sent anywhere.
- Structured project publishing fields, repeatable visual sections, up to four KPI cards, resource fields, taxonomy filters, search, and pagination.

## Elementor Free and Pro

This package works with **Elementor Free** using saved Elementor documents in shared theme slots. It does not pretend to install or license Elementor Pro Theme Builder. The shared case-study design is edited once in Elementor and used for all case studies. Custom widgets resolve real WordPress data at runtime. If Pro is available later, migrate intentionally to its conditions/dynamic bindings; do not enable duplicate headers or templates. No unlicensed Pro code is bundled.

All major static headings, prose, images, buttons, and containers are native Elementor widgets. Dynamic content uses small purpose-built widgets, not a complete HTML page hidden in an HTML widget. Custom publishing structures use standard WordPress metadata and admin fields, an ACF-equivalent interface without a paid repeater dependency.

## Prerequisites

WordPress 6.6+, PHP 8.1+, Elementor Free, HTTPS in production, and working WordPress mail delivery. PHP memory of at least 256 MB is recommended for comfortable Elementor editing. The plugin stores no API keys and has no remote service dependency. JavaScript is native browser JavaScript; no GSAP, external font service, or animation library is required.

## Uninstall and rollback

Deactivate the plugin and switch themes to revert presentation. Do not delete your content to roll back. CPT entries and metadata remain in the database; reactivating the plugin restores their admin menus and URLs. If you need to revert imported pages/settings entirely, restore your pre-install database and wp-content backup together. The import never wipes an existing website. Do not upload the complete delivery bundle as a WordPress theme: use the two individual install ZIPs inside it.
