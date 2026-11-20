<?php
if (!defined('ABSPATH')) exit;
function mmv2_id(){static $i=0;return str_pad(dechex(++$i),7,'0',STR_PAD_LEFT);}
function mmv2_w($type,$settings){return ['id'=>mmv2_id(),'elType'=>'widget','widgetType'=>$type,'settings'=>$settings,'elements'=>[]];}
function mmv2_c($children,$classes='mmv2-section',$direction='column',$extra=[]){
 return ['id'=>mmv2_id(),'elType'=>'container','isInner'=>false,'settings'=>array_merge(['content_width'=>'full','flex_direction'=>$direction,'css_classes'=>$classes,'flex_gap'=>['column'=>'24','row'=>'24','unit'=>'px','isLinked'=>true]],$extra),'elements'=>$children];
}
function mmv2_h($text,$tag='h2',$classes='mmv2-title'){return mmv2_w('heading',['title'=>$text,'header_size'=>$tag,'_css_classes'=>$classes]);}
function mmv2_t($html,$classes='mmv2-copy'){return mmv2_w('text-editor',['editor'=>$html,'_css_classes'=>$classes]);}
function mmv2_b($label,$url,$classes=''){return mmv2_w('button',['text'=>$label,'link'=>['url'=>$url],'_css_classes'=>$classes]);}
function mmv2_e($text){return mmv2_h($text,'p','mmv2-label');}
function mmv2_row($children){return mmv2_c($children,'mmv2-row','row');}
function mmv2_col($children){return mmv2_c($children,'mmv2-col');}
function mmv2_field($key,$tag='h2',$classes=''){return mmv2_w('mbili_field',['field'=>$key,'tag'=>$tag,'_css_classes'=>$classes]);}
function mmv2_image($classes){return mmv2_w('image',['image'=>['url'=>'__MMV2_PORTRAIT__','id'=>''],'image_size'=>'full','_css_classes'=>$classes]);}
function mmv2_media($source='featured',$eager=''){return mmv2_w('mbili_media',['source'=>$source,'eager'=>$eager,'_css_classes'=>'clip-reveal']);}
function mmv2_list($type,$extra=[]){return mmv2_w('mbili_listing',array_merge(['type'=>$type,'count'=>6,'columns'=>'2','columns_mobile'=>'1','stagger'=>''],$extra));}
function mmv2_doc($title,$content,$fallback=''){return ['title'=>$title,'content'=>$content,'fallback'=>$fallback];}
function mmv2_layouts(){
 $work='__MM_HOME__/work/';$resources='__MM_HOME__/resources/';$about='__MMV2_ABOUT__';$contact='__MMV2_CONTACT__';$writing='__MMV2_WRITING__';
 $home=[
  mmv2_c([
   mmv2_t('<p>Hello, I’m<br>Mbili Mwanza</p>','mmv2-greeting'),
   mmv2_h('Entrepreneur.<br>Strategist.<br>Builder.','h1','mmv2-hero-title reveal'),
   mmv2_image('mmv2-portrait'),
   mmv2_c([mmv2_b('↗',$about),mmv2_t('<p>Get to know the person<br>behind the work.</p>','mmv2-small')],'mmv2-hero-note')
  ],'mmv2-section mmv2-hero'),
  mmv2_c([
   mmv2_e('What I do'),
   mmv2_c([mmv2_t('<p>I build businesses, develop systems, and share what I learn along the way.</p><p>I’m an entrepreneur, strategist, and operator working across industries — building, improving, and running businesses.</p>'),mmv2_c([mmv2_b('View work',$work),mmv2_b('My story',$about,'mmv2-text-link')],'mmv2-actions','row')],'mmv2-intro'),
   mmv2_row([
    mmv2_col([mmv2_h('I<br>Build<br>Businesses.','h2','mmv2-statement reveal')]),
    mmv2_col([
     mmv2_c([mmv2_e('01 / Entrepreneurship'),mmv2_h('Build businesses','h3',''),mmv2_t('<p>Start, improve, and operate businesses. Stay close to the work that takes an idea into the real world.</p>')],'mmv2-panel reveal'),
     mmv2_c([mmv2_e('02 / Strategy & operations'),mmv2_h('Develop strategy & systems','h3',''),mmv2_t('<p>Connect business goals to practical decisions, clearer processes, and better ways of working.</p>')],'mmv2-panel reveal'),
     mmv2_c([mmv2_e('03 / Knowledge'),mmv2_h('Share what I learn','h3',''),mmv2_t('<p>Write about entrepreneurship, sales, marketing, operations, and the lessons found in the work.</p>')],'mmv2-panel reveal')
    ])
   ])
  ],'mmv2-section mmv2-olive'),
  mmv2_c([mmv2_w('mmv2_highlights',['count'=>6,'fallback_title'=>'The work behind the thinking.','fallback_copy'=>'Explore the organizations, business challenges, and ideas that have shaped my professional journey.'])],'mmv2-wide'),
  mmv2_c([
   mmv2_e('My journey'),
   mmv2_row([mmv2_col([mmv2_h('A different path.<br>A clear direction.')]),mmv2_col([mmv2_t('<p>It began with Fifth Dimension Business Solutions in 2016, while I was attending medical school. A change of course in 2019 led into sales, marketing, and operational leadership.</p><p>Each chapter has shaped how I think about building and running businesses.</p>'),mmv2_b('Read my story',$about)])]),
   mmv2_row([
    mmv2_col([mmv2_e('2016'),mmv2_h('The first business.','h3',''),mmv2_t('<p>Founded Fifth Dimension Business Solutions while attending medical school.</p>','mmv2-small')]),
    mmv2_col([mmv2_e('2019'),mmv2_h('A change of course.','h3',''),mmv2_t('<p>Left medical school due to financial constraints. Subsequently joined Sanlam in insurance sales.</p>','mmv2-small')]),
    mmv2_col([mmv2_e('2022'),mmv2_h('A new venture.','h3',''),mmv2_t('<p>Started Rubikon Ventures.</p>','mmv2-small')])
   ])
  ],'mmv2-section mmv2-black'),
  mmv2_c([
   mmv2_e('Current'),
   mmv2_c([mmv2_t('<p>Today, my focus is Rubikon Ventures and its subsidiary, Nutryvyt Supplements &amp; Nutrition.</p>'),mmv2_c([mmv2_b('About my journey',$about),mmv2_b('Let’s connect',$contact)],'mmv2-actions','row')],'mmv2-intro'),
   mmv2_row([
    mmv2_c([mmv2_e('Founded 2022'),mmv2_h('Rubikon Ventures','h3',''),mmv2_t('<p>The venture I started in 2022, and a central focus of my work today.</p>','mmv2-small')],'mmv2-col mmv2-venture'),
    mmv2_c([mmv2_e('A Rubikon Ventures subsidiary'),mmv2_h('Nutryvyt','h3',''),mmv2_t('<p>Supplements &amp; Nutrition. Part of the next chapter I’m building through Rubikon Ventures.</p>','mmv2-small')],'mmv2-col mmv2-venture')
   ]),
   mmv2_image('mmv2-current-portrait clip-reveal')
  ],'mmv2-section mmv2-current'),
  mmv2_c([mmv2_e('Writing'),mmv2_h('Written by Mbili Mwanza'),mmv2_t('<p>Perspectives from building businesses, developing systems, and learning through the work.</p>'),mmv2_list('post',['count'=>3]),mmv2_b('View all articles',$writing)]),
  mmv2_c([mmv2_e('Resources'),mmv2_h('Useful things.<br>Shared thoughtfully.'),mmv2_t('<p>Original tools and selected resources for people building businesses and better ways of working.</p>'),mmv2_c([mmv2_list('mm_resource',['count'=>2])],'mmv2-resource-grid'),mmv2_b('Explore resources',$resources)]),
  mmv2_c([mmv2_e('Occasional dispatches'),mmv2_h('Keep learning.<br>Keep building.'),mmv2_t('<p>A space for future notes on business, strategy, and the work in between.</p>'),mmv2_t('<p>Newsletter subscriptions are not open yet. No email address is collected here.</p>','mmv2-newsletter')],'mmv2-section mmv2-black'),
  mmv2_c([mmv2_t('<p>I’m open to conversations about strategic consulting, suitable projects, business partnerships, media, and speaking.</p><p>Tell me what you have in mind.</p>'),mmv2_b('Let’s talk',$contact)],'mmv2-section mmv2-band')
 ];
 $chapters=[
  ['2016','The first business.','I founded Fifth Dimension Business Solutions in 2016 while attending medical school.'],
  ['2019','A change of course.','I left medical school in 2019 due to financial constraints. Subsequently, I joined Sanlam in insurance sales.'],
  ['Sales & marketing','Learning to move a business forward.','I later joined Perfect Infotech International, progressing to Head of Marketing and Sales within one year.'],
  ['Operations','Taking responsibility for the whole.','I joined DNK and became General Manager within months.'],
  ['2022','Building something of my own.','I started Rubikon Ventures in 2022.'],
  ['2023','Inside the work of operations.','In 2023, I joined Prime Paints as Operations Manager.'],
  ['Today','The next chapter.','My current focus is Rubikon Ventures and its subsidiary, Nutryvyt Supplements & Nutrition.']
 ];
 $bio=[
  mmv2_c([mmv2_t('<p>Hello, I’m Mbili Mwanza</p>','mmv2-greeting'),mmv2_h('Entrepreneur.<br>Strategist.<br>Builder.','h1','mmv2-hero-title'),mmv2_image('mmv2-portrait')],'mmv2-section mmv2-hero'),
  mmv2_c([mmv2_t('<p>My professional journey has moved through entrepreneurship, insurance sales, marketing, and operational leadership. The thread running through it is a desire to build and improve businesses.</p>')],'mmv2-section mmv2-olive')
 ];
 $fallback='';
 foreach($chapters as $chapter){
  [$year,$title,$body]=$chapter;
  $bio[]=mmv2_c([mmv2_e($year),mmv2_row([mmv2_col([mmv2_h($title)]),mmv2_col([mmv2_t('<p>'.esc_html($body).'</p>')])])],'mmv2-section mmv2-timeline reveal');
  $fallback.='<h2>'.esc_html($title).'</h2><p>'.esc_html($body).'</p>';
 }
 $bio[]=mmv2_c([mmv2_h('The next conversation<br>could start here.'),mmv2_b('Get in touch',$contact)],'mmv2-section mmv2-band');
 $writing_layout=[
  mmv2_c([mmv2_e('Written by Mbili Mwanza'),mmv2_h('Writing.','h1','mmv2-title mmv2-light'),mmv2_t('<p>Ideas, lessons, and perspectives from business and the work of building.</p>')],'mmv2-section mmv2-archive-intro'),
  mmv2_c([mmv2_h('Recent writing','h2','mmv2-resource-heading'),mmv2_list('post',['count'=>9,'filter'=>'yes','paginate'=>'yes'])])
 ];
 $pages=[
  'home'=>mmv2_doc('Home',$home,'<p>I build businesses, develop systems, and share what I learn along the way.</p>'),
  'about'=>mmv2_doc('About',$bio,$fallback),
  'writing'=>mmv2_doc('Writing',$writing_layout),
  'contact'=>mmv2_doc('Contact',[
   mmv2_c([mmv2_e('Contact'),mmv2_h('Let’s connect.','h1','mmv2-title mmv2-light'),
    mmv2_row([
     mmv2_col([mmv2_t('<p>For strategic consulting, suitable projects, collaborations, media, and speaking inquiries.</p>'),mmv2_t('<p><strong>Consulting</strong><br>Strategy, systems, and operational challenges.</p><p><strong>Collaborations</strong><br>Suitable projects and business partnerships.</p><p><strong>Media &amp; speaking</strong><br>Interviews, discussions, and speaking inquiries.</p>','mmv2-small')]),
     mmv2_col([mmv2_w('mbili_contact',['button_label'=>'Send inquiry','intro'=>'Tell me what you are building, where you need support, and what a successful collaboration would look like.'])])
    ])
   ])
  ],'[mbili_contact]')
 ];
 $templates=[
  'header'=>mmv2_doc('Shared Header',[mmv2_c([
   mmv2_w('heading',['title'=>'Mbili Mwanza','header_size'=>'p','link'=>['url'=>'__MM_HOME__/'],'_css_classes'=>'wordmark']),
   mmv2_w('mbili_nav',['menu_label'=>'Menu'])
  ],'mmv2-header','row')]),
  'footer'=>mmv2_doc('Shared Footer',[
   mmv2_c([
    mmv2_row([
     mmv2_col([mmv2_h('Connect with me','h2','mmv2-footer-title'),mmv2_t('<p>For business and speaking inquiries</p>','mmv2-small'),mmv2_b('Start a conversation',$contact,'mmv2-text-link')]),
     mmv2_col([mmv2_h('Explore','h2','mmv2-footer-title'),mmv2_c([mmv2_b('Work',$work,'mmv2-text-link'),mmv2_b('Writing',$writing,'mmv2-text-link'),mmv2_b('Resources',$resources,'mmv2-text-link')],'mmv2-actions','row'),mmv2_w('mmv2_socials',[])])
    ]),
    mmv2_t('<p>© [mmv2_year] Mbili Mwanza. All rights reserved.</p>','mmv2-small'),
    mmv2_b('Privacy policy','__MM_HOME__/privacy-policy/','mmv2-text-link')
   ])
  ]),
  'work'=>mmv2_doc('Work Archive',[
   mmv2_c([mmv2_h('Portfolio','h1','mmv2-title mmv2-light'),mmv2_t('<p>A selection of organizations and projects from my professional journey.</p>')],'mmv2-section mmv2-archive-intro'),
   mmv2_c([mmv2_w('mmv2_pending_work',['names'=>"Prime Paints\nLocath Tracks\nJimmy Countrywide\nTopgred\nAfrican Paints\nFingen"]),mmv2_list('case_study',['count'=>12,'filter'=>'yes','paginate'=>'yes'])],'mmv2-work-list')
  ]),
  'resources'=>mmv2_doc('Resource Archive',[
   mmv2_c([mmv2_h('Resources','h1','mmv2-title mmv2-light'),mmv2_t('<p>Original tools and selected resources for building businesses, improving systems, and sharing knowledge.</p>')],'mmv2-section mmv2-resource-hero','column',['background_background'=>'classic','background_image'=>['url'=>'__MMV2_RESOURCES__','id'=>'']]),
   mmv2_c([mmv2_h('Products & resources','h2','mmv2-resource-heading'),mmv2_c([mmv2_list('mm_resource',['count'=>10,'filter'=>'yes','paginate'=>'yes'])],'mmv2-resource-grid')]),
   mmv2_c([mmv2_h('More to explore','h2','mmv2-resource-heading'),mmv2_h('Written by Mbili Mwanza','h3','mmv2-resource-heading'),mmv2_t('<p>Perspectives on entrepreneurship, strategy, operations, and the work of building.</p>'),mmv2_b('Read the writing',$writing),mmv2_h('More coming soon','h3','mmv2-resource-heading'),mmv2_t('<p>The library will grow as original tools and recommendations are ready to share.</p>','mmv2-small')])
  ]),
  'writing'=>mmv2_doc('Writing Archive',$writing_layout),
  'case_study'=>mmv2_doc('Single Case Study',[
   mmv2_c([mmv2_e('Selected work'),mmv2_field('post_title','h1'),mmv2_media('logo'),mmv2_media('featured','yes'),mmv2_field('metadata'),mmv2_field('summary'),mmv2_field('media_before_problem'),mmv2_field('problem'),mmv2_field('media_after_problem'),mmv2_field('solution'),mmv2_field('deliverables'),mmv2_field('implementation'),mmv2_field('media_after_solution'),mmv2_field('results'),mmv2_field('kpis'),mmv2_field('testimonial'),mmv2_field('evidence'),mmv2_field('media_after_results'),mmv2_field('external_url')]),
   mmv2_c([mmv2_h('Related work.'),mmv2_c([mmv2_list('case_study',['count'=>2,'related'=>'yes'])],'mmv2-work-list')]),
   mmv2_c([mmv2_t('<p>Have a business challenge you’d like to discuss?</p>'),mmv2_b('Let’s talk',$contact)],'mmv2-section mmv2-band')
  ]),
  'single_post'=>mmv2_doc('Single Article',[
   mmv2_c([mmv2_field('post_meta'),mmv2_field('post_title','h1'),mmv2_media('featured','yes'),mmv2_field('post_content','p','mmv2-reading'),mmv2_field('author_bio')]),
   mmv2_c([mmv2_h('More writing.'),mmv2_list('post',['count'=>3,'related'=>'yes'])])
  ]),
  'resource'=>mmv2_doc('Single Resource',[mmv2_c([mmv2_e('Resource library'),mmv2_field('post_title','h1'),mmv2_media('featured','yes'),mmv2_field('post_content','p','mmv2-reading'),mmv2_field('resource_details')])]),
  '404'=>mmv2_doc('404',[mmv2_c([mmv2_e('404 / A small detour'),mmv2_h('Page not found.','h1','mmv2-title'),mmv2_t('<p>Let’s get you back to something useful.</p>'),mmv2_b('Back home','__MM_HOME__/')])])
 ];
 return ['pages'=>$pages,'templates'=>$templates];
}
