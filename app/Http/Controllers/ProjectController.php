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
		    $result['ev_error'] = 1;
				$result['ev_message'] = "Required key doesn't exsist";
				return response()->json($result);
		}

		# Run local script
		$git_url = $request["iv_url"];
		$echo = exec('python3 ../script/cli.py add_project ' . $git_url);
		$echo = json_decode($echo, true);

		if ($echo && $echo['ev_error'] == 0){
			# if succeed
			$project_data = array();
			$project_data['name'] = $echo['ev_data'];
			$project_data['localPath'] = $echo['ev_data'];
			$Project = Project::create($project_data);
			if ($Project){
				$result['ev_error'] = 0;
				$result['ev_data'] = $Project->id;
				return response()->json($result);
			}
		}
		return response()->json($echo);
	}

	public function index(){
		$result = array();
    $Projects  = Project::all();
		if ($Projects){
			$result['ev_error'] = 0;
			$result['ea_data'] = $Projects;
			return response()->json($result);
		}
	}

	public function githook(Request $request){
		$result = array();
		//$repo_name = $request['repository']['full_name']
		$repo_name = $request['full_name'];
		$branch = explode("/", $request['ref']);
		$branch = end($branch);
		$echo = exec('python3 ../script/cli.py githook ' . $repo_name . ' ' . $branch);
		echo ($echo);
		$echo = json_decode($echo, true);

	}
}
?>
