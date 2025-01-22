<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsRespon extends Model 

{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_respon';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_respon';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'id_tip_ent','id_ent_resp','nombre_resp','cargo_resp','email_resp','tel_resp','mun_resp','dpt_resp'
	];
	public $timestamps = false;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				id_respon LIKE ?  OR 
				id_ent_resp LIKE ?  OR 
				nombre_resp LIKE ?  OR 
				cargo_resp LIKE ?  OR 
				email_resp LIKE ?  OR 
				tel_resp LIKE ?  OR 
				mun_resp LIKE ?  OR 
				dpt_resp LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id_respon",
			"id_tip_ent",
			"id_ent_resp",
			"nombre_resp",
			"cargo_resp",
			"email_resp",
			"tel_resp",
			"mun_resp",
			"dpt_resp",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent", //trae el campo
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg",
			"pqrs_respon.date_created AS date_created",
			"pqrs_respon.date_updated AS date_updated",
			//"date_created",
			//"date_updated",
			
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_respon",
			"id_tip_ent",
			"id_ent_resp",
			"nombre_resp",
			"cargo_resp",
			"email_resp",
			"tel_resp",
			"mun_resp",
			"dpt_resp",
			"date_created",
			"date_updated",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg "
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_respon",
			"id_tip_ent",
			"id_ent_resp",
			"nombre_resp",
			"cargo_resp",
			"email_resp",
			"tel_resp",
			"mun_resp",
			"dpt_resp",
			"date_created",
			"date_updated",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg "
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_respon",
			"id_tip_ent",
			"id_ent_resp",
			"nombre_resp",
			"cargo_resp",
			"email_resp",
			"tel_resp",
			"mun_resp",
			"dpt_resp",
			"date_created",
			"date_updated",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg "
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_tip_ent",
			"id_ent_resp",
			"nombre_resp",
			"cargo_resp",
			"email_resp",
			"tel_resp",
			"mun_resp",
			"dpt_resp",
			"id_respon" 
		];
	}
}
