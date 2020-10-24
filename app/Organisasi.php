<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Organisasi extends Model
{
	use SoftDeletes;
	
    protected $table = 'organisasi';
    protected $guarded = [''];

    public function childs()
	{
	    return $this->hasMany('\App\Organisasi', 'parent_id');
	}

	public function children()
	{
	    return $this->childs()->with('children');
	}

	public function parents()
	{
	    return $this->belongsTo('\App\Organisasi', 'parent_id');
	}

	public function allParents()
	{
	    return $this->parents()->with('allParents');
	}
}
