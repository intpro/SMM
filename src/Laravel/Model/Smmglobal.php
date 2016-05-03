<?php

namespace Interpro\SMM\Laravel\Model;

use Illuminate\Database\Eloquent\Model;

class Smmglobal extends Model
{
    protected $table = 'smmglobals';
    public $timestamps = false;
    protected static $unguarded = true;
}
