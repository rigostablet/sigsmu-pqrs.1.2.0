<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsResponAddRequest;
use App\Http\Requests\PqrsResponEditRequest;
use App\Models\PqrsRespon;
use Illuminate\Http\Request;
use Exception;
class PqrsResponController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsrespon.list";
		$query = PqrsRespon::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsRespon::search($query, $search); // search table records
		}

		$orderby = $request->orderby ?? "pqrs_respon.id_respon";
		$ordertype = $request->ordertype ?? "desc";
		$query->leftJoin("pqrs_ent", "pqrs_respon.id_ent_resp", "=", "pqrs_ent.id_ent");// conexión con la tabla pqrs_ent
		$query->leftJoin("pqrs_carg", "pqrs_respon.cargo_resp", "=", "pqrs_carg.id_carg");// conexión con la tabla pqrs_carg
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRespon::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsRespon::query();
		$record = $query->findOrFail($rec_id, PqrsRespon::viewFields());
		return $this->renderView("pages.pqrsrespon.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsrespon.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsResponAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsRespon record
		$record = PqrsRespon::create($modeldata);
		$rec_id = $record->id_respon;
		return $this->redirect("pqrsrespon", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsResponEditRequest $request, $rec_id = null){
		$query = PqrsRespon::query();
		$record = $query->findOrFail($rec_id, PqrsRespon::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrsrespon", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrsrespon.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = PqrsRespon::query();
		$query->whereIn("id_respon", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
