<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
 	protected $fillable = ['id', 'name', 'localPath'];
  public $timestamps = false;
}
?>
