<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finding_Pet
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet">

    <?php wp_head(); ?>

    <script src="https://kit.fontawesome.com/e4c6fe5997.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">

    <nav class="navbar navbar-expand-md bg-fp-primary" role="navigation">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <i class="fas fa-paw mr-2"></i><?php bloginfo('name'); ?>
        </a>

        <div class="collapse navbar-collapse" id="nav-content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'depth' => 2,
                'container' => 'div',
                'menu_class' => 'navbar-nav align-items-lg-center',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
            ));
            ?>

            <ul class="navbar-nav align-items-lg-center ml-lg-auto mt-0 mb-0">
                <li class="nav-item d-sm-inline-block">
                    <a class="nav-link nav-link-icon" href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
                        <i class="fab fa-facebook-square"></i>
                        <span class="nav-link-inner--text sr-only">Facebook</span>
                    </a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a class="nav-link nav-link-icon" href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
                        <i class="fab fa-instagram"></i>
                        <span class="nav-link-inner--text sr-only">Instagram</span>
                    </a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a class="nav-link nav-link-icon" href="https://wa.me/000123456789" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
                        <i class="fab fa-whatsapp"></i>
                        <span class="nav-link-inner--text sr-only">WhatsApp</span>
                    </a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial/argon-design-system" target="_blank" data-toggle="tooltip" title="Star us on Github">
                        <i class="fas fa-envelope"></i>
                        <span class="nav-link-inner--text sr-only">Email</span>
                    </a>
                </li>

                <?php if (is_user_logged_in()):
                    $current_user = wp_get_current_user(); ?>
                    <ul class="user-nav nav navbar-nav ml-5 mr-0 mt-0 mb-0 p-0">
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle user-avatar text-black-50" data-toggle="dropdown" aria-expanded="false">
                                <?php echo get_avatar( $current_user->ID, 50, '', $current_user->display_name, array('class' => 'rounded-circle') ); ?>
                                <i class="fas fa-caret-down text-white-50 ml-2"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right position-absolute">
                                <a class="dropdown-item text-black-50" href="#">Perfil</a>
                                <a class="dropdown-item text-black-50" href="#">Meus Pets</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-black-50" href="#">
                                    <span class="btn-inner--icon">
                                        <i class="fas fa-power-off" style="margin-right: 15px;"></i>
                                    </span>Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                <?php else : ?>
                    <li class="nav-item d-none d-lg-block mr-1 ml-5">
                        <a class="btn btn-light btn-icon text-black-50" href="/register">
                            <!--<span class="btn-inner--icon">
                                <i class="fas fa-sign-in-alt" style="margin-right: 15px;"></i>
                            </span>-->
                            <span class="nav-link-inner--text">Registro</span>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="btn btn-light btn-icon text-black-50" href="/login">
                            <!--<span class="btn-inner--icon">
                                <i class="fas fa-sign-in-alt" style="margin-right: 15px;"></i>
                            </span>-->
                            <span class="nav-link-inner--text">Login</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>

    </nav>

</header>