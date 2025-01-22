<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsCargAddRequest;
use App\Http\Requests\PqrsCargEditRequest;
use App\Models\PqrsCarg;
use Illuminate\Http\Request;
use Exception;
class PqrsCargController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrscarg.list";
		$query = PqrsCarg::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsCarg::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_carg.id_carg";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsCarg::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsCarg::query();
		$record = $query->findOrFail($rec_id, PqrsCarg::viewFields());
		return $this->renderView("pages.pqrscarg.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrscarg.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsCargAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsCarg record
		$record = PqrsCarg::create($modeldata);
		$rec_id = $record->id_carg;
		return $this->redirect("pqrscarg", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsCargEditRequest $request, $rec_id = null){
		$query = PqrsCarg::query();
		$record = $query->findOrFail($rec_id, PqrsCarg::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrscarg", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrscarg.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsCarg::query();
		$query->whereIn("id_carg", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
