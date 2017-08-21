<?

abstract class IData_operation {

	public function create($data);
	public function edit($id, $data);
	public function remove($id);
	public function get_by_id($id);
	public function get_all();

}

?>