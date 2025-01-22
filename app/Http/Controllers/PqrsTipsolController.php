<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsTipsolAddRequest;
use App\Http\Requests\PqrsTipsolEditRequest;
use App\Models\PqrsTipsol;
use Illuminate\Http\Request;
use Exception;
class PqrsTipsolController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrstipsol.list";
		$query = PqrsTipsol::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsTipsol::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_tipsol.id_tipsol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsTipsol::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsTipsol::query();
		$record = $query->findOrFail($rec_id, PqrsTipsol::viewFields());
		return $this->renderView("pages.pqrstipsol.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrstipsol.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsTipsolAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsTipsol record
		$record = PqrsTipsol::create($modeldata);
		$rec_id = $record->id_tipsol;
		return $this->redirect("pqrstipsol", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsTipsolEditRequest $request, $rec_id = null){
		$query = PqrsTipsol::query();
		$record = $query->findOrFail($rec_id, PqrsTipsol::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrstipsol", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrstipsol.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsTipsol::query();
		$query->whereIn("id_tipsol", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
