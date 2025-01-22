<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class NotPqrs extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'not_pqrs';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_not';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'pqrs_not_rad','pqrs_not_nom','pqrs_not_cor','id_sol_not'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				not_pqrs.pqrs_not_rad LIKE ?  OR 
				pqrs_respon.nombre_resp LIKE ?  OR 
				pqrs_respon.email_resp LIKE ?  OR 
				not_pqrs.id_not LIKE ?  OR 
				not_pqrs.pqrs_not_nom LIKE ?  OR 
				not_pqrs.pqrs_not_cor LIKE ?  OR 
				pqrs_respon.id_respon LIKE ?  OR 
				pqrs_respon.id_ent_resp LIKE ?  OR 
				pqrs_respon.cargo_resp LIKE ?  OR 
				pqrs_respon.tel_resp LIKE ?  OR 
				pqrs_respon.mun_resp LIKE ?  OR 
				pqrs_respon.dpt_resp LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"not_pqrs.not_fecha AS not_fecha",
			"not_pqrs.pqrs_not_rad AS pqrs_not_rad",
			"pqrs_respon.nombre_resp AS pqrsrespon_nombre_resp",
			"pqrs_respon.email_resp AS pqrsrespon_email_resp",
			"not_pqrs.id_not AS id_not",
			"pqrs_respon.id_respon AS pqrsrespon_id_respon" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"not_pqrs.not_fecha AS not_fecha",
			"not_pqrs.pqrs_not_rad AS pqrs_not_rad",
			"pqrs_respon.nombre_resp AS pqrsrespon_nombre_resp",
			"pqrs_respon.email_resp AS pqrsrespon_email_resp",
			"not_pqrs.id_not AS id_not",
			"pqrs_respon.id_respon AS pqrsrespon_id_respon" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"not_pqrs.id_not AS id_not",
			"not_pqrs.not_fecha AS not_fecha",
			"not_pqrs.pqrs_not_rad AS pqrs_not_rad",
			"not_pqrs.pqrs_not_nom AS pqrs_not_nom",
			"not_pqrs.pqrs_not_cor AS pqrs_not_cor",
			"not_pqrs.id_sol_not AS id_sol_not",
			"pqrs_respon.id_respon AS pqrsrespon_id_respon",
			"pqrs_respon.id_tip_ent AS pqrsrespon_id_tip_ent",
			"pqrs_respon.id_ent_resp AS pqrsrespon_id_ent_resp",
			"pqrs_respon.nombre_resp AS pqrsrespon_nombre_resp",
			"pqrs_respon.cargo_resp AS pqrsrespon_cargo_resp",
			"pqrs_respon.email_resp AS pqrsrespon_email_resp",
			"pqrs_respon.tel_resp AS pqrsrespon_tel_resp",
			"pqrs_respon.mun_resp AS pqrsrespon_mun_resp",
			"pqrs_respon.dpt_resp AS pqrsrespon_dpt_resp",
			"pqrs_respon.date_created AS pqrsrespon_date_created",
			"pqrs_respon.date_updated AS pqrsrespon_date_updated" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"not_pqrs.id_not AS id_not",
			"not_pqrs.not_fecha AS not_fecha",
			"not_pqrs.pqrs_not_rad AS pqrs_not_rad",
			"not_pqrs.pqrs_not_nom AS pqrs_not_nom",
			"not_pqrs.pqrs_not_cor AS pqrs_not_cor",
			"not_pqrs.id_sol_not AS id_sol_not",
			"pqrs_respon.id_respon AS pqrsrespon_id_respon",
			"pqrs_respon.id_tip_ent AS pqrsrespon_id_tip_ent",
			"pqrs_respon.id_ent_resp AS pqrsrespon_id_ent_resp",
			"pqrs_respon.nombre_resp AS pqrsrespon_nombre_resp",
			"pqrs_respon.cargo_resp AS pqrsrespon_cargo_resp",
			"pqrs_respon.email_resp AS pqrsrespon_email_resp",
			"pqrs_respon.tel_resp AS pqrsrespon_tel_resp",
			"pqrs_respon.mun_resp AS pqrsrespon_mun_resp",
			"pqrs_respon.dpt_resp AS pqrsrespon_dpt_resp",
			"pqrs_respon.date_created AS pqrsrespon_date_created",
			"pqrs_respon.date_updated AS pqrsrespon_date_updated" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"pqrs_not_rad",
			"pqrs_not_nom",
			"pqrs_not_cor",
			"id_sol_not",
			"id_not" 
		];
	}
}
