<?php
/**
 * Turnkey setup: build the WordPress pages, seed demo content, register the
 * primary menu, handle contact enquiries. Also exposes the default content the
 * front end falls back to before anything has been created.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ------------------------------------------------------------------ *
 * Default content (faithful to the original design). Used both for
 * seeding the CPTs and as a live fallback when no items exist yet.
 * ------------------------------------------------------------------ */

/**
 * @return array Keyed arrays of services, pricing, team, testimonials, clients.
 */
function bright_stars_default_data() {
	$d = bs_i18n_dict();
	$tri = function ( $key ) use ( $d ) {
		return array(
			'en' => isset( $d['en'][ $key ] ) ? $d['en'][ $key ] : '',
			'ar' => isset( $d['ar'][ $key ] ) ? $d['ar'][ $key ] : '',
			'fa' => isset( $d['fa'][ $key ] ) ? $d['fa'][ $key ] : '',
		);
	};

	$services = array();
	$svc_icons = array( 'search', 'target', 'share', 'pen', 'layout', 'compass' );
	for ( $i = 1; $i <= 6; $i++ ) {
		$services[] = array(
			'icon'  => $svc_icons[ $i - 1 ],
			'title' => $tri( 'sv' . $i . 't' ),
			'desc'  => $tri( 'sv' . $i . 'd' ),
		);
	}

	$pricing = array(
		array(
			'name' => $tri( 'pc1n' ), 'price' => array( 'en' => '450', 'ar' => '450', 'fa' => '۴۵۰' ), 'period' => $tri( 'pc.mo' ),
			'desc' => $tri( 'pc1d' ), 'cta' => $tri( 'pc1b' ), 'badge' => array( 'en' => '', 'ar' => '', 'fa' => '' ), 'featured' => false,
			'features' => array(
				'en' => $d['en']['pc1f1'] . "\n" . $d['en']['pc1f2'] . "\n" . $d['en']['pc1f3'],
				'ar' => $d['ar']['pc1f1'] . "\n" . $d['ar']['pc1f2'] . "\n" . $d['ar']['pc1f3'],
				'fa' => $d['fa']['pc1f1'] . "\n" . $d['fa']['pc1f2'] . "\n" . $d['fa']['pc1f3'],
			),
		),
		array(
			'name' => $tri( 'pc2n' ), 'price' => array( 'en' => '950', 'ar' => '950', 'fa' => '۹۵۰' ), 'period' => $tri( 'pc.mo' ),
			'desc' => $tri( 'pc2d' ), 'cta' => $tri( 'pc2b' ), 'badge' => $tri( 'pc2tag' ), 'featured' => true,
			'features' => array(
				'en' => $d['en']['pc2f1'] . "\n" . $d['en']['pc2f2'] . "\n" . $d['en']['pc2f3'] . "\n" . $d['en']['pc2f4'],
				'ar' => $d['ar']['pc2f1'] . "\n" . $d['ar']['pc2f2'] . "\n" . $d['ar']['pc2f3'] . "\n" . $d['ar']['pc2f4'],
				'fa' => $d['fa']['pc2f1'] . "\n" . $d['fa']['pc2f2'] . "\n" . $d['fa']['pc2f3'] . "\n" . $d['fa']['pc2f4'],
			),
		),
		array(
			'name' => $tri( 'pc3n' ), 'price' => $tri( 'pc3price' ), 'period' => array( 'en' => '', 'ar' => '', 'fa' => '' ),
			'desc' => $tri( 'pc3d' ), 'cta' => $tri( 'pc3b' ), 'badge' => array( 'en' => '', 'ar' => '', 'fa' => '' ), 'featured' => false,
			'features' => array(
				'en' => $d['en']['pc3f1'] . "\n" . $d['en']['pc3f2'] . "\n" . $d['en']['pc3f3'] . "\n" . $d['en']['pc3f4'],
				'ar' => $d['ar']['pc3f1'] . "\n" . $d['ar']['pc3f2'] . "\n" . $d['ar']['pc3f3'] . "\n" . $d['ar']['pc3f4'],
				'fa' => $d['fa']['pc3f1'] . "\n" . $d['fa']['pc3f2'] . "\n" . $d['fa']['pc3f3'] . "\n" . $d['fa']['pc3f4'],
			),
		),
	);

	$team = array(
		array( 'name' => 'Mohammad Hossein', 'photo' => 'hossein.jpg', 'role' => $tri( 'ab.r1' ), 'quote' => $tri( 'ab.s1' ), 'bio' => $tri( 'ab.b1' ) ),
		array( 'name' => 'Mohammad Ali', 'photo' => 'ali.jpg', 'role' => $tri( 'ab.r2' ), 'quote' => $tri( 'ab.s2' ), 'bio' => $tri( 'ab.b2' ) ),
		array( 'name' => 'Hanieh Salehi', 'photo' => 'hanieh.jpg', 'role' => $tri( 'ab.r3' ), 'quote' => $tri( 'ab.s3' ), 'bio' => $tri( 'ab.b3' ) ),
	);

	$testimonials = array(
		array( 'author' => 'Layla Al-Harthy', 'initials' => 'LA', 'quote' => $tri( 'ts1q' ), 'role' => $tri( 'ts1r' ) ),
		array( 'author' => 'Omar Said', 'initials' => 'OS', 'quote' => $tri( 'ts2q' ), 'role' => $tri( 'ts2r' ) ),
	);

	$cat = function ( $en, $ar, $fa ) {
		return array( 'en' => $en, 'ar' => $ar, 'fa' => $fa );
	};
	$clients = array(
		array(
			'slug' => 'm2-real-estate', 'name' => 'M2 Real Estate', 'logo' => 'm2.realestates.jpg', 'feed' => 'm2.realestates.jpg',
			'ig' => 'https://www.instagram.com/m2.realestates/', 'handle' => 'm2.realestates', 'color' => 'linear-gradient(135deg,#2E568A,#0A1F38)',
			'category' => $cat( 'Real estate', 'عقارات', 'املاک' ),
			'tagline' => "Muscat's most-wanted addresses, sold faster.",
			'brief' => 'A boutique agency with premium listings but a flat digital presence. We rebuilt the feed and the funnel so every property looked as valuable as it really is.',
			'services' => array( 'Brand & content system', 'Property reels', 'Lead-gen campaigns', 'CRM & follow-up' ),
			'results' => array( '+218% | Qualified leads', '579 | Followers', '27 | Deals influenced' ),
		),
		array(
			'slug' => 'lubna-khalili-academy', 'name' => 'Lubna Khalili Academy', 'logo' => 'academylubnakhalili.jpg', 'feed' => 'academylubnakhalili.jpg',
			'ig' => 'https://www.instagram.com/academylubnakhalili/', 'handle' => 'academylubnakhalili', 'color' => 'linear-gradient(135deg,#F9912F,#7A3A08)',
			'category' => $cat( 'Education', 'تعليم', 'آموزش' ),
			'tagline' => 'Turning expertise into a sold-out academy.',
			'brief' => 'An educator with a loyal following and no system to convert it. We packaged the courses, built the launch calendar, and ran the enrolment campaigns.',
			'services' => array( 'Course branding', 'Launch campaigns', 'Lead funnels', 'Community content' ),
			'results' => array( '+340% | Enrolments', '1,245 | Followers', '4.6x | Ad ROAS' ),
		),
		array(
			'slug' => 'zaytoon-royal', 'name' => 'Zaytoon Royal', 'logo' => 'zaytoonroyal.jpg', 'feed' => 'zaytoonroyal.jpg',
			'ig' => 'https://www.instagram.com/zaytoonroyal/', 'handle' => 'zaytoonroyal', 'color' => 'linear-gradient(135deg,#13335A,#030B16)',
			'category' => $cat( 'Hospitality', 'ضيافة', 'مهمان‌نوازی' ),
			'tagline' => 'A royal table, fully booked.',
			'brief' => 'A fine-dining destination that needed reservations, not just likes. We built a booking-first presence with seasonal campaigns.',
			'services' => array( 'Brand & art direction', 'Food content', 'Reservations funnel', 'Influencer dinners' ),
			'results' => array( '2.4x | Direct bookings', '+190% | Weekend covers', '153 | Followers' ),
		),
		array(
			'slug' => 'hudhud-fabric', 'name' => 'Hudhud Fabric', 'logo' => 'hudhud.fabric.jpg', 'feed' => 'hudhud.fabric.jpg',
			'ig' => 'https://www.instagram.com/hudhud.fabric/', 'handle' => 'hudhud.fabric', 'color' => 'linear-gradient(135deg,#F58021,#B0530B)',
			'category' => $cat( 'Textile', 'أقمشة', 'نساجی' ),
			'tagline' => 'Heritage fabric, modern demand.',
			'brief' => 'A textile house with beautiful product and quiet sales. We told the craft story and turned the catalogue into a shoppable feed.',
			'services' => array( 'Brand storytelling', 'Product photography', 'Catalogue & shop', 'Paid social' ),
			'results' => array( '+265% | Online orders', '3.0x | Catalogue views', '8,550 | Followers' ),
		),
		array(
			'slug' => 'seeb-waves', 'name' => 'Seeb Waves', 'logo' => 'seebwaves.jpg', 'feed' => 'seebwaves.jpg',
			'ig' => 'https://www.instagram.com/seebwaves/', 'handle' => 'seebwaves', 'color' => 'linear-gradient(135deg,#5A7CA8,#13335A)',
			'category' => $cat( 'Lifestyle', 'نمط حياة', 'سبک زندگی' ),
			'tagline' => 'Riding the coastal lifestyle wave.',
			'brief' => "A lifestyle brand for Oman's coast. We gave it a consistent visual world and an always-on content engine.",
			'services' => array( 'Brand world', 'Always-on content', 'Creator partnerships', 'Community growth' ),
			'results' => array( '+410% | Engagement', '14.9k | Followers', '5.1x | Reel reach' ),
		),
		array(
			'slug' => 'sima-vandad', 'name' => 'Sima Vandad', 'logo' => 'sima_vandad.jpg', 'feed' => 'sima_vandad.jpg',
			'ig' => 'https://www.instagram.com/sima_vandad/', 'handle' => 'sima_vandad', 'color' => 'linear-gradient(135deg,#FCA856,#D86A12)',
			'category' => $cat( 'Beauty', 'جمال', 'زیبایی' ),
			'tagline' => 'Beauty that books itself.',
			'brief' => 'A beauty professional ready to scale. We built the booking funnel and the before/after content that actually converts.',
			'services' => array( 'Brand identity', 'Booking funnel', 'Treatment reels', 'Retargeting' ),
			'results' => array( '+280% | Bookings', '3.4x | Lead-form rate', '32.1k | Followers' ),
		),
		array(
			'slug' => 'nota-jewelry', 'name' => 'Nota Jewelry', 'logo' => 'notajelwery.jpg', 'feed' => 'notajelwery.jpg',
			'ig' => 'https://www.instagram.com/notajelwery/', 'handle' => 'notajelwery', 'color' => 'linear-gradient(135deg,#2E568A,#061427)',
			'category' => $cat( 'Jewelry', 'مجوهرات', 'جواهرات' ),
			'tagline' => 'Every piece, a moment.',
			'brief' => 'A jewelry label competing on emotion, not price. We crafted a premium feed and gifting-season campaigns.',
			'services' => array( 'Brand & art direction', 'Product films', 'Gifting campaigns', 'Paid social' ),
			'results' => array( '+233% | Store visits', '4.2x | Campaign ROAS', '22.2k | Followers' ),
		),
		array(
			'slug' => 'oman-vision', 'name' => 'Oman Vision', 'logo' => '', 'feed' => '',
			'ig' => 'https://www.instagram.com/omanvision.ir/', 'handle' => 'omanvision.ir', 'color' => 'linear-gradient(135deg,#F9912F,#7A3A08)',
			'category' => $cat( 'Media', 'إعلام', 'رسانه' ),
			'tagline' => "Telling Oman's story to the world.",
			'brief' => 'A media platform that needed reach and retention. We sharpened the formats and grew the audience.',
			'services' => array( 'Content strategy', 'Short-form formats', 'Audience growth', 'Distribution' ),
			'results' => array( '+520% | Watch time', '48k | New followers', '3.7x | Shares' ),
		),
		array(
			'slug' => 'adam-perfumes', 'name' => 'Adam Perfumes', 'logo' => 'adam.perfumes.jpg', 'feed' => 'adam.perfumes.jpg',
			'ig' => 'https://www.instagram.com/adam.perfumes/', 'handle' => 'adam.perfumes', 'color' => 'linear-gradient(135deg,#13335A,#0A1F38)',
			'category' => $cat( 'Fragrance', 'عطور', 'عطر' ),
			'tagline' => 'Scent, made unforgettable online.',
			'brief' => 'A fragrance house with retail strength and a thin digital funnel. We built the launch playbook and the always-on engine.',
			'services' => array( 'Brand films', 'Launch campaigns', 'E-commerce funnel', 'Influencer seeding' ),
			'results' => array( '+295% | Online sales', '5.8x | Launch ROAS', '102k | Followers' ),
		),
		array(
			'slug' => 'miss-cheff', 'name' => 'Miss Cheff', 'logo' => 'miisscheff.jpg', 'feed' => 'miisscheff.jpg',
			'ig' => 'https://www.instagram.com/miisscheff/', 'handle' => 'miisscheff', 'color' => 'linear-gradient(135deg,#FCA856,#B0530B)',
			'category' => $cat( 'Food', 'طعام', 'غذا' ),
			'tagline' => 'From kitchen to fully-booked.',
			'brief' => 'A culinary brand with great food and inconsistent demand. We made the feed crave-worthy and the orders steady.',
			'services' => array( 'Food content', 'Menu campaigns', 'Delivery funnel', 'Community' ),
			'results' => array( '2.7x | Orders', '+205% | Saves', '389 | Followers' ),
		),
		array(
			'slug' => 'first-glass-oman', 'name' => 'First Glass Oman', 'logo' => '', 'feed' => '',
			'ig' => 'https://www.instagram.com/firstglassoman/', 'handle' => 'firstglassoman', 'color' => 'linear-gradient(135deg,#5A7CA8,#0A1F38)',
			'category' => $cat( 'Glass & aluminium', 'زجاج وألمنيوم', 'شیشه و آلومینیوم' ),
			'tagline' => 'Building Oman, pane by pane.',
			'brief' => 'A glass & aluminium contractor that won on craft, not clicks. We built a project-led presence and a B2B lead engine.',
			'services' => array( 'Brand & project content', 'B2B lead-gen', 'Project case films', 'Sales enablement' ),
			'results' => array( '+178% | Qualified RFQs', '3.3x | Site enquiries', '24 | Projects influenced' ),
		),
	);

	return compact( 'services', 'pricing', 'team', 'testimonials', 'clients' );
}

/**
 * Rich, trilingual detail content for each of the six default services,
 * keyed by their 1-based order. Each field is a newline-joined string of
 * "left | right" rows (value|label for stats, title|description otherwise).
 * Drives the per-service detail pages and is fully editable from the panel.
 *
 * @return array<int,array<string,array<string,string>>>
 */
function bright_stars_service_details() {
	return array(
		// 1 — SEO & organic growth.
		1 => array(
			'intro' => array(
				'en' => 'Search is where high-intent demand lives — the moment someone is actively looking for what you offer. We build the technical foundation, the content engine and the authority signals that move you up the rankings across Oman and the Gulf, and keep you there. Every gain compounds, so the traffic you earn this quarter keeps paying off the next.',
				'ar' => 'البحث هو حيث يعيش الطلب عالي النية — اللحظة التي يبحث فيها أحدهم فعلاً عمّا تقدّمه. نبني الأساس التقني ومحرّك المحتوى وإشارات المرجعية التي ترفع ترتيبك في عُمان والخليج وتُبقيك في الصدارة. كل مكسب يتراكم، فالزيارات التي تكسبها هذا الربع تواصل العطاء في التالي.',
				'fa' => 'جستجو جایی است که تقاضای پرنیّت زندگی می‌کند — همان لحظه‌ای که کسی فعالانه دنبال چیزی است که شما ارائه می‌دهید. ما زیرساخت فنی، موتور محتوا و سیگنال‌های اعتبار را می‌سازیم که جایگاه شما را در عمان و خلیج بالا می‌برد و همان‌جا نگه می‌دارد. هر دستاورد انباشته می‌شود؛ پس ترافیکی که این فصل به‌دست می‌آورید، فصل بعد هم سود می‌دهد.',
			),
			'stats' => array(
				'en' => "+212% | Avg. organic traffic\nTop 3 | Target positions\n6 mo | To compounding growth",
				'ar' => "+212% | متوسط الزيارات العضوية\nTop 3 | المراكز المستهدفة\n6 أشهر | حتى النمو المتراكم",
				'fa' => "+212% | میانگین ترافیک ارگانیک\nTop 3 | جایگاه‌های هدف\n6 ماه | تا رشد انباشته",
			),
			'features' => array(
				'en' => "Technical SEO | We fix crawlability, speed and Core Web Vitals so search engines can read and rank every page.\nKeyword & intent mapping | We map the searches your buyers make in Arabic and English — and the pages that win them.\nContent engine | A steady stream of optimised articles and landing pages that build topical authority month over month.\nAuthority & links | Digital PR and clean link-building that earn the trust signals search engines reward.",
				'ar' => "سيو تقني | نُصلح الزحف والسرعة ومؤشرات الويب الأساسية ليقرأ محرك البحث كل صفحة ويرتّبها.\nخريطة الكلمات والنية | نرسم عمليات البحث التي يجريها عملاؤك بالعربية والإنجليزية والصفحات التي تكسبها.\nمحرّك المحتوى | تدفّق ثابت من المقالات وصفحات الهبوط المحسّنة يبني المرجعية شهراً بعد شهر.\nالمرجعية والروابط | علاقات عامة رقمية وبناء روابط نظيف يكسب إشارات الثقة التي تكافئها محركات البحث.",
				'fa' => "سئوی فنی | خزش، سرعت و Core Web Vitals را اصلاح می‌کنیم تا موتور جستجو هر صفحه را بخواند و رتبه دهد.\nنقشهٔ کلمات و نیّت | جستجوهایی که مشتریان‌تان به عربی و انگلیسی انجام می‌دهند و صفحاتی که آن‌ها را می‌برند، نقشه می‌کنیم.\nموتور محتوا | جریان پیوسته‌ای از مقالات و صفحات فرود بهینه که ماه‌به‌ماه اعتبار موضوعی می‌سازد.\nاعتبار و لینک | روابط‌عمومی دیجیتال و لینک‌سازی تمیز که سیگنال‌های اعتمادِ موردپسند موتور جستجو را به‌دست می‌آورد.",
			),
			'process' => array(
				'en' => "Audit | We benchmark your rankings, technical health and competitors to find the fastest wins.\nRoadmap | A prioritised plan tied to revenue, not vanity keywords.\nExecute | Fixes, content and links shipped every week by a senior team.\nCompound | We double down on what ranks and expand into new search territory.",
				'ar' => "تدقيق | نقيس ترتيبك وصحتك التقنية ومنافسيك لإيجاد أسرع المكاسب.\nخارطة طريق | خطة مرتّبة حسب الأولوية مرتبطة بالإيرادات لا بالكلمات الشكلية.\nتنفيذ | إصلاحات ومحتوى وروابط تُنجز كل أسبوع بفريق محترف.\nتراكم | نضاعف ما يتصدّر ونتوسّع إلى مجالات بحث جديدة.",
				'fa' => "بررسی | جایگاه، سلامت فنی و رقبای شما را می‌سنجیم تا سریع‌ترین بردها را بیابیم.\nنقشهٔ راه | برنامه‌ای اولویت‌بندی‌شده و گره‌خورده به درآمد، نه کلمات نمایشی.\nاجرا | اصلاح، محتوا و لینک، هر هفته توسط تیمی ارشد.\nانباشت | روی آنچه رتبه می‌گیرد تمرکز می‌کنیم و به قلمروهای جستجوی تازه گسترش می‌یابیم.",
			),
			'faq' => array(
				'en' => "How long until I see results? | Early technical wins show within weeks; compounding organic growth usually lands between months three and six.\nDo you work in Arabic and English? | Yes — we research and write natively in both, which is essential for ranking across the Gulf.\nHow do you measure success? | Qualified organic traffic, keyword positions and the leads or sales they drive — reported transparently every month.",
				'ar' => "متى أرى النتائج؟ | تظهر المكاسب التقنية المبكرة خلال أسابيع؛ والنمو العضوي المتراكم عادة بين الشهر الثالث والسادس.\nهل تعملون بالعربية والإنجليزية؟ | نعم — نبحث ونكتب بكلتيهما بشكل أصيل، وهو أساسي للتصدّر في الخليج.\nكيف تقيسون النجاح؟ | زيارات عضوية مؤهّلة ومراكز الكلمات وما تحقّقه من عملاء ومبيعات — بتقارير شفافة شهرياً.",
				'fa' => "چه زمانی نتیجه می‌بینم؟ | بردهای فنی اولیه ظرف چند هفته دیده می‌شود؛ رشد ارگانیک انباشته معمولاً بین ماه سوم تا ششم.\nبه عربی و انگلیسی کار می‌کنید؟ | بله — در هر دو به‌صورت بومی تحقیق و می‌نویسیم که برای رتبه‌گرفتن در خلیج ضروری است.\nموفقیت را چطور می‌سنجید؟ | ترافیک ارگانیک واجد شرایط، جایگاه کلمات و سرنخ/فروشی که می‌سازد — با گزارش شفاف ماهانه.",
			),
		),
		// 2 — Paid media & PPC.
		2 => array(
			'intro' => array(
				'en' => 'When you need demand now, paid media delivers it — profitably. We engineer campaigns across Google, Meta and TikTok around the one number that matters: return on ad spend. Sharp targeting, scroll-stopping creative and relentless optimisation turn budget into measurable revenue, not vanity impressions.',
				'ar' => 'حين تحتاج الطلب الآن، تحقّقه الإعلانات المدفوعة — بربحية. نهندس حملات عبر جوجل وميتا وتيك توك حول الرقم الوحيد المهم: العائد على الإنفاق الإعلاني. استهداف دقيق وإبداع يوقف التمرير وتحسين متواصل يحوّل الميزانية إلى إيرادات قابلة للقياس لا ظهوراً شكلياً.',
				'fa' => 'وقتی تقاضا را همین حالا می‌خواهید، تبلیغات پولی آن را — به‌صورت سودده — می‌رساند. کمپین‌ها را در گوگل، متا و تیک‌تاک حول تنها عددی که مهم است مهندسی می‌کنیم: بازگشت هزینهٔ تبلیغات. هدف‌گیری دقیق، خلاقیتِ اسکرول‌متوقف‌کن و بهینه‌سازی بی‌وقفه، بودجه را به درآمدِ قابل‌اندازه‌گیری بدل می‌کند، نه نمایشِ تشریفاتی.',
			),
			'stats' => array(
				'en' => "4.8x | Average ROAS\n-38% | Cost per acquisition\n72h | To first live campaign",
				'ar' => "4.8x | متوسط العائد\n-38% | تكلفة الاكتساب\n72 ساعة | حتى أول حملة",
				'fa' => "4.8x | میانگین بازده تبلیغات\n-38% | هزینهٔ جذب\n72 ساعت | تا اولین کمپین",
			),
			'features' => array(
				'en' => "Full-funnel strategy | Prospecting, retargeting and retention mapped to every stage of the buyer journey.\nCreative that converts | Thumb-stopping ads produced in-house and tested at scale — not boosted posts.\nPrecision targeting | Audiences built from your data and ours, refined continuously for efficiency.\nTracking & attribution | Clean pixels, conversion APIs and dashboards so every dinar is accounted for.",
				'ar' => "استراتيجية متكاملة | استقطاب وإعادة استهداف واحتفاظ مرتبطة بكل مرحلة من رحلة المشتري.\nإبداع يحوّل | إعلانات توقف التمرير ننتجها داخلياً ونختبرها على نطاق واسع — لا منشورات مموّلة.\nاستهداف دقيق | جماهير مبنية من بياناتك وبياناتنا، تُصقل باستمرار لرفع الكفاءة.\nتتبّع وإسناد | بكسلات نظيفة وواجهات تحويل ولوحات تحكم ليُحتسب كل ريال.",
				'fa' => "استراتژی کامل قیف | جذب، ریتارگتینگ و نگه‌داشت، نگاشته‌شده به هر مرحلهٔ سفر مشتری.\nخلاقیتی که تبدیل می‌کند | تبلیغ‌های اسکرول‌متوقف‌کن، تولید داخلی و تست‌شده در مقیاس — نه پست بوست‌شده.\nهدف‌گیری دقیق | مخاطبانی ساخته‌شده از دادهٔ شما و ما، که پیوسته برای کارایی پالایش می‌شوند.\nردیابی و انتساب | پیکسل تمیز، Conversion API و داشبورد تا هر ریال حساب شود.",
			),
			'process' => array(
				'en' => "Plan | Goals, budget and the offer architecture that makes the numbers work.\nBuild | Campaign structure, audiences, tracking and the first creative batch.\nLaunch | We go live, then watch the data hour by hour in the early days.\nScale | Cut the losers, pour into the winners and expand profitably.",
				'ar' => "تخطيط | الأهداف والميزانية وبنية العرض التي تجعل الأرقام تنجح.\nبناء | هيكل الحملة والجماهير والتتبّع وأول دفعة إبداع.\nإطلاق | ننطلق ثم نراقب البيانات ساعة بساعة في الأيام الأولى.\nتوسيع | نوقف الخاسر ونضخّ في الرابح ونتوسّع بربحية.",
				'fa' => "برنامه | اهداف، بودجه و معماری پیشنهاد که اعداد را جواب می‌دهد.\nساخت | ساختار کمپین، مخاطبان، ردیابی و اولین دستهٔ خلاقیت.\nاجرا | منتشر می‌کنیم و در روزهای نخست داده را ساعت‌به‌ساعت می‌پاییم.\nمقیاس | بازنده را قطع، در برنده سرمایه‌گذاری و سودده گسترش می‌دهیم.",
			),
			'faq' => array(
				'en' => "What budget do I need to start? | We work with focused budgets and scale as ROAS proves out; we'll recommend a realistic starting point on the first call.\nWho makes the ad creative? | Our in-house team — copy, design and video — so testing never waits on an outside agency.\nHow soon can campaigns go live? | Typically within 72 hours of approvals and account access.",
				'ar' => "ما الميزانية التي أبدأ بها؟ | نعمل بميزانيات مركّزة ونوسّع مع إثبات العائد؛ نقترح نقطة بداية واقعية في أول مكالمة.\nمن يصنع الإعلانات؟ | فريقنا الداخلي — نصوص وتصميم وفيديو — فلا ينتظر الاختبار وكالة خارجية.\nمتى تنطلق الحملات؟ | عادة خلال 72 ساعة من الموافقات والوصول للحسابات.",
				'fa' => "با چه بودجه‌ای شروع کنم؟ | با بودجه‌های متمرکز کار می‌کنیم و با اثبات بازده مقیاس می‌دهیم؛ در اولین تماس نقطهٔ شروع واقع‌بینانه پیشنهاد می‌کنیم.\nخلاقیت تبلیغ را چه کسی می‌سازد؟ | تیم داخلی ما — متن، طراحی و ویدیو — تا تست هرگز معطل آژانس بیرونی نماند.\nکمپین‌ها کی منتشر می‌شوند؟ | معمولاً ظرف ۷۲ ساعت پس از تأییدها و دسترسی به حساب‌ها.",
			),
		),
		// 3 — Social media.
		3 => array(
			'intro' => array(
				'en' => 'Social is where your brand earns attention and trust every single day. We run always-on content, community management and creator partnerships tuned for the Gulf audience — so your feed stops the scroll, grows the right followers and turns them into customers, not just numbers.',
				'ar' => 'وسائل التواصل هي حيث تكسب علامتك الانتباه والثقة كل يوم. نُدير محتوى مستمراً وإدارة مجتمع وشراكات صنّاع محتوى مضبوطة لجمهور الخليج — ليوقف حسابك التمرير وينمّي المتابعين الصحيحين ويحوّلهم إلى عملاء لا مجرد أرقام.',
				'fa' => 'شبکه‌های اجتماعی جایی است که برند شما هر روز توجه و اعتماد کسب می‌کند. محتوای همیشه‌فعال، مدیریت جامعه و همکاری با سازندگان را متناسب با مخاطب خلیج اجرا می‌کنیم — تا فید شما اسکرول را متوقف کند، فالوورِ درست را رشد دهد و آن‌ها را به مشتری بدل کند، نه صرفاً عدد.',
			),
			'stats' => array(
				'en' => "+410% | Peak engagement\n5.1x | Reel reach\nDaily | Always-on presence",
				'ar' => "+410% | ذروة التفاعل\n5.1x | وصول الريلز\nيومياً | حضور مستمر",
				'fa' => "+410% | اوج تعامل\n5.1x | دسترسی ریل\nروزانه | حضور همیشه‌فعال",
			),
			'features' => array(
				'en' => "Content systems | A monthly calendar of reels, posts and stories with a consistent, premium look.\nCommunity management | Fast, on-brand replies and DMs that turn followers into buyers.\nCreator partnerships | The right local voices, briefed and managed end to end.\nTrend & culture radar | We catch the moments worth joining — in Arabic and English.",
				'ar' => "أنظمة المحتوى | تقويم شهري من الريلز والمنشورات والقصص بمظهر فاخر متّسق.\nإدارة المجتمع | ردود ورسائل سريعة على هوية العلامة تحوّل المتابع إلى مشترٍ.\nشراكات صنّاع المحتوى | الأصوات المحلية المناسبة، نُحضّرها ونديرها بالكامل.\nرادار الترند والثقافة | نلتقط اللحظات الجديرة بالمشاركة — بالعربية والإنجليزية.",
				'fa' => "سیستم محتوا | تقویم ماهانه از ریل، پست و استوری با ظاهری لوکس و یکدست.\nمدیریت جامعه | پاسخ و دایرکتِ سریع و هم‌خوان با برند که فالوور را به خریدار بدل می‌کند.\nهمکاری با سازندگان | صداهای محلی درست، بریف‌شده و مدیریت‌شده سرتاسری.\nرادار ترند و فرهنگ | لحظه‌های ارزشمندِ پیوستن را شکار می‌کنیم — به عربی و انگلیسی.",
			),
			'process' => array(
				'en' => "Immerse | We learn your brand voice, audience and goals.\nPlan | A content-pillar strategy and a calendar you can see weeks ahead.\nProduce | We shoot, edit and design a steady stream of scroll-stopping content.\nGrow | We engage, analyse and double down on what the audience rewards.",
				'ar' => "انغماس | نتعرّف على صوت علامتك وجمهورك وأهدافك.\nتخطيط | استراتيجية محاور محتوى وتقويم تراه قبل أسابيع.\nإنتاج | نصوّر ونمنتج ونصمّم تدفّقاً ثابتاً من المحتوى الموقف للتمرير.\nنمو | نتفاعل ونحلّل ونضاعف ما يكافئه الجمهور.",
				'fa' => "غرق‌شدن | لحن برند، مخاطب و اهداف شما را می‌شناسیم.\nبرنامه | استراتژی ستون‌های محتوا و تقویمی که هفته‌ها جلوتر می‌بینید.\nتولید | جریان پیوسته‌ای از محتوای اسکرول‌متوقف‌کن را فیلم، تدوین و طراحی می‌کنیم.\nرشد | تعامل و تحلیل می‌کنیم و روی آنچه مخاطب پاداش می‌دهد تمرکز می‌کنیم.",
			),
			'faq' => array(
				'en' => "Which platforms do you cover? | Instagram, TikTok and wherever your audience actually is — we'll advise on the right mix.\nDo you produce the content too? | Yes — filming, editing and design are all handled by our team.\nHow do you grow followers authentically? | Great content plus targeted distribution and partnerships — never bought, low-quality followers.",
				'ar' => "ما المنصّات التي تغطّونها؟ | إنستغرام وتيك توك وحيثما يوجد جمهورك فعلاً — ننصحك بالمزيج الصحيح.\nهل تنتجون المحتوى أيضاً؟ | نعم — التصوير والمونتاج والتصميم كلها على فريقنا.\nكيف تنمّون المتابعين بأصالة؟ | محتوى رائع مع توزيع مستهدف وشراكات — لا متابعين مشترين رديئين.",
				'fa' => "چه پلتفرم‌هایی را پوشش می‌دهید؟ | اینستاگرام، تیک‌تاک و هرجا مخاطب شما واقعاً هست — ترکیب درست را پیشنهاد می‌دهیم.\nمحتوا را هم تولید می‌کنید؟ | بله — فیلم‌برداری، تدوین و طراحی همه بر عهدهٔ تیم ماست.\nفالوور را چطور اصیل رشد می‌دهید؟ | محتوای عالی به‌علاوهٔ توزیع هدفمند و همکاری‌ها — نه فالوورِ خریداری‌شده و بی‌کیفیت.",
			),
		),
		// 4 — Content & branding.
		4 => array(
			'intro' => array(
				'en' => 'A premium brand looks and sounds the part everywhere it shows up. We build the identity systems, art direction and bilingual content that make ambitious brands feel established — from the logo, palette and type to the reels, photography and words that carry your story across every channel.',
				'ar' => 'العلامة الفاخرة تبدو وتُسمع بمستواها أينما ظهرت. نبني أنظمة الهوية والإخراج الفني والمحتوى ثنائي اللغة الذي يمنح العلامات الطموحة حضوراً راسخاً — من الشعار واللون والخط إلى الريلز والتصوير والكلمات التي تحمل قصتك عبر كل قناة.',
				'fa' => 'برندِ لوکس هرجا ظاهر شود، در ظاهر و لحن در حدِ خود است. سیستم‌های هویت، مدیریت هنری و محتوای دوزبانه را می‌سازیم که به برندهای جاه‌طلب حسِ جاافتادگی می‌دهد — از لوگو، پالت و تایپ تا ریل، عکاسی و کلماتی که داستان شما را در هر کانال حمل می‌کند.',
			),
			'stats' => array(
				'en' => "2 | Languages, natively\n1 | System everywhere\n100% | On-brand, always",
				'ar' => "2 | لغتان بأصالة\n1 | نظام واحد في كل مكان\n100% | على هوية العلامة دائماً",
				'fa' => "2 | زبان، بومی\n1 | یک سیستم همه‌جا\n100% | همیشه هم‌خوان با برند",
			),
			'features' => array(
				'en' => "Brand identity | Logo, palette, type and the visual rules that keep you consistent.\nArt direction | A signature look for your photography, video and graphics.\nBilingual content | Copy and captions that feel native in Arabic and English alike.\nBrand guidelines | A living playbook your whole team can build from.",
				'ar' => "هوية العلامة | الشعار واللون والخط والقواعد البصرية التي تُبقيك متّسقاً.\nالإخراج الفني | مظهر مميّز لتصويرك وفيديوهاتك وتصاميمك.\nمحتوى ثنائي اللغة | نصوص وتعليقات أصيلة بالعربية والإنجليزية معاً.\nدليل العلامة | كتيّب حيّ يبني منه فريقك بالكامل.",
				'fa' => "هویت برند | لوگو، پالت، تایپ و قواعد بصری که شما را یکدست نگه می‌دارد.\nمدیریت هنری | ظاهری امضاوار برای عکاسی، ویدیو و گرافیک شما.\nمحتوای دوزبانه | متن و کپشن که به عربی و انگلیسی هر دو بومی حس می‌شود.\nراهنمای برند | پلی‌بوکی زنده که کل تیم شما از آن می‌سازد.",
			),
			'process' => array(
				'en' => "Discover | Workshops to define positioning, personality and audience.\nDesign | Identity, art direction and the core templates.\nProduce | Photography, video and content that bring the system to life.\nDocument | Guidelines that keep every future asset on-brand.",
				'ar' => "اكتشاف | ورش لتحديد التموضع والشخصية والجمهور.\nتصميم | الهوية والإخراج الفني والقوالب الأساسية.\nإنتاج | تصوير وفيديو ومحتوى يُحيي النظام.\nتوثيق | دليل يُبقي كل أصل مستقبلي على هوية العلامة.",
				'fa' => "کشف | کارگاه‌هایی برای تعریف جایگاه، شخصیت و مخاطب.\nطراحی | هویت، مدیریت هنری و قالب‌های اصلی.\nتولید | عکاسی، ویدیو و محتوایی که سیستم را جان می‌بخشد.\nمستندسازی | راهنمایی که هر دارایی آینده را هم‌خوان با برند نگه می‌دارد.",
			),
			'faq' => array(
				'en' => "Can you refresh an existing brand? | Absolutely — we evolve what works and replace what doesn't, without losing your equity.\nDo you write in Arabic and English? | Yes, natively in both — tone and nuance intact, never just translated.\nWhat do I receive at the end? | A complete identity system, templates and guidelines, plus the editable source files.",
				'ar' => "هل تجدّدون علامة قائمة؟ | بالتأكيد — نطوّر ما ينجح ونستبدل ما لا ينجح دون فقدان رصيدك.\nهل تكتبون بالعربية والإنجليزية؟ | نعم، بأصالة في كلتيهما — النبرة والدلالة محفوظة لا مجرد ترجمة.\nماذا أستلم في النهاية؟ | نظام هوية كامل وقوالب ودليل، مع ملفات المصدر القابلة للتعديل.",
				'fa' => "برند موجود را بازآفرینی می‌کنید؟ | حتماً — آنچه جواب می‌دهد را تکامل می‌دهیم و آنچه نه را جایگزین می‌کنیم، بی‌آنکه ارزش برندتان از دست برود.\nبه عربی و انگلیسی می‌نویسید؟ | بله، در هر دو بومی — لحن و ظرافت حفظ‌شده، نه صرفاً ترجمه.\nدر پایان چه دریافت می‌کنم؟ | یک سیستم هویت کامل، قالب‌ها و راهنما، به‌علاوهٔ فایل‌های منبعِ قابل‌ویرایش.",
			),
		),
		// 5 — Web & app design.
		5 => array(
			'intro' => array(
				'en' => 'Your website is your hardest-working salesperson — open every hour of every day. We design and build conversion-first websites and product experiences end to end: fast, beautiful, bilingual and engineered to turn visitors into customers. From the first wireframe to launch and beyond, one senior team owns the outcome.',
				'ar' => 'موقعك هو أكثر بائعيك اجتهاداً — مفتوح كل ساعة من كل يوم. نصمّم ونبني مواقع وتجارب منتج تركّز على التحويل من الألف إلى الياء: سريعة وجميلة وثنائية اللغة ومهندَسة لتحويل الزائر إلى عميل. من أول مخطط حتى الإطلاق وما بعده، يملك فريق محترف واحد النتيجة.',
				'fa' => 'وب‌سایت شما پرکارترین فروشندهٔ شماست — هر ساعت از هر روز باز. وب‌سایت و تجربهٔ محصولِ تبدیل‌محور را سرتاسری طراحی و می‌سازیم: سریع، زیبا، دوزبانه و مهندسی‌شده برای تبدیل بازدیدکننده به مشتری. از اولین وایرفریم تا انتشار و پس از آن، یک تیم ارشد مالکِ نتیجه است.',
			),
			'stats' => array(
				'en' => "2.4x | Conversion lift\n<2s | Target load time\nRTL | Arabic-ready by default",
				'ar' => "2.4x | نمو التحويل\n<2s | زمن التحميل المستهدف\nRTL | جاهز للعربية افتراضياً",
				'fa' => "2.4x | رشد تبدیل\n<2s | زمان بارگذاری هدف\nRTL | آمادهٔ راست‌به‌چپ پیش‌فرض",
			),
			'features' => array(
				'en' => "UX & wireframing | Journeys designed around the actions that grow your business.\nConversion-first design | Beautiful interfaces built to guide visitors to act.\nDevelopment | Fast, secure, responsive builds — WordPress or fully custom.\nBilingual & RTL | Arabic and English handled properly, right-to-left included.",
				'ar' => "تجربة المستخدم والمخططات | رحلات مصمّمة حول الإجراءات التي تنمّي عملك.\nتصميم يركّز على التحويل | واجهات جميلة تُرشد الزائر إلى الفعل.\nتطوير | بناء سريع وآمن ومتجاوب — ووردبريس أو مخصّص بالكامل.\nثنائي اللغة وRTL | العربية والإنجليزية بإتقان، مع الاتجاه من اليمين لليسار.",
				'fa' => "UX و وایرفریم | سفرهایی طراحی‌شده حول کنش‌هایی که کسب‌وکارتان را رشد می‌دهد.\nطراحی تبدیل‌محور | رابط‌های زیبا که بازدیدکننده را به کنش هدایت می‌کند.\nتوسعه | ساختِ سریع، امن و واکنش‌گرا — وردپرس یا کاملاً سفارشی.\nدوزبانه و RTL | عربی و انگلیسی به‌درستی، همراه با راست‌به‌چپ.",
			),
			'process' => array(
				'en' => "Define | Goals, content and the journeys that matter most.\nDesign | Wireframes, UI and a clickable prototype to sign off.\nBuild | Clean, fast, responsive development with SEO baked in.\nLaunch | Testing, handover and support after you go live.",
				'ar' => "تحديد | الأهداف والمحتوى والرحلات الأهم.\nتصميم | مخططات وواجهة ونموذج تفاعلي للاعتماد.\nبناء | تطوير نظيف وسريع ومتجاوب مع سيو مدمج.\nإطلاق | اختبار وتسليم ودعم بعد انطلاقك.",
				'fa' => "تعریف | اهداف، محتوا و سفرهایی که بیشترین اهمیت را دارند.\nطراحی | وایرفریم، رابط کاربری و یک پروتوتایپِ کلیک‌پذیر برای تأیید.\nساخت | توسعهٔ تمیز، سریع و واکنش‌گرا با سئوی توکار.\nانتشار | تست، تحویل و پشتیبانی پس از اینکه منتشر شدید.",
			),
			'faq' => array(
				'en' => "WordPress or custom? | Whichever serves your goals best — we recommend the right platform, not the easiest one for us.\nIs the site bilingual and RTL-ready? | Yes — Arabic, English and right-to-left are designed in from the very start.\nDo you help after launch? | Yes — we offer ongoing support, optimisation and growth plans.",
				'ar' => "ووردبريس أم مخصّص؟ | ما يخدم أهدافك أكثر — نوصي بالمنصّة الصحيحة لا الأسهل لنا.\nهل الموقع ثنائي اللغة وجاهز لـRTL؟ | نعم — العربية والإنجليزية والاتجاه من اليمين لليسار مصمّمة من البداية.\nهل تساعدون بعد الإطلاق؟ | نعم — نوفّر دعماً وتحسيناً وخطط نمو مستمرة.",
				'fa' => "وردپرس یا سفارشی؟ | هرکدام که هدف‌تان را بهتر برآورده کند — پلتفرم درست را پیشنهاد می‌دهیم نه ساده‌ترین را برای خودمان.\nسایت دوزبانه و آمادهٔ RTL است؟ | بله — عربی، انگلیسی و راست‌به‌چپ از همان ابتدا طراحی می‌شوند.\nپس از انتشار کمک می‌کنید؟ | بله — پشتیبانی، بهینه‌سازی و برنامه‌های رشدِ مستمر ارائه می‌دهیم.",
			),
		),
		// 6 — Strategy & consulting.
		6 => array(
			'intro' => array(
				'en' => 'Sometimes the highest-leverage work is the thinking. Our senior team embeds with you to sharpen positioning, plan market entry and build the growth roadmap that ties every channel together — so your marketing pulls in one direction and your budget compounds instead of leaking.',
				'ar' => 'أحياناً يكون التفكير هو العمل الأعلى أثراً. يندمج فريقنا المحترف معك لشحذ التموضع وتخطيط دخول السوق وبناء خارطة النمو التي تربط كل القنوات — ليشدّ تسويقك في اتجاه واحد وتتراكم ميزانيتك بدل أن تتسرّب.',
				'fa' => 'گاهی پراثرترین کار، فکر کردن است. تیم ارشد ما با شما درگیر می‌شود تا جایگاه‌یابی را تیز کند، ورود به بازار را برنامه‌ریزی کند و نقشهٔ رشدی بسازد که همهٔ کانال‌ها را به هم گره می‌زند — تا بازاریابی شما در یک جهت بکشد و بودجه‌تان به‌جای نشت‌کردن، انباشته شود.',
			),
			'stats' => array(
				'en' => "Senior | Embedded team\n1 | Roadmap, joined-up\nGCC | Market expertise",
				'ar' => "محترف | فريق مندمج\n1 | خارطة واحدة منسجمة\nالخليج | خبرة بالسوق",
				'fa' => "ارشد | تیم درگیر\n1 | یک نقشهٔ یکپارچه\nخلیج | تخصص بازار",
			),
			'features' => array(
				'en' => "Market & audience research | A clear read on demand, competitors and the customer you want.\nPositioning | The sharp, defensible story that sets you apart.\nGrowth roadmap | A prioritised plan across channels, budget and KPIs.\nGo-to-market | The launch plan for a new product, service or market.",
				'ar' => "بحث السوق والجمهور | قراءة واضحة للطلب والمنافسين والعميل الذي تريده.\nالتموضع | القصة الحادّة القابلة للدفاع التي تميّزك.\nخارطة النمو | خطة مرتّبة عبر القنوات والميزانية والمؤشرات.\nخطة الإطلاق | خطة طرح منتج أو خدمة أو سوق جديد.",
				'fa' => "تحقیق بازار و مخاطب | درکی روشن از تقاضا، رقبا و مشتری‌ای که می‌خواهید.\nجایگاه‌یابی | روایتِ تیز و قابل‌دفاع که شما را متمایز می‌کند.\nنقشهٔ رشد | برنامه‌ای اولویت‌بندی‌شده در کانال‌ها، بودجه و شاخص‌ها.\nورود به بازار | برنامهٔ عرضهٔ محصول، خدمت یا بازار جدید.",
			),
			'process' => array(
				'en' => "Audit | We assess your market, brand and current performance.\nStrategise | Positioning, priorities and the roadmap that ties it together.\nAlign | Workshops to get your team behind the plan.\nEnable | We stay on to execute, or hand over a plan you can run.",
				'ar' => "تدقيق | نقيّم سوقك وعلامتك وأداءك الحالي.\nاستراتيجية | التموضع والأولويات والخارطة التي تجمعها.\nمواءمة | ورش لجعل فريقك خلف الخطة.\nتمكين | نبقى للتنفيذ أو نسلّمك خطة تديرها بنفسك.",
				'fa' => "بررسی | بازار، برند و عملکرد فعلی شما را ارزیابی می‌کنیم.\nاستراتژی | جایگاه‌یابی، اولویت‌ها و نقشه‌ای که همه را گره می‌زند.\nهم‌سو‌سازی | کارگاه‌هایی برای همراه‌کردن تیم شما با برنامه.\nتوانمندسازی | برای اجرا می‌مانیم یا برنامه‌ای تحویل می‌دهیم که خودتان اجرا کنید.",
			),
			'faq' => array(
				'en' => "Is this a one-off or ongoing? | Either — a focused strategy sprint or an ongoing advisory relationship.\nDo you help us execute? | Yes — we can run the plan with you, or equip your team to run it.\nDo you know the Gulf market? | Deeply — we're Muscat-based and work across Oman and the GCC.",
				'ar' => "هل هذا لمرة واحدة أم مستمر؟ | كلاهما — سبرنت استراتيجية مركّز أو علاقة استشارية مستمرة.\nهل تساعدوننا على التنفيذ؟ | نعم — نُدير الخطة معك أو نجهّز فريقك لإدارتها.\nهل تعرفون سوق الخليج؟ | بعمق — مقرّنا مسقط ونعمل في عُمان والخليج.",
				'fa' => "این یک‌باره است یا مستمر؟ | هر دو — یک اسپرینتِ استراتژیِ متمرکز یا رابطهٔ مشاورهٔ مستمر.\nدر اجرا کمک می‌کنید؟ | بله — می‌توانیم برنامه را با شما اجرا کنیم یا تیم‌تان را برای اجرا مجهز کنیم.\nبازار خلیج را می‌شناسید؟ | عمیقاً — مستقر در مسقط و فعال در عمان و خلیج.",
			),
		),
	);
}

/* ------------------------------------------------------------------ *
 * Page + structure builder.
 * ------------------------------------------------------------------ */

/**
 * The pages the theme needs and their templates.
 */
function bright_stars_page_blueprint() {
	return array(
		'home'     => array( 'title' => 'Home', 'template' => '', 'slug' => 'home' ),
		'services' => array( 'title' => 'Services', 'template' => 'page-templates/template-services.php', 'slug' => 'services' ),
		'about'    => array( 'title' => 'About', 'template' => 'page-templates/template-about.php', 'slug' => 'about' ),
		'pricing'  => array( 'title' => 'Pricing', 'template' => 'page-templates/template-pricing.php', 'slug' => 'pricing' ),
		'contact'  => array( 'title' => 'Contact', 'template' => 'page-templates/template-contact.php', 'slug' => 'contact' ),
		'clientspage' => array( 'title' => 'Clients', 'template' => 'page-templates/template-clients.php', 'slug' => 'clients' ),
		'blog'     => array( 'title' => 'Blog', 'template' => '', 'slug' => 'blog' ),
	);
}

/**
 * Create the pages, assign templates, set front + posts pages, store the map.
 */
function bright_stars_create_pages() {
	$o     = get_option( 'bright_stars_options', array() );
	$o     = is_array( $o ) ? $o : array();
	$map   = isset( $o['route_pages'] ) && is_array( $o['route_pages'] ) ? $o['route_pages'] : array();

	foreach ( bright_stars_page_blueprint() as $route => $info ) {
		// Skip if we already have a valid page for this route.
		if ( ! empty( $map[ $route ] ) && get_post( $map[ $route ] ) ) {
			continue;
		}
		// Reuse an existing page with the same slug if present.
		$existing = get_page_by_path( $info['slug'] );
		if ( $existing ) {
			$page_id = $existing->ID;
		} else {
			$page_id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_title'   => $info['title'],
					'post_name'    => $info['slug'],
					'post_status'  => 'publish',
					'post_content' => '',
				)
			);
		}
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			if ( $info['template'] ) {
				update_post_meta( $page_id, '_wp_page_template', $info['template'] );
			}
			$map[ $route ] = (int) $page_id;
		}
	}

	// Front page + posts page.
	if ( ! empty( $map['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $map['home'] );
	}
	if ( ! empty( $map['blog'] ) ) {
		update_option( 'page_for_posts', (int) $map['blog'] );
	}

	// The "clients" route used by nav points at the Clients page.
	if ( ! empty( $map['clientspage'] ) ) {
		$map['clients'] = (int) $map['clientspage'];
	}

	$o['route_pages'] = $map;
	update_option( 'bright_stars_options', $o );

	return $map;
}

/**
 * Seed the CPT collections from the default data (idempotent unless forced).
 *
 * @param bool $force Recreate even if items already exist.
 */
function bright_stars_seed_content( $force = false ) {
	$data = bright_stars_default_data();

	$set_tri = function ( $post_id, $base, $tri ) {
		foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
			if ( isset( $tri[ $lg ] ) ) {
				update_post_meta( $post_id, '_bs_' . $base . '_' . $lg, $tri[ $lg ] );
			}
		}
	};

	// Services.
	if ( $force || ! bright_stars_get_items( 'bs_service', 1 ) ) {
		$details = bright_stars_service_details();
		$order   = 0;
		foreach ( $data['services'] as $s ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_service', 'post_status' => 'publish', 'post_title' => $s['title']['en'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_icon', $s['icon'] );
				$set_tri( $id, 'title', $s['title'] );
				$set_tri( $id, 'desc', $s['desc'] );
				$idx = $order + 1;
				if ( isset( $details[ $idx ] ) ) {
					foreach ( array( 'intro', 'stats', 'features', 'process', 'faq' ) as $b ) {
						$set_tri( $id, $b, $details[ $idx ][ $b ] );
					}
				}
			}
			$order++;
		}
	}

	// Pricing.
	if ( $force || ! bright_stars_get_items( 'bs_pricing', 1 ) ) {
		$order = 0;
		foreach ( $data['pricing'] as $p ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_pricing', 'post_status' => 'publish', 'post_title' => $p['name']['en'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_featured', $p['featured'] ? '1' : '' );
				foreach ( array( 'name', 'price', 'period', 'desc', 'cta', 'badge', 'features' ) as $b ) {
					$set_tri( $id, $b, $p[ $b ] );
				}
			}
			$order++;
		}
	}

	// Team.
	if ( $force || ! bright_stars_get_items( 'bs_team', 1 ) ) {
		$order = 0;
		foreach ( $data['team'] as $m ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_team', 'post_status' => 'publish', 'post_title' => $m['name'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_photo', bs_asset( 'img/team/' . $m['photo'] ) );
				foreach ( array( 'role', 'quote', 'bio' ) as $b ) {
					$set_tri( $id, $b, $m[ $b ] );
				}
			}
			$order++;
		}
	}

	// Testimonials.
	if ( $force || ! bright_stars_get_items( 'bs_testimonial', 1 ) ) {
		$order = 0;
		foreach ( $data['testimonials'] as $t ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_testimonial', 'post_status' => 'publish', 'post_title' => $t['author'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_author', $t['author'] );
				update_post_meta( $id, '_bs_initials', $t['initials'] );
				$set_tri( $id, 'quote', $t['quote'] );
				$set_tri( $id, 'role', $t['role'] );
			}
			$order++;
		}
	}

	// Clients.
	if ( $force || ! bright_stars_get_items( 'bs_client', 1 ) ) {
		$order = 0;
		foreach ( $data['clients'] as $c ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_client', 'post_status' => 'publish', 'post_title' => $c['name'], 'post_name' => $c['slug'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				if ( ! empty( $c['logo'] ) ) {
					update_post_meta( $id, '_bs_logo', bs_asset( 'img/clients/' . $c['logo'] ) );
				}
				if ( ! empty( $c['feed'] ) ) {
					update_post_meta( $id, '_bs_feed', bs_asset( 'img/feeds/' . $c['feed'] ) );
				}
				update_post_meta( $id, '_bs_instagram', $c['ig'] );
				update_post_meta( $id, '_bs_handle', $c['handle'] );
				update_post_meta( $id, '_bs_color', $c['color'] );
				update_post_meta( $id, '_bs_tagline_en', $c['tagline'] );
				update_post_meta( $id, '_bs_brief_en', $c['brief'] );
				update_post_meta( $id, '_bs_services_en', implode( "\n", $c['services'] ) );
				update_post_meta( $id, '_bs_results_en', implode( "\n", $c['results'] ) );
				$set_tri( $id, 'category', $c['category'] );
			}
			$order++;
		}
	}
}

/**
 * Arabic + Persian translations of the client case-study copy, keyed by slug.
 * Result values stay in Latin numerals; only the labels are translated.
 *
 * @return array
 */
function bright_stars_client_translations() {
	return array(
		'm2-real-estate' => array(
			'tagline'  => array( 'ar' => 'أرقى عناوين مسقط، تُباع بسرعة أكبر.', 'fa' => 'مطلوب‌ترین آدرس‌های مسقط، سریع‌تر فروخته می‌شوند.' ),
			'brief'    => array( 'ar' => 'وكالة عقارية راقية بقوائم مميزة وحضور رقمي باهت. أعدنا بناء الحساب والقمع التسويقي حتى يبدو كل عقار بقيمته الحقيقية.', 'fa' => 'آژانسی بوتیک با ملک‌های لوکس اما حضور دیجیتال کم‌رنگ. فید و قیف فروش را بازطراحی کردیم تا هر ملک هم‌اندازه‌ی ارزش واقعی‌اش دیده شود.' ),
			'services' => array( 'ar' => "نظام العلامة والمحتوى\nريلز عقاري\nحملات لجذب العملاء\nإدارة العلاقات والمتابعة", 'fa' => "سیستم برند و محتوا\nریل املاک\nکمپین جذب سرنخ\nمدیریت ارتباط و پیگیری" ),
			'results'  => array( 'ar' => "+218% | عملاء مؤهلون\n579 | متابع\n27 | صفقة متأثرة", 'fa' => "+218% | سرنخ واجد شرایط\n579 | فالوور\n27 | معامله‌ی متأثر" ),
		),
		'lubna-khalili-academy' => array(
			'tagline'  => array( 'ar' => 'نحوّل الخبرة إلى أكاديمية محجوزة بالكامل.', 'fa' => 'تبدیل تخصص به آموزشگاهی با ظرفیت تکمیل.' ),
			'brief'    => array( 'ar' => 'مُعلِّمة بجمهور وفيّ دون نظام لتحويله. جهّزنا الدورات وبنينا تقويم الإطلاق وأدرنا حملات التسجيل.', 'fa' => 'مدرّسی با مخاطب وفادار اما بدون سیستمی برای تبدیل آن. دوره‌ها را بسته‌بندی کردیم، تقویم لانچ ساختیم و کمپین‌های ثبت‌نام را اجرا کردیم.' ),
			'services' => array( 'ar' => "هوية الدورات\nحملات الإطلاق\nقمع جذب العملاء\nمحتوى المجتمع", 'fa' => "برندینگ دوره‌ها\nکمپین لانچ\nقیف جذب سرنخ\nمحتوای انجمن" ),
			'results'  => array( 'ar' => "+340% | تسجيلات\n1,245 | متابع\n4.6x | عائد إعلاني", 'fa' => "+340% | ثبت‌نام\n1,245 | فالوور\n4.6x | بازده تبلیغات" ),
		),
		'zaytoon-royal' => array(
			'tagline'  => array( 'ar' => 'مائدة ملكية، محجوزة بالكامل.', 'fa' => 'میزی سلطنتی، رزروِ کامل.' ),
			'brief'    => array( 'ar' => 'وجهة طعام راقية تحتاج حجوزات لا مجرد إعجابات. بنينا حضوراً يركّز على الحجز مع حملات موسمية.', 'fa' => 'رستورانی فاین‌داینینگ که به رزرو نیاز داشت نه فقط لایک. حضوری رزروْمحور با کمپین‌های فصلی ساختیم.' ),
			'services' => array( 'ar' => "العلامة والإخراج الفني\nمحتوى الطعام\nقمع الحجوزات\nعشاء المؤثرين", 'fa' => "برند و مدیریت هنری\nمحتوای غذا\nقیف رزرو\nشام اینفلوئنسرها" ),
			'results'  => array( 'ar' => "2.4x | حجوزات مباشرة\n+190% | حجوزات نهاية الأسبوع\n153 | متابع", 'fa' => "2.4x | رزرو مستقیم\n+190% | میز آخر هفته\n153 | فالوور" ),
		),
		'hudhud-fabric' => array(
			'tagline'  => array( 'ar' => 'قماش عريق، طلب عصري.', 'fa' => 'پارچه‌ی اصیل، تقاضای مدرن.' ),
			'brief'    => array( 'ar' => 'دار أقمشة بمنتج جميل ومبيعات هادئة. روينا قصة الحِرفة وحوّلنا الكتالوج إلى فيد قابل للتسوّق.', 'fa' => 'خانه‌ی نساجی با محصول زیبا اما فروش کم‌سروصدا. داستان صنعت‌گری را روایت کردیم و کاتالوگ را به فیدی خریدنی بدل کردیم.' ),
			'services' => array( 'ar' => "سرد قصة العلامة\nتصوير المنتجات\nكتالوج ومتجر\nإعلانات مدفوعة", 'fa' => "روایت برند\nعکاسی محصول\nکاتالوگ و فروشگاه\nتبلیغات پولی" ),
			'results'  => array( 'ar' => "+265% | طلبات أونلاين\n3.0x | مشاهدات الكتالوج\n8,550 | متابع", 'fa' => "+265% | سفارش آنلاین\n3.0x | بازدید کاتالوگ\n8,550 | فالوور" ),
		),
		'seeb-waves' => array(
			'tagline'  => array( 'ar' => 'نركب موجة نمط الحياة الساحلي.', 'fa' => 'سوار بر موج سبک‌زندگی ساحلی.' ),
			'brief'    => array( 'ar' => 'علامة لايف ستايل لساحل عُمان. منحناها عالماً بصرياً متّسقاً ومحرّك محتوى دائماً.', 'fa' => 'برند لایف‌استایل برای ساحل عمان. دنیای بصری منسجم و موتور محتوای همیشه‌فعال به آن دادیم.' ),
			'services' => array( 'ar' => "العالم البصري للعلامة\nمحتوى مستمر\nشراكات صنّاع المحتوى\nنمو المجتمع", 'fa' => "دنیای برند\nمحتوای همیشه‌فعال\nهمکاری با سازندگان\nرشد جامعه" ),
			'results'  => array( 'ar' => "+410% | تفاعل\n14.9k | متابع\n5.1x | وصول الريلز", 'fa' => "+410% | تعامل\n14.9k | فالوور\n5.1x | دسترسی ریل" ),
		),
		'sima-vandad' => array(
			'tagline'  => array( 'ar' => 'جمال يحجز نفسه بنفسه.', 'fa' => 'زیبایی‌ای که خودش را رزرو می‌کند.' ),
			'brief'    => array( 'ar' => 'خبيرة تجميل جاهزة للتوسّع. بنينا قمع الحجز ومحتوى قبل/بعد الذي يُحوِّل فعلاً.', 'fa' => 'متخصص زیبایی آماده‌ی مقیاس‌پذیری. قیف رزرو و محتوای قبل/بعد را ساختیم که واقعاً تبدیل می‌کند.' ),
			'services' => array( 'ar' => "هوية العلامة\nقمع الحجز\nريلز العلاجات\nإعادة الاستهداف", 'fa' => "هویت برند\nقیف رزرو\nریل خدمات\nریتارگتینگ" ),
			'results'  => array( 'ar' => "+280% | حجوزات\n3.4x | معدل النماذج\n32.1k | متابع", 'fa' => "+280% | رزرو\n3.4x | نرخ فرم\n32.1k | فالوور" ),
		),
		'nota-jewelry' => array(
			'tagline'  => array( 'ar' => 'كل قطعة، لحظة.', 'fa' => 'هر قطعه، یک لحظه.' ),
			'brief'    => array( 'ar' => 'علامة مجوهرات تنافس بالعاطفة لا بالسعر. صنعنا فيداً فاخراً وحملات موسم الهدايا.', 'fa' => 'برند جواهری که با احساس رقابت می‌کند نه قیمت. فیدی لوکس و کمپین‌های فصل هدیه ساختیم.' ),
			'services' => array( 'ar' => "العلامة والإخراج الفني\nأفلام المنتجات\nحملات الهدايا\nإعلانات مدفوعة", 'fa' => "برند و مدیریت هنری\nفیلم محصول\nکمپین هدیه\nتبلیغات پولی" ),
			'results'  => array( 'ar' => "+233% | زيارات المتجر\n4.2x | عائد الحملات\n22.2k | متابع", 'fa' => "+233% | بازدید فروشگاه\n4.2x | بازده کمپین\n22.2k | فالوور" ),
		),
		'oman-vision' => array(
			'tagline'  => array( 'ar' => 'نروي قصة عُمان للعالم.', 'fa' => 'روایت داستان عمان برای جهان.' ),
			'brief'    => array( 'ar' => 'منصّة إعلامية تحتاج وصولاً واحتفاظاً. شحذنا الصيغ ونمّينا الجمهور.', 'fa' => 'پلتفرم رسانه‌ای که به دسترسی و حفظ مخاطب نیاز داشت. فرمت‌ها را تیز کردیم و مخاطب را رشد دادیم.' ),
			'services' => array( 'ar' => "استراتيجية المحتوى\nصيغ قصيرة\nنمو الجمهور\nالتوزيع", 'fa' => "استراتژی محتوا\nفرمت کوتاه\nرشد مخاطب\nتوزیع" ),
			'results'  => array( 'ar' => "+520% | وقت المشاهدة\n48k | متابع جديد\n3.7x | مشاركات", 'fa' => "+520% | زمان تماشا\n48k | فالوور جدید\n3.7x | اشتراک‌گذاری" ),
		),
		'adam-perfumes' => array(
			'tagline'  => array( 'ar' => 'عطرٌ لا يُنسى على الإنترنت.', 'fa' => 'عطری فراموش‌نشدنی، آنلاین.' ),
			'brief'    => array( 'ar' => 'دار عطور بقوة تجزئة وقمع رقمي ضعيف. بنينا خطة الإطلاق والمحرّك الدائم.', 'fa' => 'خانه‌ی عطر با قدرت خرده‌فروشی اما قیف دیجیتال ضعیف. پلی‌بوک لانچ و موتور همیشه‌فعال ساختیم.' ),
			'services' => array( 'ar' => "أفلام العلامة\nحملات الإطلاق\nقمع التجارة الإلكترونية\nبذر المؤثرين", 'fa' => "فیلم برند\nکمپین لانچ\nقیف فروشگاه آنلاین\nهمکاری اینفلوئنسر" ),
			'results'  => array( 'ar' => "+295% | مبيعات أونلاين\n5.8x | عائد الإطلاق\n102k | متابع", 'fa' => "+295% | فروش آنلاین\n5.8x | بازده لانچ\n102k | فالوور" ),
		),
		'miss-cheff' => array(
			'tagline'  => array( 'ar' => 'من المطبخ إلى الحجز الكامل.', 'fa' => 'از آشپزخانه تا رزرو کامل.' ),
			'brief'    => array( 'ar' => 'علامة طهي بطعام رائع وطلب متذبذب. جعلنا الفيد مُشتهى والطلبات ثابتة.', 'fa' => 'برند آشپزی با غذای عالی اما تقاضای نوسانی. فید را اشتهاآور و سفارش‌ها را پایدار کردیم.' ),
			'services' => array( 'ar' => "محتوى الطعام\nحملات القائمة\nقمع التوصيل\nالمجتمع", 'fa' => "محتوای غذا\nکمپین منو\nقیف دلیوری\nجامعه" ),
			'results'  => array( 'ar' => "2.7x | طلبات\n+205% | حفظ المنشورات\n389 | متابع", 'fa' => "2.7x | سفارش\n+205% | ذخیره\n389 | فالوور" ),
		),
		'first-glass-oman' => array(
			'tagline'  => array( 'ar' => 'نبني عُمان، لوحاً بعد لوح.', 'fa' => 'ساختن عمان، شیشه به شیشه.' ),
			'brief'    => array( 'ar' => 'مقاول زجاج وألمنيوم يفوز بالحِرفة لا بالنقرات. بنينا حضوراً قائماً على المشاريع ومحرّك عملاء B2B.', 'fa' => 'پیمانکار شیشه و آلومینیوم که با کیفیت برنده می‌شود نه کلیک. حضوری پروژه‌محور و موتور سرنخ B2B ساختیم.' ),
			'services' => array( 'ar' => "محتوى العلامة والمشاريع\nجذب عملاء B2B\nأفلام حالات المشاريع\nتمكين المبيعات", 'fa' => "محتوای برند و پروژه\nجذب سرنخ B2B\nفیلم پروژه‌ها\nتوانمندسازی فروش" ),
			'results'  => array( 'ar' => "+178% | طلبات عروض أسعار\n3.3x | استفسارات الموقع\n24 | مشروع متأثر", 'fa' => "+178% | درخواست استعلام\n3.3x | استعلام سایت\n24 | پروژه‌ی متأثر" ),
		),
	);
}

/**
 * Backfill missing meta on existing client posts from the default data
 * (matched by slug). Only fills empty fields, so it never clobbers edits.
 * This is what makes "deactivate → reactivate" populate older clients.
 */
function bright_stars_upgrade_clients() {
	$data    = bright_stars_default_data();
	$tr      = bright_stars_client_translations();
	$by_slug = array();
	foreach ( $data['clients'] as $c ) {
		$by_slug[ $c['slug'] ] = $c;
	}

	$clients = get_posts( array( 'post_type' => 'bs_client', 'post_status' => 'any', 'numberposts' => -1 ) );
	foreach ( $clients as $p ) {
		if ( ! isset( $by_slug[ $p->post_name ] ) ) {
			continue;
		}
		$c    = $by_slug[ $p->post_name ];
		$fill = function ( $key, $value ) use ( $p ) {
			$cur = get_post_meta( $p->ID, $key, true );
			if ( '' === trim( (string) $cur ) && '' !== trim( (string) $value ) ) {
				update_post_meta( $p->ID, $key, $value );
			}
		};

		$fill( '_bs_tagline_en', $c['tagline'] );
		$fill( '_bs_brief_en', $c['brief'] );
		$fill( '_bs_services_en', implode( "\n", $c['services'] ) );
		$fill( '_bs_results_en', implode( "\n", $c['results'] ) );
		$fill( '_bs_instagram', $c['ig'] );
		$fill( '_bs_handle', $c['handle'] );
		$fill( '_bs_color', $c['color'] );
		foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
			$fill( '_bs_category_' . $lg, $c['category'][ $lg ] );
		}
		if ( ! empty( $c['logo'] ) ) {
			$fill( '_bs_logo', bs_asset( 'img/clients/' . $c['logo'] ) );
		}
		if ( ! empty( $c['feed'] ) ) {
			$fill( '_bs_feed', bs_asset( 'img/feeds/' . $c['feed'] ) );
		}

		// Arabic + Persian case-study copy.
		if ( isset( $tr[ $p->post_name ] ) ) {
			$t = $tr[ $p->post_name ];
			foreach ( array( 'ar', 'fa' ) as $lg ) {
				foreach ( array( 'tagline', 'brief', 'services', 'results' ) as $field ) {
					if ( ! empty( $t[ $field ][ $lg ] ) ) {
						$fill( '_bs_' . $field . '_' . $lg, $t[ $field ][ $lg ] );
					}
				}
			}
		}
	}
}

/**
 * Backfill the rich detail meta on existing service posts from the defaults
 * (matched by English title, so order/edits never break the mapping). Only
 * fills empty fields, so admin edits are preserved. This makes the new
 * per-service detail pages populate after a theme update or reactivation.
 */
function bright_stars_upgrade_services() {
	$data     = bright_stars_default_data();
	$details  = bright_stars_service_details();
	$by_title = array();
	foreach ( $data['services'] as $i => $s ) {
		$by_title[ trim( $s['title']['en'] ) ] = $i;
	}

	$services = get_posts( array( 'post_type' => 'bs_service', 'post_status' => 'any', 'numberposts' => -1 ) );
	foreach ( $services as $p ) {
		$en    = get_post_meta( $p->ID, '_bs_title_en', true );
		$key   = '' !== trim( (string) $en ) ? trim( (string) $en ) : trim( $p->post_title );
		if ( ! isset( $by_title[ $key ] ) ) {
			continue;
		}
		$i   = $by_title[ $key ];
		$idx = $i + 1;
		$s   = $data['services'][ $i ];

		$fill = function ( $meta_key, $value ) use ( $p ) {
			$cur = get_post_meta( $p->ID, $meta_key, true );
			if ( '' === trim( (string) $cur ) && '' !== trim( (string) $value ) ) {
				update_post_meta( $p->ID, $meta_key, $value );
			}
		};

		$fill( '_bs_icon', $s['icon'] );
		foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
			if ( isset( $s['title'][ $lg ] ) ) {
				$fill( '_bs_title_' . $lg, $s['title'][ $lg ] );
			}
			if ( isset( $s['desc'][ $lg ] ) ) {
				$fill( '_bs_desc_' . $lg, $s['desc'][ $lg ] );
			}
		}
		if ( isset( $details[ $idx ] ) ) {
			foreach ( array( 'intro', 'stats', 'features', 'process', 'faq' ) as $b ) {
				foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
					if ( ! empty( $details[ $idx ][ $b ][ $lg ] ) ) {
						$fill( '_bs_' . $b . '_' . $lg, $details[ $idx ][ $b ][ $lg ] );
					}
				}
			}
		}
	}
}

/**
 * Build a Primary menu from the route pages and assign it to the location.
 */
function bright_stars_create_menu() {
	$name = 'Primary';
	$menu = wp_get_nav_menu_object( $name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $name );
	} else {
		$menu_id = $menu->term_id;
	}
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	// Only populate an empty menu.
	$items = wp_get_nav_menu_items( $menu_id );
	if ( empty( $items ) ) {
		foreach ( bright_stars_nav_items() as $it ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => $it['label'],
					'menu-item-url'    => $it['url'],
					'menu-item-status' => 'publish',
					'menu-item-type'   => 'custom',
				)
			);
		}
	}

	$locations           = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Run the whole setup.
 *
 * @param bool $force_seed Recreate demo content.
 */
function bright_stars_run_setup( $force_seed = false ) {
	bright_stars_create_pages();
	bright_stars_seed_content( $force_seed );
	bright_stars_create_menu();

	$o = get_option( 'bright_stars_options', array() );
	$o = is_array( $o ) ? $o : array();
	$o['seeded'] = '1';
	update_option( 'bright_stars_options', $o );

	flush_rewrite_rules();
}

/**
 * On first activation, configure everything automatically.
 */
function bright_stars_after_switch_theme() {
	$o = get_option( 'bright_stars_options', array() );
	if ( is_array( $o ) && ! empty( $o['seeded'] ) ) {
		// Re-activation: ensure pages exist and backfill any new fields.
		bright_stars_create_pages();
		bright_stars_upgrade_clients();
		bright_stars_upgrade_services();
		flush_rewrite_rules();
		update_option( 'bright_stars_data_version', BRIGHT_STARS_VERSION );
		return;
	}
	bright_stars_run_setup( false );
	update_option( 'bright_stars_data_version', BRIGHT_STARS_VERSION );
}
add_action( 'after_switch_theme', 'bright_stars_after_switch_theme' );

/**
 * Run data migrations once after the theme files are updated (no re-activation
 * required) — guarded by a stored version so it only runs when something
 * changed. This guarantees the changes show up in WordPress after an update.
 */
function bright_stars_maybe_upgrade() {
	if ( get_option( 'bright_stars_data_version' ) === BRIGHT_STARS_VERSION ) {
		return;
	}
	$o = get_option( 'bright_stars_options', array() );
	if ( is_array( $o ) && ! empty( $o['seeded'] ) ) {
		bright_stars_create_pages();
		bright_stars_upgrade_clients();
		bright_stars_upgrade_services();
		flush_rewrite_rules();
	}
	update_option( 'bright_stars_data_version', BRIGHT_STARS_VERSION );
}
add_action( 'wp_loaded', 'bright_stars_maybe_upgrade' );

/* ------------------------------------------------------------------ *
 * Setup admin page.
 * ------------------------------------------------------------------ */

function bright_stars_render_setup_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_POST['bright_stars_setup_action'] ) && check_admin_referer( 'bright_stars_setup', 'bright_stars_setup_nonce' ) ) {
		$action = sanitize_text_field( wp_unslash( $_POST['bright_stars_setup_action'] ) );
		if ( 'run' === $action ) {
			bright_stars_run_setup( false );
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Pages created and content set up.', 'bright-stars' ) . '</p></div>';
		} elseif ( 'reseed' === $action ) {
			bright_stars_run_setup( true );
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Demo content re-imported.', 'bright-stars' ) . '</p></div>';
		}
	}

	$map = bs_opt( 'route_pages', array() );
	?>
	<div class="wrap bs-admin">
		<h1><?php esc_html_e( 'Bright Stars — Setup', 'bright-stars' ); ?></h1>
		<p class="description"><?php esc_html_e( 'This builds the WordPress pages (Home, Services, Clients, About, Pricing, Contact, Blog), sets the front page, and fills the site with the original Bright Stars content in English, Arabic and Persian.', 'bright-stars' ); ?></p>

		<h2><?php esc_html_e( 'Pages', 'bright-stars' ); ?></h2>
		<table class="widefat striped" style="max-width:640px">
			<thead><tr><th><?php esc_html_e( 'Route', 'bright-stars' ); ?></th><th><?php esc_html_e( 'Status', 'bright-stars' ); ?></th></tr></thead>
			<tbody>
			<?php foreach ( bright_stars_page_blueprint() as $route => $info ) : ?>
				<tr>
					<td><strong><?php echo esc_html( $info['title'] ); ?></strong></td>
					<td>
						<?php
						$pid = isset( $map[ $route ] ) ? (int) $map[ $route ] : 0;
						if ( $pid && get_post( $pid ) ) {
							printf( '<a href="%s">%s</a> · <a href="%s" target="_blank" rel="noopener">%s</a>', esc_url( get_edit_post_link( $pid ) ), esc_html__( 'Edit', 'bright-stars' ), esc_url( get_permalink( $pid ) ), esc_html__( 'View', 'bright-stars' ) );
						} else {
							echo '<span style="color:#b32d2e">' . esc_html__( 'Not created yet', 'bright-stars' ) . '</span>';
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<h2 style="margin-top:24px"><?php esc_html_e( 'Content', 'bright-stars' ); ?></h2>
		<p>
			<?php
			$counts = array(
				'bs_service'     => __( 'Services', 'bright-stars' ),
				'bs_pricing'     => __( 'Pricing plans', 'bright-stars' ),
				'bs_team'        => __( 'Team members', 'bright-stars' ),
				'bs_testimonial' => __( 'Testimonials', 'bright-stars' ),
				'bs_client'      => __( 'Clients', 'bright-stars' ),
			);
			$parts = array();
			foreach ( $counts as $pt => $lbl ) {
				$parts[] = $lbl . ': <strong>' . count( bright_stars_get_items( $pt ) ) . '</strong>';
			}
			echo wp_kses_post( implode( ' &nbsp;·&nbsp; ', $parts ) );
			?>
		</p>

		<form method="post" style="margin-top:16px">
			<?php wp_nonce_field( 'bright_stars_setup', 'bright_stars_setup_nonce' ); ?>
			<button type="submit" name="bright_stars_setup_action" value="run" class="button button-primary"><?php esc_html_e( 'Create pages & set up', 'bright-stars' ); ?></button>
			<button type="submit" name="bright_stars_setup_action" value="reseed" class="button" onclick="return confirm('<?php echo esc_js( __( 'Re-import all demo content? Existing demo items are kept and a fresh set is added.', 'bright-stars' ) ); ?>');"><?php esc_html_e( 'Re-import demo content', 'bright-stars' ); ?></button>
		</form>
	</div>
	<?php
}

/* ------------------------------------------------------------------ *
 * Contact enquiries: a private CPT + AJAX handler.
 * ------------------------------------------------------------------ */

function bright_stars_register_lead_cpt() {
	register_post_type(
		'bs_lead',
		array(
			'labels'       => bright_stars_cpt_labels( 'Enquiry', 'Enquiries' ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => 'bright-stars',
			'menu_icon'    => 'dashicons-email-alt',
			'supports'     => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'bright_stars_register_lead_cpt' );

/**
 * Handle the contact form (AJAX).
 */
function bright_stars_handle_lead() {
	check_ajax_referer( 'bright_stars_lead', 'nonce' );

	$name    = isset( $_POST['bs_name'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_name'] ) ) : '';
	$brand   = isset( $_POST['bs_brand'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_brand'] ) ) : '';
	$email   = isset( $_POST['bs_email'] ) ? sanitize_email( wp_unslash( $_POST['bs_email'] ) ) : '';
	$phone   = isset( $_POST['bs_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_phone'] ) ) : '';
	$service = isset( $_POST['bs_service'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_service'] ) ) : '';
	$budget  = isset( $_POST['bs_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_budget'] ) ) : '';
	$message = isset( $_POST['bs_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['bs_message'] ) ) : '';

	if ( '' === $name || ( '' === $email && '' === $phone ) ) {
		wp_send_json_error( bs_t( 'f.required' ) );
	}
	if ( '' !== $email && ! is_email( $email ) ) {
		wp_send_json_error( bs_t( 'f.error' ) );
	}

	// Honeypot.
	if ( ! empty( $_POST['bs_website'] ) ) {
		wp_send_json_success( bs_t( 'f.thanksSub' ) );
	}

	$lead_id = wp_insert_post(
		array(
			'post_type'   => 'bs_lead',
			'post_status' => 'publish',
			/* translators: 1: name, 2: brand. */
			'post_title'  => trim( sprintf( '%1$s — %2$s', $name, $brand ? $brand : '—' ) ),
			'post_content' => $message,
		)
	);
	if ( $lead_id && ! is_wp_error( $lead_id ) ) {
		foreach ( compact( 'name', 'brand', 'email', 'phone', 'service', 'budget' ) as $k => $v ) {
			update_post_meta( $lead_id, '_bs_' . $k, $v );
		}
		update_post_meta( $lead_id, '_bs_lang', bs_lang() );
	}

	$to      = bs_opt( 'lead_email' );
	$to      = $to ? $to : get_option( 'admin_email' );
	$subject = sprintf( '[%s] New enquiry from %s', bs_brand_name(), $name );
	$body    = "Name: $name\nBrand: $brand\nEmail: $email\nPhone: $phone\nService: $service\nBudget: $budget\n\nMessage:\n$message\n";
	$headers = array();
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	wp_mail( $to, $subject, $body, $headers );

	wp_send_json_success( bs_t( 'f.thanksSub' ) );
}
add_action( 'wp_ajax_bright_stars_lead', 'bright_stars_handle_lead' );
add_action( 'wp_ajax_nopriv_bright_stars_lead', 'bright_stars_handle_lead' );

/**
 * Show enquiry detail columns.
 */
function bright_stars_lead_columns( $cols ) {
	$cols['bs_email'] = __( 'Email', 'bright-stars' );
	$cols['bs_phone'] = __( 'Phone', 'bright-stars' );
	$cols['bs_service'] = __( 'Service', 'bright-stars' );
	return $cols;
}
add_filter( 'manage_bs_lead_posts_columns', 'bright_stars_lead_columns' );

function bright_stars_lead_column_content( $col, $post_id ) {
	if ( in_array( $col, array( 'bs_email', 'bs_phone', 'bs_service' ), true ) ) {
		echo esc_html( get_post_meta( $post_id, '_' . $col, true ) );
	}
}
add_action( 'manage_bs_lead_posts_custom_column', 'bright_stars_lead_column_content', 10, 2 );
