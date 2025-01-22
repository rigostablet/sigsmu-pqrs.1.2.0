<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsRegPqrs extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_reg_pqrs';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_sol';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'fec_sol','fecrep_sol','rad_sol','tip_ent_sol','id_ent_sol','id_pet','tip_sol','medio_sol','desc_sol','regsol_photo','regsol_dias','diaspen_sol','id_asig_sol','nom_ent_sol','nom_pet_sol','email_sol','regsol_est','usu_sol','ofic_usu_sol','mun_user_sol','mun_sol'
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
				pqrs_tipsol.tipsol_nombre LIKE ?  OR 
				pqrs_reg_pqrs.rad_sol LIKE ?  OR 
				pqrs_reg_pqrs.nom_ent_sol LIKE ?  OR 
				pqrs_reg_pqrs.nom_pet_sol LIKE ?  OR 
				pqrs_mun.nom_mun LIKE ?  OR 
				pqrs_reg_pqrs.medio_sol LIKE ?  OR 
				pqrs_reg_pqrs.desc_sol LIKE ?  OR 
				pqrs_reg_pqrs.email_sol LIKE ?  OR 
				pqrs_reg_pqrs.id_asig_sol LIKE ?  OR 
				user.nom_ofic_user LIKE ?  OR 
				pqrs_reg_pqrs.regsol_est LIKE ?  OR 
				pqrs_reg_pqrs.mun_user_sol LIKE ?  OR 
				pqrs_reg_pqrs.usu_sol LIKE ?  OR 
				pqrs_tipsol.id_tipsol LIKE ?  OR 
				user.iduser LIKE ?  OR 
				user.username LIKE ?  OR 
				user.phone LIKE ?  OR 
				user.email LIKE ?  OR 
				user.fullname LIKE ?  OR 
				user.role LIKE ?  OR 
				user.mun LIKE ?  OR 
				user.account_status LIKE ?  OR 
				user.cod_mun LIKE ?  OR 
				user.dpto_user LIKE ?  OR 
				user.oficina LIKE ?  OR 
				pqrs_mun.id_mun LIKE ?  OR 
				pqrs_mun.cod_mun LIKE ?  OR 
				pqrs_mun.dpto_mun LIKE ?  OR 
				pqrs_mun.dir_mun LIKE ?  OR 
				pqrs_mun.nit_mun LIKE ?  OR 
				pqrs_respu.id_respu LIKE ?  OR
				pqrs_respu.rad_respu LIKE ?  OR 
				pqrs_reg_pqrs.mun_sol LIKE ?  OR 
				pqrs_reg_pqrs.ofic_usu_sol LIKE ?  OR 
				user.password LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			/** "pqrs_mun.id_mun AS pqrsmun_id_mun", */
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_pet.email_pet AS pqrspet_email_pet",
			"pqrs_reg_pqrs.id_sol AS id_sol" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			/** "pqrs_mun.id_mun AS pqrsmun_id_mun", */
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_respu.id_respu AS pqrsrespu_id_respu",
			"pqrs_reg_pqrs.id_sol AS id_sol" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_reg_pqrs.id_ent_sol AS id_ent_sol",
			"pqrs_reg_pqrs.tip_ent_sol AS tip_ent_sol",
			"pqrs_reg_pqrs.id_pet AS id_pet",
			"pqrs_reg_pqrs.tip_sol AS tip_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.mun_sol AS mun_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_reg_pqrs.date_updated AS date_updated",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.ofic_usu_sol AS ofic_usu_sol",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_tipsol.date_created AS pqrstipsol_date_created",
			"pqrs_tipsol.date_updated AS pqrstipsol_date_updated",
			"user.iduser AS user_iduser",
			"user.username AS user_username",
			"user.phone AS user_phone",
			"user.email AS user_email",
			"user.photo AS user_photo",
			"user.fullname AS user_fullname",
			"user.role AS user_role",
			"user.mun AS user_mun",
			"user.photo_mun AS user_photo_mun",
			"user.user_role_id AS user_user_role_id",
			"user.date_created AS user_date_created",
			"user.date_updated AS user_date_updated",
			"user.email_verified_at AS user_email_verified_at",
			"user.account_status AS user_account_status",
			"user.cod_mun AS user_cod_mun",
			"user.dpto_user AS user_dpto_user",
			"user.oficina AS user_oficina",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_mun.cod_mun AS pqrsmun_cod_mun",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_mun.dpto_mun AS pqrsmun_dpto_mun",
			"pqrs_mun.date_created AS pqrsmun_date_created",
			"pqrs_mun.date_updated AS pqrsmun_date_updated",
			"pqrs_mun.dir_mun AS pqrsmun_dir_mun",
			"pqrs_mun.nit_mun AS pqrsmun_nit_mun",
			"pqrs_respu.id_respu AS pqrsrespu_id_respu",
			"pqrs_respu.rad_respu AS pqrsrespu_rad_respu",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_respu.date_created AS pqrsrespu_date_created",
			"pqrs_respu.date_updated AS pqrsrespu_date_updated" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_reg_pqrs.id_ent_sol AS id_ent_sol",
			"pqrs_reg_pqrs.tip_ent_sol AS tip_ent_sol",
			"pqrs_reg_pqrs.id_pet AS id_pet",
			"pqrs_reg_pqrs.tip_sol AS tip_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.mun_sol AS mun_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_reg_pqrs.date_updated AS date_updated",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.ofic_usu_sol AS ofic_usu_sol",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_tipsol.date_created AS pqrstipsol_date_created",
			"pqrs_tipsol.date_updated AS pqrstipsol_date_updated",
			"user.iduser AS user_iduser",
			"user.username AS user_username",
			"user.phone AS user_phone",
			"user.email AS user_email",
			"user.photo AS user_photo",
			"user.fullname AS user_fullname",
			"user.role AS user_role",
			"user.mun AS user_mun",
			"user.photo_mun AS user_photo_mun",
			"user.user_role_id AS user_user_role_id",
			"user.date_created AS user_date_created",
			"user.date_updated AS user_date_updated",
			"user.email_verified_at AS user_email_verified_at",
			"user.account_status AS user_account_status",
			"user.cod_mun AS user_cod_mun",
			"user.dpto_user AS user_dpto_user",
			"user.oficina AS user_oficina",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_mun.cod_mun AS pqrsmun_cod_mun",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_mun.dpto_mun AS pqrsmun_dpto_mun",
			"pqrs_mun.date_created AS pqrsmun_date_created",
			"pqrs_mun.date_updated AS pqrsmun_date_updated",
			"pqrs_mun.dir_mun AS pqrsmun_dir_mun",
			"pqrs_mun.nit_mun AS pqrsmun_nit_mun",
			"pqrs_respu.id_respu AS pqrsrespu_id_respu",
			"pqrs_respu.rad_respu AS pqrsrespu_rad_respu",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_respu.date_created AS pqrsrespu_date_created",
			"pqrs_respu.date_updated AS pqrsrespu_date_updated" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"fec_sol",
			"fecrep_sol",
			"rad_sol",
			"tip_ent_sol",
			"id_ent_sol",
			"id_pet",
			"tip_sol",
			"medio_sol",
			"desc_sol",
			"regsol_photo",
			"regsol_dias",
			"diaspen_sol",
			"id_asig_sol",
			"nom_ent_sol",
			"nom_pet_sol",
			"email_sol",
			"regsol_est",
			"usu_sol",
			"ofic_usu_sol",
			"mun_user_sol",
			"mun_sol",
			"id_sol" 
		];
	}
	

	/**
     * return pqrsSinAsignar page fields of the model.
     * 
     * @return array
     */
	public static function pqrsSinAsignarFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			/** "pqrs_mun.nom_mun AS pqrsmun_nom_mun", */
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"user.mun AS user_mun",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			/** "pqrs_mun.id_mun AS pqrsmun_id_mun", */
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun",
			"pqrs_reg_pqrs.id_sol AS id_sol" 
		];
	}
	

	/**
     * return exportPqrsSinAsignar page fields of the model.
     * 
     * @return array
     */
	public static function exportPqrsSinAsignarFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"user.mun AS user_mun",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.id_sol AS id_sol" 
		];
	}
	

	/**
     * return pqrsAsignados page fields of the model.
     * 
     * @return array
     */
	public static function pqrsAsignadosFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun"  
		];
	}
	

	/**
     * return exportPqrsAsignados page fields of the model.
     * 
     * @return array
     */
	public static function exportPqrsAsignadosFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_pet.mun_pet AS pqrspet_mun_pet", 
		];
	}
	

	/**
     * return pqrsRespond page fields of the model.
     * 
     * @return array
     */
	public static function pqrsRespondFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"user.iduser AS user_iduser",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun"  
		];
	}
	

	/**
     * return exportPqrsRespond page fields of the model.
     * 
     * @return array
     */
	public static function exportPqrsRespondFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"user.iduser AS user_iduser",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun"  
		];
	}
	

	/**
     * return listPqrsContrat page fields of the model.
     * 
     * @return array
     */
	public static function listPqrsContratFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_reg_pqrs.mun_sol AS mun_sol",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_reg_pqrs.date_updated AS date_updated",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_reg_pqrs.id_sol AS id_sol" ,
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu",
			"pqrs_pet.email_pet AS pqrspet_email_pet",
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun" // llamamos el campo nom_mun de la tabla con un alias para que este disponible
		];
	}
	

	/**
     * return exportListPqrsContrat page fields of the model.
     * 
     * @return array
     */
	public static function exportListPqrsContratFields(){
		return [ 
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.ofic_usu_sol AS ofic_usu_sol",
			"pqrs_ent.nom_ent AS pqrsent_nom_ent",
			"pqrs_reg_pqrs.mun_sol AS mun_sol",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"pqrs_reg_pqrs.date_updated AS date_updated",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"pqrs_ent.id_ent AS pqrsent_id_ent",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu", 
			"pqrs_pet.email_pet AS pqrspet_email_pet",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun"
		];
	}
	

	/**
     * return listPqrsTotalCont page fields of the model.
     * 
     * @return array
     */
	public static function listPqrsTotalContFields(){
		return [ 
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.ofic_usu_sol AS ofic_usu_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu", 
			"pqrs_dpto.nom_mun AS pqrsdpto_nom_mun", // traemos el campo nom_mun de la tabla pqrs_dpto
			"pqrs_pet.email_pet AS pqrspet_email_pet" // traemos el campo email_pet de la tabla pqrs_pet
		];
	}
	

	/**
     * return exportListPqrsTotalCont page fields of the model.
     * 
     * @return array
     */
	public static function exportListPqrsTotalContFields(){
		return [ 
			"pqrs_tipsol.tipsol_nombre AS pqrstipsol_tipsol_nombre",
			"pqrs_reg_pqrs.rad_sol AS rad_sol",
			"pqrs_reg_pqrs.fec_sol AS fec_sol",
			"pqrs_reg_pqrs.fecrep_sol AS fecrep_sol",
			"pqrs_reg_pqrs.nom_ent_sol AS nom_ent_sol",
			"pqrs_reg_pqrs.nom_pet_sol AS nom_pet_sol",
			"pqrs_reg_pqrs.medio_sol AS medio_sol",
			"pqrs_reg_pqrs.desc_sol AS desc_sol",
			"pqrs_reg_pqrs.email_sol AS email_sol",
			"pqrs_reg_pqrs.regsol_photo AS regsol_photo",
			"pqrs_reg_pqrs.id_asig_sol AS id_asig_sol",
			"pqrs_reg_pqrs.regsol_dias AS regsol_dias",
			"pqrs_reg_pqrs.diaspen_sol AS diaspen_sol",
			"pqrs_reg_pqrs.regsol_est AS regsol_est",
			"pqrs_reg_pqrs.usu_sol AS usu_sol",
			"pqrs_reg_pqrs.mun_user_sol AS mun_user_sol",
			"pqrs_reg_pqrs.date_created AS date_created",
			"user.nom_ofic_user AS user_nom_ofic_user",
			"pqrs_mun.nom_mun AS pqrsmun_nom_mun",
			"pqrs_tipsol.id_tipsol AS pqrstipsol_id_tipsol",
			"user.iduser AS user_iduser",
			"pqrs_mun.id_mun AS pqrsmun_id_mun",
			"pqrs_reg_pqrs.id_sol AS id_sol",
			"pqrs_respu.fec_respu AS pqrsrespu_fec_respu", 
			"pqrs_pet.email_pet AS pqrspet_email_pet"
		];
	}
}
