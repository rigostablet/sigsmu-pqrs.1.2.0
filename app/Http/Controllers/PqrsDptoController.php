<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsDptoAddRequest;
use App\Http\Requests\PqrsDptoEditRequest;
use App\Models\PqrsDpto;
use Illuminate\Http\Request;
use Exception;
class PqrsDptoController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsdpto.list";
		$query = PqrsDpto::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsDpto::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_dpto.id_dpto";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsDpto::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsDpto::query();
		$record = $query->findOrFail($rec_id, PqrsDpto::viewFields());
		return $this->renderView("pages.pqrsdpto.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsdpto.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsDptoAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsDpto record
		$record = PqrsDpto::create($modeldata);
		$rec_id = $record->id_dpto;
		return $this->redirect("pqrsdpto", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsDptoEditRequest $request, $rec_id = null){
		$query = PqrsDpto::query();
		$record = $query->findOrFail($rec_id, PqrsDpto::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrsdpto", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrsdpto.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsDpto::query();
		$query->whereIn("id_dpto", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
