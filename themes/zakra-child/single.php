<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zakra
 */

get_header();
?>

    <div id="primary" class="content-area tg-container new_cl">
        <?php echo apply_filters( 'zakra_after_primary_start_filter', false ); // WPCS: XSS OK. ?>

        <?php
        while ( have_posts() ) :
            the_post();
?>
            <div class="pre_single">
                <div class="pre_single_image">
                    <?php echo get_the_post_thumbnail(); ?>
                </div>
                <div class="pre_single_content">
                    <div class="pre_single_excerpt">
                        <?php the_content(); ?>
                    </div>
                    <div class="pre_single_bottom_part">
						<?php if(rwmb_meta('start')){ ?>
                        <div class="pre_date">
                            <div class="pre_text">
                                <?php echo rwmb_meta('start'); ?>
                            </div>
                            <div class="pre_title">
                                <?php 
										if(rwmb_meta('start-text')){
											echo rwmb_meta('start-text');
										}else{
											echo get_theme_mod('start_section_id_date');
										}			 
								?>
                            </div>
                        </div>
						<?php } ?>
						<?php if(rwmb_meta('end')){ ?>
						<div class="pre_date">
                            <div class="pre_text">
                                <?php echo rwmb_meta('end'); ?>
                            </div>
                            <div class="pre_title">
                                <?php
										if(rwmb_meta('end-text')){
											echo rwmb_meta('end-text');
										}else{
											echo get_theme_mod('section_id_date');
										}
								?>
                            </div>
                        </div>
						<?php } ?>
						<?php if(rwmb_meta('prize')){ ?>
                        <div class="pre_information">
                            <div class="pre_text">
                                <?php echo rwmb_meta('prize'); ?>
                            </div>
                            <div class="pre_title">
								 <?php
										if(rwmb_meta('prize-text')){
											echo rwmb_meta('prize-text');
										}else{
											echo get_theme_mod('section_id_prize');
										}
								?>
                            </div>
                        </div>
						<?php } ?>
						<?php if(rwmb_meta('distribution')){ ?>
                        <div class="pre_information">
                            <div class="pre_text">
                                <?php echo rwmb_meta('distribution'); ?>
                            </div>
                            <div class="pre_title">
								 <?php
										if(rwmb_meta('distribution-text')){
											echo rwmb_meta('distribution-text');
										}else{
											echo get_theme_mod('section_id_distribution');
										}
								?>
                            </div>
                        </div>
						<?php } ?>
                    </div>
                </div>
            </div>
            <div class="steps_block">
				<?php if (!empty(rwmb_meta('steps_title'))){?>
				<h2 class="steps_title">
					<?php echo rwmb_meta('steps_title'); ?>
				</h2>
				<?php } ?>
                <?php echo rwmb_meta('steps'); ?>
            </div>
            <div class="button_block">
                <?php
                    $id = get_the_ID();
                    $link = rwmb_meta( 'link','',$id );
				if($link){ ?>
					 <a href="<?php echo $link; ?>" class="button"> 
						<?php if(rwmb_meta('but_text')){
							echo rwmb_meta('but_text');
						}else{
							echo get_theme_mod('btn_in_drop');
						} ?>
                	</a>
				<?php } ?>
            </div>
            <div class="about_block">
				<?php if (!empty(rwmb_meta('about_tit'))){?>
				<h2 class="about_title">
					<?php echo rwmb_meta('about_tit'); ?>
				</h2>
				<?php } ?>
                <?php echo rwmb_meta('about'); ?>
                <div class="social">
                    <div class="social_title">
                        <?php echo rwmb_meta('soc_title'); ?>
                    </div>
                    <div class="social_icons">
                        <?php if (!empty(rwmb_meta('facebook'))){?>
                        <a href="<?php echo rwmb_meta('facebook'); ?>">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="34" height="34" rx="17" fill="#211C1E"/>
                                <path d="M22.5636 13.8216H18.5605V11.8351C18.5605 11.8351 18.3363 9.94602 19.6337 9.94602C21.1 9.94602 22.2708 9.94602 22.2708 9.94602V5.87271H17.7809C17.7809 5.87271 14.0237 5.85646 14.0237 9.69768C14.0237 10.5228 14.02 12.0251 14.0143 13.8216H11.4363V17.1012H14.0077C13.9927 22.3158 13.9749 28.1273 13.9749 28.1273H18.5605V17.1012H21.5869L22.5636 13.8216Z" fill="white"/>
                            </svg>
                        </a>
                        <?php } ?>
                        <?php if (!empty(rwmb_meta('instagram'))){?>
                            <a href="<?php echo rwmb_meta('instagram'); ?>">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="34" height="34" rx="17" fill="#211C1E"/>
                                    <path d="M16.9976 12.8272C14.6963 12.8272 12.8271 14.6964 12.8271 16.9977C12.8271 19.2989 14.6963 21.1727 16.9976 21.1727C19.2989 21.1727 21.1726 19.2989 21.1726 16.9977C21.1726 14.6964 19.2989 12.8272 16.9976 12.8272Z" fill="white"/>
                                    <path d="M22.3898 7.26361H11.6097C9.2146 7.26361 7.26343 9.21478 7.26343 11.6099V22.39C7.26343 24.7891 9.2146 26.7363 11.6097 26.7363H22.3898C24.7889 26.7363 26.7362 24.7891 26.7362 22.39V11.6099C26.7362 9.21478 24.7889 7.26361 22.3898 7.26361ZM16.9998 23.3091C13.522 23.3091 10.6906 20.4778 10.6906 17C10.6906 13.5221 13.522 10.6947 16.9998 10.6947C20.4776 10.6947 23.309 13.5221 23.309 17C23.309 20.4778 20.4776 23.3091 16.9998 23.3091ZM23.4414 11.8397C22.7053 11.8397 22.1055 11.2438 22.1055 10.5078C22.1055 9.7717 22.7053 9.17194 23.4414 9.17194C24.1774 9.17194 24.7772 9.7717 24.7772 10.5078C24.7772 11.2438 24.1774 11.8397 23.4414 11.8397Z" fill="white"/>
                                </svg>
                            </a>
                        <?php } ?>
                        <?php if (!empty(rwmb_meta('twitter'))){?>
                            <a href="<?php echo rwmb_meta('twitter'); ?>">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="34" height="34" rx="17" fill="#211C1E"/>
                                    <path d="M28.1273 10.0997C27.2998 10.4627 26.4179 10.7033 25.4985 10.8202C26.4443 10.2555 27.1662 9.36807 27.5056 8.29846C26.6238 8.82422 25.6501 9.19559 24.6125 9.40284C23.7752 8.51127 22.5818 7.95908 21.2799 7.95908C18.754 7.95908 16.7205 10.0093 16.7205 12.5226C16.7205 12.8843 16.7511 13.232 16.8262 13.563C13.0332 13.3781 9.67694 11.5601 7.42228 8.79084C7.02865 9.47378 6.79776 10.2555 6.79776 11.097C6.79776 12.677 7.61144 14.0777 8.82431 14.8886C8.0913 14.8747 7.3722 14.6619 6.76298 14.3267C6.76298 14.3406 6.76298 14.3586 6.76298 14.3767C6.76298 16.5938 8.34445 18.4354 10.4183 18.8596C10.0469 18.9612 9.64217 19.0098 9.22211 19.0098C8.93002 19.0098 8.63515 18.9932 8.35836 18.932C8.94949 20.7387 10.6269 22.0671 12.6215 22.1102C11.0692 23.3244 9.09832 24.0561 6.96467 24.0561C6.59051 24.0561 6.23166 24.0394 5.8728 23.9935C7.89379 25.2968 10.2889 26.0409 12.8719 26.0409C21.2674 26.0409 25.8574 19.0863 25.8574 13.0581C25.8574 12.8565 25.8504 12.6617 25.8407 12.4684C26.7462 11.8258 27.507 11.0232 28.1273 10.0997Z" fill="white"/>
                                </svg>
                            </a>
                        <?php } ?>
						<?php if (!empty(rwmb_meta('telegram'))){?>
                        <a href="<?php echo rwmb_meta('telegram'); ?>">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="34" height="34" rx="17" fill="#241F21"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M21.32 25.9806C21.5883 26.1879 21.9341 26.2397 22.2425 26.1125C22.5508 25.9843 22.7775 25.697 22.8458 25.3488C23.5699 21.6362 25.3266 12.2391 25.9857 8.86193C26.0357 8.60739 25.9524 8.34285 25.7691 8.17286C25.5857 8.00286 25.3316 7.95377 25.1049 8.04559C21.6108 9.45647 10.8502 13.8609 6.45199 15.6363C6.17283 15.749 5.99117 16.0418 6.00033 16.3627C6.01033 16.6845 6.20866 16.9636 6.49449 17.0572C8.46694 17.7008 11.056 18.5963 11.056 18.5963C11.056 18.5963 12.266 22.5825 12.8968 24.6098C12.976 24.8643 13.1585 25.0643 13.3993 25.1334C13.6393 25.2016 13.896 25.1297 14.0751 24.9452C15.0885 23.9016 16.6551 22.288 16.6551 22.288C16.6551 22.288 19.6317 24.6688 21.32 25.9806ZM12.1452 18.0926L13.5443 23.1271L13.8552 19.939C13.8552 19.939 19.2609 14.62 22.3425 11.5882C22.4325 11.4991 22.445 11.3501 22.37 11.2455C22.2958 11.141 22.1591 11.1164 22.0566 11.1873C18.485 13.6755 12.1452 18.0926 12.1452 18.0926Z" fill="white"/>
</svg>
                        </a>
                        <?php } ?>
						<?php if (!empty(rwmb_meta('discord'))){?>
                        <a href="<?php echo rwmb_meta('discord'); ?>">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="34" height="34" rx="17" fill="#241F21"/>
<path d="M23.9419 10.2966C22.6473 9.69088 21.263 9.25066 19.8157 9C19.638 9.32134 19.4304 9.75355 19.2872 10.0974C17.7487 9.86601 16.2245 9.86601 14.7143 10.0974C14.5712 9.75355 14.3588 9.32134 14.1795 9C12.7307 9.25066 11.3448 9.6925 10.0502 10.2998C7.43887 14.2458 6.73099 18.0938 7.08493 21.8872C8.81688 23.1805 10.4953 23.9662 12.1455 24.4804C12.5529 23.9196 12.9163 23.3235 13.2293 22.6953C12.6331 22.4688 12.0621 22.1892 11.5226 21.8647C11.6657 21.7586 11.8057 21.6478 11.941 21.5337C15.2318 23.0729 18.8074 23.0729 22.0589 21.5337C22.1958 21.6478 22.3358 21.7586 22.4774 21.8647C21.9362 22.1908 21.3637 22.4704 20.7675 22.697C21.0805 23.3235 21.4423 23.9212 21.8513 24.4819C23.503 23.9678 25.183 23.1822 26.915 21.8872C27.3303 17.4897 26.2056 13.6771 23.9419 10.2966ZM13.6776 19.5543C12.6898 19.5543 11.8796 18.632 11.8796 17.509C11.8796 16.3859 12.6725 15.4621 13.6776 15.4621C14.6829 15.4621 15.493 16.3843 15.4757 17.509C15.4772 18.632 14.6829 19.5543 13.6776 19.5543ZM20.3223 19.5543C19.3344 19.5543 18.5243 18.632 18.5243 17.509C18.5243 16.3859 19.3171 15.4621 20.3223 15.4621C21.3275 15.4621 22.1376 16.3843 22.1203 17.509C22.1203 18.632 21.3275 19.5543 20.3223 19.5543Z" fill="white"/>
</svg>
                        </a>
                        <?php } ?>
						<?php if (!empty(rwmb_meta('site'))){?>
                        <a href="<?php echo rwmb_meta('site'); ?>">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="34" height="34" rx="17" fill="#241F21"/>
<path d="M17 7C11.4771 7 7 11.4771 7 17C7 22.5229 11.4771 27 17 27C22.5229 27 27 22.5229 27 17C27 11.4771 22.5229 7 17 7ZM8.28167 17.625H10.4262C10.474 18.6627 10.6308 19.6121 10.8743 20.4647H8.96865C8.58706 19.5836 8.35298 18.6269 8.28167 17.625ZM20.0849 16.375C20.0379 15.3704 19.9188 14.4188 19.7576 13.5353H21.8062C22.0789 14.3739 22.2661 15.3194 22.3225 16.375H20.0849ZM15.4237 20.4647C15.2473 19.4907 15.1607 18.54 15.1447 17.625H18.8554C18.8394 18.54 18.7528 19.4907 18.5763 20.4647H15.4237ZM18.304 21.7147C18.0109 22.8397 17.5867 23.9865 16.9999 25.1358C16.4131 23.9865 15.989 22.8397 15.696 21.7147H18.304ZM15.1617 16.375C15.2112 15.3647 15.3389 14.4126 15.5086 13.5353H18.4914C18.6611 14.4126 18.7888 15.3647 18.8384 16.375H15.1617ZM15.7895 12.2854C16.1801 10.7605 16.6627 9.55743 16.9999 8.81669C17.3372 9.55743 17.8198 10.7605 18.2105 12.2854H15.7895ZM19.4927 12.2854C19.0939 10.6329 18.5818 9.30539 18.2018 8.44743C18.6741 8.78355 20.2435 10.0259 21.314 12.2854H19.4927ZM15.7981 8.44735C15.418 9.30531 14.906 10.6328 14.5073 12.2854H12.6858C13.7564 10.0257 15.3259 8.78335 15.7981 8.44735ZM14.2424 13.5354C14.0812 14.4189 13.9622 15.3704 13.9151 16.3751H11.6773C11.7337 15.3195 11.9209 14.3739 12.1936 13.5354H14.2424ZM10.4276 16.375H8.28167C8.35298 15.3732 8.58702 14.4165 8.96861 13.5353H10.883C10.6376 14.3878 10.4777 15.3366 10.4276 16.375ZM11.6766 17.625H13.898C13.9122 18.5415 13.9893 19.491 14.1527 20.4647H12.1942C11.9192 19.624 11.7314 18.6782 11.6766 17.625ZM14.4116 21.7147C14.7182 22.9875 15.1736 24.2883 15.8297 25.5944C15.387 25.2774 13.7776 24.0115 12.6863 21.7147H14.4116ZM18.1688 25.5972C18.8257 24.2902 19.2815 22.9884 19.5884 21.7147H21.3262C20.2382 24.0232 18.6219 25.2787 18.1688 25.5972ZM19.8473 20.4647C20.0108 19.491 20.0879 18.5415 20.102 17.625H22.3238C22.2701 18.6801 22.0853 19.6257 21.8143 20.4647H19.8473ZM23.5735 17.625H25.7183C25.647 18.6269 25.4129 19.5836 25.0313 20.4647H23.1255C23.369 19.6121 23.5258 18.6627 23.5735 17.625ZM23.5722 16.375C23.5221 15.3365 23.3622 14.3878 23.1168 13.5353H25.0314C25.4131 14.4164 25.6471 15.3731 25.7184 16.375H23.5722ZM24.3596 12.2854H22.6762C22.1175 10.9395 21.3891 9.87486 20.7036 9.08392C22.2031 9.78841 23.4701 10.9019 24.3596 12.2854ZM13.296 9.08408C12.6106 9.87502 11.8823 10.9396 11.3236 12.2854H9.64045C10.5298 10.902 11.7967 9.78861 13.296 9.08408ZM9.64049 21.7147H11.3134C11.8637 23.0468 12.5818 24.1079 13.2625 24.8998C11.7779 24.1944 10.5232 23.0877 9.64049 21.7147ZM20.7378 24.8996C21.4183 24.1078 22.1363 23.0467 22.6864 21.7147H24.3595C23.4769 23.0876 22.2222 24.1942 20.7378 24.8996Z" fill="white"/>
</svg>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php

        endwhile; // End of the loop.
        ?>
        
    </div><!-- #primary -->
    <style>
        body p{
            font-weight: 400 !important;
        }
        body.single div h2{
            font-size: 24px;
            font-weight: 400;
        }
        @media screen and (max-width: 991px){
            body div.social{
                margin-top: 20px;
            }
            body div.about_block{
                padding: 25px;
            }
            body.single #primary> div{
                margin-bottom: 10px;
            }
            body.single #primary> div.about_block{
                margin-bottom: 20px;
            }
        }
		@media screen and (min-width: 1200px){
			.pre_single_image img{
				width: 200px;
			}
		}
        @media screen and (min-width: 991px){
            body.single #primary> div.about_block{
                margin-bottom: 40px;
            }
            body.single #primary> div{
                margin-bottom: 15px;
            }
			
        }
        @media screen and (max-width: 768px) {
            body div .button{
                font-size: 24px;
                padding-top: 25px;
                padding-bottom: 25px;
            }
            body .pre_single,
            body .steps_block,
            body .button,
            body .about_block{
                border-radius: 30px;
            }
        }
        .pre_single,
        .steps_block,
        .button,
        .about_block{
            border-radius: 5px;
        }
		body .button_block .button{
			margin-bottom:0;
		}
        body .button_block{
            display: flex;
        }
        .social_title{
            font-weight: 400;
            font-size: 20px;
            line-height: 25px;
            color: #000000;
            text-align: center;
        }
        .social_icons a{
            display: flex;
        }
        div.social{
            margin-top: 30px;
        }
        .social_icons{
            margin-top: 17px;
            justify-content: center;
            gap: 10px;
            display: flex;
        }
        .about_block{
            padding: 30px 40px;
            background: #FFFFFF;
        }
        .button{
            color: #fff;
            min-width: 100%;
            text-align: center;
            background: #40B8DD;
            padding-top: 35px;
            padding-bottom: 35px;
        }
        .steps_block> ul> li> ul> li:before{
            content: '';
            background: #000;
            min-width: 4px;
            display: inline-block;
            height: 4px;
            border-radius: 50px;
            margin-top: 12px;
        }
        .steps_block> ul> li> ul> li{
            display: flex;
            gap: 10px;
            list-style: none;
        }
        .steps_block> ul> li> ul{
            margin-left: 85px;
        }
        .steps_block> ul> li:before{
            content: '';
            background: #40B8DD;
            min-width: 12px;
            height: 12px;
            border-radius: 50px;
			position:absolute;
			left:0;
			top: 7px;
        }
        .steps_block> ul> li{
            align-items: center;
            display: block;
			flex-wrap:wrap;
            column-gap: 5px;
            list-style: none;
			position:relative;
			padding-left:32px;
        }
        .steps_block{
            padding: 30px 40px;
            background: #FFFFFF;
        }
        @media screen and (max-width: 768px){
            .pre_single_bottom_part{
                justify-content: space-around;
            }
            body .pre_single_content{
                display: flex;
                flex-direction: column-reverse;
                gap: 10px;
            }
            body .pre_single_image{
                justify-content: center;
            }
            .pre_single_image{
                margin-top: -105px;
            }
            body .pre_single_image img{
                max-width: 135px;
            }
            body .pre_single{
                gap: 20px;
                padding: 20px 25px;
            }
            body #primary{
                margin-top: 210px !important;
            }
            .pre_single{
                flex-direction: column;
            }
            body #primary{
                width: calc(100% - 30px) !important;
            }
            .content-area.tg-container{
                margin-left: 15px;
            }
        }
        @media screen and (min-width: 768px) and (max-width: 991px){
            body .pre_single{
                gap: 40px;
            }
        }
        .pre_single_image{
            display: flex;
            align-items: center;
        }
        .pre_title{
            text-align: center;
        }
        .pre_date,
        .pre_information{
            display: flex;
            flex-direction: column;
        }
        .pre_text{
            font-weight: 700;
            font-size: 20px;
            line-height: 25px;
            color: #000000;
        }
        .pre_single_content{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .pre_single_excerpt p{
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
        }
        .pre_single_bottom_part{
            display: flex;
			flex-wrap:wrap;
            gap: 15px 55px ;
        }
        .pre_single_image img{
            
			border-radius:50%;
        }
        .pre_single{
            background: #FFFFFF;
            padding: 50px;
            gap: 75px;
            display: flex;
			align-items:center;
        }
        .content-area{
            padding-top: 10px;
        }
        .li_with_ul{
            flex-wrap: wrap;
        }
        @media screen and (max-width: 768px){
            body .steps_block> ul> li> ul{
                margin-left: 65px;
            }
            body .steps_block> ul> li> ul> li:before{
                margin-top: 6px;
            }
            .li_with_ul ul{
                margin-top: 10px;
            }
            body .steps_block{
                padding: 15px 20px;
            }
            body .steps_block> ul> li{
                margin-bottom: 10px;
                font-size: 14px;
                line-height: 17px;
            }
        }
    </style>
    <script>
        jQuery(document).ready((function ($) {
            $("ul").parents("li").addClass("li_with_ul");
        }));
    </script>

<?php

get_footer();
