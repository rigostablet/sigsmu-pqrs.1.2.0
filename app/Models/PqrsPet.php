<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsPet extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_pet';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_pet';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'id_ent','pet_ent','pet_tipdoc','pet_numpet','nom_pet','carg_pet','dir_pet','bar_pet','email_pet','tele_pet','dpto_pet','mun_pet','mun_usu_pet','usuario'
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
				pqrs_tipent.tipent_nom LIKE ?  OR 
				pqrs_pet.pet_tipdoc LIKE ?  OR 
				pqrs_pet.pet_numpet LIKE ?  OR 
				pqrs_pet.nom_pet LIKE ?  OR 
				pqrs_carg.nom_carg LIKE ?  OR 
				pqrs_ent.nom_ent LIKE ?  OR 
				pqrs_pet.dir_pet LIKE ?  OR 
				pqrs_pet.bar_pet LIKE ?  OR 
				pqrs_pet.email_pet LIKE ?  OR 
				pqrs_pet.tele_pet LIKE ?  OR 
				pqrs_pet.mun_pet LIKE ?  OR 
				pqrs_pet.usuario LIKE ?  OR 
				pqrs_pet.mun_usu_pet LIKE ?  OR 
				pqrs_pet.dpto_pet LIKE ?  OR 
				pqrs_ent.mun_ent LIKE ?  OR 
				pqrs_ent.id_ent LIKE ?  OR 
				pqrs_ent.dir_ent LIKE ?  OR 
				pqrs_ent.tel_ent LIKE ?  OR 
				pqrs_ent.email_ent LIKE ?  OR 
				pqrs_carg.id_carg LIKE ?  OR 
				pqrs_tipent.id_tip LIKE ?  OR 
				pqrs_pet.carg_pet LIKE ?  OR 
				pqrs_pet.id_pet LIKE ?  OR 
				pqrs_pet.pet_ent LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"pqrs_tipent.tipent_nom AS pqrstipent_tipent_nom",
			"pqrs_pet.pet_tipdoc AS pet_tipdoc",
			"pqrs_pet.pet_numpet AS pet_numpet",
			"pqrs_pet.nom_pet AS nom_pet",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_pet.dir_pet AS dir_pet",
			"pqrs_pet.bar_pet AS bar_pet",
			"pqrs_pet.email_pet AS email_pet",
			"pqrs_pet.tele_pet AS tele_pet",
			"pqrs_pet.mun_pet AS mun_pet",
			"pqrs_pet.usuario AS usuario",
			"pqrs_pet.mun_usu_pet AS mun_usu_pet",
			"pqrs_pet.dpto_pet AS dpto_pet",
			"pqrs_pet.date_created AS date_created",
			"pqrs_pet.date_updated AS date_updated",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_carg.id_carg AS pqrscarg_id_carg",
			"pqrs_tipent.id_tip AS pqrstipent_id_tip",
			"pqrs_pet.id_pet AS id_pet" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"pqrs_tipent.tipent_nom AS pqrstipent_tipent_nom",
			"pqrs_pet.pet_tipdoc AS pet_tipdoc",
			"pqrs_pet.pet_numpet AS pet_numpet",
			"pqrs_pet.nom_pet AS nom_pet",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_pet.dir_pet AS dir_pet",
			"pqrs_pet.bar_pet AS bar_pet",
			"pqrs_pet.email_pet AS email_pet",
			"pqrs_pet.tele_pet AS tele_pet",
			"pqrs_pet.mun_pet AS mun_pet",
			"pqrs_pet.usuario AS usuario",
			"pqrs_pet.mun_usu_pet AS mun_usu_pet",
			"pqrs_pet.dpto_pet AS dpto_pet",
			"pqrs_pet.date_created AS date_created",
			"pqrs_pet.date_updated AS date_updated",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_carg.id_carg AS pqrscarg_id_carg",
			"pqrs_tipent.id_tip AS pqrstipent_id_tip",
			"pqrs_pet.id_pet AS id_pet" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"pqrs_pet.id_pet AS id_pet",
			"pqrs_pet.id_ent AS id_ent",
			"pqrs_pet.pet_tipdoc AS pet_tipdoc",
			"pqrs_pet.pet_numpet AS pet_numpet",
			"pqrs_pet.pet_ent AS pet_ent",
			"pqrs_pet.nom_pet AS nom_pet",
			"pqrs_pet.carg_pet AS carg_pet",
			"pqrs_pet.dir_pet AS dir_pet",
			"pqrs_pet.bar_pet AS bar_pet",
			"pqrs_pet.email_pet AS email_pet",
			"pqrs_pet.tele_pet AS tele_pet",
			"pqrs_pet.mun_pet AS mun_pet",
			"pqrs_pet.usuario AS usuario",
			"pqrs_pet.date_created AS date_created",
			"pqrs_pet.date_updated AS date_updated",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_ent.tip_ent AS pqrsent_tip_ent",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_ent.date_created AS pqrsent_date_created",
			"pqrs_ent.dir_ent AS pqrsent_dir_ent",
			"pqrs_ent.tel_ent AS pqrsent_tel_ent",
			"pqrs_ent.email_ent AS pqrsent_email_ent",
			"pqrs_ent.date_updated AS pqrsent_date_updated",
			"pqrs_ent.mun_ent AS pqrsent_mun_ent",
			"pqrs_carg.id_carg AS pqrscarg_id_carg",
			"pqrs_carg.id_ent AS pqrscarg_id_ent",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg",
			"pqrs_carg.date_created AS pqrscarg_date_created",
			"pqrs_carg.date_updated AS pqrscarg_date_updated",
			"pqrs_tipent.id_tip AS pqrstipent_id_tip",
			"pqrs_tipent.tipent_nom AS pqrstipent_tipent_nom",
			"pqrs_tipent.date_created AS pqrstipent_date_created",
			"pqrs_tipent.date_updated AS pqrstipent_date_updated",
			"pqrs_pet.mun_usu_pet AS mun_usu_pet",
			"pqrs_pet.dpto_pet AS dpto_pet" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"pqrs_pet.id_pet AS id_pet",
			"pqrs_pet.id_ent AS id_ent",
			"pqrs_pet.pet_tipdoc AS pet_tipdoc",
			"pqrs_pet.pet_numpet AS pet_numpet",
			"pqrs_pet.pet_ent AS pet_ent",
			"pqrs_pet.nom_pet AS nom_pet",
			"pqrs_pet.carg_pet AS carg_pet",
			"pqrs_pet.dir_pet AS dir_pet",
			"pqrs_pet.bar_pet AS bar_pet",
			"pqrs_pet.email_pet AS email_pet",
			"pqrs_pet.tele_pet AS tele_pet",
			"pqrs_pet.mun_pet AS mun_pet",
			"pqrs_pet.usuario AS usuario",
			"pqrs_pet.date_created AS date_created",
			"pqrs_pet.date_updated AS date_updated",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_ent.tip_ent AS pqrsent_tip_ent",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_ent.date_created AS pqrsent_date_created",
			"pqrs_ent.dir_ent AS pqrsent_dir_ent",
			"pqrs_ent.tel_ent AS pqrsent_tel_ent",
			"pqrs_ent.email_ent AS pqrsent_email_ent",
			"pqrs_ent.date_updated AS pqrsent_date_updated",
			"pqrs_ent.mun_ent AS pqrsent_mun_ent",
			"pqrs_carg.id_carg AS pqrscarg_id_carg",
			"pqrs_carg.id_ent AS pqrscarg_id_ent",
			"pqrs_carg.nom_carg AS pqrscarg_nom_carg",
			"pqrs_carg.date_created AS pqrscarg_date_created",
			"pqrs_carg.date_updated AS pqrscarg_date_updated",
			"pqrs_tipent.id_tip AS pqrstipent_id_tip",
			"pqrs_tipent.tipent_nom AS pqrstipent_tipent_nom",
			"pqrs_tipent.date_created AS pqrstipent_date_created",
			"pqrs_tipent.date_updated AS pqrstipent_date_updated",
			"pqrs_pet.mun_usu_pet AS mun_usu_pet",
			"pqrs_pet.dpto_pet AS dpto_pet" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_ent",
			"pet_ent",
			"pet_tipdoc",
			"pet_numpet",
			"nom_pet",
			"carg_pet",
			"dir_pet",
			"bar_pet",
			"email_pet",
			"tele_pet",
			"dpto_pet",
			"mun_pet",
			"mun_usu_pet",
			"usuario",
			"id_pet" 
		];
	}
}
