<?php

namespace BricksExtras;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ChangelogPage {

	public static function init() { ?>
		<h2>Changelog</h2>

		<div class="changelog-entry">
			<h3>1.2.6
				<small>( May 10, 2023 )</small>
			</h3>
			<ul>
				<li>[Evergreen Countdown] - New element for evergreen countdowns.</li>
				<li>[Dynamic Chart] - New query loop option for dynamically adding new data points.</li>
				<li>[Header Search] - Added "expand" search type.</li>
				<li>[Pro Accordion] - Added an option to auto-add FAQ schema to all accordion items.</li>
				<li>[Notification Bar] - The "show again until user clicks dismiss" now allows for showing again after a set time.</li>
				<li>[Pro Slider Gallery] - Added an option to change the size of image when adding links (for use with Dynamic Lightbox).</li>
				<li>[Hotspots] - Markers can now be links.</li>
				<li>[Slide Menu] - Added customizable aria-label for dropdown arrows.</li>
				<li>[Table of Contents] - Added "conditional display" option to remove table if no headings found.</li>
				<li>[X-Ray] - Moved position of icon and can now be enabled/disabled from plugin settings page.</li>
				<li>[Dynamic Lightbox] - Plyr assets no longer being fetched from the CDN.</li>
				<li>[General] - Added support for using elements inside content filtered by Piotnet Grid's facets.</li>
				<li>[General] - Some minor UI changes ready for Bricks v1.8.</li>
				<li>[Lottie] - Fixed an issue with "hover" trigger where child elements would restart animation.</li>
				<li>[Pro Slider] - Fixed an issue where styling wasn't correct inside builder if was inside Bricks' template element.</li>
				<li>[Table of Contents] - Fixed an issue where adding non-numeric values in offset wasn't accepted.</li>
				<li>[Modal] - Fixed an issue where very bottom of modal sometimes wasn't visible on mobile devices.</li>
			</ul>
			
			<h3>1.2.5
				<small>( Apr 12, 2023 )</small>
			</h3>
			<ul>
				<li>[Adjacent Posts] - New Query Loop extension for building custom prev/next post layout.</li>
				<li>[Related Posts] - New Query Loop extension for displaying related posts within specific taxonomies.</li>
				<li>[General] - Support added for JetSmartFilters for using the elements inside loops being filtered (Modal, Lightbox, OffCanvas, Pro Accordion, Social Share, Read More, Pro Slider & Popover).</li>
				<li>[Dynamic Lightbox] - Now supports being inside nested query loops.</li>
				<li>[Pro Slider] - Now supports being inside nested query loops (including syncing and controls).</li>
				<li>[Pro Slider] - Added "adaptive height" option to allow slider to adapt to current active slide height.</li>
				<li>[Pro Slider] - Added support for re-triggering "big" inner animations - fadeInUpBig, fadeInDownBig etc. from Bricks' interactions.</li>
				<li>[Pro Slider Gallery] - Gallery images can now be linked to Bricks v1.7.2+ Lightbox.</li>
				<li>[Site breadcrumbs] - Added more controls over output - excluding specific post/product categories or disabling categories.</li>
				<li>[Dynamic Chart] - New horizontal option for bar/line charts. (labels up the Y-axis, values along the X-axis).</li>
				<li>[Dynamic Chart] - Now allows for adding units before or after the values.</li>
				<li>[Dynamic Chart] - Added option to add tooltips to charts.</li>
				<li>[Dynamic Chart] - Fixed an issue where using large 7+ digit numbers (that resemble telephone numbers) as values wouldn't plot correctly if viewed on iOS.</li>
				<li>[Header Extras] - Fixed Header Extras tab sometimes not appearing inside page settings.</li>
				<li>[Header Search] - Fixed an issue with icons not changing size/colors if using custom SVGs.</li>
				<li>[Dynamic Table] - Fixed an issue with "if no rows found" text not being customizable when pagination is disabled.</li>
			</ul>
			
			<h3>1.2.4
				<small>( Mar 09, 2023 )</small>
			</h3>
			<ul>
				<li>[Social Share] - New element for adding social share buttons.</li>
				<li>[Site Breadcrumbs] - New element for adding site-wide breadcrumbs.</li>
				<li>[Modal] - Now supports being inside nested query loops (up to 3 levels deep).</li>
				<li>[OffCanvas] - Now supports being inside nested query loops (up to 3 levels deep)</li>
				<li>[OffCanvas] - Added an option to fade in in addition to slide in for the Transition type.</li>
				<li>[Pro Slider] - Added Splide lazy loading option.</li>
				<li>[Pro Slider Gallery] - Added a setting to enable slider lazy loading for all gallery images (either Bricks or Splide lazy load).</li>
				<li>[Pro Slider Gallery] - Added a setting to enable/disable SRCSET on images.</li>
				<li>[General] - Added out-of-the-box support for WP Grid Builder's facets. Modal, OffCanvas, Pro Accordion, Pro Slider, Dynamic Lightbox, Social Share, Read More, Popover (for being used inside query loops when building filtered).</li>
				<li>[Tilt Effect] - Scale now accepts decimal values ( 1.5 = 150%).</li>
				<li>[Pro Accordion] - Added an option to change the HTML tag on the wrapper (for doing ul>li etc).</li>
				<li>[Dynamic Table] - Added an option to set a fixed height for a scrollable table (header & footer remain fixed).</li>
				<li>[Dynamic Lightbox] - Added an option to change UI color for video player in manual link mode.</li>
				<li>[Dynamic Lightbox] - Can now use class added to headings or images directly for link selectors (before you may have needed to use `.my-class a` due to Bricks not adding the classes to the links, this is done automatically now).</li>
				<li>[Content Timeline] - Reworked the logic for the line, for more accurate positioning.</li>
				<li>[Content Timeline] - Added a `—x-timeline-progress` CSS variable that changes value from 1 - 100 as the timeline progresses (can be used to change styles on any inner elements based on timeline position).</li>
				<li>[Interactive Cursor] - Added an option to change border-radius of ball/trails.</li>
				<li>[X-Ray] - Slightly darker outlines by default for better visibility (users can change `—x-xray-color` CSS variable from Bricks CSS settings if wishing to change color).</li>
				<li>[Modal] - Fixed the issue with close button not triggering if multiple modals are open simultaneously.</li>
				<li>[Slide Menu] - Fixed the issue of not correctly outputting menu when populating `menu slug` using dynamic tags.</li>
			</ul>
			
			<h3>1.2.3
				<small>( Jan 26, 2023 )</small>
			</h3>
			<ul>
				<li>[Read More] - Accessibility improvement (aria-expanded label).</li>
				<li>[Dynamic Lightbox] - Fixed specificity issue causing width to appear incorrectly in builder.</li>
				<li>[General] - Fixed an issue with Bricks v1.6.2 where some style settings were hidden if class selected.</li>
			</ul>

			<h3>1.2.2
				<small>( Jan 23, 2023 )</small>
			</h3>
			<ul>
				<li>[Content Timeline] - New element for creating content timeline layouts.</li>
				<li>[X-Ray Mode] - In-builder option for quickly viewing layout structures visually.</li>
				<li>[Dynamic Lightbox] - Added "gallery" option to lightbox content for pulling in galleries into single lightbox.</li>
				<li>[Dynamic Lightbox] - Added better support for WPGB infinite scroll (see support FAQ in docs).</li>
				<li>[Image hotspots] - Added an option to add custom alt text to image.</li>
				<li>[Dynamic Table] - No longer outputs "NaN" if column set to numbers and cell has no value.</li>
				<li>[Dynamic Lightbox] - Fixed the issue with UI styles styling both close buttons and navigation together.</li>
				<li>[Fluent Form] - Updated some selectors to match Fluent Forms flex-box column gaps.</li>
				<li>[Header Extras] - Slight CSS change to avoid small jump if header set to be sticky immediately after scrolling.</li>
				<li>[General] - Removed various default CSS settings for better support for mobile-first.</li>
			</ul>
			
			<h3>1.2.1
				<small>( Jan 04, 2023 )</small>
			</h3>
			<ul>
				<li>[Pro Slider / Gallery] - Added an option to change the slide list HTML tag (for changing to <ul> lists etc. if needed).</li>
				<li>[Interactive Cursor] - Fixed the issue where cursor wasn't visible on some desktop devices that have touchscreen.</li>
				<li>[Header Extras] - Fixed breakpoint issue causing warning with some older versions of PHP.</li>
			</ul>
			
			<h3>1.2.0
				<small>( Jan 03, 2023 )</small>
			</h3>
			<ul>
				<li>[Header Extras] - New features added to Bricks' header template - (overlay headers, sticky on scroll, hide header after scrolling X added to any breakpoint globally, or per page/template).</li>
				<li>[Header Row] - New element for more easily building headers in bricks (supports conditionally appearing in overlay or sticky headers, change styles when sticky etc).</li>
				<li>[Pro Slider] - Added an option to change all aria-labels for pagination, nav arrows etc.</li>
				<li>[Pro Slider] - Added a "conditional slider" option to disable slider if not enough slides to fill the slider viewport.</li>
				<li>[Pro Slider] - Added an option to set horizontal flex alignment if there are not enough slides.</li>
				<li>[Pro Slider] - Added an option to delay the first staggered animation.</li>
				<li>[Pro Slider] - "Focus" setting can now be changed per breakpoint.</li>
				<li>[Toggle Switch] - Query loop can now be used to populate "multiple labels".</li>
				<li>[Dynamic Table] - New "Stackable table" option for stacking columns on mobile.</li>
				<li>[Burger Trigger] - Now possible to hide the button text at different breakpoints.</li>
				<li>[Interactive Cursor] - Cursor will now automatically shrink if moving position over an iFrame.</li>
				<li>[Interactive Cursor] - Fixed the issue with cursor not reacting to readmore/less buttons.</li>
				<li>[General] - Fixed compatibility issue with OffCanvas/Modal template dropdown with Bricks v1.6+.</li>
				<li>[Dynamic Lightbox] - Fixed an issue with overflow resetting to "auto" on mobile.</li>
				<li>[Table of Contents] - Fixed an issue where collapse depth wouldn't apply.</li>
			</ul>
			
			<h3>1.1.9
				<small>( Nov 23, 2022 )</small>
			</h3>
			<ul>
				<li>[Pro Accordion] - New element for building nestable and accessible accordions.</li>
				<li>[Table of Contents] - Now supports different open/close positions at different screen widths.</li>
				<li>[Pro Slider] - Added support for Bricks v.1.5.6 interactions (for triggering fadein type animations on elements inside slides).</li>
				<li>[Pro Slider] - Added overflow setting to allow slides to go outside of slide track.</li>
				<li>[Dynamic Table] - Added an option to change "no records found" text if there are no rows.</li>
				<li>[Toggle Switch] - Added an option to disable labels and just use the toggle switch.</li>
			</ul>
			
			<h3>1.1.8
				<small>( Nov 15, 2022 )</small>
			</h3>
			<ul>
				<li>[Toggle Switch] - Added label layout controls to allow for stacking labels on mobile.</li>
				<li>[Toggle Switch / Switcher] - Accessibility improvement - tablist/tabpanel & ARIA labels added when using multiple labels like tabs.</li>
				<li>[Back to Top] - Fixed BricksProps CSS overriding the button SVG.</li>
				<li>[Back to Top] - Fixed background circle being slightly visible over progress when on darker backgrounds.</li>
				<li>[Read More] - Fixed read more not always opening when inside query loops.</li>
				<li>[Dynamic Table] - Fixed an issue with columns not being resizable.</li>
			</ul>
			
			<h3>1.1.7
				<small>( Nov 10, 2022 )</small>
			</h3>
			<ul>
				<li>[Back to Top] - New element for creating animated back to top buttons.</li>
				<li>[Interactive Cursor] - New element for adding cursors that interact with other elements.</li>
				<li>[Popovers/Tooltips] - New element for adding popovers or tooltips to elements.</li>
				<li>[Modal] - Modals using "click" as trigger can now be used inside query loops.</li>
				<li>[Interactive features] - Now added to most native elements.</li>
				<li>[Fluent Form] - Added "progress steps" to progress bar style controls.</li>
				<li>[Lightbox] - Fixed the issue where CSS grid inside lightbox content wouldn't display correctly inside the builder.</li>
			</ul>
			
			<h3>1.1.6
				<small>( Oct 30, 2022 )</small>
			</h3>
			<ul>
				<li>[Pro Slider] Fixed a bug with the counter being blank unless navigated.</li>
			</ul>
			
			<h3>1.1.5
				<small>( Oct 28, 2022 )</small>
			</h3>
			<ul>
				<li>[Pro Slider Control] - Added an option to create custom navigation arrows/buttons for Slider.</li>
				<li>[Pro Slider Gallery] - Added an ability to link gallery images to Bricks' Lightbox.</li>
				<li>[Dynamic Table] - Added "static" option - add rows/cells manually without query loop.</li>
				<li>[Dynamic Table] - Alternative row styles for background / text colors.</li>
				<li>[Modal] - Added "hashlink to close" option.</li>
				<li>[Dynamic Lightbox] - Added "hashlink to close" option.</li>
				<li>[Dynamic Lightbox] - Added "manual links" option to populate content dynamically from links. Supports images/videos/iFrames.</li>
				<li>[Modal] - Fixed the issue with exit intent trigger not triggering in Safari.</li>
			</ul>
			
			<h3>1.1.4
				<small>( Oct 21, 2022 )</small>
			</h3>
			<ul>
				<li>[Reading Progress Bar] - New element for adding reading progress bars based on scroll position of containers, or of the whole page.</li>
				<li>[Before / After Image] - New element for adding accessible before/after image sliders.</li>
				<li>[Table of Contents] - Added option to automatically use heading text for the anchor links.</li>
				<li>[Table of Contents] - Better support for Bricks' "Add Element ID & class as needed" setting (no longer required to add an ID to the element).</li>
				<li>[Modal] - Added an option to disable "auto focus on first focusable element" when opened.</li>
				<li>[Dynamic Table] - Added options to change/translate all text inside the pagination summary.</li>
				<li>[Dynamic Table] - Bumped to the latest GridJS version.</li>
				<li>[Dynamic Table] - Added an option to customize the number of pagination buttons.</li>
				<li>[Dynamic Table] - Fixed the issue with certain characters ( åäö ) not displaying correctly inside the builder.</li>
				<li>[Dynamic Lightbox] - Removed the default 900px max-width restriction on the container.</li>
			</ul>
			
			<h3>1.1.3
				<small>( Oct 13, 2022 )</small>
			</h3>
			<ul>
				<li>[Pro Slider] - Added option to change "focus" (was originally set to "center" as default).</li>
				<li>[Pro Slider] - Added controls for navigation by mouse wheel.</li>
				<li>[Pro Slider] - Reduced default slide padding and now no default padding if using code element to add custom slides.</li>
				<li>[Image Hotspots] - Better style control over marker icon.</li>
			</ul>
			
			<h3>1.1.2
				<small>( Oct 07, 2022 )</small>
			</h3>
			<ul>
				<li>[Pro Slider] - New element for building sliders/carousels.</li>
				<li>[Pro Slider Control] - New element for adding extras to sliders: Progress bars, counters, autoplay play/pause button.</li>
				<li>[Pro Slider Gallery] - New element for allowing to use the Pro Slider for dynamic galleries ex.: use ACF Gallery field or Meta Box Image Advanced or Media Library as the source of slide images.</li>
				<li>[Dynamic Chart] - Added "pie / doughnut" chart type.</li>
				<li>[Dynamic Lightbox] - Added easy way to add custom close buttons - "data-x-lightbox-close" attribute.</li>
				<li>[Burger Trigger] - Added option to add button text.</li>
				<li>[Table of Contents] - Smooth scrolling can now be disabled.</li>
				<li>[Modal] - Clicking backdrop to close and ESC key to close now optional.</li>
				<li>[Read More / Less] - Fixed issue where read more wouldn't size correctly when inside a modal.</li>
				<li>[OffCanvas] - Fixed issue where Safari that would cause lazy loaded images not to render.</li>
				<li>[Developer docs] - gLightbox instance now exposed, so lightbox can be controlled programmatically easily.</li>
			</ul>
			
			<h3>1.1.1
				<small>( Sep 14, 2022 )</small>
			</h3>
			<ul>
				<li>[Header Search] - Fixed an issue with return (enter) key in Safari causing the search form to close.</li>
				<li>[Fluent Forms] - Switched over some control types to allow for CSS variables.</li>
				<li>[Modal] - When using custom link for closing, browser will now follow the link after closing the modal.</li>
				<li>[General] - Addressed an issue that was causing styling not to be applied when elements were being pulled from other templates inside of templates (ex.: the "template" element or "post content" element).</li>
				<li>[Modal/OffCanvas] - Fixed issue with "template" versions that would cause the "hide in builder" setting to reset sometimes when moving the elements in the structure panel.</li>
			</ul>
			
			<h3>1.1
				<small>( Sep 13, 2022 )</small>
			</h3>
			<ul>
				<li>[General] - Fixed an issue where inline CSS wasn't correctly output on some installs.</li>
			</ul>
			
			<h3>1.0.9
				<small>( Sep 12, 2022 )</small>
			</h3>
			<ul>
				<li>[Header Search] - New element for creating different types of header searches.</li>
				<li>[Lottie] - New element for adding interactive Lottie animations.</li>
				<li>[Toggle Switch] - New element for adding toggle switches (supports multiple toggles).</li>
				<li>[Content Switcher] - New element for switching multiple versions of any content.</li>
				<li>[Lightbox] - Added iFrame option for lightbox content.</li>
				<li>[Dynamic Table] - Now supports being inside nested query loops.</li>
				<li>[Image Hotspots] - Now supports being inside nested query loops.</li>
				<li>[Dynamic Chart] - Now supports being inside nested query loops.</li>
				<li>[Dynamic Chart] - If no data found, will now output nothing, instead of an empty chart.</li>
				<li>[Modal] - Performance improvement (prevent images/video loading until modal opened).</li>
				<li>[Star rating] - Added "gap" setting for stars.</li>
				<li>[Lightbox] - Fixed lazy loading images not always showing in Safari.</li>
				<li>[General] - Removed all slider controls to replace with number controls (to align with Bricks v1.5.1 removing the units dropdown).</li>
				<li>[General] - Minor CSS specificity changes for Bricks v1.5.1.</li>
				<li>[General] - Performance improvement for element CSS to prevent FOUC (also now respects user preferred CSS loading method as set in Bricks settings - inline or external files).</li>
			</ul>
			
			<h3>1.0.8
				<small>( Aug 23, 2022 )</small>
			</h3>
			<ul>
				<li>[Dynamic tag - Loop Index] - New tag "x_loop_index" for count inside query loops (with offset filter).</li>
				<li>[Interactive features] - Now available for the div and block elements.</li>
				<li>[Modal, Lightbox] - Added flex layout controls to main "content" settings for easier control over the inner content layout.</li>
				<li>[Table of Contents] - Now supports including headings found inside separate containers.</li>
				<li>[Burger Trigger] - Added "active line color" control.</li>
			</ul>
			
			<h3>1.0.7
				<small>( Aug 17, 2022 )</small>
			</h3>
			<ul>
				<li>[Modal] - Added option to disable scroll when open.</li>
				<li>[Star Rating] - Improved logic for star rating to avoid issue when using empty values from dynamic data.</li>
			</ul>
			
			<h3>1.0.6
				<small>( Aug 16, 2022 )</small>
			</h3>
			<ul>
				<li>[Dynamic Lightbox] - New element for being able to popup dynamic content from inside post loops.</li>
				<li>[Offcanvas, Modal] - New nestable elements to replace older versions (previous "template" versions still available for backward compatibility or if you prefer to use templates).</li>
				<li>[Read More / Less, Header Notification Bar, Pro Alert, Shortcode Wrapper, Pro Alert] - now supports nesting elements.</li>
				<li>[Dynamic Tags] - Now supports being used inside AJAX added content (ex.: when using inside content dynamically added using WP Grid Builder's filters).</li>
				<li>[Star Rating] - Now allows for any number of total stars.</li>
				<li>[Slide Menu] - Now allows for elements being inside, either above/below the menu items.</li>
				<li>[Table of Contents] - Added ability to have "closed on page load".</li>
				<li>[Burger Trigger] - Better default CSS to prevent bottom gap if changing the display setting.</li>
				<li>[Fluent Form] - Fixed issue with dynamic data for Form ID not displaying form correctly.</li>
				<li>[Fluent Form] - Fixed CSS specificity issues where styles added via class were being overridden by defaults.</li>
				<li>[General] - A few small CSS fixes to account for Bricks v1.5's new default CSS.</li>
				<li>[General] - Added support for Bricks' experimental feature "Add Element ID & class only as needed" (elements that need the element ID to function, will have an ID added automatically if there isn't one).</li>
			</ul>
			
			<h3>1.0.5
				<small>( Jul 31, 2022 )</small>
			</h3>
			<ul>
				<li>Fixed a fatal error due to change in the attributes of bricks/element/render_attributes filter.</li>
			</ul>
			
			<h3>1.0.4
				<small>( Jul 05, 2022 )</small>
			</h3>
			<ul>
				<li>[Dynamic Table] - Added option to specify column data type as "number", to allow for sorting by numbers.</li>
				<li>[Dynamic Table] - Now allows for HTML tags from WYSIWYG fields inside the cells.</li>
				<li>[Slide Menu] - Added "text indent" setting for indenting nested sub menu items.</li>
				<li>[Image Hotspots] - Fixed the issue where marker background style wasn't visible.</li>
				<li>[Table of Contents] - Fixed the issue with unique ID setting causing table not to show.</li>
			</ul>
			
			<h3>1.0.3
				<small>( Jun 24, 2022 )</small>
			</h3>
			<ul>
				<li>[Parallax] - Improved the parallax scroll feature, new "default" setting for all devices.</li>
				<li>[Star Rating] - Small improvement for the default CSS.</li>
			</ul>
			
			<h3>1.0.2
				<small>( Jun 21, 2022 )</small>
			</h3>
			<ul>
				<li>[Dynamic Chart] - New element for displaying line/bar charts using dynamic data.</li>
				<li>[Read More/Less] - New element for expanding/revealing content.</li>
				<li>[Star Rating] - New element for displaying star ratings (for testimonials, reviews etc).</li>
				<li>[Dynamic Data Tags] - Added multiple new tags for use inside Bricks' dynamic data options.</li>
				<li>[Dynamic Table] - Added an option to make columns resizable.</li>
				<li>[Dynamic Table] - Added an option to prevent column text wrapping.</li>
				<li>[Dynamic Table] - Added cell overflow control.</li>
				<li>[Dynamic Table] - Added an option to specify a min-width for each column.</li>
				<li>[OffCanvas] - Added an option to prevent site scrolling when open.</li>
				<li>[Modal & OffCanvas] - iFrame embeds, videos and forms inside will now be automatically reset/stopped when closed.</li>
			</ul>

			<h3>1.0.1
				<small>( Jun 08, 2022 )</small>
			</h3>
			<ul>
				<li>[Image hotspots] - Added the ability to control animation for popovers.</li>
				<li>[Fluent form] - Fixed the issue with box-shadow not being applied.</li>
				<li>[General] - Fixed an error when using WP Toolkit searching for updates.</li>
				<li>[General] - Fixed an error if Bricks theme is deactivated with BricksExtras still active.</li>
			</ul>
			
			<h3>1.0.0
				<small>( Jun 06, 2022 )</small>
			</h3>
			<ul>
				<li>Initial release.</li>
			</ul>
		</div>


	<?php }

}