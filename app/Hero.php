<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hero extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'first_name',
    'last_name',
    'level',
    'race_id',
    'class_id',
    'weapon_id',
    'strength',
    'intelligence',
    'dexterity'];

    protected $dates = ['deleted_at'];
}
