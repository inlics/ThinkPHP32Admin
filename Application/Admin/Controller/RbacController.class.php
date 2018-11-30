<?php
namespace Admin\Controller;
use Think\Controller;
class RbacController extends CommonController {

    /**
     * 检测字符串是否含有中文
     * @method test_zw
     * @param string $str
     * @return bool true:有, false:无
     * */
    public function test_zw($str) {
        if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $str)>0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 展示角色列表
     * @method role
     * */
    public function role() {
        $roleData = M('role')->select();
        $this->assign('roleData', $roleData);
        // $this->assign('nodeData', getNode());
        // $this->assign('breakTitle', '角色表');
        $this->display('role');
    }

    /**
     * 添加角色
     * @method addRole
     * */
    public function addRole() {
        if(IS_POST) {
            if(!empty(I('post.name')) && !empty(I('post.remark'))) {
                $where['name'] = I('post.name');
                $roleName = M('role')->getField('name', true);
                if(in_array(strtolower(I('post.name')), $roleName)) {
                    $this->error('角色名已经存在，请修改角色名后重试'); return;
                } else {
                    $data = I('post.');
                    $id = M('role')->add($data);
                    if($id) {
                        $res = M('role')->where(array('id'=>$id))->setField('pid', $id);
                        if($res || ($res == 0 && $id == '1')) {
                            $this->success('角色添加成功', U('role'), 2);
                        } else {
                            $this->error('角色pid更新失败，请手动更改为pid为当前id值: '.$id);
                        }
                    } else {
                        $this->error('角色添加失败，请重试');
                    }
                }
            } else {
                $this->error('角色名称和描述不能为空,请重新添加');
            }
        } else {
            $this->display('addRole');
        }
    }

    /**
     * 展示权限节点
     * @method node
     * */
    public function node() {
        $nodeData = getAllNode();
        // $jsondata = json_encode($nodeData);
        $this->assign('nodeData', $nodeData);
        $this->display('node');
    }

    /**
     * 添加权限节点
     * @method addNode
     * */
    public function addNode() {
        if(IS_POST) {
            if(!empty(I('post.name')) && !empty(I('post.title'))) {
                if($this->test_zw(I('post.name'))) {
                    $this->error('节点名称只能含有英文字母'); return;
                }
                $nodeModel = M('node');
                $id = I('post.id');
                $level = I('post.level');
                $data = I('post.');
                if($level == 1 || $level == 2) {
                    $data['name'] = I('post.name','', 'ucfirst');
                }
                if(!empty($id)) {
                    $map_1['name'] = array('neq', $data['name']);
                    $map_1['pid'] = array('eq', $data['pid']);
                    $map_1['level'] = array('eq', $data['level']);
                    $chkname_1 = M('node')->where($map_1)->getField('name', true);
                    $res_1 = in_array(strtolower($data['name']), array_map('strtolower', $chkname_1));
                    if($res_1) {
                        $this->error('该级别节点下已存在 '.$data['name'].' 节点，请换一个名称！');
                        return;
                    }
                    if($nodeModel->save($data)) {
                        $this->success('编辑成功', U('node'), 2);
                    } else {
                        $this->error('未作任何修改');
                    }
                } else {
                    $map_2['level'] = array('eq', $level);
                    $map_2['pid'] = array('eq', $data['pid']);
                    $chkname_2 = M('node')->where($map_2)->getField('name', true);
                    $res_2 = in_array(strtolower($data['name']), array_map('strtolower', $chkname_2));
                    if($res_2) {
                        $this->error('该级别节点下已存在 '.$data['name'].' 节点，请换一个名称！');
                        return;
                    }
                    if($nodeModel->add($data)) {
                        $this->success('添加成功', U('node'), 2);
                    } else {
                        $this->error('添加失败');
                    }
                }
            } else {
                $this->error('名称和描述不能为空,请重新添加');
            }
        } else {
            $level = I('get.level', 1, 'intval');
            $pid = I('get.pid', 0, 'intval');
            switch($level) {
                case 1:
                    $type = '模块';
                    break;
                case 2:
                    $type = '控制器';
                    break;
                case 3:
                    $type = '方法';
                    break;
            }
            $this->assign('type', $type);
            $this->assign('pid', $pid);
            $this->assign('level', $level);
            $this->display('addNode');
        }
    }

    /**
     * 跳转到节点编辑页面
     * @method editNode
     * */
    public function editNode() {
        $id = I('get.id');
        $node = M('node')->find($id);
        $this->assign('node', $node);
        $this->display('editNode');
    }

    /**
     * 角色权限配置
     * @method access
     * */
    public function access() {
        $rid = I('get.id', 0, 'intval');
        $name = M('role')->where(array('id'=>$rid))->getField('name');
        $accessData = M('access')->where(array('role_id'=>$rid))->getField('node_id', true);
        $nodeData = getAllNode(1, $accessData);
        $this->assign('rid', $rid);
        $this->assign('name', $name);
        $this->assign('nodeData', json_encode($nodeData));
        $this->assign('accessData', $accessData);
        $this->display('access');
    }

    /**
     * 保存（新增或修改）角色对应的权限节点
     * @method saveNewAccess
     * */
    public function saveNewAccess() {
        $rid = I('post.rid');
        if(IS_POST && !empty(I('post.'))) {
            $data = I('post.');
            $arr = array();
            foreach($data['access'] as $v) {
                // $temp = explode('-', $v);
                $arr[] = array(
                    'role_id' => $rid,
                    'node_id' => $v
                    // 'level' => $temp[1]
                );
            }
            $accessModel = M('access');
            $accessModel->where(array('role_id' => $rid))->delete();
            if($accessModel->addAll($arr)) {
                // $this->success(, U('role'), 2);
                $this->ajaxReturn(array('err' => 0, 'msg' => '权限分配成功', 'url' => U("role"), 'wait' => 2));
            } else {
                // $this->error('权限分配失败');
                $this->ajaxReturn(array('err' => 1, 'msg' => '权限分配失败，请重试', 'wait' => 2));
            }
        } else {
            // $this->error('请至少选择一个权限');
            $this->ajaxReturn(array('err' => 1, 'msg' => '请至少选择一个权限', 'wait' => 2));
        }
    }

    /**
     * 展示用户列表
     * @method user
     * */
    public function user() {
        $userData = D('UserRelation')->relation(true)->select();
        $this->assign('userData', $userData);
        $this->display('user');
    }

    /**
     * 编辑用户
     * @method editUser
     * */
    public function editUser() {
        if(IS_POST && !empty(I('post.id'))) {
            $id = I('post.id');
            $map['id'] = array('neq', $id);
            $username_1 = M('user')->where($map)->getField('name', true);
            $arr = array(
                'name' => I('post.name'),
                'password' => md5(I('post.password')),
                'status' => I('post.status'),
                'phone' => I('post.phone'),
                'email' => I('post.email')
            );
            if(in_array(strtolower(I('post.name')), $username_1)) {
                $this->ajaxReturn(array('err' => 1, 'msg' => '用户名已存在，请修改', 'wait' => 2));
            }
            if(M('user')->where(array('id'=>$id))->save($arr) === false) {
                $this->ajaxReturn(array('err' => 1, 'msg' => '修改用户失败，请重试', 'wait' => 2));
            } else {
                $arr_1 = array();
                foreach(I('post.role_id') as $v) {
                    $arr_1[] = array(
                        'role_id' => $v,
                        'user_id' => $id
                    );
                }
                $ruModel = M('role_user');
                $ruModel->where(array('user_id'=>$id))->delete();
                if($ruModel->addAll($arr_1)) {
                    $this->ajaxReturn(array('err' => 0, 'msg' => '用户修改成功', 'url' => 'U("user")', 'wait' => 2));
                } else {
                    $this->ajaxReturn(array('err' => -1, 'msg' => '用户修改成功，但角色配置无效', 'wait' => 2));
                }
            }
        } else {
            $uid = I('get.id',0,'intval');
            $roleData = getRole();
            $userData = D('UserRelation')->relation(true)->field('id, name, phone, email')->find($uid);
            $rids = array();
            foreach($userData['role'] as $v) {
                $rids[] = $v['id'];
            }
            $this->assign('roleData', $roleData);
            $this->assign('role_ids', $rids);
            $this->assign('userData', $userData);
            $this->display('editUser');
        }
    }

    /**
     * 添加 / 修改 用户信息
     * @method addUser
     * */
    public function addUser() {
        if(IS_POST) {
            if(!empty(I('post.name')) && !empty(I('post.password'))) {
                $id = I('post.id');
                $userModel = M('user');
                $ruModel = M('role_user');
                $userAuthKey = buildAuthKey(8,false);
                $arr = array(
                    'name' => I('post.name'),
                    'password' => customerMd5(I('post.password'), $userAuthKey),
                    'status' => I('post.status'),
                    'phone' => I('post.phone'),
                    'email' => I('post.email'),
                    'auth' => $userAuthKey
                );

                if(!empty($id)) {
                    $map['id'] = array('neq', $id);
                    $username_1 = $userModel->where($map)->getField('name', true);
                    if(in_array(strtolower(I('post.name')), $username_1)) {
                        // $this->error('用户名已存在，请修改'); return;
                        $this->ajaxReturn(array('err' => 1, 'msg' => '用户名已存在，请修改', 'wait' => 2));
                    }
                    if($userModel->where(array('id'=>$id))->save($arr) === false) {
                        // $this->error('修改用户失败，请重试');
                        $this->ajaxReturn(array('err' => 1, 'msg' => '修改用户失败，请重试', 'wait' => 2));
                    } else {
                        $arr_1 = array();
                        foreach(I('post.role_id') as $v) {
                            $arr_1[] = array(
                                'role_id' => $v,
                                'user_id' => $id
                            );
                        }
                        $ruModel->where(array('user_id'=>$id))->delete();
                        if($ruModel->addAll($arr_1)) {
                            // $this->success('用户修改成功', U('user'), 2);
                            $this->ajaxReturn(array('err' => 1, 'msg' => '用户修改成功', 'wait' => 2));
                        } else {
                            // $this->success('用户修改成功，但角色配置无效', U('user'), 3);
                            $this->ajaxReturn(array('err' => 1, 'msg' => '用户修改成功，但角色配置无效', 'wait' => 2));
                        }
                    }
                } else {
                    $username_2 = $userModel->getField('name', true);
                    if(in_array(strtolower(I('post.name')), $username_2)) {
                        $this->ajaxReturn(array('err' => 1, 'msg' => '用户名已存在，请修改', 'wait' => 2));
                    }
                    $uid = $userModel->add($arr);
                    if($uid) {
                        $arr_2 = array();
                        foreach(I('post.role_id') as $v) {
                            $arr_2[] = array(
                                'role_id' => $v,
                                'user_id' => $uid
                            );
                        }
                        if($ruModel->addAll($arr_2)) {
                            $this->ajaxReturn(array('err' => 0, 'msg' => '用户添加成功', 'wait' => 2));
                        } else {
                            $this->ajaxReturn(array('err' => 1, 'msg' => '用户名已存在，请修改', 'wait' => 2));
                        }
                    } else {
                        $this->ajaxReturn(array('err' => 1, 'msg' => '用户添加失败，请重试', 'wait' => 2));
                    }
                }
            } else {
                // $this->error('用户名或密码不能为空');
                $this->ajaxReturn(array('err' => 1, 'msg' => '用户名或密码不能为空', 'wait' => 2));
            }
        } else {
            $this->assign('roleData', getRole());
            $this->display('addUser');
        }
    }

}