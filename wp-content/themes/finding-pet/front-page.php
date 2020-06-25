<?php get_header(); ?>

    <main id="primary" class="site-main">

        <section class="section section-hero bg-secondary page-header" style="padding: 100px 0; background: #ea9a96 !important">
            <div class="container text-center">
                <h1 class="text-white display-3">Ajude um Pet</h1>
                <h2 class="display-5 font-weight-normal text-white">A hora é agora!!!</h2>
                <!--<button type="button" class="btn btn-warning btn-icon mt-3 mb-sm-0 video-btn" data-toggle="modal" data-target="#introModal" data-src="https://www.youtube.com/embed/NGC8IS4gjpM">
                    <i class="ni ni-button-play"></i> Veja como contribuir
                </button>-->

                <button type="button" class="btn btn-warning btn-icon mt-3 mb-sm-0 video-btn text-uppercase" data-toggle="modal" data-target="#introModal" data-src="https://www.youtube.com/embed/NGC8IS4gjpM">
                    <i class="fas fa-play mr-3"></i>Veja como contribuir
                </button>

                <div class="modal intro-modal fade" id="introModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-6" style="padding-top: 70px">
            <div class="container">
                <div class="row">
                    <div class="col-12 order-2 col-md-12 order-md-2 col-lg-10 order-lg-1">

                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <h2>Últimas atualizações</h2>
                                <h3 class="mb-5"><small>Ajude-nos a encontrar esses Pets perdidos!</small></h3>
                                <?php
                                $args = array(
                                    // 'post_type' => array('pet', 'post'),
                                    'post_type' => 'pet'
                                );
                                $the_query = new WP_Query($args); ?>

                                <?php
                                if ($the_query->have_posts()) :

                                    while ($the_query->have_posts()) : $the_query->the_post();

                                        get_template_part('template-parts/content', get_post_type());

                                    endwhile;
                                    wp_reset_postdata();

                                else :
                                    // ?
                                endif; ?>

                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <?php
                                $user_ip = $_SERVER['REMOTE_ADDR'];
                                // $user_ip = '200.175.190.205'; // Asa Sul
                                // $user_ip = '148.71.50.21'; // Lisboa
                                // $user_ip = '189.6.34.131'; // Lisboa

                                if( isset( $_GET['ip'] ) )
                                    $user_ip = $_GET['ip'];

                                $geo = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $user_ip) );
                                $country = $geo['geoplugin_countryName'];
                                $city = $geo['geoplugin_city'];

                                $proximity = 15;
                                $unit = 'K';

                                // create an empty array to store results for a later query
                                $results = array();
                                $proximity_query = new WP_Query(array(
                                    'post_type' => 'pet', /* this is the name of our custom post type */
                                    'posts_per_page' => -1
                                ));
                                // loop over each result
                                // and calculate if it's in the proximity
                                if ($proximity_query->have_posts()) {
                                    while ($proximity_query->have_posts()) {
                                        $proximity_query->the_post();
                                        // this is the name of our custom field
                                        $address = get_field('last_know_location');
                                        if ($address) {
                                            // calculate distance using our function
                                            // the $origin values is from the url parameters
                                            $distance = finding_pet_get_distance($geo['geoplugin_latitude'], $geo['geoplugin_longitude'], $address['lat'], $address['lng'], $unit);
                                            // if the distance is less than our threshold,
                                            // then we are going to add it to our $results array
                                            // need to use (float) because the original values are strings.
                                            if ((float)$distance <= (float)$proximity) {
                                                array_push($results, get_the_ID());
                                            }
                                        }
                                    }
                                }
                                // reset the $proximity_query
                                wp_reset_postdata();

                                // a search was made, and there are results in the '$results' array
                                if ($results && $proximity) {
                                    $results_args = array(
                                        'post_type' => 'pet',
                                        'post__in' => $results /* we use post__in to find only the posts that are in the '$results' array */
                                    );
                                // a search was made, but there are no results in the '$results' array
                                } else if (!$results && $proximity) {
                                    $results_args = array();
                                } ?>

                                <h2>Casos próximos de você</h2>
                                <h3 class="mb-5"><small>Pets perdidos num raio de 15Km de você (<?php echo $city . ', ' . $country; ?>)</small></h3>

                                <?php
                                // create a new query to display the results
                                $results_query = new WP_Query($results_args);
                                if ($results_query->have_posts()) :

                                    while ($results_query->have_posts()) : $results_query->the_post();

                                        set_query_var('geoplugin_latitude', $geo['geoplugin_latitude']);
                                        set_query_var('geoplugin_longitude', $geo['geoplugin_longitude']);

                                        get_template_part('template-parts/content', get_post_type());

                                    endwhile;
                                    wp_reset_postdata();

                                else :
                                    echo '<p style="margin-bottom: 150px">Nenhum caso encontrado próximo de você</p>';
                                endif;

                                ?>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <h2>Seguindo</h2>
                                <h3 class="mb-5"><small>Acompanhe e seja notificado sobre casos de Pets</small></h3>
                                <p style="margin-bottom: 150px">Você ainda não está acompanhando nenhum caso</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 order-1 col-md-12 order-md-1 col-lg-2">
                        <div class="main-content-nav nav flex-column nav-pills sticky-top" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <i class="d-block d-lg-none fas fa-exclamation-triangle"></i>
                                Atualizações
                            </a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <i class="d-block d-lg-none fas fa-map-marker-alt"></i>
                                Próximos
                            </a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <i class="d-block d-lg-none fas fa-star"></i>
                                Seguindo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- #main -->

<?php
get_footer();
