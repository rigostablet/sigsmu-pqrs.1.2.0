<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsRespuAddRequest;
use App\Http\Requests\PqrsRespuEditRequest;
use App\Models\PqrsRespu;
use Illuminate\Http\Request;
use Exception;
class PqrsRespuController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsrespu.list";
		$query = PqrsRespu::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsRespu::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_respu.id_respu";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRespu::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsRespu::query();
		$record = $query->findOrFail($rec_id, PqrsRespu::viewFields());
		return $this->renderView("pages.pqrsrespu.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsrespu.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsRespuAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsRespu record
		$record = PqrsRespu::create($modeldata);
		$rec_id = $record->id_respu;
		return $this->redirect("pqrsrespu", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsRespuEditRequest $request, $rec_id = null){
		$query = PqrsRespu::query();
		$record = $query->findOrFail($rec_id, PqrsRespu::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrsrespu", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrsrespu.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsRespu::query();
		$query->whereIn("id_respu", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
