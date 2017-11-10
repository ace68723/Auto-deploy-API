<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
 	protected $fillable = ['server_id', 'project_id'];
  public $timestamps = false;
}
?>
