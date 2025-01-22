<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsMun extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_mun';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_mun';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'dpto_mun','cod_mun','nom_mun','nit_mun','dir_mun'
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
				id_mun LIKE ?  OR 
				cod_mun LIKE ?  OR 
				nom_mun LIKE ?  OR 
				dpto_mun LIKE ?  OR 
				dir_mun LIKE ?  OR 
				nit_mun LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"id_mun",
			"cod_mun",
			"nom_mun",
			"dpto_mun",
			"date_created",
			"date_updated",
			"dir_mun",
			"nit_mun" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_mun",
			"cod_mun",
			"nom_mun",
			"dpto_mun",
			"date_created",
			"date_updated",
			"dir_mun",
			"nit_mun" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_mun",
			"cod_mun",
			"nom_mun",
			"dpto_mun",
			"date_created",
			"date_updated",
			"dir_mun",
			"nit_mun" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_mun",
			"cod_mun",
			"nom_mun",
			"dpto_mun",
			"date_created",
			"date_updated",
			"dir_mun",
			"nit_mun" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"dpto_mun",
			"cod_mun",
			"nom_mun",
			"nit_mun",
			"dir_mun",
			"id_mun" 
		];
	}
}
