<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 */

 use \Illuminate\Database\Eloquent\Model as Model;

class SampleModel extends Model{
    protected $table = 'sample';
}

