<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Position extends Model
{
    public function collaborators()
    {
        return $this->hasMany('App\Models\Collaborator');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Position', 'parent_id', 'id');
    }

    public static function getTree(Collection $collection, $parent_id = 0)
    {
        foreach ($collection as $item) {
            if($item->parent_id === 0) {

            }
        }
    }
}
