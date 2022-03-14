<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	use HasDateTimeFormatter;



    const GENDER = [1 => '男', 2 => '女'];

    // 关联班级信息
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }


}
