<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotPqrsAddRequest;
use App\Http\Requests\NotPqrsEditRequest;
use App\Models\NotPqrs;
use Illuminate\Http\Request;
use Exception;
class NotPqrsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.notpqrs.list";
		$query = NotPqrs::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			NotPqrs::search($query, $search); // search table records
		}
		$query->join("pqrs_respon", "not_pqrs.pqrs_not_nom", "=", "pqrs_respon.id_respon");
		$orderby = $request->orderby ?? "not_pqrs.id_not";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, NotPqrs::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = NotPqrs::query();
		$query->join("pqrs_respon", "not_pqrs.pqrs_not_nom", "=", "pqrs_respon.id_respon");
		$record = $query->findOrFail($rec_id, NotPqrs::viewFields());
		return $this->renderView("pages.notpqrs.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.notpqrs.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(NotPqrsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save NotPqrs record
		$record = NotPqrs::create($modeldata);
		$rec_id = $record->id_not;
		return $this->redirect("notpqrs", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(NotPqrsEditRequest $request, $rec_id = null){
		$query = NotPqrs::query();
		$record = $query->findOrFail($rec_id, NotPqrs::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("notpqrs", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.notpqrs.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = NotPqrs::query();
		$query->whereIn("id_not", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
