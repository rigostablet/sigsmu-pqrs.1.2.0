<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsTipdoc extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_tipdoc';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_tipdoc';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'tippdoc_tipent','nom_tipdoc'
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
				id_tipdoc LIKE ?  OR 
				nom_tipdoc LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
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
			"id_tipdoc",
			"tippdoc_tipent",
			"nom_tipdoc",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_tipdoc",
			"tippdoc_tipent",
			"nom_tipdoc",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_tipdoc",
			"tippdoc_tipent",
			"nom_tipdoc",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_tipdoc",
			"tippdoc_tipent",
			"nom_tipdoc",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_tipdoc",
			"tippdoc_tipent",
			"nom_tipdoc" 
		];
	}
}
