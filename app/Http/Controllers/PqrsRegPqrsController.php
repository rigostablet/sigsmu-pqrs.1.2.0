<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsRegPqrsAddRequest;
use App\Http\Requests\PqrsRegPqrsEditRequest;
use App\Http\Requests\PqrsRegPqrsadd_pqrs_contratRequest;
use App\Models\PqrsRegPqrs;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PqrsregpqrsListPqrsTotalContExport;
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
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->leftjoin("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$query->leftjoin("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->leftJoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu"); //Con esto creamos la relacion entre las dos tablas para mostras datos de pqrs_respu
		$query->leftJoin("pqrs_pet", "pqrs_reg_pqrs.id_pet", "=", "pqrs_pet.id_pet"); // consulta con tabla peticionarios y trae todos los registros igual por el id_pet a la tabla pqrsregpqrs con o sin respuesta
		$query->leftjoin("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftjoin("pqrs_dpto", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_dpto.cod_mun");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$ofi_act    = "ofic_usu_sol";
		$usu_act    = Auth()->user()->oficina;
		if($ofi_act){
			$query->where($ofi_act , $usu_act); //filter by a table field
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
		$query->join("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->join("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftjoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu");
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
			//$modeldata['rad_sol'] = $fileInfo['fileext'];
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
		return $this->redirect($redirectUrl, "eliminado con éxito");
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
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->leftjoin("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$query->leftjoin("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->leftjoin("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftjoin("pqrs_dpto", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_dpto.cod_mun");
		$query->leftJoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu");// consulta con tabla respuesta y trae todos los registros igual de la tabla pqrsregpqrs con o sin respuesta
		$query->leftJoin("pqrs_pet", "pqrs_reg_pqrs.id_pet", "=", "pqrs_pet.id_pet"); // consulta con tabla peticionarios y trae todos los registros igual por el id_pet a la tabla pqrsregpqrs con o sin respuesta
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname  = "regsol_est";
		$fieldvalue = 'SIN ASIGNAR';
		$ofi_act    = "ofic_usu_sol";
		$usu_act    = Auth()->user()->oficina;
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		
		if($ofi_act){
			$query->where($ofi_act , $usu_act); //filter by a table field
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
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->leftjoin("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$query->leftjoin("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->leftjoin("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftJoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu");
		$query->leftJoin("pqrs_pet", "pqrs_reg_pqrs.id_pet", "=", "pqrs_pet.id_pet");
		$query->leftjoin("pqrs_dpto", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_dpto.cod_mun");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname  = "regsol_est";
		$fieldvalue = 'ASIGNADO';
		$ofi_act    = "ofic_usu_sol";
		$usu_act    = Auth()->user()->oficina;
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($ofi_act){
			$query->where($ofi_act , $usu_act); //filter by a table field
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
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->leftjoin("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$query->leftjoin("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftjoin("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->leftJoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu");
		$query->leftjoin("pqrs_dpto", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_dpto.cod_mun");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname  = "regsol_est";
		$fieldvalue = 'RESUELTA';
		$ofi_act    = "ofic_usu_sol";
		$usu_act    = Auth()->user()->oficina;
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($ofi_act){
			$query->where($ofi_act , $usu_act); //filter by a table field
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
		$query->leftjoin("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$query->leftjoin("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->leftjoin("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftjoin("pqrs_ent", "pqrs_reg_pqrs.ofic_usu_sol", "=", "pqrs_ent.id_ent");
		$query->leftJoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu");
		$query->leftJoin("pqrs_pet", "pqrs_reg_pqrs.id_pet", "=", "pqrs_pet.id_pet");
		$query->leftjoin("pqrs_dpto", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_dpto.cod_mun");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$fieldname   = 'usu_sol';
		$fieldvalue  = auth()->user()->username;
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
		$query = PqrsRegPqrs::query()->distinct();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PqrsRegPqrs::search($query, $search); // search table records
			if ($request->ajax()) {
				$view = "pages.pqrsregpqrs.search"; // use search component for dropdown search 
			}
		}
		$query->leftjoin("pqrs_tipsol", "pqrs_reg_pqrs.tip_sol", "=", "pqrs_tipsol.id_tipsol");
		$query->leftjoin("pqrs_ent", "pqrs_reg_pqrs.ofic_usu_sol", "=", "pqrs_ent.id_ent");
		$query->leftjoin("user", "pqrs_reg_pqrs.ofic_usu_sol", "=", "user.oficina");
		$query->leftJoin("pqrs_respu", "pqrs_reg_pqrs.rad_sol", "=", "pqrs_respu.rad_respu");// consulta con tabla respuesta y trae todos los registros igual de la tabla pqrsregpqrs con o sin respuesta
		$query->leftJoin("pqrs_pet", "pqrs_reg_pqrs.id_pet", "=", "pqrs_pet.id_pet"); // consulta con tabla peticionarios y trae todos los registros igual por el id_pet a la tabla pqrsregpqrs con o sin respuesta
		$query->leftjoin("pqrs_mun", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_mun.cod_mun");
		$query->leftJoin("pqrs_dpto", "pqrs_reg_pqrs.mun_sol", "=", "pqrs_dpto.cod_mun");
		$orderby = $request->orderby ?? "pqrs_reg_pqrs.id_sol";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportListPqrsTotalCont($query); // export current query
		}
		$records = $query->paginate($limit, PqrsRegPqrs::listPqrsTotalContFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportListPqrsTotalCont($query){
	ob_start();	
	ob_end_clean(); // clean any output to allow file download
		$filename = "ListPqrsTotal_Report-" . date_now(); // nombre con sale el archivo descargado
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(PqrsRegPqrs::exportListPqrsTotalContFields());
			return Excel::download(new PqrsregpqrsListPqrsTotalContExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	
	}
	
}
