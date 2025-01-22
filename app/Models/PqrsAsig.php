<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsAsig extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_asig';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_asig';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'id_rad_asig','tip_ent_asig','id_ent_asig','id_resp_asig','email_asig','observacion'
	];
	public $timestamps = true;
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
				pqrs_asig.id_rad_asig LIKE ?  OR 
				pqrs_respon.nombre_resp LIKE ?  OR 
				pqrs_ent.nom_ent LIKE ?  OR 
				pqrs_respon.email_resp LIKE ?  OR 
				pqrs_asig.observacion LIKE ?  OR 
				pqrs_ent.mun_ent LIKE ?  OR 
				pqrs_respon.id_ent_resp LIKE ?  OR 
				pqrs_asig.id_asig LIKE ?  OR 
				pqrs_asig.tip_ent_asig LIKE ?  OR 
				pqrs_asig.id_ent_asig LIKE ?  OR 
				pqrs_respon.id_respon LIKE ?  OR 
				pqrs_respon.cargo_resp LIKE ?  OR 
				pqrs_respon.tel_resp LIKE ?  OR 
				pqrs_respon.mun_resp LIKE ?  OR 
				pqrs_respon.dpt_resp LIKE ?  OR 
				pqrs_ent.id_ent LIKE ?  OR 
				pqrs_ent.dir_ent LIKE ?  OR 
				pqrs_ent.tel_ent LIKE ?  OR 
				pqrs_ent.email_ent LIKE ?  OR 
				pqrs_asig.email_asig LIKE ?  OR 
				pqrs_asig.id_resp_asig LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"pqrs_asig.id_rad_asig AS id_rad_asig",
			"pqrs_respon.nombre_resp AS pqrsrespon_nombre_resp",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_respon.email_resp AS pqrsrespon_email_resp",
			"pqrs_asig.observacion AS observacion",
			"pqrs_asig.date_created AS date_created",
			"pqrs_asig.date_updated AS date_updated",
			"pqrs_asig.id_asig AS id_asig",
			"pqrs_respon.id_respon AS pqrsrespon_id_respon",
			"pqrs_ent.id_ent AS pqrsent_id_ent" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"pqrs_asig.id_rad_asig AS id_rad_asig",
			"pqrs_respon.nombre_resp AS pqrsrespon_nombre_resp",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_respon.email_resp AS pqrsrespon_email_resp",
			"pqrs_asig.observacion AS observacion",
			"pqrs_asig.date_created AS date_created",
			"pqrs_asig.date_updated AS date_updated",
			"pqrs_asig.id_asig AS id_asig",
			"pqrs_respon.id_respon AS pqrsrespon_id_respon",
			"pqrs_ent.id_ent AS pqrsent_id_ent" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"pqrs_asig.id_asig AS id_asig",
			"pqrs_asig.id_rad_asig AS id_rad_asig",
			"pqrs_asig.tip_ent_asig AS tip_ent_asig",
			"pqrs_asig.id_ent_asig AS id_ent_asig",
			"pqrs_asig.email_asig AS email_asig",
			"pqrs_asig.id_resp_asig AS id_resp_asig",
			"pqrs_asig.observacion AS observacion",
			"pqrs_asig.date_created AS date_created",
			"pqrs_asig.date_updated AS date_updated",
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
			"pqrs_respon.date_updated AS pqrsrespon_date_updated",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_ent.tip_ent AS pqrsent_tip_ent",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_ent.date_created AS pqrsent_date_created",
			"pqrs_ent.dir_ent AS pqrsent_dir_ent",
			"pqrs_ent.tel_ent AS pqrsent_tel_ent",
			"pqrs_ent.email_ent AS pqrsent_email_ent",
			"pqrs_ent.date_updated AS pqrsent_date_updated",
			"pqrs_ent.mun_ent AS pqrsent_mun_ent" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"pqrs_asig.id_asig AS id_asig",
			"pqrs_asig.id_rad_asig AS id_rad_asig",
			"pqrs_asig.tip_ent_asig AS tip_ent_asig",
			"pqrs_asig.id_ent_asig AS id_ent_asig",
			"pqrs_asig.email_asig AS email_asig",
			"pqrs_asig.id_resp_asig AS id_resp_asig",
			"pqrs_asig.observacion AS observacion",
			"pqrs_asig.date_created AS date_created",
			"pqrs_asig.date_updated AS date_updated",
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
			"pqrs_respon.date_updated AS pqrsrespon_date_updated",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_ent.tip_ent AS pqrsent_tip_ent",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_ent.date_created AS pqrsent_date_created",
			"pqrs_ent.dir_ent AS pqrsent_dir_ent",
			"pqrs_ent.tel_ent AS pqrsent_tel_ent",
			"pqrs_ent.email_ent AS pqrsent_email_ent",
			"pqrs_ent.date_updated AS pqrsent_date_updated",
			"pqrs_ent.mun_ent AS pqrsent_mun_ent" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_rad_asig",
			"tip_ent_asig",
			"id_ent_asig",
			"id_resp_asig",
			"email_asig",
			"observacion",
			"id_asig" 
		];
	}
}
