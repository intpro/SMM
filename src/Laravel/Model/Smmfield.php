<?php

namespace Interpro\SMM\Laravel\Model;

use Illuminate\Database\Eloquent\Model;

class Smmfield extends Model
{
    protected $table = 'smmfields';
    public $timestamps = false;
    protected static $unguarded = true;
}
