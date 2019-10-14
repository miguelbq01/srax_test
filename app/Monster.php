<?php

use Illuminate\Database\Eloquent\SoftDeletes;

class Monster extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
