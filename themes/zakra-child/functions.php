<?php

function replace_placeholder_search_text( $form ) { 
	 $pattern = '/(placeholder=)".*"/';
	 $replacement = "$1" . "'Search airdrops'";
         $form = preg_replace($pattern, $replacement, $form); 
         return $form;
}

 add_filter( 'get_search_form', 'replace_placeholder_search_text' );

// function post_published_notification($query) {
// 	if ( !(defined( 'REST_REQUEST' ) && REST_REQUEST )) { 
// 		$id = get_the_ID();
// 		$my_post = array(
//   'post_title'    => rwmb_meta('title_red', $id),
//   'post_content'  => rwmb_meta('link_red', $id),
//   'post_status'   => 'publish',
//   'post_type' => "links",
// );
	
// 	wp_insert_post( $my_post );
// 	}

// }

// add_action( 'publish_post', 'post_published_notification', 10 );





function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

    add_filter('rwmb_meta_boxes', 'your_prefix_register_readmore');

    function your_prefix_register_readmore($meta_boxes)
    {
        $prefix = '';

        $meta_boxes[] = [
            'title'           => 'Read more block',
            'id'              => 'readmore-block',
            'description'     => 'Place to edit content',
            'type'            => 'block',
            'icon'            => 'awards',
            'teaamegory'        => 'layout',
            'context'         => 'side',
            'render_callback' => 'my_readmore',
            'supports' => [
                'align' => [ 'left', 'center', 'right', 'full' ],
            ],
            'fields' => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Title', 'online-generator' ),
                    'id'   => $prefix . 'title',
                ],
                [
                    'type' => 'wysiwyg',
                    'name' => esc_html__( 'Text', 'online-generator' ),
                    'id'   => $prefix . 'wys_text',
                ],
            ],
        ];

        return $meta_boxes;
    }

    function my_readmore( $attributes, $is_preview = false, $post_id = null ) {
        // Fields data.
        if ( empty( $attributes['data'] ) ) {
            return;
        }
        // Unique HTML ID if available.
        $id = 'id' . ( $attributes['id'] ?? '' );
        if ( ! empty( $attributes['anchor'] ) ) {
            $id = $attributes['anchor'];
        }
        // Custom CSS class name.
        $class = 'acord ' . ( $attributes['className'] ?? '' );
        if ( ! empty( $attributes['align'] ) ) {
            $class .= " align{$attributes['align']}";
        }

        ?>
        <div class="readmore_cover tg-container">
            <h2 class="faq_title">
                <?php echo mb_get_block_field( 'title' ); ?>
            </h2>
            <div class="readmore_text">
                <?php echo mb_get_block_field( 'wys_text' ); ?>
            </div>
        </div>
        <style>
            body .readmore_text p,
            body .readmore_text{
                font-weight: 400;
            }
            .wpsm-hide,
            .wpsm-show{
                text-align: center !important;
            }
            .bef{
                position: relative;
            }
            .wpsm-show.wpsm-content-hide{
                display: none;
            }
            .wpsm-show{
                z-index: 99;
                position: relative;
            }
            .bef:before{
                content: '';
                background: linear-gradient(180deg, rgba(217, 217, 217, 0) 0%, #ECF0F3 28.62%);
                width: 100%;
                position: absolute;
                height: 93px;
                bottom: -40px;
                display: block;
            }
            .readmore_cover{
                overflow: hidden;
            }
        </style>
        <script>
            jQuery(document).ready((function ($) {
                $(".show_more").addClass("bef");
                $( ".wpsm-show" ).click(function() {
                    $("div").removeClass("bef");
                });
                $( ".wpsm-content-hide" ).click(function() {
                    $(".show_more").addClass("bef");
                });
            }));
        </script>
    <?php }


    add_filter('rwmb_meta_boxes', 'your_prefix_register_meta_boxes');

    function your_prefix_register_meta_boxes($meta_boxes)
    {

        $query = new WP_Query( array( 'post_type' => 'links', 'posts_per_page'  => 100 ) );
        $posts12 = $query->posts;
        foreach($posts12 as $post) {
            $options[$post->ID] =  $post->post_title;
        }

        $prefix = '';

        $meta_boxes[] = [
            'title' => esc_html__('Information', 'online-generator'),
            'id' => 'untitled',
            'post_types' => ['post'],
            'context' => 'normal',
            'fields' => [
				[
                    'type' => 'text',
                    'name' => esc_html__('Start date (Change text?)', 'online-generator'),
                    'id' => $prefix . 'start-text',
                ],
				 [
                    'type' => 'text',
                    'name' => esc_html__('Start date value', 'online-generator'),
                    'id' => $prefix . 'start',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('End date (Change text?)', 'online-generator'),
                    'id' => $prefix . 'end-text',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('End date', 'online-generator'),
                    'id' => $prefix . 'end',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('Prize type (Change text?)', 'online-generator'),
                    'id' => $prefix . 'prize-text',
                ], 
                [
                    'type' => 'text',
                    'name' => esc_html__('Prize type', 'online-generator'),
                    'id' => $prefix . 'prize',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('Distribution date (Change text?)', 'online-generator'),
                    'id' => $prefix . 'distribution-text',
                ],
				 [
                    'type' => 'text',
                    'name' => esc_html__('Distribution date', 'online-generator'),
                    'id' => $prefix . 'distribution',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('Steps title', 'online-generator'),
                    'id' => $prefix . 'steps_title',
                ],
                [
                    'type' => 'wysiwyg',
                    'name' => esc_html__('Steps text', 'online-generator'),
                    'id' => $prefix . 'steps',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('About title', 'online-generator'),
                    'id' => $prefix . 'about_tit',
                ],
				[
                    'type' => 'wysiwyg',
                    'name' => esc_html__('About text', 'online-generator'),
                    'id' => $prefix . 'about',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__('Button text (if you want unique)', 'online-generator'),
                    'id' => $prefix . 'but_text',
                ],
// 				[
//                     'type'    => 'text',
//                     'name'    => esc_html__( 'Title for redirection', 'online-generator' ),
//                     'id'      => $prefix . 'title_red',
//                 ],
// 				[
//                     'type'    => 'text',
//                     'name'    => esc_html__( 'Link for redirection', 'online-generator' ),
//                     'id'      => $prefix . 'link_red',
//                 ],
                [
                    'type'    => 'text',
                    'name'    => esc_html__( 'Link on button', 'online-generator' ),
                    'id'      => $prefix . 'link',
                    'options' => $options,
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__('Social icon title', 'online-generator'),
                    'id' => $prefix . 'soc_title',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__('Facebook url', 'online-generator'),
                    'id' => $prefix . 'facebook',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__('Instagram url', 'online-generator'),
                    'id' => $prefix . 'instagram',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__('Twitter url', 'online-generator'),
                    'id' => $prefix . 'twitter',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('Telegram url', 'online-generator'),
                    'id' => $prefix . 'telegram',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('Discord url', 'online-generator'),
                    'id' => $prefix . 'discord',
                ],
				[
                    'type' => 'text',
                    'name' => esc_html__('Site url', 'online-generator'),
                    'id' => $prefix . 'site',
                ],
            ],
        ];

        return $meta_boxes;
    }


    function templateslots_init(){
        register_taxonomy('reward', array('post'), array(
            'label'                 => 'Reward type', // определяется параметром $labels->name
            'labels'                => array(

                'menu_name'         => 'Reward type',
            ),
            'description'           => '', // описание таксономии
            'public'                => true,
            'show_in_rest' => true,
            'show_in_nav_menus'     => true, // равен аргументу public
            'show_ui'               => true, // равен аргументу public
            'show_tagcloud'         => false, // равен аргументу show_ui

            'hierarchical'          => true,
            'rewrite'               => array('slug'=>'reward', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
            'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        ) );
    }

    add_action( 'init', 'templateslots_init' );

    add_action('customize_register', 'zw_customizer');
    /*
     * Register Our Customizer Stuff Here
     */
    function zw_customizer($wp_customize)
    {
        // Create custom panel.
        $wp_customize->add_panel('zamvald', array(
            'priority' => 500,
            'theme_supports' => '',
            'title' => __('Theme settings', 'sober'),
        ));
        // Add Footer Text
        // Add section.
        $wp_customize->add_section('custom_zw_text', array(
            'title' => __('Fields', 'sober'),
            'panel' => 'zamvald',
            'priority' => 10
        ));


        // Add setting

        $wp_customize->add_setting('section_id_ins', array(
            'default' => __('', 'sober'),
            'sanitize_callback' => 'sanitize_text'
        ));

        $wp_customize->add_setting('section_id_date', array(
            'default' => __('', 'sober'),
            'sanitize_callback' => 'sanitize_text'
        ));
		$wp_customize->add_setting('start_section_id_date', array(
            'default' => __('', 'sober'),
            'sanitize_callback' => 'sanitize_text'
        ));

        $wp_customize->add_setting('section_id_prize', array(
            'default' => __('', 'sober'),
            'sanitize_callback' => 'sanitize_text'
        ));
		$wp_customize->add_setting('section_id_distribution', array(
            'default' => __('', 'sober'),
            'sanitize_callback' => 'sanitize_text'
        ));
		
		$wp_customize->add_setting('btn_in_drop', array(
            'default' => __('', 'sober'),
            'sanitize_callback' => 'sanitize_text'
        ));



        // Add control

        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'section_id_ins',
                array(
                    'label' => __('Text to go single post', 'genesischild'),
                    'section' => 'custom_zw_text',
                    'settings' => 'section_id_ins',
                    'type' => 'text'
                )
            )
        );
		
		$wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'start_section_id_date',
                array(
                    'label' => __('Start Date field name', 'genesischild'),
                    'section' => 'custom_zw_text',
                    'settings' => 'start_section_id_date',
                    'type' => 'text'
                )
            )
        );

        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'section_id_date',
                array(
                    'label' => __('End Date field name', 'genesischild'),
                    'section' => 'custom_zw_text',
                    'settings' => 'section_id_date',
                    'type' => 'text'
                )
            )
        );
		

        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'section_id_distribution',
                array(
                    'label' => __('Distribution field name', 'genesischild'),
                    'section' => 'custom_zw_text',
                    'settings' => 'section_id_distribution',
                    'type' => 'text'
                )
            )
        );
		
		$wp_customize->add_control(new WP_Customize_Control(
                $wp_customize,
                'btn_in_drop',
                array(
                    'label' => __('Button field name', 'genesischild'),
                    'section' => 'custom_zw_text',
                    'settings' => 'btn_in_drop',
                    'type' => 'text'
                )
            )
        );



        // Sanitize text
        function sanitize_text($text)
        {
            return sanitize_text_field($text);
        }
    }


    add_filter('rwmb_meta_boxes', 'your_prefix_register_tab');

    function your_prefix_register_tab($meta_boxes)
    {
        $tags = get_tags();

        foreach ( $tags as $tag ) {
            $options[$tag->term_taxonomy_id] =  $tag->name;
        }

        $prefix = '';

        $meta_boxes[] = [
            'title'           => 'Tabs',
            'id'              => 'tab-block',
            'description'     => 'Place to edit content',
            'type'            => 'block',
            'icon'            => 'awards',
            'teaamegory'        => 'layout',
            'context'         => 'side',
            'render_callback' => 'my_tab',
            'supports' => [
                'align' => [ 'left', 'center', 'right', 'full' ],
            ],
            'fields' => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Title for mobile (slider)', 'online-generator' ),
                    'id'   => $prefix . 'title',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Title for mobile (tabs)', 'online-generator' ),
                    'id'   => $prefix . 'title_tabs',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Title column name', 'online-generator' ),
                    'id'   => $prefix . 'title_name',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Rewards column name', 'online-generator' ),
                    'id'   => $prefix . 'rewards',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Category column name', 'online-generator' ),
                    'id'   => $prefix . 'category',
                ],
				[
                    'type' => 'group',
                    'id'      => $prefix . 'tags',
                    'clone'   => true,
                    'collapsible'   => true,
                    'save_state' => true,
                    'sort_clone' => true,
                    'group_title'   => "Tag {#}",
                    'fields' => [
                        [
                            'type' => 'select',
                            'name' => esc_html__( 'Choose your tag', 'online-generator' ),
                            'id'   => $prefix . 'choose_tag',
							'options' => $options,
                        ],
                    ],
                ],
            ],
        ];

        return $meta_boxes;
    }

    function my_tab( $attributes, $is_preview = false, $post_id = null ) {
        // Fields data.
        if ( empty( $attributes['data'] ) ) {
            return;
        }
        // Unique HTML ID if available.
        $id = 'id' . ( $attributes['id'] ?? '' );
        if ( ! empty( $attributes['anchor'] ) ) {
            $id = $attributes['anchor'];
        }
        // Custom CSS class name.
        $class = 'acord ' . ( $attributes['className'] ?? '' );
        if ( ! empty( $attributes['align'] ) ) {
            $class .= " align{$attributes['align']}";
        }
        $tags_ids = mb_get_block_field( 'tags' );
        $i=0;
        $t=0;
        ?>
        <div class="tab_cover">
            <div class="tabs_block standart-m-120" id="strategies">
                <h2 class="mobile_title hide_desc">
                    <?php echo mb_get_block_field( 'title' ); ?>
                </h2>
                <div id="tabContainer" class="tab-container desctop">
                    <div class="for_ul_width tg-container">
                        <div class="swiper filter_swiper">
                            <ul class="tab-menu mobile_tab_list swiper-wrapper">
                                <?php
		$ids=[];
		foreach ($tags_ids as $value){
			$ids[] = $value["choose_tag"];
		}
                                    $tags = get_terms( array( 'taxonomy' => 'post_tag', 'orderby' => 'include', 'include' => $ids  ) );
                                    foreach( $tags as $tag ){
                                        $i++;
                                        ?>
                                        <li class="swiper-slide tab-item <?php if ($i == 1){?> active <?php } else {}?>">
                                            <button class="btn-tab" data-tab-target="tab<?php echo $i; ?>">
                                                <?php
                                                if (function_exists('z_taxonomy_image_url')) {?>
                                                <img height="38px" src="<?php echo z_taxonomy_image_url($tag->term_taxonomy_id); ?> " alt="Provider <?php echo get_term( $tag->term_taxonomy_id )->name; ?>">
                                                <?php } ?>
                                                <?php echo $tag->name . ' '; ?>
                                            </button>
                                        </li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <div class="tab-prev">
                                <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 26.82L6.29703 15L18 3.18L14.8515 -2.75252e-07L1.06646e-06 15L14.8515 30L18 26.82Z" fill="#101011"/>
                                </svg>
                            </div>
                            <div class="tab-next">
                                <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 3.18L11.703 15L0 26.82L3.14851 30L18 15L3.14851 0L0 3.18Z" fill="#101011"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h2 class="mobile_title hide_desc">
                        <?php echo mb_get_block_field( 'title_tabs' ); ?>
                    </h2>
                    <div class="top_tab_panel_content tg-container">
                        <div class="first_column">
                        </div>
                        <div class="second_column">
                            <?php echo mb_get_block_field( 'title_name' ); ?>
                        </div>
                        <div class="third_column">
                            <?php echo mb_get_block_field( 'rewards' ); ?>
                        </div>
                        <div class="fourth_column">
                            <?php echo mb_get_block_field( 'category' ); ?>
                        </div>
                    </div>
                    <div class="tab_content tg-container">
                        <?php foreach ($ids as $tags_id): $t++; 
													$args = array(
														'posts_per_page' => 100,
														'post_type'      => "post",
														'tag_id'      => $tags_id,
													);
													$query = new WP_Query( $args );
												?>
												<article class="tab-contents tg-container <?= $t == 1 ? 'active':''?>" data-tab-id="tab<?= $t; ?>">
                        
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            'use strict';

            /**
             * 탭
             * @param {string} containerId 탭 컨테이너 ID명
             * @param {string} btnSelector 컨테이너 하위의 탭 버튼 선택자
             */
            function setTab(containerId, btnSelector) {
                const tabContainer = document.getElementById(containerId);
                const btnTab       = tabContainer.querySelectorAll(btnSelector);
                const activeClass  = 'active';

                const removeActiveClass = target => target.classList.remove(activeClass);
                const addActiveClass    = target => target.classList.add(activeClass);

                function resetActiveTab() {
                    const tabItem     = tabContainer.querySelectorAll('.tab-item');
                    const tabContents = tabContainer.querySelectorAll('.tab-contents');

                    tabItem.forEach(item => removeActiveClass(item));
                    tabContents.forEach(content => removeActiveClass(content));
                }

                function setActiveTab(btn) {
                    const tabTarget      = btn.dataset.tabTarget;
                    const targetItem     = btn.closest('.tab-item');
                    const targetContents = tabContainer.querySelector(`[data-tab-id="${tabTarget}"]`);

                    addActiveClass(targetItem);
                    addActiveClass(targetContents);
                }

                function clickHandler(e) {
                    resetActiveTab();
                    setActiveTab(this);
                }

                btnTab.forEach(btn => btn.addEventListener('click', clickHandler));
            }

            const tabContainerId = 'tabContainer';
            const tabBtnSelector = '.btn-tab';

            setTab(tabContainerId, tabBtnSelector);

        </script>
    <?php
    }


    add_filter('rwmb_meta_boxes', 'your_prefix_register_faq');

    function your_prefix_register_faq($meta_boxes)
    {
        $prefix = '';

        $meta_boxes[] = [
            'title'           => 'Faq',
            'id'              => 'faq-block',
            'description'     => 'Place to edit content',
            'type'            => 'block',
            'icon'            => 'awards',
            'teaamegory'        => 'layout',
            'context'         => 'side',
            'render_callback' => 'my_faq',
            'supports' => [
                'align' => [ 'left', 'center', 'right', 'full' ],
            ],
            'fields' => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Title', 'online-generator' ),
                    'id'   => $prefix . 'title',
                ],
                [
                    'type' => 'group',
                    'id' => 'lines',
                    'clone'   => true,
                    'collapsible'   => true,
                    'save_state' => true,
                    'sort_clone' => true,
                    'group_title'   => "Accordion {#}",
                    'fields' => [
                        [
                            'type' => 'text',
                            'name' => esc_html__( 'Title', 'online-generator' ),
                            'id'   => $prefix . 'item_title',
                        ],
                        [
                            'type' => 'textarea',
                            'name' => esc_html__( 'Text', 'online-generator' ),
                            'id'   => $prefix . 'item_text',
                        ],
                    ],
                ],
            ],
        ];

        return $meta_boxes;
    }

    function my_faq( $attributes, $is_preview = false, $post_id = null ) {
        // Fields data.
        if ( empty( $attributes['data'] ) ) {
            return;
        }
        // Unique HTML ID if available.
        $id = 'id' . ( $attributes['id'] ?? '' );
        if ( ! empty( $attributes['anchor'] ) ) {
            $id = $attributes['anchor'];
        }
        // Custom CSS class name.
        $class = 'acord ' . ( $attributes['className'] ?? '' );
        if ( ! empty( $attributes['align'] ) ) {
            $class .= " align{$attributes['align']}";
        }
        $values = mb_get_block_field( 'lines' );
        $j = 0;
        $i = 0;
        ?>
        <div class="faq_cover">
            <div class="faq_block tg-container">
                <div class="faq_content">
                    <h2 class="faq_title">
                        <?php echo mb_get_block_field( 'title' ); ?>
                    </h2>
                    <div class="faq_accordions">
                        <div class="first_faq_column">
                        <?php foreach ($values as $value): $j++;
                                if ($j % 2 != 0): $idac =  uniqid(); ?>
                                <div class="status wp-block-pb-accordion-item c-accordion__item js-accordion-item" data-initially-open="<?= $j==1 ? 'true':''?>" data-auto-close="true"   data-scroll="false" data-scroll-offset="0">
                                    <div id="at-<?= $idac; ?>" class="status-title c-accordion__title js-accordion-controller" role="button" tabindex="0" aria-controls="<?= $idac; ?>" aria-expanded="false">
                                        <h5 class="km-title"><?= $value["item_title"]; ?></h5>
                                    </div>
                                    <div id="ac-<?= $idac; ?>" class="c-accordion__content" style="<?= $j==1 ? 'display: block' : 'display: none'?>" hidden="hidden">
                                        <?= $value["item_text"]; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
														<?php endforeach; ?>
                        </div>
                        <div class="second_faq_column">
                            <?php
                                foreach ($values as $value){
                                    $i++;
                                    if ($i % 2 == 0){
                                        $idac =  uniqid();
                                        ?>
                                        <div class="status wp-block-pb-accordion-item c-accordion__item js-accordion-item" data-initially-open="<?php if ($j==1){?>true<?}?>" data-auto-close="true"   data-scroll="false" data-scroll-offset="0">
                                            <div id="at-<?php echo $idac; ?>" class="status-title c-accordion__title js-accordion-controller" role="button" tabindex="0" aria-controls="<?php echo $idac; ?>" aria-expanded="false">
                                                <h5 class="km-title"><?php echo $value["item_title"]; ?></h5>
                                            </div>
                                            <div id="ac-<?php echo $idac; ?>" class="c-accordion__content" style="<?php if ($j==1){?>display: block;<?} else {?> display: none; <?php } ?>" hidden="hidden">
                                                <?php echo $value["item_text"]; ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            @media screen and (max-width: 768px){
                body .faq_accordions{
                    flex-direction: column;
                    gap: 10px;
                }
                body div .c-accordion__title:after{
                    width: 10px;
                    background: url("/wp-content/uploads/2023/01/mobile_arrow.svg");
                    right: 25px;
                }
                body .status-title{
                    padding-left: 16px;
                    padding-right: 50px;
                }
                body .c-accordion__content{
                    padding: 16px;
                    padding-top: 0;
                }
            }
            .faq_accordions{
                display: flex;
                gap: 20px;
            }
            .faq_accordions> div{
                flex-basis: 50%;
            }
            .status-title{
                padding: 12px 25px;
                padding-right: 60px;
            }
            .wp-block-pb-accordion-item{
                background: #FFFFFF;
                box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.15);
                border-radius: 7px;
            }
            body .is-open>.c-accordion__title:after{
                content: '';
                transform: rotate(180deg);
                top: calc(50% - 3px);
            }
            body .c-accordion__title:after{
                right: 35px;
                content: '';
                background: url("/wp-content/uploads/2023/01/close_accordion.svg");
                width: 17px;
                height: 6px;
            }
            .c-accordion__content{
                font-weight: 400;
                padding: 25px;
                padding-top: 0;
                padding-bottom: 20px;
            }
            .km-title{
                margin-bottom: 0;
            }
            .faq_accordions div .wp-block-pb-accordion-item:not(:last-child){
                margin-bottom: 10px;
            }
        </style>
    <?php }

    add_filter('rwmb_meta_boxes', 'your_prefix_register_banner');

    function your_prefix_register_banner($meta_boxes)
    {
        $prefix = '';

        $meta_boxes[] = [
            'title'           => 'Banner',
            'id'              => 'banner-block',
            'description'     => 'Place to edit content',
            'type'            => 'block',
            'icon'            => 'awards',
            'teaamegory'        => 'layout',
            'context'         => 'side',
            'render_callback' => 'my_banner',
            'supports' => [
                'align' => [ 'left', 'center', 'right', 'full' ],
            ],
            'fields' => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Title', 'online-generator' ),
                    'id'   => $prefix . 'title',
                ],
                [
                    'type' => 'textarea',
                    'name' => esc_html__( 'Text', 'online-generator' ),
                    'id'   => $prefix . 'text',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Background image', 'online-generator' ),
                    'id'   => $prefix . 'back_image',
                ],
            ],
        ];

        return $meta_boxes;
    }

    function my_banner( $attributes, $is_preview = false, $post_id = null ) {
        // Fields data.
        if ( empty( $attributes['data'] ) ) {
            return;
        }
        // Unique HTML ID if available.
        $id = 'id' . ( $attributes['id'] ?? '' );
        if ( ! empty( $attributes['anchor'] ) ) {
            $id = $attributes['anchor'];
        }
        // Custom CSS class name.
        $class = 'acord ' . ( $attributes['className'] ?? '' );
        if ( ! empty( $attributes['align'] ) ) {
            $class .= " align{$attributes['align']}";
        }
        $values = mb_get_block_field( 'bannergroup' );
        ?>
        <div class="banner tg-container" style="background: right / cover no-repeat url(<?php echo mb_get_block_field( 'back_image' ); ?>);">
            <div class="banner_container">
                <h1 class="banner_title">
                    <?php echo mb_get_block_field( 'title' ); ?>
                </h1>
                <div class="banner_text">
                    <?php echo mb_get_block_field( 'text' ); ?>
                </div>
            </div>
        </div>
        <style>
            @media screen and (max-width: 991px){
                body .banner{
                    border-radius: 0px;
                    justify-content: flex-end;
                    padding-bottom: 25px;
                }
            }
            @media screen and (min-width: 768px) and (max-width: 991px){
                .banner{
                    padding-left: 35px;
                }
            }
            @media screen and (min-width: 991px){
                .banner{
                    padding-left: 75px;
                }
            }
            .banner_text{
                color: #fff;
            }
            .banner{
                margin-top: 15px;
                display: flex;
                flex-direction: column;
                min-height: 200px;
                justify-content: center;
                border-radius: 5px;
            }
        </style>
    <?php }


function wrap_heading_paragraph_in_block($block_content, $block){
    foreach( $block['innerBlocks'] as $blockcurinner ) {

        if( 'core/code' == $blockcurinner['blockName'] ){
            $htmldd =  implode("|",$blockcurinner['innerContent']);
            preg_match('/<pre class="wp-block-code"><code>(.*?)<\/code><\/pre>/s', $htmldd, $match);
            $outdd = $match[1];

        }

    }


    if ($block['blockName'] === 'core/cover') {
        $content = '<div class="' . $outdd  . '">';
        $content .= $block_content;
        $content .= '</div>';
        return  $content;
    }
    if ($block['blockName'] === 'core/code') {
        $content = '';
        return  $content;
    }
    return $block_content;
}
add_filter('render_block', 'wrap_heading_paragraph_in_block', 10, 2);

function timer() {
    wp_enqueue_script( 'formstylesheet','/wp-content/themes/zakra-child/script.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'timer' );
 

function dequeue_my_css() {
    wp_deregister_style('cf7md_roboto');
    wp_deregister_style( 'font-awesome' );
}
add_action('init','add_some_init');
function add_some_init(){
    add_action('wp_enqueue_scripts','dequeue_my_css');
}

function custom_admin_js() {
    wp_enqueue_script(
        'your-script', // name your script so that you can attach other scripts and de-register, etc.
        '/wp-content/themes/zakra-child/admin-script.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );

}
add_action('login_enqueue_scripts', 'custom_admin_js');




function wpdocs_enqueue_custom_admin_style_admin() {
    wp_register_style( 'custom_wp_admin_css', '/wp-content/themes/zakra-child/admin-style.css', false, '1.5.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style_admin' );
add_action( 'login_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style_admin' );

function form_scripts() {
    wp_register_style( 'formstylesheet','/wp-content/themes/zakra-child/form.css' );
    wp_enqueue_style( 'formstylesheet' );
}
add_action( 'wp_enqueue_scripts', 'form_scripts' );



add_filter('wpcf7_autop_or_not', '__return_false');
function removenavdd()
{
    remove_action('zakra_header_block_two', 'zakra_mobile_navigation', 20);
}

add_action( 'init', 'removenavdd', 20 );

add_action( 'zakra_header_block_two', 'zakra_mobile_navigation_new', 20 );

function zakra_mobile_navigation_new() {
    ?>
    <nav id="mobile-navigation" class="<?php zakra_css_class( 'zakra_mobile_nav_class' ); ?>"
        <?php echo wp_kses_post( apply_filters( 'zakra_nav_data_attrs', '' ) ); ?>>
        <div class="mob-wid">
            <?php


            if ( is_active_sidebar('mobile') ) {
                dynamic_sidebar( 'mobile' );
            }
            ?>

        </div>
    </nav><!-- /#mobile-navigation-->
    <?php
}

add_action( 'zakra_header_block_two', 'zakra_second_navigation_top', 20 );

function zakra_second_navigation_top(){

    //wp_nav_menu( array('theme_location' => 'menu-shop', 'menu_id'        => 'primary-menu',) );

    echo '<div class="header1">';
    if ( is_active_sidebar('header-widgets-1') ) {
        dynamic_sidebar( 'header-widgets-1' );
    }
    echo '</div>';

}


 


add_action( 'widgets_init', 'register_agrotrade_footer_two_widgets' );
function register_agrotrade_footer_two_widgets(){
    register_sidebar( array(
        'name'          => sprintf(__('Header Widgets 1', 'agrotrade')),
        'id'            => "header-widgets-1",
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="footer-inner">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<p class="footer-headline">',
        'after_title'   => "</p>\n",
    ) );
    register_sidebar( array(
        'name'          => sprintf(__('Header Widgets 2', 'agrotrade')),
        'id'            => "header-widgets-2",
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="footer-inner">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<p class="footer-headline">',
        'after_title'   => "</p>\n",
    ) );
    register_sidebar( array(
        'name'          => sprintf(__('Header Widgets 3', 'agrotrade')),
        'id'            => "header-widgets-3",
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="men-inner">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<div>',
        'after_title'   => "</div>\n",
    ) );
    

    register_sidebar( array(
        'name'          => sprintf(__('Mobile', 'agrotrade')),
        'id'            => "mobile",
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="conten">',
        'after_widget'  => "</div>\n",
        'before_title'  => '<p class="head">',
        'after_title'   => "</p>\n",
    ) );
}

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');



add_action('init', 'remove_this_head_brand');
function remove_this_head_brand()
{
    remove_action('zakra_header_block_one', 'zakra_header_main_site_branding', 10);
}
add_action( 'zakra_header_block_one', 'zakra_header_main_site_branding_zw', 10 );
function zakra_header_main_site_branding_zw() {
    ?>
    <div class="site-branding">
        <?php
        // Check for meta logo.
        $meta_logo_id = ! is_home() ? intval( get_post_meta( zakra_get_post_id(), 'zakra_logo', true ) ) : '';

        if ( $meta_logo_id ) {
            $meta_logo_attr = array(
                'class'    => 'tg-logo',
                'itemprop' => 'logo',
            );

            // @codingStandardsIgnoreStart
            $meta_logo = apply_filters( 'zakra_meta_logo', zakra_get_image_by_id( $meta_logo_id, $meta_logo_attr, get_bloginfo( 'name', 'display' ) ) ); // WPCS: CSRF ok.
            // @codingStandardsIgnoreEnd

            echo sprintf(
                '<a href="%1$s" class="tg-logo-link" rel="home" itemprop="url">%2$s</a>',
                esc_url( home_url( '/' ) ),
                $meta_logo
            );
        } else {
            the_custom_logo();
        }
        ?>
        <div class="site-info-wrap">
            <?php
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
            else :
                ?>
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </p>
            <?php
            endif;

            $zakra_description = get_bloginfo( 'description', 'display' );

            if ( $zakra_description || is_customize_preview() ) :
                ?>
                <p class="site-description"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $zakra_description; /* WPCS: xss ok. */ ?></a></p>
            <?php endif; ?>
        </div>

    </div><!-- .site-branding -->
    <?php
}


