<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Модель должностей
 * Class Position
 * @package App\Models
 */
class Position extends Model
{
    /**
     * Связь с сотрудниками
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collaborators()
    {
        return $this->hasMany('App\Models\Collaborator');
    }
}
