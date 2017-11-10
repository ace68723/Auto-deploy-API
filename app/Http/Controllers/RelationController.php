<?php

namespace App\Http\Controllers;

use App\Relation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationController extends Controller{

	public function index(){
		$result = array();
    $Relations  = Relation::query()
                    ->join('servers', 'servers.id', '=', 'relations.server_id')
                    ->join('projects', 'projects.id', '=', 'relations.project_id')
                    ->select(
															'servers.id AS server_id',
                              'servers.name AS server_name',
                              'projects.name AS project_name',
															'projects.id AS project_id',
                              'servers.ip',
                              'servers.user',
                              'servers.path',
                              'servers.deploy_path',
                              'servers.branch')
                    ->get();

		if ($Relations){
			$result['ev_error'] = 0;
			$result['ea_data'] = $Relations;
			return response()->json($result);
		}

	}
}
?>
