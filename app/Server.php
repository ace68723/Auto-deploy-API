<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
 	protected $fillable = ['id', 'name', 'ip', 'user', 'password', 'path', 'deploy_path', 'branch', 'deleted'];
  public $timestamps = false;
}
?>
