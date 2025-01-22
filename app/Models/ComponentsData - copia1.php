<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT role_id as value, role_name as label FROM roles";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_ent_asig_option_list Model Action
     * @return array
     */
	function id_ent_asig_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_ent AS value,nom_ent AS label FROM pqrs_ent WHERE tip_ent=:lookup_tip_ent_asig" ;
		$query_params = [];
		$query_params['lookup_tip_ent_asig'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_resp_asig_option_list Model Action
     * @return array
     */
	function id_resp_asig_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_respon AS value,nombre_resp AS label FROM pqrs_respon WHERE id_ent_resp=:lookup_id_ent_asig" ;
		$query_params = [];
		$query_params['lookup_id_ent_asig'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * email_asig_option_list Model Action
     * @return array
     */
	function email_asig_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_respon AS value,email_resp AS label FROM pqrs_respon WHERE id_respon=:lookup_id_resp_asig" ;
		$query_params = [];
		$query_params['lookup_id_resp_asig'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * tip_ent_option_list Model Action
     * @return array
     */
	function tip_ent_option_list(){
		$sqltext = "SELECT  DISTINCT id_tip AS value,tipent_nom AS label FROM pqrs_tipent WHERE id_tip != 1";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * mun_ent_option_list Model Action
     * @return array
     */
	function mun_ent_option_list(){
		$sqltext = "SELECT  DISTINCT cod_mun AS value,nom_mun AS label FROM pqrs_mun ORDER BY nom_mun";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_ent_option_list Model Action
     * @return array
     */
	function id_ent_option_list(){
		$sqltext = "SELECT  DISTINCT id_tip AS value,tipent_nom AS label FROM pqrs_tipent ORDER BY tipent_nom";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * pet_ent_option_list Model Action
     * @return array
     */
	function pet_ent_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_ent AS value,nom_ent AS label FROM pqrs_ent WHERE tip_ent=:lookup_id_ent" ;
		$query_params = [];
		$query_params['lookup_id_ent'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * pet_tipdoc_option_list Model Action
     * @return array
     */
	function pet_tipdoc_option_list(){
		$sqltext = "SELECT  DISTINCT nom_tipdoc AS value,nom_tipdoc AS label FROM pqrs_tipdoc";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * carg_pet_option_list Model Action
     * @return array
     */
	function carg_pet_option_list(){
		$sqltext = "SELECT  DISTINCT id_carg AS value,nom_carg AS label FROM pqrs_carg ORDER BY nom_carg";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in PqrsPet table
	 * @param string $value
     * @return bool
     */
	function pqrspet_email_pet_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('pqrs_pet')->where('email_pet', $value)->value('email_pet');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * tip_ent_sol_option_list Model Action
     * @return array
     */
	function tip_ent_sol_option_list(){
		$sqltext = "SELECT id_tip AS value,tipent_nom AS label FROM pqrs_tipent";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_ent_sol_option_list Model Action
     * @return array
     */
	function id_ent_sol_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_ent AS value,nom_ent AS label FROM pqrs_ent WHERE tip_ent=:lookup_tip_ent_sol" ;
		$query_params = [];
		$query_params['lookup_tip_ent_sol'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_pet_option_list Model Action
     * @return array
     */
	function id_pet_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_pet AS value,nom_pet AS label FROM pqrs_pet WHERE pet_ent=:lookup_id_ent_sol ORDER BY nom_pet" ;
		$query_params = [];
		$query_params['lookup_id_ent_sol'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * tip_sol_option_list Model Action
     * @return array
     */
	function tip_sol_option_list(){
		$sqltext = "SELECT  DISTINCT id_tipsol AS value,tipsol_nombre AS label FROM pqrs_tipsol ORDER BY tipsol_nombre";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * mun_sol_option_list Model Action
     * @return array
     */
	function mun_sol_option_list(){
		$sqltext = "SELECT  DISTINCT nom_mun AS value,nom_mun AS label FROM pqrs_mun ORDER BY nom_mun";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * pqrsregpqrs_mun_sol_option_list Model Action
     * @return array
     */
	function pqrsregpqrs_mun_sol_option_list(){
		$sqltext = "SELECT  DISTINCT cod_mun AS value,nom_mun AS label FROM pqrs_mun";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_tip_ent_option_list Model Action
     * @return array
     */
	function id_tip_ent_option_list(){
		$sqltext = "SELECT  DISTINCT id_tip AS value,tipent_nom AS label FROM pqrs_tipent";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_ent_resp_option_list Model Action
     * @return array
     */
	function id_ent_resp_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id_ent AS value,nom_ent AS label FROM pqrs_ent WHERE tip_ent=:lookup_id_tip_ent" ;
		$query_params = [];
		$query_params['lookup_id_tip_ent'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * rad_respu_option_list Model Action
     * @return array
     */
	function rad_respu_option_list(){
		$sqltext = "SELECT  pqrs_reg_pqrs.rad_sol AS value FROM pqrs_reg_pqrs WHERE  regsol_est  ='ASIGNADO'";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in User table
	 * @param string $value
     * @return bool
     */
	function user_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('user')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in User table
	 * @param string $value
     * @return bool
     */
	function user_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('user')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * oficina_option_list Model Action
     * @return array
     */
	function oficina_option_list(){
		$sqltext = "SELECT  DISTINCT id_ent AS value,nom_ent AS label FROM pqrs_ent WHERE tip_ent = 3";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * dpto_user_option_list Model Action
     * @return array
     */
	function dpto_user_option_list(){
		$sqltext = "SELECT  DISTINCT cod_dpto_pqrs AS value,nom_dpto_pqrs AS label FROM pqrs_dpto ORDER BY cod_dpto_pqrs";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * mun_option_list Model Action
     * @return array
     */
	function mun_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT cod_mun AS value,nom_mun AS label FROM pqrs_mun WHERE dpto_mun=:lookup_dpto_user" ;
		$query_params = [];
		$query_params['lookup_dpto_user'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * role_option_list Model Action
     * @return array
     */
	function role_option_list(){
		$sqltext = "SELECT  DISTINCT role_id AS value,role_name AS label FROM roles ORDER BY role_name";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * cod_mun_option_list Model Action
     * @return array
     */
	function cod_mun_option_list(){
		$sqltext = "SELECT  DISTINCT cod_mun AS value,nom_mun AS label FROM pqrs_mun ORDER BY cod_mun";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * getcount_sinnotificar Model Action
     * @return int
     */
	function getcount_sinnotificar(){
		$ofic_logue = Auth()->user()->oficina; // Obtenemos la instancia del usuario logueado
		$sqltext = "SELECT COUNT(*) AS num FROM pqrs_reg_pqrs where regsol_est = 'SIN ASIGNAR' and  ofic_usu_sol = $ofic_logue" ; //cuenta los registros iguales a "SIN ASIGNAR y con la oficina del usuario logueado
		$query_params = [];
		$val = DB::selectOne($sqltext,$query_params);
		return $val->num;
	}

	/**
     * getcount_sinresponder Model Action
     * @return int
     */
	function getcount_sinresponder(){
		$ofic_logue = Auth()->user()->oficina; // Obtenemos la instancia del usuario logueado
		$sqltext = "SELECT COUNT(*) AS num FROM pqrs_reg_pqrs where regsol_est = 'ASIGNADO' and  ofic_usu_sol = $ofic_logue";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_respond Model Action
     * @return int
     */
	function getcount_respuestas(){
		$ofic_logue = Auth()->user()->oficina; // Obtenemos la instancia del usuario logueado
		$sqltext = "SELECT COUNT(*) AS num FROM pqrs_reg_pqrs where regsol_est = 'RESUELTA' and  ofic_usu_sol = $ofic_logue";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_totalpqrs Model Action
     * @return int
     */
	function getcount_totalpqrs(){
		$ofic_logue = Auth()->user()->oficina; // Obtenemos la instancia del usuario logueado
		$sqltext = "SELECT COUNT(*) AS num FROM pqrs_reg_pqrs where ofic_usu_sol = $ofic_logue";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
}
