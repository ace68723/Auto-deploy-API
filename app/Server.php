<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
 	protected $fillable = ['id', 'name', 'ip', 'user', 'password', 'path', 'deploy_path', 'branch', 'deleted'];
  public $timestamps = false;
  public static function deleteServer($serverId){
    Server::query()
          ->where('id', $server_id)
          ->update(['deleted' => 1]);
  }
}
?>
