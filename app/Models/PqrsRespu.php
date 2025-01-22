<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PqrsRespu extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pqrs_respu';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_respu';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'rad_respu','fec_respu'
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
				rad_respu LIKE ?  OR 
				id_respu LIKE ? 
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
			"rad_respu",
			"fec_respu",
			"date_created",
			"date_updated",
			"id_respu" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"rad_respu",
			"fec_respu",
			"date_created",
			"date_updated",
			"id_respu" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_respu",
			"rad_respu",
			"fec_respu",
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
			"id_respu",
			"rad_respu",
			"fec_respu",
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
			"rad_respu",
			"fec_respu",
			"id_respu" 
		];
	}
}
