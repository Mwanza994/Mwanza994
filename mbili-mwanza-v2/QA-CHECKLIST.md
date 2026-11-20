# V2 staging checklist

## What can be confirmed without the failed workspace

- Source stored in a separate repository folder; original downloads preserved.
- Two native WordPress install ZIPs and a combined source/preview ZIP are generated with standard ZIP headers and CRC-32 values.
- JavaScript syntax checked without executing browser-dependent code.
- Layouts use native Elementor containers and widgets with small dynamic widgets for highlights, pending organization titles, and verified social links.
- Installation and activation use WordPress capability and nonce checks.
- Existing page bodies are preserved; activation requires an explicit backup/authorization acknowledgment.
- Empty optional case-study data is still managed by the original Mbili Platform plugin.
- Imagery placeholders are explicitly labeled.

## Required before launch

- PHP lint and activation on PHP 8.1+ and your actual WordPress/Elementor versions.
- Create preview layouts and open each in Elementor; change/save a heading, portrait, button, responsive spacing, and shared template.
- Check 320, 390, 768, 1024, and 1440px layouts; ensure no horizontal overflow.
- Test header menu, Escape behavior, focus visibility, touch targets, and JavaScript-disabled navigation.
- Publish at least two authentic featured case studies; test the highlight slider's next/previous/dot/arrow-key controls and project links.
- Confirm Work's row layout, optional image preview, filtering, pagination, and pending-title behavior.
- Verify Resources cards, resource destinations, affiliate disclosure, article typography, related content, and 404.
- Temporarily disable Elementor on staging to verify that original case-study content remains readable.
- Test inquiry validation and actual email receipt. Recheck the recipient under the child theme's Customizer.
- Exclude both the original Contact page and `/contact-v2/` from server/CDN caches. If renaming Contact, update the no-cache conditions in code.
- Review the existing privacy draft, metadata, canonical URLs, actual author profile, XML sitemap, and social links.
- Test the restore-assignments action and switch back to the parent theme.
- Replace the portrait and workspace placeholders with optimized authentic images. Add descriptive alt text.
- Measure actual LCP, CLS, and INP with the final content and host. Targets: LCP ≤2.5s, CLS ≤0.1, INP ≤200ms. No V2 production score is claimed.
