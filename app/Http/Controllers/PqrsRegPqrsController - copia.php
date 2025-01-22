<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsRegPqrsAddRequest;
use App\Http\Requests\PqrsRegPqrsEditRequest;
use App\Http\Requests\PqrsRegPqrsadd_pqrs_contratRequest;
use App\Models\PqrsRegPqrs;
use Illuminate\Http\Request;
use Exception;
class PqrsRegPqrsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsregpqrs.list";
		$query = PqrsRegPqrs::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRegPqrs::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsRegPqrs::query();
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$record = $query->findOrFail($rec_id, PqrsRegPqrs::viewFields());
		return $this->renderView("pages.pqrsregpqrs.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.pqrsregpqrs.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsregpqrs.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsRegPqrsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("regsol_photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['regsol_photo'], "regsol_photo");
			$modeldata['regsol_photo'] = $fileInfo['filepath'];
			$modeldata['rad_sol'] = $fileInfo['fileext'];
		}
		
		//save PqrsRegPqrs record
		$record = PqrsRegPqrs::create($modeldata);
		$rec_id = $record->id_sol;
		return $this->redirect("pqrsregpqrs/pqrs_sin_asignar", "pqrs agregada exitosamente!!!");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsRegPqrsEditRequest $request, $rec_id = null){
		$query = PqrsRegPqrs::query();
		$record = $query->findOrFail($rec_id, PqrsRegPqrs::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("regsol_photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['regsol_photo'], "regsol_photo");
			$modeldata['regsol_photo'] = $fileInfo['filepath'];
			$modeldata['rad_sol'] = $fileInfo['fileext'];
		}
			$record->update($modeldata);
			return $this->redirect("pqrsregpqrs", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.pqrsregpqrs.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PqrsRegPqrs::query();
		$query->whereIn("id_sol", $arr_id);
		$records = $query->get(['regsol_photo']); //get records files to be deleted before delete
		$query->delete();
		foreach($records as $record){
			$this->deleteRecordFiles($record['regsol_photo'], "regsol_photo"); //delete file after record delete
		}
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function pqrs_sin_asignar(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsregpqrs.pqrs_sin_asignar";
		$query = PqrsRegPqrs::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname  = "regsol_est";
		$fieldvalue = 'SIN ASIGNAR';
		$fielname_usu_sol = "usu_sol"; // toma de este campo
		$logueado = auth()->user()->username; // el usuario logueado
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($fielname_usu_sol){
			$query->where($fielname_usu_sol , $logueado); //filter by a table field usuario logueado
		}
		$records = $query->paginate($limit, PqrsRegPqrs::pqrsSinAsignarFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function pqrs_asignados(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsregpqrs.pqrs_asignados";
		$query = PqrsRegPqrs::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname  = "regsol_est";
		$fieldvalue = 'ASIGNADO';
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRegPqrs::pqrsAsignadosFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function pqrs_respond(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsregpqrs.pqrs_respond";
		$query = PqrsRegPqrs::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname  = "regsol_est";
		$fieldvalue = 'RESUELTA';
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRegPqrs::pqrsRespondFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function list_pqrs_contrat(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsregpqrs.list_pqrs_contrat";
		$query = PqrsRegPqrs::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname   = 'usu_sol';
		$fieldvalue  = auth()->user()->username;
		#$fieldname2  = "regsol_est";
		#$fieldvalue2 = 'SIN ASIGNAR';
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRegPqrs::listPqrsContratFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add_pqrs_contrat(){
		return $this->renderView("pages.pqrsregpqrs.add_pqrs_contrat");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add_pqrs_contrat_store(PqrsRegPqrsadd_pqrs_contratRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("regsol_photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['regsol_photo'], "regsol_photo");
			$modeldata['regsol_photo'] = $fileInfo['filepath'];
			$modeldata['rad_sol'] = $fileInfo['filename'];
		}
		
		//save PqrsRegPqrs record
		$record = PqrsRegPqrs::create($modeldata);
		$rec_id = $record->id_sol;
		return $this->redirect("pqrsregpqrs/list_pqrs_contrat", "pqrs agregada exitosamente!!!");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function list_pqrs_total_cont_(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsregpqrs.list_pqrs_total_cont_";
		$query = PqrsRegPqrs::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->join("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsRegPqrs::listPqrsTotalContFields());
		return $this->renderView($view, compact("records"));
	}
}
