<?php
if (!defined('ABSPATH')) exit;
class MMV2_Highlights extends \Elementor\Widget_Base {
 public function get_name(){return 'mmv2_highlights';}
 public function get_title(){return 'Mbili V2 · Featured highlights';}
 public function get_icon(){return 'eicon-slides';}
 public function get_categories(){return ['general'];}
 protected function register_controls(){
  $this->start_controls_section('content',['label'=>'Featured work']);
  $this->add_control('count',['label'=>'Maximum slides','type'=>\Elementor\Controls_Manager::NUMBER,'min'=>1,'max'=>8,'default'=>6]);
  $this->add_control('fallback_title',['label'=>'Empty-state heading','type'=>\Elementor\Controls_Manager::TEXT,'default'=>'The work behind the thinking.']);
  $this->add_control('fallback_copy',['label'=>'Empty-state description','type'=>\Elementor\Controls_Manager::TEXTAREA,'default'=>'Explore the organizations, business challenges, and ideas that have shaped my professional journey.']);
  $this->end_controls_section();
  $this->start_controls_section('style',['label'=>'Presentation','tab'=>\Elementor\Controls_Manager::TAB_STYLE]);
  $this->add_responsive_control('slide_height',['label'=>'Slide height','type'=>\Elementor\Controls_Manager::SLIDER,'range'=>['px'=>['min'=>320,'max'=>1100]],'selectors'=>['{{WRAPPER}} .mmv2-slide, {{WRAPPER}} .mmv2-highlights'=>'min-height:{{SIZE}}{{UNIT}};']]);
  $this->add_group_control(\Elementor\Group_Control_Typography::get_type(),['name'=>'heading','selector'=>'{{WRAPPER}} .mmv2-slide h2']);
  $this->end_controls_section();
 }
 protected function render(){
  if(!function_exists('mbili_media'))return;
  $s=$this->get_settings_for_display();
  $q=new WP_Query(['post_type'=>'case_study','post_status'=>'publish','posts_per_page'=>max(1,min(8,absint($s['count']))),'no_found_rows'=>true,'meta_query'=>[['key'=>'_mm_featured','value'=>'1']]]);
  $uid=wp_unique_id('mmv2-slide-');$titles=[];$index=0;
  echo '<section class="mmv2-highlights" aria-label="Selected work highlights" data-mmv2-slider>';
  while($q->have_posts()){
   $q->the_post();$title=get_the_title();$titles[]=$title;
   echo '<article class="mmv2-slide" data-mmv2-slide id="'.esc_attr($uid.$index).'"><div class="mmv2-slide-photo">'.mbili_media(get_post_thumbnail_id(),'mbili-hero').'</div><div class="mmv2-slide-content"><p class="slide-label">Highlights</p><h2><a href="'.esc_url(get_permalink()).'">'.esc_html($title).'</a></h2>';
   if(get_the_excerpt())echo '<p>'.esc_html(wp_trim_words(get_the_excerpt(),28)).'</p>';
   echo '<a class="button" href="'.esc_url(get_permalink()).'">View case study</a></div></article>';$index++;
  }
  wp_reset_postdata();
  if(!$index)echo '<article class="mmv2-slide mmv2-empty-slide"><div class="mmv2-slide-content"><p class="slide-label">Selected work</p><h2>'.esc_html($s['fallback_title']).'</h2><p>'.esc_html($s['fallback_copy']).'</p><a class="button" href="'.esc_url(home_url('/work/')).'">Explore work</a></div></article>';
  if($index>1){
   echo '<div class="mmv2-slider-controls" data-mmv2-controls hidden><button type="button" data-mmv2-prev aria-label="Previous project">←</button>';
   foreach($titles as $i=>$title)echo '<button type="button" class="slide-dot" data-mmv2-dot="'.esc_attr($i).'" aria-controls="'.esc_attr($uid.$i).'" aria-label="'.esc_attr('Show '.$title).'"></button>';
   echo '<button type="button" data-mmv2-next aria-label="Next project">→</button><span class="mmv2-slide-status" data-mmv2-status aria-live="polite"></span></div>';
  }
  echo '</section>';
 }
}
class MMV2_Pending_Work extends \Elementor\Widget_Base {
 public function get_name(){return 'mmv2_pending_work';}
 public function get_title(){return 'Mbili V2 · Pending work titles';}
 public function get_icon(){return 'eicon-post-list';}
 public function get_categories(){return ['general'];}
 protected function register_controls(){
  $this->start_controls_section('content',['label'=>'Pending organization titles']);
  $this->add_control('names',['label'=>'One organization per line','type'=>\Elementor\Controls_Manager::TEXTAREA,'default'=>"Prime Paints\nLocath Tracks\nJimmy Countrywide\nTopgred\nAfrican Paints\nFingen"]);
  $this->end_controls_section();
 }
 protected function render(){
  // Never read or expose draft content. These names are explicit public display settings.
  $published=new WP_Query(['post_type'=>'case_study','post_status'=>'publish','posts_per_page'=>1,'fields'=>'ids','no_found_rows'=>true]);
  if($published->have_posts())return;
  $s=$this->get_settings_for_display();$names=array_filter(array_map('trim',explode("\n",$s['names'])));
  if(!$names)return;
  echo '<div class="mmv2-pending" aria-label="Case studies in preparation">';
  foreach(array_slice($names,0,30)as $name)echo '<article class="editorial-card"><p>Case study in preparation</p><h2>'.esc_html($name).'</h2></article>';
  echo '</div>';
 }
}
class MMV2_Socials extends \Elementor\Widget_Base {
 public function get_name(){return 'mmv2_socials';}
 public function get_title(){return 'Mbili V2 · Verified social links';}
 public function get_icon(){return 'eicon-social-icons';}
 public function get_categories(){return ['general'];}
 protected function render(){
  $links=[];foreach(['linkedin'=>'LinkedIn','instagram'=>'Instagram']as $key=>$label){$url=get_theme_mod('mbili_'.$key);if($url)$links[]='<a href="'.esc_url($url).'">'.esc_html($label).'</a>';}
  if($links)echo '<nav class="mmv2-socials" aria-label="Social profiles">'.implode('',$links).'</nav>';
  elseif(\Elementor\Plugin::instance()->editor->is_edit_mode())echo '<p class="mmv2-small">Add verified social URLs under Appearance → Customize → Mbili identity & social links. This note is hidden on the public site.</p>';
 }
}
