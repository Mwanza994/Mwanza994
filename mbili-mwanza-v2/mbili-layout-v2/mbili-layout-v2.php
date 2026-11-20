<?php
/**
 * Plugin Name: Mbili Layout V2
 * Description: Screenshot-directed native Elementor layouts and featured-work interactions. Requires Elementor and Mbili Platform.
 * Version: 2.0.0
 * Requires at least: 6.6
 * Requires PHP: 8.1
 * Requires Plugins: elementor
 * License: GPL-2.0-or-later
 */
if (!defined('ABSPATH')) exit;
define('MMV2_PATH', plugin_dir_path(__FILE__));
define('MMV2_URL', plugin_dir_url(__FILE__));
require_once __DIR__.'/layouts.php';
add_action('wp_enqueue_scripts',function(){
    wp_enqueue_script('mmv2-interactions',MMV2_URL.'assets/interactions.js',[],'2.0.0',['strategy'=>'defer','in_footer'=>true]);
});
add_shortcode('mmv2_year',function(){return esc_html(wp_date('Y'));});
add_action('elementor/widgets/register',function($manager){
    require_once __DIR__.'/widgets.php';
    $manager->register(new MMV2_Highlights());
    $manager->register(new MMV2_Pending_Work());
    $manager->register(new MMV2_Socials());
});
function mmv2_dependencies(){
    return did_action('elementor/loaded') && function_exists('mbili_data') && function_exists('mbili_listing');
}
function mmv2_resolve_tokens($value){
    if(is_array($value)){foreach($value as $k=>$v)$value[$k]=mmv2_resolve_tokens($v);return $value;}
    if(!is_string($value))return $value;
    $map=[
        '__MM_HOME__'=>untrailingslashit(home_url('/')),
        '__MMV2_ABOUT__'=>home_url('/about-v2/'),
        '__MMV2_CONTACT__'=>home_url('/contact-v2/'),
        '__MMV2_WRITING__'=>home_url('/writing-v2/'),
        '__MMV2_PORTRAIT__'=>MMV2_URL.'assets/portrait-placeholder.svg',
        '__MMV2_RESOURCES__'=>MMV2_URL.'assets/resources-placeholder.svg',
    ];
    return strtr($value,$map);
}
function mmv2_create_document($key,$doc,$type){
    $found=get_posts(['post_type'=>$type,'post_status'=>['publish','draft','private'],'numberposts'=>1,'meta_key'=>'_mmv2_key','meta_value'=>$key]);
    if($found)return $found[0]->ID;
    $slug=$type==='page'?$key.'-v2':'mbili-v2-'.$key;
    if(get_page_by_path($slug,OBJECT,$type))return new WP_Error('mmv2_conflict','A document already uses the reserved slug: '.$slug.'. Rename it or contact the site administrator; no content was overwritten.');
    $id=wp_insert_post(['post_type'=>$type,'post_status'=>$type==='page'?'draft':'publish','post_title'=>($type==='page'?$doc['title']:'Mbili V2 · '.$doc['title']),'post_name'=>$slug,'post_content'=>$doc['fallback']??''],true);
    if(is_wp_error($id))return $id;
    update_post_meta($id,'_mmv2_key',$key);
    update_post_meta($id,'_elementor_edit_mode','builder');
    update_post_meta($id,'_elementor_template_type',$type==='page'?'wp-page':'section');
    update_post_meta($id,'_elementor_version',defined('ELEMENTOR_VERSION')?ELEMENTOR_VERSION:'3.33.0');
    update_post_meta($id,'_elementor_page_settings',['hide_title'=>'yes','page_layout'=>'default']);
    update_post_meta($id,'_elementor_data',wp_slash(wp_json_encode(mmv2_resolve_tokens($doc['content']))));
    if($type==='elementor_library')wp_set_object_terms($id,'section','elementor_library_type');
    return $id;
}
function mmv2_setup_redirect($message){
    set_transient('mmv2_notice_'.get_current_user_id(),$message,120);
    wp_safe_redirect(admin_url('tools.php?page=mmv2-setup'));exit;
}
add_action('admin_menu',function(){
    add_management_page('Mbili Layout V2','Mbili Layout V2','manage_options','mmv2-setup','mmv2_setup');
});
function mmv2_setup(){
    if(!current_user_can('manage_options'))return;
    $ids=get_option('mmv2_ids',[]);
    echo '<div class="wrap"><h1>Mbili Layout V2</h1><p>Charcoal, olive, coral, and full-width editorial layouts based on the supplied screenshots. Requires the original Mbili Editorial theme, Mbili Platform plugin, and Elementor Free.</p>';
    $notice=get_transient('mmv2_notice_'.get_current_user_id());
    if($notice){echo '<div class="notice notice-info"><p>'.esc_html($notice).'</p></div>';delete_transient('mmv2_notice_'.get_current_user_id());}
    if(!mmv2_dependencies())echo '<div class="notice notice-error"><p>Activate Elementor and Mbili Platform before creating layouts.</p></div>';
    echo '<h2>1. Create preview layouts</h2><p>This creates new draft pages and saved Elementor templates. It does not replace your existing pages, articles, projects, resources, or template assignments. Re-running creation preserves existing V2 edits.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
    wp_nonce_field('mmv2_create');
    echo '<input type="hidden" name="action" value="mmv2_create"><button class="button button-primary">Create V2 preview layouts</button></form>';
    if(!empty($ids['pages'])){
        echo '<h3>Preview / edit the new pages</h3><ul>';
        foreach($ids['pages']as $key=>$id)echo '<li>'.esc_html(ucfirst($key)).' — <a href="'.esc_url(admin_url('post.php?post='.$id.'&action=elementor')).'">Edit with Elementor</a> · <a href="'.esc_url(get_preview_post_link($id)).'">Preview</a></li>';
        echo '</ul>';
    }
    echo '<h2>2. Activate after staging review</h2><p>First activate the Mbili Reference Layout child theme. This action publishes the new V2 pages, switches the front/posts pages and shared template slots, and assigns a new Primary menu. Existing page bodies are not edited. Back up your complete database and wp-content first. Replace image placeholders, review privacy, and confirm mail delivery before production use.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
    wp_nonce_field('mmv2_activate');
    echo '<input type="hidden" name="action" value="mmv2_activate"><p><label><input type="checkbox" name="confirm" value="1" required> I have a backup, have reviewed the V2 layouts, and authorize these page/template/menu changes.</label></p><button class="button">Activate V2 page and template assignments</button></form>';
    echo '<h2>3. Restore earlier assignments</h2><p>Restores the Reading settings, template slots, and Primary menu captured before V2 activation. The added V2 pages remain in WordPress. Switch back to the parent theme to restore its styling.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
    wp_nonce_field('mmv2_restore');
    echo '<input type="hidden" name="action" value="mmv2_restore"><button class="button">Restore saved assignments</button></form></div>';
}
add_action('admin_post_mmv2_create',function(){
    if(!current_user_can('manage_options'))wp_die('Permission denied.');
    check_admin_referer('mmv2_create');
    if(!mmv2_dependencies())wp_die('Activate Elementor and Mbili Platform first.');
    $data=mmv2_layouts();$ids=get_option('mmv2_ids',[]);$ids=wp_parse_args($ids,['pages'=>[],'templates'=>[]]);$errors=[];
    foreach(['pages'=>'page','templates'=>'elementor_library']as $group=>$type){
        foreach($data[$group]as $key=>$doc){
            $id=mmv2_create_document($key,$doc,$type);
            if(is_wp_error($id)){$errors[]=$id->get_error_message();continue;}
            $ids[$group][$key]=$id;
        }
    }
    update_option('mmv2_ids',$ids);
    if(class_exists('Elementor\\Plugin'))\Elementor\Plugin::instance()->files_manager->clear_cache();
    mmv2_setup_redirect($errors?implode(' ',$errors):'V2 preview layouts created. Existing live content and assignments were preserved.');
});
add_action('admin_post_mmv2_activate',function(){
    if(!current_user_can('manage_options'))wp_die('Permission denied.');
    check_admin_referer('mmv2_activate');
    if(empty($_POST['confirm']))wp_die('Confirm the backup and assignment changes.');
    if(!mmv2_dependencies())wp_die('Required plugins are unavailable.');
    $ids=get_option('mmv2_ids',[]);
    if(empty($ids['pages']['home'])||empty($ids['pages']['writing']))wp_die('Create all V2 preview layouts first.');
    $expected=mmv2_layouts();
    foreach(['pages','templates']as $group){foreach(array_keys($expected[$group])as $key){if(empty($ids[$group][$key]))wp_die('Some V2 documents are missing. Re-run layout creation.');}}
    foreach($ids['pages']as $id){if(!get_post($id))wp_die('A V2 page is missing. Re-run layout creation.');}
    foreach($ids['templates']as $id){if(!get_post($id))wp_die('A V2 template is missing. Re-run layout creation.');}
    $keys=['show_on_front','page_on_front','page_for_posts'];
    foreach(array_keys($ids['templates'])as $slot)$keys[]='mbili_template_'.$slot;
    if(!get_option('mmv2_before')){
        $before=['options'=>[],'menus'=>get_theme_mod('nav_menu_locations',[])];
        foreach($keys as $key)$before['options'][$key]=get_option($key,false);
        add_option('mmv2_before',$before,'',false);
    }
    foreach($ids['pages']as $id)wp_update_post(['ID'=>$id,'post_status'=>'publish']);
    foreach($ids['templates']as $slot=>$id)update_option('mbili_template_'.$slot,$id);
    update_option('show_on_front','page');update_option('page_on_front',$ids['pages']['home']);update_option('page_for_posts',$ids['pages']['writing']);
    $menu=wp_get_nav_menu_object('Mbili V2 Primary');
    $menu_id=$menu?$menu->term_id:wp_create_nav_menu('Mbili V2 Primary');
    if(!is_wp_error($menu_id)){
        if(!wp_get_nav_menu_items($menu_id)){
            foreach(['Work'=>home_url('/work/'),'About'=>home_url('/about-v2/'),'Writing'=>home_url('/writing-v2/'),'Resources'=>home_url('/resources/'),'Contact'=>home_url('/contact-v2/')]as $label=>$url)
                wp_update_nav_menu_item($menu_id,0,['menu-item-title'=>$label,'menu-item-url'=>$url,'menu-item-status'=>'publish','menu-item-type'=>'custom']);
        }
        $locations=get_theme_mod('nav_menu_locations',[]);$locations['primary']=$menu_id;set_theme_mod('nav_menu_locations',$locations);
    }
    flush_rewrite_rules();
    \Elementor\Plugin::instance()->files_manager->clear_cache();
    mmv2_setup_redirect('V2 assignments activated. Review all pages, forms, links, and image placeholders before production launch.');
});
add_action('admin_post_mmv2_restore',function(){
    if(!current_user_can('manage_options'))wp_die('Permission denied.');
    check_admin_referer('mmv2_restore');
    $before=get_option('mmv2_before');
    if(!$before)mmv2_setup_redirect('No prior assignment snapshot exists.');
    foreach($before['options']as $key=>$value){if($value===false)delete_option($key);else update_option($key,$value);}
    set_theme_mod('nav_menu_locations',$before['menus']);flush_rewrite_rules();
    mmv2_setup_redirect('Earlier page/template/menu assignments restored. Added V2 documents remain available for editing. Switch to the parent theme to restore the previous styling.');
});
// Forms on the new Contact page need fresh security tokens as well.
add_action('template_redirect',function(){
    if(is_page('contact-v2')){
        if(!defined('DONOTCACHEPAGE'))define('DONOTCACHEPAGE',true);
        nocache_headers();
    }
});
