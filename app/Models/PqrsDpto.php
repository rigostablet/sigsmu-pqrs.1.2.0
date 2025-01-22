<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsDpto extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_dpto';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_dpto';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'cod_dpto_pqrs','nom_dpto_pqrs','cod_mun','nom_mun'
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
				id_dpto LIKE ?  OR 
				cod_mun LIKE ?  OR 
				nom_mun LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
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
			"id_dpto",
			"cod_dpto_pqrs",
			"nom_dpto_pqrs",
			"cod_mun",
			"nom_mun" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_dpto",
			"cod_dpto_pqrs",
			"nom_dpto_pqrs",
			"cod_mun",
			"nom_mun" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_dpto",
			"cod_dpto_pqrs",
			"nom_dpto_pqrs",
			"cod_mun",
			"nom_mun" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_dpto",
			"cod_dpto_pqrs",
			"nom_dpto_pqrs",
			"cod_mun",
			"nom_mun" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"cod_dpto_pqrs",
			"nom_dpto_pqrs",
			"id_dpto",
			"cod_mun",
			"nom_mun" 
		];
	}
}
