<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\DetalleVen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;
class DetalleVenController extends Controller
{
	

	/**
     * List page records
     * @return \Illuminate\View\View
     */
	function index(Request $request){
		$limit = $request->limit ?? 100;
		$page = $request->page ?? 1;
		$offset = (($page-1) * $limit);
		$query_params = [];
		$ofic_logue = Auth()->user()->oficina; // Obtenemos la instancia del usuario logueado; en este caso la oficina del user logueado
		$mun_logue = Auth()->user()->cod_mun; // Obtenemos la instancia del usuario logueado
		$sqltext = "SELECT  pqrs_reg_pqrs.fec_sol, pqrs_reg_pqrs.fecrep_sol, pqrs_reg_pqrs.rad_sol, pqrs_reg_pqrs.diaspen_sol, pqrs_reg_pqrs.id_asig_sol, pqrs_reg_pqrs.regsol_est, user.nom_ofic_user FROM pqrs_reg_pqrs JOIN user ON pqrs_reg_pqrs.usu_sol=user.username WHERE  pqrs_reg_pqrs.regsol_est  ='ASIGNADO' AND pqrs_reg_pqrs.diaspen_sol <= '2' AND ofic_usu_sol = $ofic_logue AND mun_user_sol =$mun_logue";
		$data = DB::select($sqltext, $query_params);
		$data = array_map(function ($value) {
			return (array)$value;
		}, $data);
		$total_records = count($data);
		$records = new LengthAwarePaginator($data, $total_records, $limit, $page);
		return $this->renderView("pages.detalleven.list", compact("records"));
	}
}
