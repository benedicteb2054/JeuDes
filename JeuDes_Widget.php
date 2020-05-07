<?php
// J'initialise les widgets
add_action( 'widgets_init', 'register_JeuDes' );

add_action( 'widgets_init', 'Lances_de_des' );


function Lances_de_des() {

    //  before_widget : Le code HTML à placer avant chaque widget présent dans cette zone
    // after_widget : Le code HTML à placer après chaque widget présent dans cette zone
    // before_title : Le code HTML à placer avant chaque titre de widget présent dans cette zone
    // after_title : Le code HTML à placer après chaque titre de widget présent dans cette zone
    // class : Le nom de la classe de la zone à widgets

    register_sidebar( array(
        'name'          => 'Lances de des',
        'id'            => 'Lances_de_des',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
        'class'         => 'nom_de_la_classe',
    ) );
}
// J'insere une zone de widget
dynamic_sidebar( 'Lances_de_des' );

function register_JeuDes() {
    register_widget( 'JeuDes' );
}

// Insertion du widget dans Wordpress
class JeuDes extends WP_Widget {
}

function __construct() {
    parent::__construct(
        'JeuDes',
        esc_html__( 'JeuDes', 'textdomain' ),
        array( 'description' => esc_html__( 'lancement de des', 'textdomain' ), )
    );
}

public function widget( $args, $instance ) {
    echo $args['before_widget'];

    echo "<h2>lancement de des</h2>";
    
    echo $args['after_widget'];
}




