<?
	class Contact_model extends CI_Model { 

		public function __construct(){
			parent::__construct();
		}


		/**
		 * 
		 * Listado de todos los contactos sin discriminacion
		 * @return {array} 
		 */
		public function get_all_contacts(){
			$query = $this->db->get('contacts');
			return $query->result();
		}


		/**
		 * Detalla un contacto en particular
		 * @param {number} $contact_id
		 * @return {object} 
		 */
		public function get_contact($contact_id){

			$this->db->where('id_contact', $contact_id);
			$query = $this->db->get('contacts');

			return $query->row();
		}

		/**
		 * 
		 * Create a simple porfolio
		 * 
		 * @param {string} $contact_id
		 * @param {string} $firstname
		 * @param {string} $lastname
		 * @param {string} $dni
		 * @param {string} $phone
		 * @param {string} $movil
		 * @param {string} $mail
		 * @param {string} $direction
		 * @param {string} $reference
		 * @param {string} $description
		 * @param {number} $status
		 *  
		 * @return {object} Retorna si no se inserto
		 */
		public function create_contact($firstname,$lastname,$dni,$phone,
									 $movil,$mail,$direction,$reference,
									 $description,$status){
			
			$this->db->set('contact_firstname', $firstname);
			$this->db->set('contact_lastname', $lastname);
			$this->db->set('contact_dni', $dni);
			$this->db->set('contact_phone', $phone);
			$this->db->set('contact_movil', $movil);
			$this->db->set('contact_mail', $mail);
			$this->db->set('contact_direction', $direction);
			$this->db->set('contact_reference', $reference);
			$this->db->set('contact_description', $description);
			$this->db->set('contact_status', 0);

			$this->db->insert('contacts');

			return $this->db->insert_id();
		}


		/**
		 * Solo aplicable para el caso en 
		 * caso que el admninistrador genero el contacto, y no desde
		 * el frontend
		 * 
		 * 
		 * Edit a single porfolio
		 * @param {string} $contact_id
		 * @param {string} $firstname
		 * @param {string} $lastname
		 * @param {string} $dni
		 * @param {string} $phone
		 * @param {string} $movil
		 * @param {string} $mail
		 * @param {string} $direction
		 * @param {string} $reference
		 * @param {string} $description
		 * @param {number} $status
		 * 
		 * @return {void}
		 */
		public function edit_contact($contact_id, $firstname,$lastname,$dni,
									 $phone,$movil,$mail,$direction,$reference,
									 $description,$status){
			
			$this->db->set('contact_firstname', $firstname);
			$this->db->set('contact_lastname', $lastname);
			$this->db->set('contact_dni', $dni);
			$this->db->set('contact_phone', $phone);
			$this->db->set('contact_movil', $movil);
			$this->db->set('contact_mail', $mail);
			$this->db->set('contact_direction', $direction);
			$this->db->set('contact_reference', $reference);
			$this->db->set('contact_description', $description);
			$this->db->set('contact_status', $status);

			$this->db->where('id_contact', $contact_id);
			$this->db->update('contacts');
		}
	}

?>