<?

	/**
	 * Custom library for the create widget
	 * 
	 * @package GestionCMS
	 * @subpackage Website/library/widget
	 * @author Ivan Fretes
	 * 
	 */
	class Widget_model extends CI_Model { 

		public function __construct(){
			//parent::__construct();
		}

		/**
		 * -- Create the single widget --
		 */


		/**
		 * List a widget by a page
		 * 
		 * @param {number} $page_id
		 * @return {array}
		 * 
		 */
		public function get_widget_list($page_id){
			$this->db->where('page',$page_id);
			$this->db->order_by('widget_orderly','asc');
			$query = $this->db->get('widgets');
			
			return $query->result();
		}

		/**
		 * Remove the widget by id
		 * @param number $widget_id 
		 * 
		*/
		public function remove_widget($widget_id){
			$this->db->where('id_widget', $widget_id);
			$this->db->delete('widgets');
		}


		/**
		 * Widget Detail
		 * 
		 * @param {number} $widget_id
		 * @return {object} 
		 */
		public function get_widget($widget_id){
			$this->db->where('id_wiget',$widget_id);
			$query = $this->db->get('widgets');

			return $query->row();
		}

		

		/**
		 * Create a widget (jocker) 
		 * @param datatype $paramname description
		 */
		public function create_widget($page_id, $widget_name, 
									  $atributes, $order){

			// component is instead the widget_name
			$data = array('page' => $page_id, 
						  'component' => $widget_name, 
						  'widget_atributes' => $atributes,
						  'widget_orderly' => $order);

	    	$this->db->insert('widgets',$data);
	    	return $this->db->insert_id();
		}


		public function ordered_widget($widget_id,$order){

			$this->db->where('id_widget', $widget_id);
			$this->db->set('widget_orderly',$order);

			$this->db->update('widgets');
		}



		/**
		 *  -- Rows column --
		*/


			/**
			 * Create a widget ide row with 2 column
			 * @param datatype $paramname description
			 * @param {string} $row_title
			 * @param {string} $row_subtitle
			 * @param {string} $row_content
			 * @param {string} $row_btn_title
			 * @param {string} $row_btn_link
			 * @param {string} $row_orientation
			 * @param {number} $widget_id ID
			 * 
			 * @return {number} Return the row_id
			 */
			public function create_single_row($row_title,$row_subtitle,
											  $row_content, $row_btn_title,
											  $row_btn_link, $row_orientation,
											  $widget_id) {


			
				$this->db->set('row_title',$row_title);
				$this->db->set('row_subtitle',$row_subtitle);
				$this->db->set('row_content',$row_content);
				$this->db->set('row_btn_title',$row_btn_title);
				$this->db->set('row_btn_link',$row_btn_link);
				$this->db->set('row_orientation',$row_orientation);
				$this->db->set('widget',$widget_id);

				$this->db->insert('widget_rows');
				return $this->db->insert_id();
				
			}

			/**
			 * Get The single row detail, by row id or 
			 * of the widget
			 * 
			 * @param {number} $row_value
			 * @return {object}
			 */
			public function get_single_row($row_value){
				$this->db->where('id_row',$row_value);
				$this->db->or_where('widget',$row_value);
				$query = $this->db->get('widget_rows');
				
				return $query->row();
			}


			/**
			 * Edit a single row with id row
			 * @param datatype $paramname description
			 * @param {string} $row_title
			 * @param {string} $row_subtitle
			 * @param {string} $row_content
			 * @param {string} $row_btn_title
			 * @param {string} $row_btn_link
			 * @param {string} $row_orientation
			 * @param {number} $row_id 
			 * 
			 * @return {boolean} 
			 */
			public function edit_single_row($row_title,$row_subtitle,
											$row_content, $row_btn_title,
											$row_btn_link, $row_orientation,
											$row_id) {


				// queda pendiente el row
				// row_img o row_link video
				// if ('' !== $image)
				// 	$this->db->set('', $image);
			

				if (isset($row_content)) 
					$this->db->set('row_content',$row_content);

				$this->db->set('row_title',$row_title)
					->set('row_subtitle',$row_subtitle)
					->set('row_btn_title',$row_btn_title)
					->set('row_btn_link',$row_btn_link)
					->set('row_orientation',$row_orientation)
					
					->where('id_row',$row_id);

				if ($this->db->update('widget_rows')) return TRUE;
				return FALSE;
				
			}


		/**
		 * -- Slides -- 
		 */

			/**
			 * Get the slide by widget id
			 * @param {number} $widget_id
			 * @return {array}
			 */
			public function get_slide_list($widget_id){
				$this->db->where('widget',$widget_id);
				$query = $this->db->get('widget_slides');

				return $query->result();
			}


			/**
			 * Get the slide by ID slide
			 * @param {number} $slide_id
			 * @return {array}
			 */
			public function get_slide($slide_id){
				$this->db->where('widget_slides',$widget_id);
				$query = $this->db->get('slide');

				return $query->result();
			}

			/**
			 * 
			 * Create a simple slide
			 * 
			 * @param {number} $page_id, 
			 * @param {string} $image, 
			 * @param {string} $title, 
			 * @param {string} $description
			 * @param {number} $order
			 * 
			 * @return {object} Return the record insert
			 */
			public function create_slide($widget_id, $image, $title, 
										 $description, $order){
				
				if ('' !== $image)
					$this->db->set('slide_image', $image);
				
				$this->db->set('widget', $widget_id);
				$this->db->set('slide_title', $title);
				$this->db->set('slide_description', $description);
				$this->db->set('slide_order', $order);

				$this->db->insert('widget_slides');

				return $this->db->insert_id();
			}


			/**
			 * 
			 * Edit a slide
			 * 
			 * @param {number} $page_id, 
			 * @param {string} $image, 
			 * @param {string} $title, 
			 * @param {string} $description
			 * @param {number} $order
			 * 
			 * @return {void}
			 */
			public function edit_slide($slide_id, $image, $title, 
									   $description, $order){

				if ('' !== $image)
					$this->db->set('slide_image', $image);

				if ('' !== $order)
					$this->db->set('slide_order', $order);

				$this->db->set('slide_title', $title);
				$this->db->set('slide_description', $description);
				
				$this->db->where('slide_id', $slide_id);
				$this->db->update('widget_slides');
			}


			/**
			 * Remove slide by id
			 * 
			 * @param {number} $slide_id
			 */
			public function remove_slide($slide_id){
				$this->db->where('id_slide',$slide_id);
				$this->db->delete('widget_slides');
			}

		/**
		 * -- Portfolio -- 
		 */


			/**
			 * Get the list portfolio by widget id
			 * @param {number} $widget_id
			 * @return {array}
			 */
			public function get_portfolio_list($widget_id){
				$this->db->where('widget',$widget_id);
				$query = $this->db->get('widget_portfolio');

				return $query->result();
			}

			/**
			 * Get the portfolio detail by id portfolio
			 * @param {number} $portfolio id
			 * @return {array}
			 */
			public function get_portfolio($portfolio_id){
				$this->db->where('portfolio_id',$portfolio_id);
				$query = $this->db->get('widget_portfolio');

				return $query->row();
			}

			/**
			 * 
			 * Create a simple portfolio
			 * 
			 * @param {number} $page_id, 
			 * @param {string} $image, 
			 * @param {string} $title, 
			 * @param {string} $description
			 * @param {number} $order
			 * 
			 * @return {object} Return the record insert
			 */
			public function create_portfolio($widget_id, $image, $title, 
										     $description, $order){
				$this->db->set('widget', $widget_id);
				$this->db->set('portfolio_image', $image);
				$this->db->set('portfolio_title', $title);
				$this->db->set('portfolio_description', $description);
				$this->db->set('portfolio_order', $order);	

				$this->db->insert('widget_portfolio');

				return $this->db->insert_id();

			}


			/**
			 * 
			 * Edit a single portfolio
			 * 
			 * @param {number} $portfolio_id, 
			 * @param {string} $image, 
			 * @param {string} $title, 
			 * @param {string} $description
			 * @param {number} $order
			 * 
			 * @return {void}
			 */
			public function edit_portfolio($portfolio_id, $image, $title, 
										  $description, $order){
				

				if ('' !== $image)
					$this->db->set('portfolio_image', $image);	
				
				if ('' !== $order)
					$this->db->set('portfolio_order', $order);

				$this->db->set('portfolio_title', $title);
				$this->db->set('portfolio_description', $description);

				$this->db->where('portfolio_id', $portfolio_id);
				$this->db->update('widget_portfolio');

			}



			/**
			 * Remove portfolio by ID portfolio
			 * 
			 * @param {number} $portfolio_id
			 */
			public function remove_portfolio($portfolio_id){
				$this->db->where('id_portfolio',$slide_id);
				$this->db->delete('widget_portfolio');
			}


			/**
			 * -- Grid --
			 */


			/**
			 * Get the list portfolio by widget id
			 * @param {number} $widget_id
			 * @return {array}
			 */
			public function get_grid_list($widget_id){
				$this->db->where('widget',$widget_id);
				$query = $this->db->get('widget_grid');

				return $query->result();
			}

			/**
			 * Get the portfolio detail by id portfolio
			 * @param {number} $portfolio id
			 * @return {array}
			 */
			public function get_grid($portfolio_id){
				$this->db->where('portfolio_id',$portfolio_id);
				$query = $this->db->get('widget_grid');

				return $query->row();
			}

			/**
			 * 
			 * Create a simple portfolio
			 * 
			 * @param {number} $page_id, 
			 * @param {string} $image, 
			 * @param {string} $title, 
			 * @param {string} $description
			 * @param {number} $order
			 * 
			 * @return {object} Return the record insert
			 */
			public function create_grid($widget_id, $image, $title, 
										$description, $order){
				$this->db->set('widget', $widget_id);
				$this->db->set('portfolio_image', $image);
				$this->db->set('portfolio_title', $title);
				$this->db->set('portfolio_description', $description);
				$this->db->set('portfolio_order', $order);	

				$this->db->insert('widget_grid');

				return $this->db->insert_id();

			}


			/**
			 * 
			 * Edit a single portfolio
			 * 
			 * @param {number} $portfolio_id, 
			 * @param {string} $image, 
			 * @param {string} $title, 
			 * @param {string} $description
			 * @param {number} $order
			 * 
			 * @return {void}
			 */
			public function edit_grid($grid_id, $image, $title, 
									  $description, $order){
				

				if ('' !== $image)
					$this->db->set('portfolio_image', $image);	
				
				if ('' !== $order)
					$this->db->set('portfolio_order', $order);

				$this->db->set('portfolio_title', $title);
				$this->db->set('portfolio_description', $description);

				$this->db->where('portfolio_id', $portfolio_id);
				$this->db->update('widget_grid');

			}



			/**
			 * Remove portfolio by ID portfolio
			 * 
			 * @param {number} $portfolio_id
			 */
			public function remove_grid($portfolio_id){
				$this->db->where('id_portfolio',$slide_id);
				$this->db->delete('widget_grid');
			}

	}

?>