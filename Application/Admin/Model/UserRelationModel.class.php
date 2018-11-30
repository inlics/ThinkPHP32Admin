<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-10-09
 * Time: 17:45
 */

namespace Admin\Model;
use Think\Model\RelationModel;

class UserRelationModel extends RelationModel {

    protected $tableName = 'user'; // 主表

    protected $_link = array(
        'role' => array( // 副表
            'mapping_type' => self::MANY_TO_MANY, // 关联关系：多对多
            'foreign_key' => 'user_id', // 和主表关联的外键
            'realtion_foreign_ley' => 'role_id', // 和副表关联的外键
            'relation_table' => 'tb_role_user', // 中间表
            'mapping_field' => 'id, name, remark, phone, email' // 字段筛选
        )
    );

}