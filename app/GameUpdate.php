<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameUpdate extends Model
{
    protected $connection = 'KPI';
    protected $table = 'game_updates';
    public $timestamps = false;
}
