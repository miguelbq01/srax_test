<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hero extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'active',
    'first_name',
    'last_name',
    'level',
    'race_id',
    'class_id',
    'weapon',
    'strength',
    'intelligence',
    'dexterity'];

    protected $dates = ['deleted_at'];
}
