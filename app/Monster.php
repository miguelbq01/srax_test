<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monster extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'picture',
        'level',
        'race_id',
        'strength',
        'intelligence',
        'dexterity'];

    protected $dates = ['deleted_at'];
}
