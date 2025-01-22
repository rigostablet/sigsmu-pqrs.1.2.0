<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsPetAddRequest;
use App\Http\Requests\PqrsPetEditRequest;
use App\Models\PqrsPet;
use Illuminate\Http\Request;
use Exception;
class PqrsPetController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrspet.list";
		$query = PqrsPet::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsPet::search($query, $search); // search table records
		}
		$query->join("pqrs_ent", "pqrs_pet.pet_ent", "=", "pqrs_ent.id_ent");
		$query->join("pqrs_carg", "pqrs_pet.carg_pet", "=", "pqrs_carg.id_carg");
		$query->join("pqrs_tipent", "pqrs_pet.id_ent", "=", "pqrs_tipent.id_tip");
		$orderby = $request->orderby ?? "pqrs_pet.id_pet";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsPet::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsPet::query();
		$query->join("pqrs_ent", "pqrs_pet.pet_ent", "=", "pqrs_ent.id_ent");
		$query->join("pqrs_carg", "pqrs_pet.carg_pet", "=", "pqrs_carg.id_carg");
		$query->join("pqrs_tipent", "pqrs_pet.id_ent", "=", "pqrs_tipent.id_tip");
		$record = $query->findOrFail($rec_id, PqrsPet::viewFields());
		return $this->renderView("pages.pqrspet.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrspet.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsPetAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsPet record
		$record = PqrsPet::create($modeldata);
		$rec_id = $record->id_pet;
		return $this->redirect("pqrspet", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsPetEditRequest $request, $rec_id = null){
		$query = PqrsPet::query();
		$record = $query->findOrFail($rec_id, PqrsPet::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("pqrspet", "Notificación enviada al correo!!!");
		}
		return $this->renderView("pages.pqrspet.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsPet::query();
		$query->whereIn("id_pet", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
