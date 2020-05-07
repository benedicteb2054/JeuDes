<?php

/*
Plugin Name: Jeu Des
Description: Module de lancement de des
Version: 1.0
Author: Benedicte Bouy
*/


// crochet d'activation du hook. 
register_activation_hook(__FILE__, array('JeuDes_Widget', 'install'));
// crochet de suppression du hook.
register_uninstall_hook(__FILE__, array('JeuDes_Widget', 'uninstall'));

// add_action( 'widgets_init', 'register_JeuDes_Widget' );

// Mon premier widget 
class Lances_de_des extends WP_Widget {

    function __construct() {
        parent::__construct(
            'Lances_de_des',
            esc_html__( 'Lances_de_des', 'textdomain' ),
            array( 'description' => esc_html__( 'Affiche les coordonnées', 'textdomain' ), )
        );
    }
// Description du Widget
    private $widget_fields = array(
        array(
            'label' => 'Titre',
            'id' => 'nom_text',
            'type' => 'text',
        ),
        array(
            'label' => 'Liste Des',
            'id' => 'liste_text',
            'type' => 'text',
        ),
    );

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // Output generated fields
        echo '<p>'.$instance['nom_text'].'</p>';
        echo '<p>'.$instance['liste_text'].'</p>';
        
        echo $args['after_widget'];
    }
// Les fonctions field_generator() sert à afficher les champs dans le backend
    public function field_generator( $instance ) {
        $output = '';
        foreach ( $this->widget_fields as $widget_field ) {
            $default = '';
            if ( isset($widget_field['default']) ) {
                $default = $widget_field['default'];
            }
            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'textdomain' );
            switch ( $widget_field['type'] ) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }
    // Les fonctions  form() sert à afficher les champs dans le backend
    public function form( $instance ) {
        $this->field_generator( $instance );
    }
// fonction update() permet de gérer l’update du contenu du widget.
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }
        return $instance;
    }
}

add_action( 'widgets_init', 'register_Lances_de_des' );

function register_Lances_de_des() {
    register_widget( 'Lances_de_des' );
}


