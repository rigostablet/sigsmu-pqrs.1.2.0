<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable 
{
	use Notifiable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'user';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'iduser';
	protected $fillable = ['username','phone','password','email','photo','fullname','role','mun','photo_mun','user_role_id','email_verified_at','account_status','cod_mun','dpto_user','oficina','nom_ofic_user'];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				iduser LIKE ?  OR 
				username LIKE ?  OR 
				phone LIKE ?  OR 
				email LIKE ?  OR 
				fullname LIKE ?  OR 
				role LIKE ?  OR 
				mun LIKE ?  OR 
				account_status LIKE ?  OR 
				cod_mun LIKE ?  OR 
				dpto_user LIKE ?  OR 
				oficina LIKE ?  OR 
				nom_ofic_user LIKE ? 
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
			"iduser",
			"username",
			"phone",
			"email",
			"photo",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"date_created",
			"date_updated",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"iduser",
			"username",
			"phone",
			"email",
			"photo",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"date_created",
			"date_updated",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"iduser",
			"username",
			"phone",
			"email",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"date_created",
			"date_updated",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"iduser",
			"username",
			"phone",
			"email",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"date_created",
			"date_updated",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"iduser",
			"username",
			"phone",
			"photo",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"iduser",
			"username",
			"phone",
			"email",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"date_created",
			"date_updated",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"iduser",
			"username",
			"phone",
			"email",
			"fullname",
			"role",
			"mun",
			"photo_mun",
			"user_role_id",
			"date_created",
			"date_updated",
			"email_verified_at",
			"account_status",
			"cod_mun",
			"dpto_user",
			"oficina",
			"nom_ofic_user" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"username",
			"phone",
			"photo",
			"fullname",
			"role",
			"oficina",
			"dpto_user",
			"cod_mun",
			"mun",
			"photo_mun",
			"user_role_id",
			"email_verified_at",
			"account_status",
			"nom_ofic_user",
			"iduser" 
		];
	}
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->username;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->iduser;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->photo;
	}
	public function UserRole(){
		return $this->user_role_id;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
	
	private $roleNames = [];
	private $userPages = [];
	
	/**
	* Get the permissions of the user.
	*/
	public function permissions(){
		return $this->hasMany(Permissions::class, 'role_id', 'user_role_id');
	}
	
	/**
	* Get the roles of the user.
	*/
	public function roles(){
		return $this->hasMany(Roles::class, 'role_id', 'user_role_id');
	}
	
	/**
	* set user role
	*/
	public function assignRole($roleName){
		$roleId = Roles::select('role_id')->where('role_name', $roleName)->value('role_id');
		$this->user_role_id = $roleId;
		$this->save();
	}
	
	/**
     * return list of pages user can access
     * @return array
     */
	public function getUserPages(){
		if(empty($this->userPages)){ // ensure we make db query once
			$this->userPages = $this->permissions()->pluck('permission')->toArray();
		}
		return $this->userPages;
	}
	
	/**
     * return user role names
     * @return array
     */
	public function getRoleNames(){
		if(empty($this->roleNames)){// ensure we make db query once
			$this->roleNames = $this->roles()->pluck('role_name')->toArray();
		}
		return $this->roleNames;
	}
	
	/**
     * check if user has a role
     * @return bool
     */
	public function hasRole($arrRoles){
		if(!is_array($arrRoles)){
			$arrRoles = [$arrRoles];
		}
		$userRoles = $this->getRoleNames();
		if(array_intersect(array_map('strtolower', $userRoles), array_map('strtolower', $arrRoles))){
			return true;
		}
		return false;
	}
	
	/**
     * check if user is the owner of the record
     * @return bool
     */
	public function isOwner($recId){
		return $this->UserId() == $recId;
	}
	
	/**
     * check if user can access page
     * @return bool
     */
	public function canAccess($path){
		$userPages = $this->getUserPages();
		$arrPaths = explode("/", strtolower($path));
		$page = $arrPaths[0] ?? "home";
		$action = $arrPaths[1] ?? "index";
		$page_path = "$page/$action";
		return in_array($page_path, $userPages);
	}
	
	/**
     * check if user is the owner of the record or has role that can edit or delete it
     * @return bool
     */
	public function canManage($path, $recId){
		return false;
	}
}
