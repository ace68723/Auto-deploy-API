<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
 	protected $fillable = ['server_id', 'project_id'];
  public $timestamps = false;

  public static function getRelationMapping(){
    $Relations  = Relation::query()
                    ->join('servers', 'servers.id', '=', 'relations.server_id')
                    ->join('projects', 'projects.id', '=', 'relations.project_id')
                    ->select(
															'servers.id AS server_id',
                              'servers.name AS name',
															'projects.id AS project_id',
                              'projects.name AS project_name',
															'projects.localPath AS project_path',
                              'servers.ip',
                              'servers.user',
                              'servers.path',
                              'servers.deploy_path',
                              'servers.branch')
										->where('servers.deleted', 0)
                    ->get();
      return $Relations;
  }
}
?>
