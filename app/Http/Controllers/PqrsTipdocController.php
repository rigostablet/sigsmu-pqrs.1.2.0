<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsTipdocAddRequest;
use App\Http\Requests\PqrsTipdocEditRequest;
use App\Models\PqrsTipdoc;
use Illuminate\Http\Request;
use Exception;
class PqrsTipdocController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrstipdoc.list";
		$query = PqrsTipdoc::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsTipdoc::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_tipdoc.id_tipdoc";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsTipdoc::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsTipdoc::query();
		$record = $query->findOrFail($rec_id, PqrsTipdoc::viewFields());
		return $this->renderView("pages.pqrstipdoc.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrstipdoc.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsTipdocAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsTipdoc record
		$record = PqrsTipdoc::create($modeldata);
		$rec_id = $record->id_tipdoc;
		return $this->redirect("pqrstipdoc", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsTipdocEditRequest $request, $rec_id = null){
		$query = PqrsTipdoc::query();
		$record = $query->findOrFail($rec_id, PqrsTipdoc::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrstipdoc", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrstipdoc.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsTipdoc::query();
		$query->whereIn("id_tipdoc", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
