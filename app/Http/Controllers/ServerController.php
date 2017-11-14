<?php

namespace App\Http\Controllers;

use App\Server;
use App\Relation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller{

	public function createServer(Request $request){
		$result = array();

		# Check if key valid
		if (!array_key_exists('io_server', $request->all())) {
		    $result['ev_error'] = 1;
				$result['ev_message'] = "Required key doesn't exsist";
				return response()->json($result);
		}
    $new_server = json_decode($request["io_server"], true);

		# Run local script
		$echo = exec('python3 ../script/cli.py add_server ' . $new_server["project_name"] .
                                                   " " . $new_server["project_id"] .
                                                   " " . $new_server["name"] .
                                                   " " . $new_server["ip"] .
                                                   " " . $new_server["user"] .
                                                   " '" . $new_server["password"] . "'" .
                                                   " " . $new_server["path"] .
                                                   " " . $new_server["deploy_path"] .
                                                   " " . $new_server["branch"]
                                                 );
		if ($echo){
      # then add to server
			$server_data = array();
			$server_data['name'] = $new_server["name"];
      $server_data['ip'] = $new_server["ip"];
      $server_data['user'] = $new_server["user"];
      $server_data['password'] = $new_server["password"];
      $server_data['path'] = $new_server["path"];
      $server_data['deploy_path'] = $new_server["deploy_path"];
      $server_data['branch'] = $new_server["branch"];
      $server_data['deleted'] = 0;
			$Server = Server::create($server_data);
			if ($Server){
        # then add new relation
        $server_id = $Server->id;
        $relation_data = array();
        $relation_data['server_id'] = $server_id;
        $relation_data['project_id'] =$new_server["project_id"];
        $Relation = Relation::create($relation_data);

        if ($Relation){
          $result['ev_error'] = 0;
					$result['ev_data'] = $server_id;
          return response()->json($result);
        }
			}
		}

		$result['ev_error'] = 1;
		$result['ev_message'] = "Failed to add server";
		return response()->json($result);
	}

	public function index(){
		$result = array();
    $Servers  = Server::all();
		if ($Servers){
			$result['ev_error'] = 0;
			$result['ea_data'] = $Servers;
			return response()->json($result);
		}
  }

  public function deleteServer($id){
    $result = array();
		# Check if key valid
		if (!$id) {
		    $result['ev_error'] = 1;
				$result['ev_message'] = "Required key doesn't exsist";
				return response()->json($result);
		}
    $server_id = intval($id);
		Server::deleteServer($server_id);
    $result['ev_error'] = 0;
		# need to remove local remote as well
    return response()->json($result);
	}
}
?>
