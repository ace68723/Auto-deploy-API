<?php

namespace App\Http\Controllers;

use App\Server;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller{

	public function createServer(Request $request){
		$result = array();
    // 
		// # Check if key valid
		// if (!array_key_exists('iv_url', $request->all())) {
		//     $result['ev_status'] = 1;
		// 		$result['ev_message'] = "Required key doesn't exsist";
		// 		return response()->json($result);
		// }
    //
		// # Run local script
		// $git_url = $request["iv_url"];
		// $echo = exec('python3 ../script/cli.py add_project https://github.com/ace68723/auto-deploy');
		// if ($echo){
		// 	$project_data = array();
		// 	$project_data['name'] = $echo;
		// 	$project_data['localPath'] = $echo;
		// 	$Server = Server::create($project_data);
		// 	if ($Server){
		// 		$result['ev_status'] = 0;
		// 		return response()->json($result);
		// 	}
		// }
    //
		// $result['ev_status'] = 1;
		// $result['ev_message'] = "Failed to add project";
		return response()->json($result);
	}

	public function index(){
		$result = array();
    $Servers  = Server::all();
		if ($Servers){
			$result['ev_status'] = 0;
			$result['ea_data'] = $Servers;
			return response()->json($result);
		}

	}
}
?>
