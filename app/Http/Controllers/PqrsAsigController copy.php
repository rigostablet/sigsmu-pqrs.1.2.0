<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsAsigAddRequest;
use App\Http\Requests\PqrsAsigEditRequest;
use App\Models\PqrsAsig;
use App\Models\Pqrsregpqrs;
use Illuminate\Mail\Mailable; //Agregado nuevo
use Illuminate\Support\Facades\Mail; //clase que maneja el mail
use App\Mail\Mailpqrs; //agregar la clase que se creo para el envio de lso emails
use Illuminate\Http\Request;
use Exception;
class PqrsAsigController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pqrsasig.list";
		$query = PqrsAsig::query();
		$limit = $request->limit ?? 100;
		if($request->search){
			$search = trim($request->search);
			PqrsAsig::search($query, $search); // search table records
		}
		$query->join("pqrs_respon", "pqrs_asig.id_resp_asig", "=", "pqrs_respon.id_respon");
		$query->join("pqrs_ent", "pqrs_asig.id_ent_asig", "=", "pqrs_ent.id_ent");
		$orderby = $request->orderby ?? "pqrs_asig.id_asig";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PqrsAsig::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PqrsAsig::query();
		$query->join("pqrs_respon", "pqrs_asig.id_resp_asig", "=", "pqrs_respon.id_respon");
		$query->join("pqrs_ent", "pqrs_asig.id_ent_asig", "=", "pqrs_ent.id_ent");
		$record = $query->findOrFail($rec_id, PqrsAsig::viewFields());
		return $this->renderView("pages.pqrsasig.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pqrsasig.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PqrsAsigAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PqrsAsig record
		$record = PqrsAsig::create($modeldata);
		$rec_id = $record->id_asig;
		return $this->redirect("pqrsasig", "Grabar agregado exitosamente");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PqrsAsigEditRequest $request, $rec_id = null){
		$query = PqrsAsig::query();
		$record = $query->findOrFail($rec_id, PqrsAsig::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			$this->afterEdit($rec_id, $record);
			$obser= $record->id_rad_asig;
			$cor=$record->email_asig;
			$rad= $record->id_rad_asig;
			$obser= $record->observacion;
			return $this->redirect("pqrsasig", "" .$rad. " notificada con exito!!!");
			
		}
		return $this->renderView("pages.pqrsasig.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
    /**
     * After page record updated
     * @param string $rec_id // updated record id
     * @param array $record // updated page record
     */
    function afterEdit($rec_id,$record){
        $queryreg = Pqrsregpqrs::query(); //se conecta a la tabla Pqrsregpqrs para poder llamar los campos
        $recordreg = $queryreg->findOrFail($rec_id, Pqrsregpqrs::editFields()); //se obtienen y se almacenan los registros de la tabla
        $query_asig = PqrsAsig::query(); //se conecta a la tabla Pqrsregpqrs para poder llamar los campos
        $recor_asig = $query_asig->findOrFail($rec_id, PqrsAsig::editFields()); //se obtienen y se almacenan los registros de la tabla
		$photoreg = $recordreg->regsol_photo; // se toma la imagen del campo
        $respo = $recordreg->id_asig_sol; // se toma el nombre del responsable
        $radicado = $recordreg->rad_sol; // se toma el número del radicado
        $correo =$recordreg->email_sol; // se toma el correo electrónico del subformulario
        $noment = $recordreg->nom_ent_sol; // se toma el campo entidad
        $nompet =$recordreg->nom_pet_sol; // se toma  el campo peticionario
        $diaspen =$recordreg->diaspen_sol;  // se toma el campo dias pendientes
        $fecresp=$recordreg->fecrep_sol; // se toma campo fecha respuesta
        $fecsol    = $recordreg->fec_sol; // se toma campo fecha radicado
		$obser = $recor_asig->observacion;
        Mail::to($correo)->send(new Mailpqrs($correo,$photoreg,$respo,$radicado,$noment,$fecresp,$nompet,$diaspen,$fecsol, $obser)); // se ejecuta el envio del email con el controlador Mailpqrs 
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
		$query = PqrsAsig::query();
		$query->whereIn("id_asig", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Grabar eliminado con éxito");
	}
}
