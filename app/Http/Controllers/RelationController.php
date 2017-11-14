<?php

namespace App\Http\Controllers;

use App\Relation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationController extends Controller{

	public function index(){
		$result = array();
		$Relations = Relation::getRelationMapping();
		if ($Relations){
			$result['ev_error'] = 0;
			$result['ea_data'] = $Relations;
			return response()->json($result);
		}

	}
}
?>
