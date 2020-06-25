<?php if (is_singular()): ?>
    <section class="section section-hero bg-secondary page-header" style="padding: 100px 0; background: #ea9a96 !important; margin-bottom: 70px">
        <div class="container text-center">
            <h1 class="text-white display-3"><?php the_title(); ?></h1>
            <h2 class="display-5 font-weight-normal text-white"><?php the_field('state'); ?></h2>
        </div>
    </section>
<?php endif; ?>

<div class="<?php echo is_singular() ? 'container' : ''; ?>">
    <div class="pet-card card text-center shadow" style="margin-bottom: 100px;">
        <div class="card-header container">
            <div class="row">
                <div class="col d-none d-lg-block">
                    <ul>
                        <li>
                            <b>22</b>
                            <span>Seguidores</span>
                        </li>
                        <li>
                            <b>10</b>
                            <span>Fotos</span>
                        </li>
                        <li>
                            <b>4</b>
                            <span>Comentários</span>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <div class="header-image text-center">
                        <a href="<?php the_permalink(); ?>" class="pet">
                            <?php
                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail('thumbnail', array('class' => 'rounded-circle', 'title' => get_the_title()));
                            else : ?>
                            <img class="rounded-circle" src="<?php echo get_template_directory_uri(); ?>/assets/img/cat.png" style="background: #ea9a96;">
                            <?php endif; ?>
                        </a>
                        <a href="#" class="owner">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 90, '', get_the_author_meta('display_name'), array('class' => 'rounded-circle') ); ?>
                        </a>
                    </div>
                </div>
                <div class="col d-none d-lg-block text-right">
                    <button type="button" class="btn btn-info btn-sm shadow-sm">
                        <i class="fas fa-star" style="margin-right: 5px; color: rgb(255, 255, 255);"></i>Seguir
                    </button>
                    <button type="button" class="btn btn-info btn-sm shadow-sm">
                        <i class="fab fa-whatsapp" style="margin-right: 5px; color: rgb(255, 255, 255);"></i>Mensagem
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <small class="date text-muted">
                <?php echo get_the_date('d/m/Y'); ?>
            </small>

            <h4 class="card-title"><?php the_title(); ?></h4>
            <h5 class="text-muted">
                <small>Pet de <?php the_author(); ?></small>
            </h5>

            <span class="d-block mt-4 mb-2"><i class="fas fa-map-marker-alt"></i> Perdido, Última localização</span>

            <?php
            $location = get_field('last_know_location');
            if ($location) {

                // Loop over segments and construct HTML.
                $address = '';
                foreach (array('street_name', 'city', 'state', 'post_code', 'country') as $i => $k) {
                    if (isset($location[$k])) {
                        $address .= sprintf('<span class="segment-%s">%s</span>, ', $k, $location[$k]);
                    }
                }

                // Trim trailing comma.
                $address = trim($address, ', ');

                // Display HTML.
                echo '<p class="mb-0"><b>' . $address . '</b></p>';

                if( get_query_var('geoplugin_latitude') && get_query_var('geoplugin_longitude') ) {
                    $distance = finding_pet_get_distance(get_query_var('geoplugin_latitude'), get_query_var('geoplugin_longitude'), $location['lat'], $location['lng'], 'K');
                    echo '<small>' . round($distance) . 'Km de distância</small>';
                }
            } ?>

            <?php if (is_singular()): ?>

                <?php
                $location = get_field('last_know_location');

                if( $location ): ?>
                    <div class="acf-map" data-zoom="13">
                        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

            <div class="row justify-content-center text-muted mt-3">
                <div class="col">
                    <span class="d-block"><?php the_field('type'); ?>, <?php the_field('sex'); ?>, <?php the_field('age'); ?></span>
                    <span class="d-block">Raça: <?php the_field('breed'); ?></span>
                    <span class="d-block">Porte: <?php the_field('size'); ?></span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <?php if (is_singular()): ?>

                        <?php if( have_rows('gallery') ): ?>

                            <div class="pet-gallery">
                                <h5 class="text-white"><i class="fas fa-camera mr-2 mb-3"></i>Galeria de fotos</h5>
                                <ul>

                                    <?php while( have_rows('gallery') ): the_row();

                                        $image = get_sub_field('gallery_item'); ?>

                                        <li class="slide">
                                            <a href="<?php echo $image['url']; ?>" data-fancybox="gallery">
                                                <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt'] ?>" />
                                            </a>
                                        </li>

                                    <?php endwhile; ?>

                                </ul>
                            </div>

                        <?php endif; ?>

                        <!--<a href="https://source.unsplash.com/lSXpV8bDeMA/1536x2304" data-fancybox="gallery" data-caption="Caption for single image">
                            <img src="https://source.unsplash.com/lSXpV8bDeMA/1536x2304" alt="" />
                        </a>
                        <a href="https://source.unsplash.com/ty4X72BSsXY/1279x853" data-fancybox="gallery" data-caption="Caption for single image">
                            <img src="https://source.unsplash.com/ty4X72BSsXY/1279x853" alt="" />
                        </a>-->

                        <?php the_content(); ?>
                    <?php else: ?>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary text-white">Mais informações</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>