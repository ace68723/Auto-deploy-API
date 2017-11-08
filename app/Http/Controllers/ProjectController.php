<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller{

	public function createProject(Request $request){
		$result = array();

		# Check if key valid
		if (!array_key_exists('iv_url', $request->all())) {
		    $result['ev_status'] = 1;
				$result['ev_message'] = "Required key doesn't exsist";
				return response()->json($result);
		}

		# Run local script
		$git_url = $request["iv_url"];
		$echo = exec('python3 ../script/cli.py add_project https://github.com/ace68723/auto-deploy');
		if ($echo){
			$project_data = array();
			$project_data['name'] = $echo;
			$project_data['localPath'] = $echo;
			$Project = Project::create($project_data);
			if ($Project){
				$result['ev_status'] = 0;
				return response()->json($result);
			}
		}

		$result['ev_status'] = 1;
		$result['ev_message'] = "Failed to add project";
		return response()->json($result);
	}

	public function index(){
		$result = array();
    $Projects  = Project::all();
		if ($Projects){
			$result['ev_status'] = 0;
			$result['ea_data'] = $Projects;
			return response()->json($result);
		}

	}
}
?>
