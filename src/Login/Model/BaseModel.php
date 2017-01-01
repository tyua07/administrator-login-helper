<?php

namespace Yangyifan\Administrator\Login\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use SoftDeletes;
}
