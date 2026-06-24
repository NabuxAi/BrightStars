<?php
/**
 * Trilingual string dictionary (English / Arabic / Persian).
 *
 * These are the faithful defaults ported from the original design. Any key can
 * be overridden per language from the admin panel (see bs_field()); when an
 * admin field is left blank the string below is used, so the site is fully
 * translated out of the box.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The master string table.
 *
 * @return array<string,array<string,string>>
 */
function bs_i18n_dict() {
	static $dict = null;
	if ( null !== $dict ) {
		return $dict;
	}

	$dict = array(
		'en' => array(
			// Navigation.
			'nav.home' => 'Home', 'nav.services' => 'Services', 'nav.process' => 'Process', 'nav.clients' => 'Clients', 'nav.about' => 'About', 'nav.pricing' => 'Pricing', 'nav.blog' => 'Blog', 'nav.contact' => 'Contact', 'nav.start' => 'Start a project',
			// Hero.
			'hero.tag' => 'Digital marketing · Oman', 'hero.h1a' => 'Lighting the path', 'hero.h1b' => 'for your', 'hero.brand' => 'brand.', 'hero.sub' => 'Bright Starts is a Muscat-based digital marketing agency for ambitious brands — we partner with you from growth to business development, and from the bright idea all the way to execution.', 'hero.start' => 'Start a project', 'hero.what' => 'What we do',
			'st.brands' => 'Brands grown', 'st.gulf' => 'In the Gulf', 'st.roas' => 'Avg. ROAS',
			// Zero to viral.
			'zv.eyebrow' => 'From zero to viral', 'zv.h' => 'We take brands the whole way', 'zv.sub' => "From the first spark to a brand people can't stop sharing — idea, production and distribution under one roof.",
			'zv1t' => 'Spark the idea', 'zv1d' => 'Positioning, story and the bright idea that sets you apart.', 'zv1x' => '< Audit · market research · audience mapping >', 'zv1a' => 'Brand audit & positioning', 'zv1b' => 'Audience & competitor research', 'zv1c' => 'The core creative idea',
			'zv2t' => 'Roll the camera', 'zv2d' => 'Filming, editing and design that make every frame premium.', 'zv2x' => '< Scripting · filming · editing · motion >', 'zv2a' => 'Scripts & storyboards', 'zv2b' => 'Filming & photography', 'zv2c' => 'Editing, motion & design',
			'zv3t' => 'Go live', 'zv3d' => 'Launch across the right channels with a coordinated rollout.', 'zv3x' => '< Channel plan · publishing · paid boost >', 'zv3a' => 'Channel & content plan', 'zv3b' => 'Coordinated publishing', 'zv3c' => 'Paid media setup',
			'zv4t' => 'Build momentum', 'zv4d' => 'Optimise, double down on what works and grow the audience.', 'zv4x' => '< A/B testing · analytics · community >', 'zv4a' => 'Weekly optimisation', 'zv4b' => 'Performance reporting', 'zv4c' => 'Community management',
			'zv5t' => 'Go viral', 'zv5d' => 'Reach, shares and a brand people recognise and remember.', 'zv5x' => '< Trends · creators · earned reach >', 'zv5a' => 'Trend-led content', 'zv5b' => 'Creator partnerships', 'zv5c' => 'Earned & shared reach',
			// Blog.
			'bl.eyebrow' => 'From the studio', 'bl.h' => 'Insights & stories', 'bl.h2' => 'The Bright Starts blog', 'bl.sub' => 'Playbooks, production notes and growth stories from taking brands from zero to viral.', 'bl.read' => 'Read article', 'bl.all' => 'Read the blog',
			// Clients.
			'cl.eyebrow' => 'Selected clients', 'cl.sub' => "Brands we've grown across Oman and the Gulf — from real estate to fragrance, fashion to fine dining.", 'cl.soon' => 'Coming soon', 'cl.soonsub' => 'New client',
			// Services.
			'sv.eyebrow' => 'What we do', 'sv.h' => 'Full-funnel, full-service', 'sv.sub' => 'One senior team across every channel — so your growth is joined-up, not stitched together.',
			'sv1t' => 'SEO & organic growth', 'sv1d' => 'Technical SEO, content engines and authority building that compound month over month.',
			'sv2t' => 'Paid media & PPC', 'sv2d' => 'Performance campaigns across Google, Meta and TikTok — engineered for ROAS, not vanity.',
			'sv3t' => 'Social media', 'sv3d' => 'Always-on content, community and creator partnerships tuned for the Gulf audience.',
			'sv4t' => 'Content & branding', 'sv4d' => 'Brand systems, art direction and bilingual content that look and sound premium.',
			'sv5t' => 'Web & app design', 'sv5d' => 'Conversion-first websites and product experiences, designed and built end to end.',
			'sv6t' => 'Strategy & consulting', 'sv6d' => 'Market entry, positioning and growth roadmaps from a senior, embedded team.',
			// Metrics.
			'mt.eyebrow' => 'By the numbers', 'mt.h' => 'Growth you can measure', 'mt1' => 'Peak revenue lift', 'mt2' => 'Brands grown', 'mt3' => 'Average ROAS', 'mt4' => 'Client retention',
			// Process.
			'pr.eyebrow' => 'From idea to execution', 'pr.h' => 'How we work',
			'pr1t' => 'Discover', 'pr1d' => 'Audit, market research and goals. We learn your business before we touch a campaign.',
			'pr2t' => 'Strategize', 'pr2d' => 'A clear roadmap: channels, budget, KPIs and the bright idea that ties it together.',
			'pr3t' => 'Execute', 'pr3d' => 'Design, build and launch — creative, media and web, shipped by one senior team.',
			'pr4t' => 'Grow', 'pr4d' => 'Measure, optimise and scale what works. Transparent reporting, every week.',
			// About.
			'ab.eyebrow' => 'About us', 'ab.h' => 'The team behind Bright Starts', 'ab.intro' => 'Bright Starts is a Muscat-based digital marketing agency helping ambitious brands grow — from strategy to execution. We are a small senior team that treats your brand like our own, combining sharp marketing with high-craft content and design.',
			'ab.r1' => 'Digital Marketing & Advertising', 'ab.s1' => "“In a world where everyone shouts, we create a voice that's heard.”", 'ab.b1' => "I'm Mohammad Hossein, a digital marketing and advertising specialist. I help your brand grow and get noticed in the digital space — planning effective ad campaigns, managing social platforms, building online strategy, and producing targeted content.",
			'ab.r2' => 'Content Creation, Editing & Design', 'ab.s2' => '“Every brand has a story; we bring it to life.”', 'ab.b2' => "I'm Mohammad Ali, a specialist in content creation, video editing and filming. Through high-quality video, engaging graphic design and creative storytelling, I narrate your brand's story in the most captivating way and keep your audience connected.",
			'ab.r3' => 'I/O Psychologist · Neuromarketing & Brand Strategy', 'ab.s3' => '“When minds are engaged, brands become unforgettable.”', 'ab.b3' => "I'm Hanieh Salehi, an industrial & organizational psychologist specializing in neuromarketing and brand strategy. I help you build a memorable, impactful brand by analyzing your audience's mind and designing smart strategies that make your brand stand out in the market and stay in people's minds.",
			// Map.
			'mp.eyebrow' => 'Find us', 'mp.h' => 'Visit our studio', 'mp.addr' => 'Muscat, Sultanate of Oman', 'mp.cta' => 'Open in Google Maps',
			// Testimonials.
			'ts.eyebrow' => 'Client voices', 'ts1q' => 'Bright Starts feels like our in-house team — senior, fast, and genuinely invested in the numbers.', 'ts1r' => 'CMO, Oasis Living', 'ts2q' => 'From idea to launch in six weeks. The strategy was sharp and the execution flawless.', 'ts2r' => 'Founder, Mizan Pay',
			// Pricing.
			'pc.eyebrow' => 'Engagements', 'pc.h' => 'Pick how we partner', 'pc.sub' => 'Monthly retainers, no long lock-ins. Scale up or down as your growth demands.', 'pc.mo' => 'OMR / mo',
			'pc1n' => 'Spark', 'pc1d' => 'For early brands finding their footing.', 'pc1f1' => '2 marketing channels', 'pc1f2' => 'Monthly strategy session', 'pc1f3' => 'Monthly performance report', 'pc1b' => 'Choose Spark',
			'pc2n' => 'Growth', 'pc2tag' => 'Most popular', 'pc2d' => 'Full-funnel growth for scaling brands.', 'pc2f1' => 'Up to 4 channels', 'pc2f2' => 'Weekly optimisation', 'pc2f3' => 'Dedicated strategist', 'pc2f4' => 'Bi-weekly creative', 'pc2b' => 'Choose Growth',
			'pc3n' => 'Scale', 'pc3price' => 'Custom', 'pc3d' => 'An embedded senior team for market leaders.', 'pc3f1' => 'Every channel, joined-up', 'pc3f2' => 'Dedicated squad', 'pc3f3' => 'Weekly reporting', 'pc3f4' => 'Priority support', 'pc3b' => 'Talk to us',
			// Contact / CTA + form.
			'cta.eyebrow' => "Let's build", 'cta.h' => 'Tell us the bright idea', 'cta.sub' => "Share your goal and we'll come back within one business day with how we'd approach it.", 'cta.send' => 'Send', 'cta.thanks' => "Thank you — we'll be in touch shortly.",
			'f.name' => 'Full name', 'f.brand' => 'Brand / company', 'f.email' => 'Email', 'f.phone' => 'Phone / WhatsApp', 'f.service' => 'What do you need?', 'f.budget' => 'Monthly budget', 'f.msg' => 'Tell us about your project', 'f.send' => 'Send request', 'f.opt' => 'Select…', 'f.svc1' => 'SEO & organic', 'f.svc2' => 'Paid media', 'f.svc3' => 'Social media', 'f.svc4' => 'Content & branding', 'f.svc5' => 'Web & app', 'f.svc6' => 'Strategy', 'f.b1' => 'Under 500 OMR', 'f.b2' => '500–1,500 OMR', 'f.b3' => '1,500–3,000 OMR', 'f.b4' => '3,000+ OMR', 'f.thanksH' => 'Request received', 'f.thanksSub' => 'Thank you — our team will be in touch within one business day.', 'f.error' => 'Something went wrong. Please try again or email us directly.', 'f.required' => 'Please fill in your name and a way to reach you.',
			// Footer.
			'ft.tag' => '< Lighting the path for your brand >', 'ft.services' => 'Services', 'ft.agency' => 'Agency', 'ft.contact' => 'Contact', 'ft.work' => 'Clients', 'ft.copy' => '© 2026 Bright Starts · Muscat, Oman', 'ft.legal' => 'Terms · Privacy',
			// Generic UI.
			'ui.menu' => 'Menu', 'ui.close' => 'Close', 'ui.readmore' => 'Read more', 'ui.back' => 'Back', 'ui.allposts' => 'All articles', 'ui.search' => 'Search', 'ui.lang' => 'Language',
			// Client case study.
			'cl.work_e' => 'Selected work', 'cl.work_h' => 'The feed we built', 'cl.work_sub' => 'Scroll through the real profiles — content, art direction and grids by Bright Starts.',
			'cs.ig' => 'Visit on Instagram', 'cs.did_e' => 'What we did', 'cs.did_h' => 'The engagement', 'cs.res_e' => 'The results', 'cs.res_h' => 'What changed', 'cs.scroll' => '↕ Scroll inside the window', 'cs.next' => 'Next client', 'cs.start_big' => 'Start your project',
			'ui.ok' => 'OK', 'f.missing' => 'Missing details', 'f.oops' => 'Something went wrong',
			// Comments.
			'co.one' => 'One comment', 'co.many' => '%s comments', 'co.reply' => 'Reply', 'co.moderation' => 'Your comment is awaiting moderation.', 'co.closed' => 'Comments are closed.', 'co.form_title' => 'Leave a reply', 'co.form_title_to' => 'Reply to %s', 'co.submit' => 'Post comment', 'co.notes' => 'Your email address will not be published. Required fields are marked *', 'co.name' => 'Name', 'co.email' => 'Email', 'co.website' => 'Website', 'co.comment' => 'Comment',
			// Service detail page.
			'svc.badge' => 'Service', 'svc.intro_e' => 'Overview', 'svc.intro_h' => 'What this service delivers', 'svc.stats_e' => 'The impact', 'svc.stats_h' => 'Numbers that matter', 'svc.inc_e' => "What's included", 'svc.inc_h' => 'Everything in this service', 'svc.proc_e' => 'How we deliver', 'svc.proc_h' => 'Our process', 'svc.faq_e' => 'FAQ', 'svc.faq_h' => 'Common questions', 'svc.cta_h' => 'Ready to grow?', 'svc.cta_sub' => "Tell us your goal and we'll come back within one business day with how we'd approach it.", 'svc.talk' => 'Discuss your project', 'svc.all' => 'All services', 'svc.other_e' => 'Keep exploring', 'svc.other_h' => 'Other services', 'svc.step' => 'Step',
			// Homepage "our work" scroll section.
			'ow.eyebrow' => 'Clients & case studies', 'ow.h' => 'Brands we took from zero to viral', 'ow.sub' => "A look at the work — the feeds, funnels and campaigns we've built for ambitious brands across Oman and the Gulf.", 'ow.view' => 'View case study', 'ow.all' => 'See all clients',
		),
		'ar' => array(
			'nav.home' => 'الرئيسية', 'nav.services' => 'خدماتنا', 'nav.process' => 'آلية العمل', 'nav.clients' => 'عملاؤنا', 'nav.about' => 'من نحن', 'nav.pricing' => 'الباقات', 'nav.blog' => 'المدوّنة', 'nav.contact' => 'تواصل معنا', 'nav.start' => 'ابدأ مشروعك',
			'hero.tag' => 'تسويق رقمي · عُمان', 'hero.h1a' => 'نُنير الطريق', 'hero.h1b' => 'لعلامتك', 'hero.brand' => 'التجارية.', 'hero.sub' => 'برايت ستارتس وكالة تسويق رقمي مقرّها مسقط للعلامات الطموحة — نرافقك من النمو إلى تطوير الأعمال، ومن الفكرة المضيئة حتى التنفيذ.', 'hero.what' => 'ماذا نقدّم',
			'st.brands' => 'علامة طوّرناها', 'st.gulf' => 'في الخليج', 'st.roas' => 'متوسط العائد',
			'zv.eyebrow' => 'من الصفر إلى الانتشار', 'zv.h' => 'نأخذ العلامة على طول الطريق', 'zv.sub' => 'من الشرارة الأولى إلى علامة لا يتوقف الناس عن مشاركتها — الفكرة والإنتاج والتوزيع تحت سقف واحد.',
			'zv1t' => 'أطلق الفكرة', 'zv1d' => 'التموضع والقصة والفكرة المضيئة التي تميّزك.', 'zv1x' => '< تدقيق · بحث سوق · تحليل الجمهور >', 'zv1a' => 'تدقيق وتموضع العلامة', 'zv1b' => 'بحث الجمهور والمنافسين', 'zv1c' => 'الفكرة الإبداعية الأساسية',
			'zv2t' => 'ابدأ التصوير', 'zv2d' => 'تصوير ومونتاج وتصميم يجعل كل لقطة فاخرة.', 'zv2x' => '< كتابة · تصوير · مونتاج · موشن >', 'zv2a' => 'سيناريوهات وستوري بورد', 'zv2b' => 'تصوير فوتو وفيديو', 'zv2c' => 'مونتاج وموشن وتصميم',
			'zv3t' => 'انطلق', 'zv3d' => 'إطلاق عبر القنوات المناسبة بخطة متناسقة.', 'zv3x' => '< خطة قنوات · نشر · دعم مدفوع >', 'zv3a' => 'خطة القنوات والمحتوى', 'zv3b' => 'نشر منسّق', 'zv3c' => 'إعداد الإعلانات المدفوعة',
			'zv4t' => 'اصنع الزخم', 'zv4d' => 'نحسّن ونضاعف ما ينجح وننمّي الجمهور.', 'zv4x' => '< اختبارات · تحليلات · مجتمع >', 'zv4a' => 'تحسين أسبوعي', 'zv4b' => 'تقارير أداء', 'zv4c' => 'إدارة المجتمع',
			'zv5t' => 'انتشر', 'zv5d' => 'وصول ومشاركات وعلامة يتذكّرها الناس.', 'zv5x' => '< ترندات · صنّاع محتوى · وصول مكتسب >', 'zv5a' => 'محتوى يركب الترند', 'zv5b' => 'شراكات صنّاع المحتوى', 'zv5c' => 'وصول مكتسب ومشاركات',
			'bl.eyebrow' => 'من الاستوديو', 'bl.h' => 'رؤى وقصص', 'bl.h2' => 'مدوّنة برايت ستارتس', 'bl.sub' => 'أدلة عملية وملاحظات إنتاج وقصص نمو من رحلة العلامات من الصفر إلى الانتشار.', 'bl.read' => 'اقرأ المقال', 'bl.all' => 'تصفّح المدوّنة',
			'cl.eyebrow' => 'عملاء مختارون', 'cl.sub' => 'علامات طوّرناها في عُمان والخليج — من العقارات إلى العطور، ومن الأزياء إلى المطاعم الراقية.', 'cl.soon' => 'قريباً', 'cl.soonsub' => 'عميل جديد',
			'sv.eyebrow' => 'ماذا نقدّم', 'sv.h' => 'تسويق متكامل من الألف إلى الياء', 'sv.sub' => 'فريق واحد محترف عبر كل القنوات — لينمو عملك بانسجام لا بترقيع.',
			'sv1t' => 'تحسين محركات البحث', 'sv1d' => 'سيو تقني ومحتوى وبناء مرجعية تتراكم نتائجها شهراً بعد شهر.',
			'sv2t' => 'الإعلانات المدفوعة', 'sv2d' => 'حملات أداء عبر جوجل وميتا وتيك توك — مصمّمة للعائد لا للظهور.',
			'sv3t' => 'وسائل التواصل', 'sv3d' => 'محتوى مستمر ومجتمع وشراكات صنّاع محتوى مناسبة لجمهور الخليج.',
			'sv4t' => 'المحتوى والهوية', 'sv4d' => 'أنظمة علامة وإخراج فني ومحتوى ثنائي اللغة بمظهر وصوت فاخر.',
			'sv5t' => 'تصميم المواقع والتطبيقات', 'sv5d' => 'مواقع وتجارب منتج تركّز على التحويل، نصمّمها ونبنيها بالكامل.',
			'sv6t' => 'الاستراتيجية والاستشارات', 'sv6d' => 'دخول الأسواق والتموضع وخرائط النمو من فريق محترف مندمج معك.',
			'mt.eyebrow' => 'بالأرقام', 'mt.h' => 'نموٌّ يمكن قياسه', 'mt1' => 'أعلى نمو في الإيرادات', 'mt2' => 'علامة طوّرناها', 'mt3' => 'متوسط العائد', 'mt4' => 'بقاء العملاء',
			'pr.eyebrow' => 'من الفكرة إلى التنفيذ', 'pr.h' => 'كيف نعمل',
			'pr1t' => 'نكتشف', 'pr1d' => 'تدقيق وبحث سوق وأهداف. نفهم عملك قبل أن نلمس أي حملة.',
			'pr2t' => 'نخطّط', 'pr2d' => 'خارطة واضحة: القنوات والميزانية والمؤشرات والفكرة المضيئة التي تجمعها.',
			'pr3t' => 'ننفّذ', 'pr3d' => 'تصميم وبناء وإطلاق — إبداع وإعلام وويب، ينجزها فريق محترف واحد.',
			'pr4t' => 'ننمو', 'pr4d' => 'نقيس ونحسّن ونوسّع ما ينجح. تقارير شفافة كل أسبوع.',
			'ab.eyebrow' => 'من نحن', 'ab.h' => 'الفريق وراء برايت ستارتس', 'ab.intro' => 'برايت ستارتس وكالة تسويق رقمي مقرّها مسقط تساعد العلامات الطموحة على النمو — من الاستراتيجية إلى التنفيذ. نحن فريق صغير محترف يتعامل مع علامتك كأنها علامته، نجمع بين تسويق ذكي ومحتوى وتصميم عالي الإتقان.',
			'ab.r1' => 'التسويق الرقمي والإعلان', 'ab.s1' => '«في عالمٍ يصرخ فيه الجميع، نصنع صوتاً يُسمَع.»', 'ab.b1' => 'أنا محمد حسين، مختص في التسويق الرقمي والإعلان. أساعد علامتك على النمو والظهور في الفضاء الرقمي عبر تخطيط حملات إعلانية فعّالة، وإدارة منصات التواصل، وبناء استراتيجية رقمية، وإنتاج محتوى موجّه.',
			'ab.r2' => 'صناعة المحتوى والمونتاج والتصميم', 'ab.s2' => '«لكل علامة قصة؛ ونحن نبثّ فيها الحياة.»', 'ab.b2' => 'أنا محمد علي، مختص في صناعة المحتوى ومونتاج الفيديو والتصوير. عبر إنتاج فيديو عالي الجودة وتصميم جذّاب وسرد إبداعي، أروي قصة علامتك بأكثر الطرق جاذبية وأبقي جمهورك متصلاً.',
			'ab.r3' => 'علم النفس الصناعي والمؤسسي · التسويق العصبي واستراتيجية العلامة', 'ab.s3' => '«حين تنشغل العقول، تصبح العلامات لا تُنسى.»', 'ab.b3' => 'أنا هانية صالحي، أخصائية علم نفس صناعي ومؤسسي متخصصة في التسويق العصبي واستراتيجية العلامة. أساعدك على بناء علامة مؤثرة لا تُنسى عبر تحليل عقل جمهورك وتصميم استراتيجيات ذكية تجعل علامتك تبرز في السوق وتبقى في الأذهان.',
			'mp.eyebrow' => 'موقعنا', 'mp.h' => 'زر استوديونا', 'mp.addr' => 'مسقط، سلطنة عُمان', 'mp.cta' => 'افتح في خرائط جوجل',
			'ts.eyebrow' => 'آراء العملاء', 'ts1q' => 'برايت ستارتس كأنه فريقنا الداخلي — محترف وسريع ومهتم فعلاً بالأرقام.', 'ts1r' => 'مديرة التسويق، أوازيس ليفينغ', 'ts2q' => 'من الفكرة إلى الإطلاق في ستة أسابيع. استراتيجية ذكية وتنفيذ بلا أخطاء.', 'ts2r' => 'المؤسس، ميزان باي',
			'pc.eyebrow' => 'الباقات', 'pc.h' => 'اختر طريقة شراكتنا', 'pc.sub' => 'اشتراك شهري بلا التزام طويل. وسّع أو قلّص حسب احتياج نموّك.', 'pc.mo' => 'ر.ع / شهرياً',
			'pc1n' => 'سبارك', 'pc1d' => 'للعلامات الناشئة التي تبني حضورها.', 'pc1f1' => 'قناتان تسويقيتان', 'pc1f2' => 'جلسة استراتيجية شهرية', 'pc1f3' => 'تقرير أداء شهري', 'pc1b' => 'اختر سبارك',
			'pc2n' => 'نمو', 'pc2tag' => 'الأكثر طلباً', 'pc2d' => 'نمو متكامل للعلامات المتوسّعة.', 'pc2f1' => 'حتى ٤ قنوات', 'pc2f2' => 'تحسين أسبوعي', 'pc2f3' => 'استراتيجي مخصّص', 'pc2f4' => 'إبداع كل أسبوعين', 'pc2b' => 'اختر النمو',
			'pc3n' => 'تطوير', 'pc3price' => 'مخصّص', 'pc3d' => 'فريق محترف مندمج لقادة السوق.', 'pc3f1' => 'كل القنوات بانسجام', 'pc3f2' => 'فريق مخصّص', 'pc3f3' => 'تقارير أسبوعية', 'pc3f4' => 'دعم ذو أولوية', 'pc3b' => 'تحدّث إلينا',
			'cta.eyebrow' => 'لنبدأ', 'cta.h' => 'احكِ لنا الفكرة المضيئة', 'cta.sub' => 'شاركنا هدفك ونعود إليك خلال يوم عمل واحد بطريقة تنفيذنا له.', 'cta.send' => 'إرسال', 'cta.thanks' => 'شكراً لك — سنتواصل معك قريباً.',
			'f.name' => 'الاسم الكامل', 'f.brand' => 'العلامة / الشركة', 'f.email' => 'البريد الإلكتروني', 'f.phone' => 'الهاتف / واتساب', 'f.service' => 'ما الذي تحتاجه؟', 'f.budget' => 'الميزانية الشهرية', 'f.msg' => 'حدّثنا عن مشروعك', 'f.send' => 'إرسال الطلب', 'f.opt' => 'اختر…', 'f.svc1' => 'سيو ونمو عضوي', 'f.svc2' => 'إعلانات مدفوعة', 'f.svc3' => 'وسائل تواصل', 'f.svc4' => 'محتوى وهوية', 'f.svc5' => 'موقع وتطبيق', 'f.svc6' => 'استراتيجية', 'f.b1' => 'أقل من ٥٠٠ ر.ع', 'f.b2' => '٥٠٠–١٥٠٠ ر.ع', 'f.b3' => '١٥٠٠–٣٠٠٠ ر.ع', 'f.b4' => '٣٠٠٠+ ر.ع', 'f.thanksH' => 'تم استلام طلبك', 'f.thanksSub' => 'شكراً لك — سيتواصل فريقنا معك خلال يوم عمل واحد.', 'f.error' => 'حدث خطأ ما. حاول مجدداً أو راسلنا مباشرة.', 'f.required' => 'يرجى إدخال اسمك ووسيلة للتواصل معك.',
			'ft.tag' => '< نُنير الطريق لعلامتك التجارية >', 'ft.services' => 'خدماتنا', 'ft.agency' => 'الوكالة', 'ft.contact' => 'تواصل', 'ft.work' => 'عملاؤنا', 'ft.copy' => '© 2026 برايت ستارتس · مسقط، عُمان', 'ft.legal' => 'الشروط · الخصوصية',
			'ui.menu' => 'القائمة', 'ui.close' => 'إغلاق', 'ui.readmore' => 'اقرأ المزيد', 'ui.back' => 'رجوع', 'ui.allposts' => 'كل المقالات', 'ui.search' => 'بحث', 'ui.lang' => 'اللغة',
			'cl.work_e' => 'أعمال مختارة', 'cl.work_h' => 'الحساب الذي بنيناه', 'cl.work_sub' => 'تصفّح الحسابات الحقيقية — المحتوى والإخراج الفني والشبكة من برايت ستارتس.',
			'cs.ig' => 'زيارة إنستغرام', 'cs.did_e' => 'ماذا فعلنا', 'cs.did_h' => 'نطاق العمل', 'cs.res_e' => 'النتائج', 'cs.res_h' => 'ما الذي تغيّر', 'cs.scroll' => '↕ مرّر داخل النافذة', 'cs.next' => 'العميل التالي', 'cs.start_big' => 'ابدأ مشروعك',
			'ui.ok' => 'حسناً', 'f.missing' => 'معلومات ناقصة', 'f.oops' => 'حدث خطأ',
			// Comments.
			'co.one' => 'تعليق واحد', 'co.many' => '%s تعليقات', 'co.reply' => 'ردّ', 'co.moderation' => 'تعليقك في انتظار المراجعة.', 'co.closed' => 'التعليقات مغلقة.', 'co.form_title' => 'اترك تعليقاً', 'co.form_title_to' => 'الردّ على %s', 'co.submit' => 'أرسل التعليق', 'co.notes' => 'لن يتم نشر بريدك الإلكتروني. الحقول المطلوبة مشار إليها بـ *', 'co.name' => 'الاسم', 'co.email' => 'البريد الإلكتروني', 'co.website' => 'الموقع', 'co.comment' => 'التعليق',
			'svc.badge' => 'خدمة', 'svc.intro_e' => 'نظرة عامة', 'svc.intro_h' => 'ماذا تقدّم هذه الخدمة', 'svc.stats_e' => 'الأثر', 'svc.stats_h' => 'أرقام مهمة', 'svc.inc_e' => 'ما الذي تشمله', 'svc.inc_h' => 'كل ما في هذه الخدمة', 'svc.proc_e' => 'كيف ننفّذ', 'svc.proc_h' => 'آلية عملنا', 'svc.faq_e' => 'الأسئلة الشائعة', 'svc.faq_h' => 'أسئلة متكرّرة', 'svc.cta_h' => 'جاهز للنمو؟', 'svc.cta_sub' => 'أخبرنا بهدفك ونعود إليك خلال يوم عمل واحد بطريقة تنفيذنا له.', 'svc.talk' => 'ناقش مشروعك', 'svc.all' => 'كل الخدمات', 'svc.other_e' => 'واصل الاستكشاف', 'svc.other_h' => 'خدمات أخرى', 'svc.step' => 'خطوة',
			'ow.eyebrow' => 'عملاء ودراسات حالة', 'ow.h' => 'علامات أخذناها من الصفر إلى الانتشار', 'ow.sub' => 'لمحة عن العمل — الحسابات والقمعات والحملات التي بنيناها لعلامات طموحة في عُمان والخليج.', 'ow.view' => 'اطّلع على دراسة الحالة', 'ow.all' => 'كل العملاء',
		),
		'fa' => array(
			'nav.home' => 'خانه', 'nav.services' => 'خدمات', 'nav.process' => 'فرایند', 'nav.clients' => 'مشتریان', 'nav.about' => 'درباره ما', 'nav.pricing' => 'تعرفه‌ها', 'nav.blog' => 'وبلاگ', 'nav.contact' => 'تماس با ما', 'nav.start' => 'شروع پروژه',
			'hero.tag' => 'بازاریابی دیجیتال · عمان', 'hero.h1a' => 'روشن‌کردن مسیر', 'hero.h1b' => 'برای برند', 'hero.brand' => 'شما.', 'hero.sub' => 'برایت استارتس یک آژانس بازاریابی دیجیتال در مسقط برای برندهای جاه‌طلب است — از رشد تا توسعهٔ کسب‌وکار و از ایدهٔ درخشان تا اجرا همراه شماییم.', 'hero.what' => 'چه می‌کنیم', 'hero.start' => 'شروع پروژه',
			'st.brands' => 'برند رشدیافته', 'st.gulf' => 'در خلیج', 'st.roas' => 'میانگین بازده',
			'zv.eyebrow' => 'از صفر تا وایرال', 'zv.h' => 'برند را تا انتها همراهی می‌کنیم', 'zv.sub' => 'از اولین جرقه تا برندی که مردم از به‌اشتراک‌گذاشتنش سیر نمی‌شوند — ایده، تولید و توزیع زیر یک سقف.',
			'zv1t' => 'جرقهٔ ایده', 'zv1d' => 'جایگاه‌سازی، روایت و ایدهٔ درخشانی که شما را متمایز می‌کند.', 'zv1x' => '< بررسی · تحقیق بازار · شناخت مخاطب >', 'zv1a' => 'بررسی و جایگاه‌سازی برند', 'zv1b' => 'تحقیق مخاطب و رقبا', 'zv1c' => 'ایدهٔ خلاقانهٔ اصلی',
			'zv2t' => 'روشن کن دوربین', 'zv2d' => 'فیلم‌برداری، تدوین و طراحی که هر فریم را لوکس می‌کند.', 'zv2x' => '< نگارش · فیلم‌برداری · تدوین · موشن >', 'zv2a' => 'سناریو و استوری‌بورد', 'zv2b' => 'عکاسی و فیلم‌برداری', 'zv2c' => 'تدوین، موشن و طراحی',
			'zv3t' => 'برو روی هوا', 'zv3d' => 'انتشار در کانال‌های درست با یک برنامهٔ هماهنگ.', 'zv3x' => '< برنامهٔ کانال · انتشار · تبلیغ پولی >', 'zv3a' => 'برنامهٔ کانال و محتوا', 'zv3b' => 'انتشار هماهنگ', 'zv3c' => 'راه‌اندازی تبلیغات پولی',
			'zv4t' => 'ساختن شتاب', 'zv4d' => 'بهینه‌سازی، تمرکز بر آنچه جواب می‌دهد و رشد مخاطب.', 'zv4x' => '< تست A/B · تحلیل · جامعه >', 'zv4a' => 'بهینه‌سازی هفتگی', 'zv4b' => 'گزارش عملکرد', 'zv4c' => 'مدیریت جامعه',
			'zv5t' => 'وایرال شو', 'zv5d' => 'دسترسی، اشتراک‌گذاری و برندی که مردم به یاد می‌سپارند.', 'zv5x' => '< ترندها · سازندگان · دسترسی ارگانیک >', 'zv5a' => 'محتوای ترندمحور', 'zv5b' => 'همکاری با سازندگان محتوا', 'zv5c' => 'دسترسی ارگانیک و اشتراک',
			'bl.eyebrow' => 'از استودیو', 'bl.h' => 'بینش‌ها و داستان‌ها', 'bl.h2' => 'وبلاگ برایت استارتس', 'bl.sub' => 'راهنماها، یادداشت‌های تولید و داستان‌های رشد از مسیر برندها از صفر تا وایرال.', 'bl.read' => 'خواندن مقاله', 'bl.all' => 'مشاهدهٔ وبلاگ',
			'cl.eyebrow' => 'مشتریان منتخب', 'cl.sub' => 'برندهایی که در عمان و خلیج رشد دادیم — از املاک تا عطر، از مد تا رستوران‌های لوکس.', 'cl.soon' => 'به‌زودی', 'cl.soonsub' => 'مشتری جدید',
			'sv.eyebrow' => 'چه می‌کنیم', 'sv.h' => 'بازاریابی کامل، سرویس کامل', 'sv.sub' => 'یک تیم ارشد در همهٔ کانال‌ها — تا رشد شما یکپارچه باشد نه وصله‌پینه.',
			'sv1t' => 'سئو و رشد ارگانیک', 'sv1d' => 'سئوی فنی، موتور محتوا و اعتبارسازی که ماه‌به‌ماه انباشته می‌شود.',
			'sv2t' => 'تبلیغات پولی و PPC', 'sv2d' => 'کمپین‌های عملکردی در گوگل، متا و تیک‌تاک — برای بازده نه نمایش.',
			'sv3t' => 'شبکه‌های اجتماعی', 'sv3d' => 'محتوای همیشه‌فعال، جامعه و همکاری سازندگان متناسب با مخاطب خلیج.',
			'sv4t' => 'محتوا و برندینگ', 'sv4d' => 'سیستم برند، مدیریت هنری و محتوای دوزبانه با ظاهر و لحن لوکس.',
			'sv5t' => 'طراحی وب و اپ', 'sv5d' => 'وب‌سایت و تجربهٔ محصول تبدیل‌محور، طراحی و ساخت سرتاسری.',
			'sv6t' => 'استراتژی و مشاوره', 'sv6d' => 'ورود به بازار، جایگاه‌یابی و نقشهٔ رشد از یک تیم ارشد و درگیر.',
			'mt.eyebrow' => 'با اعداد', 'mt.h' => 'رشدی که قابل اندازه‌گیری است', 'mt1' => 'اوج رشد درآمد', 'mt2' => 'برند رشدیافته', 'mt3' => 'میانگین بازده', 'mt4' => 'ماندگاری مشتری',
			'pr.eyebrow' => 'از ایده تا اجرا', 'pr.h' => 'چگونه کار می‌کنیم',
			'pr1t' => 'کشف', 'pr1d' => 'بررسی، تحقیق بازار و اهداف. کسب‌وکارتان را پیش از هر کمپین می‌شناسیم.',
			'pr2t' => 'استراتژی', 'pr2d' => 'نقشهٔ روشن: کانال‌ها، بودجه، شاخص‌ها و ایدهٔ درخشانی که همه را پیوند می‌دهد.',
			'pr3t' => 'اجرا', 'pr3d' => 'طراحی، ساخت و انتشار — خلاقیت، رسانه و وب، توسط یک تیم ارشد.',
			'pr4t' => 'رشد', 'pr4d' => 'اندازه‌گیری، بهینه‌سازی و مقیاس آنچه جواب می‌دهد. گزارش شفاف، هر هفته.',
			'ab.eyebrow' => 'درباره ما', 'ab.h' => 'تیم پشت برایت استارتس', 'ab.intro' => 'برایت استارتس یک آژانس بازاریابی دیجیتال در مسقط است که به برندهای جاه‌طلب کمک می‌کند رشد کنند — از استراتژی تا اجرا. ما تیمی کوچک و حرفه‌ای هستیم که با برند شما مثل برند خودمان رفتار می‌کنیم و بازاریابی هوشمند را با محتوا و طراحی باکیفیت ترکیب می‌کنیم.',
			'ab.r1' => 'بازاریابی دیجیتال و تبلیغات', 'ab.s1' => '«در دنیایی که همه فریاد می‌زنند، صدایی می‌سازیم که شنیده شود.»', 'ab.b1' => 'من محمدحسین هستم، متخصص بازاریابی دیجیتال و تبلیغات. به رشد و دیده‌شدن برند شما در فضای دیجیتال کمک می‌کنم — با برنامه‌ریزی کمپین‌های مؤثر، مدیریت شبکه‌های اجتماعی، ساخت استراتژی آنلاین و تولید محتوای هدفمند.',
			'ab.r2' => 'تولید محتوا، تدوین و طراحی', 'ab.s2' => '«هر برند داستانی دارد؛ ما به آن جان می‌دهیم.»', 'ab.b2' => 'من محمدعلی هستم، متخصص تولید محتوا، تدوین ویدیو و فیلم‌برداری. با ویدیوی باکیفیت، طراحی جذاب و روایت خلاق، داستان برند شما را به جذاب‌ترین شکل تعریف می‌کنم و مخاطب را متصل نگه می‌دارم.',
			'ab.r3' => 'روان‌شناسی صنعتی-سازمانی · نورومارکتینگ و استراتژی برند', 'ab.s3' => '«وقتی ذهن‌ها درگیر شوند، برندها فراموش‌نشدنی می‌شوند.»', 'ab.b3' => 'من هانیه صالحی هستم، روان‌شناس صنعتی-سازمانی متخصص در نورومارکتینگ و استراتژی برند. به شما کمک می‌کنم برندی ماندگار و تأثیرگذار بسازید؛ با تحلیل ذهن مخاطب و طراحی استراتژی‌های هوشمند که برندتان را در بازار متمایز و در ذهن‌ها ماندگار می‌کند.',
			'mp.eyebrow' => 'ما را پیدا کنید', 'mp.h' => 'از استودیوی ما دیدن کنید', 'mp.addr' => 'مسقط، سلطنت عمان', 'mp.cta' => 'باز کردن در گوگل مپ',
			'ts.eyebrow' => 'صدای مشتریان', 'ts1q' => 'برایت استارتس مثل تیم داخلی ماست — حرفه‌ای، سریع و واقعاً درگیر اعداد.', 'ts1r' => 'مدیر بازاریابی، اوازیس لیوینگ', 'ts2q' => 'از ایده تا اجرا در شش هفته. استراتژی دقیق و اجرای بی‌نقص.', 'ts2r' => 'بنیان‌گذار، میزان پی',
			'pc.eyebrow' => 'همکاری‌ها', 'pc.h' => 'نحوهٔ همکاری را انتخاب کنید', 'pc.sub' => 'قرارداد ماهانه، بدون قفل طولانی. متناسب با رشد شما کم یا زیاد می‌شود.', 'pc.mo' => 'ر.ع / ماهانه',
			'pc1n' => 'اسپارک', 'pc1d' => 'برای برندهای نوپا که در حال یافتن جای پای خود هستند.', 'pc1f1' => '۲ کانال بازاریابی', 'pc1f2' => 'جلسهٔ استراتژی ماهانه', 'pc1f3' => 'گزارش عملکرد ماهانه', 'pc1b' => 'انتخاب اسپارک',
			'pc2n' => 'رشد', 'pc2tag' => 'محبوب‌ترین', 'pc2d' => 'رشد کامل برای برندهای در حال توسعه.', 'pc2f1' => 'تا ۴ کانال', 'pc2f2' => 'بهینه‌سازی هفتگی', 'pc2f3' => 'استراتژیست اختصاصی', 'pc2f4' => 'خلاقیت دوهفته‌ای', 'pc2b' => 'انتخاب رشد',
			'pc3n' => 'توسعه', 'pc3price' => 'سفارشی', 'pc3d' => 'تیم ارشد یکپارچه برای رهبران بازار.', 'pc3f1' => 'همهٔ کانال‌ها، یکپارچه', 'pc3f2' => 'تیم اختصاصی', 'pc3f3' => 'گزارش هفتگی', 'pc3f4' => 'پشتیبانی اولویت‌دار', 'pc3b' => 'با ما صحبت کنید',
			'cta.eyebrow' => 'بیایید بسازیم', 'cta.h' => 'ایدهٔ درخشان را به ما بگویید', 'cta.sub' => 'هدف‌تان را با ما در میان بگذارید؛ ظرف یک روز کاری با نحوهٔ اجرای ما برمی‌گردیم.', 'cta.send' => 'ارسال', 'cta.thanks' => 'ممنون — به‌زودی با شما تماس می‌گیریم.',
			'f.name' => 'نام کامل', 'f.brand' => 'برند / شرکت', 'f.email' => 'ایمیل', 'f.phone' => 'تلفن / واتساپ', 'f.service' => 'به چه چیزی نیاز دارید؟', 'f.budget' => 'بودجهٔ ماهانه', 'f.msg' => 'دربارهٔ پروژه‌تان بگویید', 'f.send' => 'ارسال درخواست', 'f.opt' => 'انتخاب…', 'f.svc1' => 'سئو و ارگانیک', 'f.svc2' => 'تبلیغات پولی', 'f.svc3' => 'شبکه‌های اجتماعی', 'f.svc4' => 'محتوا و برندینگ', 'f.svc5' => 'وب و اپ', 'f.svc6' => 'استراتژی', 'f.b1' => 'زیر ۵۰۰ ر.ع', 'f.b2' => '۵۰۰ تا ۱۵۰۰ ر.ع', 'f.b3' => '۱۵۰۰ تا ۳۰۰۰ ر.ع', 'f.b4' => '۳۰۰۰+ ر.ع', 'f.thanksH' => 'درخواست دریافت شد', 'f.thanksSub' => 'ممنون — تیم ما ظرف یک روز کاری با شما تماس می‌گیرد.', 'f.error' => 'مشکلی پیش آمد. دوباره تلاش کنید یا مستقیم ایمیل بزنید.', 'f.required' => 'لطفاً نام و یک راه ارتباطی وارد کنید.',
			'ft.tag' => '< روشن‌کردن مسیر برای برند شما >', 'ft.services' => 'خدمات', 'ft.agency' => 'آژانس', 'ft.contact' => 'تماس', 'ft.work' => 'مشتریان', 'ft.copy' => '© ۲۰۲۶ برایت استارتس · مسقط، عمان', 'ft.legal' => 'قوانین · حریم خصوصی',
			'ui.menu' => 'منو', 'ui.close' => 'بستن', 'ui.readmore' => 'بیشتر بخوانید', 'ui.back' => 'بازگشت', 'ui.allposts' => 'همهٔ مقالات', 'ui.search' => 'جستجو', 'ui.lang' => 'زبان',
			'cl.work_e' => 'کارهای منتخب', 'cl.work_h' => 'حسابی که ساختیم', 'cl.work_sub' => 'در حساب‌های واقعی پیمایش کنید — محتوا، مدیریت هنری و شبکه از برایت استارتس.',
			'cs.ig' => 'دیدن در اینستاگرام', 'cs.did_e' => 'چه کردیم', 'cs.did_h' => 'محدودهٔ کار', 'cs.res_e' => 'نتایج', 'cs.res_h' => 'چه تغییر کرد', 'cs.scroll' => '↕ داخل پنجره پیمایش کنید', 'cs.next' => 'مشتری بعدی', 'cs.start_big' => 'پروژه‌ات را شروع کن',
			'ui.ok' => 'باشه', 'f.missing' => 'اطلاعات ناقص', 'f.oops' => 'خطایی رخ داد',
			// Comments.
			'co.one' => 'یک دیدگاه', 'co.many' => '%s دیدگاه', 'co.reply' => 'پاسخ', 'co.moderation' => 'دیدگاه شما در انتظار بررسی است.', 'co.closed' => 'دیدگاه‌ها بسته است.', 'co.form_title' => 'دیدگاه خود را بنویسید', 'co.form_title_to' => 'پاسخ به %s', 'co.submit' => 'ثبت دیدگاه', 'co.notes' => 'نشانی ایمیل شما منتشر نخواهد شد. بخش‌های موردنیاز با * مشخص شده‌اند', 'co.name' => 'نام', 'co.email' => 'ایمیل', 'co.website' => 'وب‌سایت', 'co.comment' => 'دیدگاه',
			'svc.badge' => 'خدمت', 'svc.intro_e' => 'مرور کلی', 'svc.intro_h' => 'این خدمت چه ارائه می‌دهد', 'svc.stats_e' => 'تأثیر', 'svc.stats_h' => 'اعدادی که مهم‌اند', 'svc.inc_e' => 'چه چیزهایی شامل می‌شود', 'svc.inc_h' => 'هر آنچه در این خدمت هست', 'svc.proc_e' => 'چگونه اجرا می‌کنیم', 'svc.proc_h' => 'فرایند ما', 'svc.faq_e' => 'سؤالات متداول', 'svc.faq_h' => 'پرسش‌های پرتکرار', 'svc.cta_h' => 'آمادهٔ رشد هستید؟', 'svc.cta_sub' => 'هدف‌تان را بگویید؛ ظرف یک روز کاری با نحوهٔ اجرای ما برمی‌گردیم.', 'svc.talk' => 'دربارهٔ پروژه صحبت کنیم', 'svc.all' => 'همهٔ خدمات', 'svc.other_e' => 'ادامهٔ کاوش', 'svc.other_h' => 'خدمات دیگر', 'svc.step' => 'گام',
			'ow.eyebrow' => 'مشتریان و مطالعات موردی', 'ow.h' => 'برندهایی که از صفر تا وایرال بردیم', 'ow.sub' => 'نگاهی به کارها — فیدها، قیف‌ها و کمپین‌هایی که برای برندهای جاه‌طلب در عمان و خلیج ساختیم.', 'ow.view' => 'دیدن مطالعهٔ موردی', 'ow.all' => 'همهٔ مشتریان',
		),
	);

	return $dict;
}
