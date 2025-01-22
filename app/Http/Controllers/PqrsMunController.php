<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsMunAddRequest;
use App\Http\Requests\PqrsMunEditRequest;
use App\Models\PqrsMun;
use Illuminate\Http\Request;
use Exception;
class PqrsMunController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsmun.list";
		$query = PqrsMun::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsMun::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "pqrs_mun.id_mun";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsMun::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsMun::query();
		$record = $query->findOrFail($rec_id, PqrsMun::viewFields());
		return $this->renderView("pages.pqrsmun.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsmun.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsMunAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsMun record
		$record = PqrsMun::create($modeldata);
		$rec_id = $record->id_mun;
		return $this->redirect("pqrsmun", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsMunEditRequest $request, $rec_id = null){
		$query = PqrsMun::query();
		$record = $query->findOrFail($rec_id, PqrsMun::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrsmun", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrsmun.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsMun::query();
		$query->whereIn("id_mun", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
