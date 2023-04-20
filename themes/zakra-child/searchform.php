<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php _x( 'Search for:', 'label' ); ?></span>
        <input type="search" class="search-field" placeholder="Search articles" value="<?php echo get_search_query(); ?>" name="s">
    </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>">
</form>
<style>
    .search-form,
    .search-form label{
        position: relative;
        display: flex;
    }
    .search-form label:before{
        content: '';
        background: center / contain no-repeat url("/wp-content/uploads/2023/01/search.png");
        width: 20px;
        height: 20px;
        display: flex;
        position: absolute;
        left: 27px;
        top: calc(50% - 10px);
    }
    .search-form label input{
        padding-left: 55px;
        width: 100%;
    }
    .search-form label{
        flex-basis: 100%;
    }
    .search_field{
        flex-basis: 50%;
    }
    .search-submit{
        display: none;
    }
</style>

