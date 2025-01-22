<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends Controller{
	/**
     * Index Action
     * @return \Illuminate\View\View
     */
	function index(){
		$user = auth()->user();
		if($user->hasRole('digitador')){
			return view("pages.home.digitador");
		}
		elseif($user->hasRole('contratista')){
			return view("pages.home.contratista");
		}
		else{
			return view("pages.home.index");
		}
	}
	
}
