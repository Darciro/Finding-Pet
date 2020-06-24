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
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">

    <nav class="navbar navbar-expand-md bg-fp-primary" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'depth' => 2,
            'container' => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'bs-example-navbar-collapse-1',
            'menu_class' => 'navbar-nav align-items-lg-center',
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new WP_Bootstrap_Navwalker(),
        ));
        ?>

        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
                <a class="nav-link nav-link-icon" href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
                    <i class="fab fa-facebook-square"></i>
                    <span class="nav-link-inner--text d-lg-none">Facebook</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-icon" href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
                    <i class="fab fa-instagram"></i>
                    <span class="nav-link-inner--text d-lg-none">Instagram</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-icon" href="https://wa.me/000123456789" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
                    <i class="fab fa-whatsapp"></i>
                    <span class="nav-link-inner--text d-lg-none">WhatsApp</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial/argon-design-system" target="_blank" data-toggle="tooltip" title="Star us on Github">
                    <i class="fas fa-envelope"></i>
                    <span class="nav-link-inner--text d-lg-none">Email</span>
                </a>
            </li>

            <li class="nav-item d-block d-lg-block">
                <a class="btn btn-light btn-icon" href="/register">
                        <span class="btn-inner--icon">
                            <i class="fas fa-sign-in-alt" style="margin-right: 15px;"></i>
                        </span>
                    <span class="nav-link-inner--text">Registro</span>
                </a>
            </li>
            <li class="nav-item d-block d-lg-block">
                <a class="btn btn-light btn-icon" href="/login">
                        <span class="btn-inner--icon">
                            <i class="fas fa-sign-in-alt" style="margin-right: 15px;"></i>
                        </span>
                    <span class="nav-link-inner--text">Login</span>
                </a>
            </li>
        </ul>
    </nav>

</header>