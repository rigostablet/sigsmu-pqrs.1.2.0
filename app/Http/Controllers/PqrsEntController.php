<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsEntAddRequest;
use App\Http\Requests\PqrsEntEditRequest;
use App\Models\PqrsEnt;
use Illuminate\Http\Request;
use Exception;
class PqrsEntController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsent.list";
		$query = PqrsEnt::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PqrsEnt::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_ent.id_ent";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsEnt::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsEnt::query();
		$record = $query->findOrFail($rec_id, PqrsEnt::viewFields());
		return $this->renderView("pages.pqrsent.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsent.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsEntAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsEnt record
		$record = PqrsEnt::create($modeldata);
		$rec_id = $record->id_ent;
		return $this->redirect("pqrsent", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsEntEditRequest $request, $rec_id = null){
		$query = PqrsEnt::query();
		$record = $query->findOrFail($rec_id, PqrsEnt::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrsent", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrsent.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsEnt::query();
		$query->whereIn("id_ent", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
