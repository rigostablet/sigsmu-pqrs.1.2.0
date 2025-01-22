<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsEnt extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_ent';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_ent';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'tip_ent','nit_ent','nom_ent','dir_ent','tel_ent','email_ent','mun_ent'
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
				nom_ent LIKE ?  OR 
				dir_ent LIKE ?  OR 
				tel_ent LIKE ?  OR 
				email_ent LIKE ?  OR 
				mun_ent LIKE ?  OR 
				nit_ent LIKE ?  OR 
				id_ent LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"tip_ent",
			"nom_ent",
			"dir_ent",
			"tel_ent",
			"email_ent",
			"mun_ent",
			"date_created",
			"date_updated",
			"nit_ent",
			"id_ent" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"tip_ent",
			"nom_ent",
			"dir_ent",
			"tel_ent",
			"email_ent",
			"mun_ent",
			"date_created",
			"date_updated",
			"nit_ent",
			"id_ent" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_ent",
			"tip_ent",
			"nom_ent",
			"date_created",
			"dir_ent",
			"tel_ent",
			"email_ent",
			"date_updated",
			"mun_ent",
			"nit_ent" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_ent",
			"tip_ent",
			"nom_ent",
			"date_created",
			"dir_ent",
			"tel_ent",
			"email_ent",
			"date_updated",
			"mun_ent",
			"nit_ent" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"tip_ent",
			"nit_ent",
			"nom_ent",
			"dir_ent",
			"tel_ent",
			"email_ent",
			"mun_ent",
			"id_ent" 
		];
	}
}
