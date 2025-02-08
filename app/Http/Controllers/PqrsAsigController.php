<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PqrsAsigAddRequest;
use App\Http\Requests\PqrsAsigEditRequest;
use App\Models\PqrsAsig;
use App\Models\User;
use App\Models\Pqrsregpqrs;
use Illuminate\Mail\Mailable; //Agregado nuevo
use Illuminate\Support\Facades\Mail; //clase que maneja el mail
use App\Mail\Mailpqrs; //agregar la clase que se creo para el envio de lso emails
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mailer\Exception\TransportException;
use Swift_SmtpTransport;
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
		return $this->redirect("pqrsasig", "agregado exitosamente");
	}
	/**
	 * CODIGO QUE ENVIA CORREO Y SI SE ENVIO EFECTIVAMENTE ACTUALIZA LA TABLA
	 */
	//Nuevo codigo
	function edit(PqrsAsigEditRequest $request, $rec_id = null){
		$query = PqrsAsig::query(); // hacemos consulta con la tabla
		$record = $query->findOrFail($rec_id, PqrsAsig::editFields());//recorremos los registro y los guardamos en $record 
		if ($request->isMethod('post')) {
			$envioExitoso = $this->envioEmail($rec_id, $record); //instanciamos a la funcion envioEmail
			if ($envioExitoso) {
				$modeldata = $this->normalizeFormData($request->validated());
				$record->update($modeldata);
				// Actualizar el campo "regsol_est" en la tabla "pqrsregpqrs"
				$pqrsRegRecord = PqrsRegPqrs::findOrFail($rec_id); //instanciamos la tabla PqrsRegPqrs
				$pqrsRegRecord->regsol_est = 'ASIGNADO'; // Cambiamos el valor del campo
				$pqrsRegRecord->save();
				$rad = $record->id_rad_asig;
				return $this->redirect("pqrsasig", "" .$rad. " notificada con exito!!!");
			} else {
				return $this->redirect('error', 'no se pudo notificar!!!'); //retorno en la misma vista el mensaje de error
				//return back()->with('error', 'No se pudo enviar el correo');
			}
		}
		
		return $this->renderView("pages.pqrsasig.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	
	/**
	 * After page record updated
	 * @param string $rec_id // updated record id
	 * @param array $record // updated page record
	 */
	function envioEmail($rec_id, $record){
		// Conexión a la base de datos "Pqrsregpqrs"
		$queryreg = PqrsRegPqrs::query();
		$recordreg = $queryreg->findOrFail($rec_id, PqrsRegPqrs::editFields());
		// Conexión a la base de datos "PqrsAsig"
		$query_asig = PqrsAsig::query();
		$recor_asig = $query_asig->findOrFail($rec_id, PqrsAsig::editFields());
		$photoreg = $recordreg->regsol_photo;
		$respo = $recordreg->id_asig_sol;
		$radicado = $recordreg->rad_sol;
		$correo = $recordreg->email_sol;
		$noment = $recordreg->nom_ent_sol;
		$nompet = $recordreg->nom_pet_sol;
		$diaspen = $recordreg->diaspen_sol;
		$fecresp = $recordreg->fecrep_sol;
		$fecsol = $recordreg->fec_sol;
		$ofic_act = Auth()->user()->nom_ofic_user;
		$obs_asig = $recor_asig->observacion;// se toma el campo de la tabla pqrsasig
		//$obs_reg = $obs_asig;
		// Enviar el correo
		try {
			Mail::to($correo)->send(new Mailpqrs($correo, $photoreg, $respo, $radicado, $noment, $fecresp, $nompet, $diaspen, $fecsol, $ofic_act, $obs_asig));
			return true; // Envío exitoso
		} catch (\Exception $e) {
			return false; // Envío fallido
		}
	}
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
		return $this->redirect($redirectUrl, "eliminado con éxito");
	}

	
