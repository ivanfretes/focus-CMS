<?
	class Contact_model extends CI_Model { 

		public function __construct(){
			parent::__construct();
			$this->table = 'contacts';
		}

		/**
		 * Lista todos los contactos
		 * @return {array} 
		 */
		public function get_all($start,$cant){
			$this->db->limit($cant, $start)
				 ->order_by('contact_date_created', 'DESC');

			$query = $this->db->get($this->table);
			return $query->result();
		}


		/**
		 * Elimina un contacto
		 * 
		 * @param {number} $page_id
		 * @return {boolean}
		 */
		public function remove($contact_id){
			$this->db->where('contact_id', $contact_id);
			if ($this->db->delete($this->table)) return TRUE;
			return FALSE;
		}


		/**
		 * Detalla un contacto
		 * @param {number} $contact_id
		 * @return {object} 
		 */
		public function get($contact_id){

			$this->db->where('id_contact', $contact_id);
			$query = $this->db->get('contacts');

			return $query->row();
		}

		/**
		 * 
		 * Create a simple porfolio
		 * Requiere que el nombre de la persona este inicializado
		 * 
		 * @param {array} $data
		 */
		public function create($contact_data){
			if (!not_value($contact_data)){ 
				if ($this->db->insert($this->table, $contact_data)) 
					return TRUE;
			}
			return FALSE;
		}


		/**
		 * Edita un contacto, Puede cambiar el estado del contacto
		 * 
		 * @param {number} $contact_id
		 * @param {array} $contact_data
		 * @return {boolean}
		 */
		public function edit($contact_id, $contact_data){
			$this->db->where('contact_id', $contact_id);
			if ($this->db->update($this->table,$data)) 
				return TRUE; 
			return FALSE;
		}


		/**
		 * Cuenta la cantidad de contactos generados
		 * @return {number} 
		 */
		public function get_count(){
			$this->db->select('COUNT(1) AS cantContact');
			$query = $this->db->get('contacts');

			return $query->row()->cantContact;    
		}
	}

	

?>