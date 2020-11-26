<?php
if ( !function_exists( ' unnamed_theme_setup' ) ) :
	function  unnamed_theme_setup()
	{
		register_nav_menus(
			[
				'primary' => 'Основной',
			]
		);
	}
endif;
add_action( 'after_setup_theme', 'unnamed_theme_setup' );


function unnamed_theme_enqueues()
{
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' );

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );

}
add_action( 'wp_enqueue_scripts', 'unnamed_theme_enqueues' );

//убираем все лишние классы у пунктом меню
add_filter( 'nav_menu_css_class', '__return_empty_array' );

//добавляем классы бутстрапа
add_filter( 'nav_menu_css_class', 'add_bootstrap_classes_to_li', 10, 4 );
function add_bootstrap_classes_to_li( $classes, $item ) {
    $classes[] = 'nav-item'; 
    if ( $item->current ){
        $classes[] = 'active';
    }
	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'add_bootstrap_classes_to_a', 10, 3 );
function add_bootstrap_classes_to_a( $atts, $item, $args ) {
    $atts['class'] = 'nav-link';
    return $atts;
}

//создаем кастомные посты
add_action('init', 'video_post_type');
function video_post_type(){
	register_post_type('video', array(
		'labels'             => array(
			'name'               => 'Видео', 
			'singular_name'      => 'Видео', 
			'add_new'            => 'Добавить видео',
			'add_new_item'       => 'Добавить новое видео',
			'edit_item'          => 'Редактировать видео',
			'new_item'           => 'Новое видео',
			'view_item'          => 'Посмотреть видео',
			'search_items'       => 'Найти видео',
			'not_found'          => 'Видео не найдено',
			'not_found_in_trash' => 'В корзине видео не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Видео'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'         => array('category', 'post_tag'),
		'supports'           => array('title','editor','author','thumbnail','excerpt','comments', 'custom-fields')
	) );
}

//создаем числовые поля для видео
add_action('add_meta_boxes', 'video_order_fields', 1);
function video_order_fields() {
	add_meta_box( 'order_field', 'обязательно поле order', 'video_order_fields_func', 'video', 'normal', 'high'  );
}

function video_order_fields_func( $post ){
    ?>
    <p>
        <label>
            <input type="number" name="video_order" required value="<?php echo get_post_meta($post->ID, 'order_field', 1); ?>" style="width:100%" />
            Обязательно поле order
        </label>
    </p>

    <input type="hidden" name="video_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

add_action('save_post', 'video_order_fields_save', 1);
function video_order_fields_save( $post_id ) {

	if (
    empty( $_POST['video_order'] )
     || ! wp_verify_nonce( $_POST['video_fields_nonce'], __FILE__ )
     || wp_is_post_autosave( $post_id )
     || wp_is_post_revision( $post_id )
    )
    return false;

    $number_value = $_POST['video_order'];
    $key = 'order_field';
    update_post_meta( $post_id, $key, $number_value );
    return $post_id;
}



class VideoQueryClass{
    public static function init(){
        add_action('pre_get_posts', array(__CLASS__, 'order_by_num'));
    }
    public static function order_by_num($query){
        if ( in_array ( $query->get('post_type'), array('video') ) ) {
            $query->set( 'meta_key', 'order_field' );
            $query->set( 'orderby', 'meta_value_num' );
            $query->set( 'order', 'ASC' );
            return;
        }
    }
}

VideoQueryClass::init();



add_filter( 'excerpt_length', function(){
	return 20;
});