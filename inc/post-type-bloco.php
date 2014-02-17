<?php
/**
 * Custom class for creating & defining a post type
 * 
 * Register Block & School post type, its taxonomies and
 * custom meta boxes
 *
 * @todo Add new labels and pass them to english
 */
class Folia_Post_Type_Bloco {

    public static $custom_meta_fields;

    /**
  	 * Define meta fields and add necessary actions
  	 *
	 */
    static function init() {
    	
    	// The prefix for all meta
    	$meta_prefix = '_folia_bloco_';
    
	    self::$custom_meta_fields = array(
			array(  
		        'label'			=> __( 'Facebook', 'folia' ),
		        'description'  	=> '',  
		        'id'    		=> $meta_prefix . 'facebook',  
		        'type'  		=> 'url',
		        'description'	=> ''
	        ),
	        array(  
		        'label'			=> __( 'Instagram', 'folia' ),
		        'description'  	=> '',  
		        'id'    		=> $meta_prefix . 'instagram',  
		        'type'  		=> 'url',
		        'description'	=> ''
	        ),
	        array(  
		        'label'			=> __( 'Twitter', 'folia' ),
		        'description'  	=> '',  
		        'id'    		=> $meta_prefix . 'twitter',  
		        'type'  		=> 'url',
		        'description'	=> ''
	        )
	        
	    );
    
        add_action( 'init', array( __CLASS__, 'register_post_type' ) );
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_post_type_meta_box' ) );
        add_action( 'save_post', array( __CLASS__, 'save_postdata' ) );

        add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
        
        /*
		add_filter( 'manage_edit-bloco_columns', array( __CLASS__, 'manage_bloco_column' ) );
		add_action( 'manage_bloco_posts_custom_column', array( __CLASS__, 'manage_posts_bloco_column' ), 5, 2 );
		*/
        
    }
  
    
    /**
     * Post Type registration
     * 
     */
    static function register_post_type() {
	  	
        $labels = array(
			'name'               => __( 'Blocos', 'folia' ),
			'singular_name'      => __( 'Bloco', 'folia' ),
			'menu_name'          => 'Blocos'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'bloco' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'bloco', $args );
        
    }
    
    /**
	 * Taxonomy registration
	 *
	 * @todo i18n strings
	 * 
	 * @since Folia 1.0
	 */
	function register_taxonomies() 
	{
		// Sections / Mostras
		$taxonomies = array( 
			array(
				'id'				=>	'filter',
				'label_singular'	=> __( 'Filtro', 'folia' ),
				'label_plural'		=> __( 'Filtros', 'folia' )
			)
		);
		
		foreach ( $taxonomies as $taxonomy ) {

			$labels = array(
				'name' => $taxonomy['label_plural'],
				'singular_name' => $taxonomy['label_singular'],
				/*
				'search_items' =>  sprintf( _x( 'Search %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				'all_items' => sprintf( _x( 'All %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				'parent_item' => sprintf( _x( 'Parent %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				'parent_item_colon' => sprintf( _x( 'Parent %s:', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				'edit_item' => sprintf( _x( 'Edit %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				'update_item' => sprintf( _x( 'Update %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				'add_new_item' => sprintf( _x( 'Add New %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_singular'] ),
				'new_item_name' => sprintf( _x( 'New %s', 'Taxonomy labels', 'folia' ), $taxonomy['label_plural'] ),
				*/
				'menu_name' => $taxonomy['label_plural']
			); 
			
			register_taxonomy( $taxonomy['id'], array( 'bloco' ), array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true
			) );
	 	
		}
	}
    
    /**
     * Add Post Type Meta Box
     * 
     * @uses add_meta_box http://codex.wordpress.org/Function_Reference/add_meta_box
     */
    static function add_post_type_meta_box() {
        
	    add_meta_box( 
	        'post-type-bloco-info',
	        __( 'Redes sociais', 'folia' ),
	        array( __CLASS__, 'meta_box_cb' ),
	        'bloco',
	        'normal',
	        'high'
	    );
	    
    }

    /**
     * Meta box callback
     * 
     */
    static function meta_box_cb( $post ) {
        
        // Cria o nonce para verificação
        wp_nonce_field( 'save_meta', 'meta_noncename' );

	
        foreach ( self::$custom_meta_fields as $field ) {

	        // Recebe os metadados
	        $meta_value =  get_post_meta( $post->ID, $field['id'], true );
	        
	        // Cria a estrutura
	        echo '<p><strong><label for="' . $field['id'] . '">' . $field['label'] . ':</label></strong><br/>';
	        
	        switch ( $field['type'] ) {	
	        	
	        	// Text field
	        	case 'text':
			        echo '<input type="text" id="' . $field['id'] . '" class="widefat" name="' . $field['id'] . '" value="' . esc_attr( $meta_value ) . '" size="25" />';
			    break;

			    // URL field
	        	case 'url':
			        echo '<input type="url" id="' . $field['id'] . '" class="widefat" placeholder="http://" name="' . $field['id'] . '" value="' . esc_attr( $meta_value ) . '" size="25" />';
			    break;
			    
			    // Textarea field
	        	case 'textarea':
			        echo '<textarea id="' . $field['id'] . '" class="widefat" rows="7" name="' . $field['id'] . '">' . esc_attr( $meta_value ) . '</textarea>';
			    break;
			    
			    // Dropdown / Select field
				case 'select':
					echo '<select class="widefat" name="' . $field['id'] . '" id="' . $field['id'] . '">';
					foreach ( $field['options'] as $option ) {
						echo '<option value="' . $option['value'] . '"' , $meta_value == $option['value'] ? ' selected="selected"' : '' , '>' . $option['label'] . '</option>';
					}
					echo '</select>';
				break;
				
				// Upload field
				case 'upload':
					echo '<input type="text" id="' . $field['id'] . '" class="widefat custom-uploader" name="' . $field['id'] . '" value="' . esc_attr( $meta_value ) . '" size="25" />';
					echo '<br/><br/>';
					echo '<a href="#" id="set-default-image" class="custom-uploader-button button thickbox">Fazer upload</a>';
				break;
				
			}
			
			if ( $field['description'] )
				echo '<br/><span class="description">' . $field['description'] . '</span>';
				
			echo '</p>';
	        
        }
        
    }

    /**
     * Save custom fields
     * 
     */
    function save_postdata( $post_id ) {
    	
    	global $post;
    	
    	if ( wp_is_post_revision( $post_id ) ) 
    		return;
        
        // Verifica o autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		  return;
		 
		if ( ! isset ( $post ) )
			return;

		// Não salva o campo caso seja uma revisão
		if ( $post->post_type == 'revision' )
			return; 
		
		// Não salva para outros post types
		if ( $post->post_type != 'bloco' )
			return; 
		
		// Verifica o nonce
        if ( ! wp_verify_nonce( $_POST['meta_noncename'], 'save_meta' ) )
            return;

        // Permissões
        if ( $post->post_type == 'bloco' ) 
		{
			if ( ! current_user_can( 'edit_post', $post_id ) )
		    	return;
		}
		
		foreach ( self::$custom_meta_fields as $field )
		{	
			$old = get_post_meta( $post_id, $field['id'], true );  
			$new = $_POST[$field['id']]; 
			
			if ( $new && $new != $old )
			    update_post_meta( $post_id, $field['id'], $new );  
			elseif ( $new == '' && $old )
				delete_post_meta( $post_id, $field['id'], $old );  
	    }   
    }
    
    /**
	 * Adiciona as coluna Section e Premiére na página de edição
	 *
	 * @since Folia 1.0
	 */
	function manage_bloco_column( $columns ) {
	
		$new = array();
		
		// Adiciona *antes* da coluna de data
	  	foreach( $columns as $key => $title ) {
	    	if ( $key == 'date' ) {
	      		$new['section'] = __( 'Section' );
	      		$new['premiere'] = __( 'Premiere' );
	    	}
	    	
	    	$new[$key] = $title;
	  	}
	  
		return $new;
	  
	}
	
	/**
	 * Lista as sections na coluna de edição de filmes
	 *
	 * @since Folia 1.0
	 */
	function manage_posts_bloco_column( $column, $post_id ) {
	    
	    switch ( $column ) {
			case 'section':
				$terms = get_the_term_list( $post_id , 'section' , '' , ', ' , '' );
				echo ( is_string( $terms ) ) ? strip_tags( $terms ) : '—';
			break;
			case 'premiere':
				$terms = get_the_term_list( $post_id , 'premiere' , '' , ', ' , '' );
				echo ( is_string( $terms ) ) ? strip_tags( $terms ) : '—';
			break;
	        
	    }
	    
	}
    
}

Folia_Post_Type_Bloco::init();