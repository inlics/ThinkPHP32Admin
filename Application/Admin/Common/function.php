<?php
/**
 * Created by PhpStorm.
 * User: 10328
 * Date: 2018-09-30
 * Time: 13:44
 */

/**
 * 递归重组节点信息为多维数组
 * @param array $node  要处理的节点数组
 * @param int $pid     父级id
 * @return array
 */
function node_merage($node, $pid = 1) {
    $arr = array();
    foreach($node as $v){
        if($v['pid'] == $pid) {
            if( $v['level'] != 3) {
                $v['children'] = node_merage($node, $v['id']);
            }
            $arr[] = $v;
        }
    }
    return $arr;
}

/**
 * 递归重组节点信息为多维数组
 * @param array $arr  要处理的节点数组
 * @param array $arrcompare   角色对应的权限
 * @return array
 */
function access_node_merage($arr, $arrcompare) {
    $new_arr = array();
    foreach($arr as $v){
        if($v['children']) {
            if(in_array($v['id'], $arrcompare)) {
                $v['checked'] = true;
                $v['halfChecked'] = true;
                $v['isParent'] = true;
                $v['open'] = true;
            }
            $v['children'] =  access_node_merage($v['children'], $arrcompare);
        } else {
            if(in_array($v['id'], $arrcompare)) {
                $v['checked'] = true;
            }
        }
        array_push($new_arr,$v);
    }
    return $new_arr;
}

/**
 * 获取菜单栏目录节点
 * @method getNode
 * */
function getNode() {
    $field = array('id','name','title','pid','status');
    $where['level'] = array('neq', '1');
    $where['status'] = array('eq', '1');
    $where['isMenu'] = array('eq', '1');
    $nodeData = M('node')->field($field)->where($where)->order('sort')->select();
    return node_merage($nodeData, 1);
}

/**
 * 获取所有节点（权限）
 * @method getAllNode
 * @param int $type 使用类型 0：获取正常的所有节点，1：获取权限配置所用的节点
 * @param array $comparearr 角色对应的权限数组
 * @return array
 * */
function getAllNode($type = 0, $comparearr = []) {
    $field = array('id','name','title','pid','status', 'level');
    $nodeData = M('node')->field($field)->order('sort')->select();
    if($type == 0) {
        return node_merage($nodeData, 0);
    } else if($type == 1) {
        return access_node_merage(node_merage($nodeData, 1), $comparearr);
    }
}

/**
 * 获取角色列表
 * @return array
 * */
function getRole() {
    $role = M('role')->field('id, name, remark')->select();
    return $role;
}

/**
 * 通过新浪接口将长连接转为短连接
 * @param string $source Appkey
 * @param string|array $url_long
 * @return array
 * */
function getSinaShortUrl($source, $url_long) {
    if(empty($source) || !$url_long) {
        return false;
    }

    if(!is_array($url_long)) {
        $url_long = array($url_long);
    }

    $url_param = array_map(function($value) {
       return '&url_long='.urlencode($value);
    }, $url_long);

    $url_param = implode('', $url_param);

    $api = 'http://api.t.sina.com.cn/short_url/shorten.json';

    // $request_url = sprintf($api.'?source=s%.s%', $source, $url_param);
    $request_url = 

    $result = array();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $request_url);
    $data = curl_exec($ch);
    if($error=curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    $result = json_decode($data, true);
    return $result;
}