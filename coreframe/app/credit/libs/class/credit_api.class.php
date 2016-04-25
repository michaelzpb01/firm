<?php
// +----------------------------------------------------------------------
// | wuzhicms [ ��ָ������վ���ݹ���ϵͳ ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * ���ֲ�����
 * ���ֻ�ȡ������
 */
class WUZHI_credit_api {
	public function __construct() {
        $this->db = load_class('db');
	}

    /**
     * ���ֲ�����
     *
     * @param $uid �û�id
     * @param $method , + , -
     * @param $point ��������������
     * @param $remark ������
     * @param string $note ���鱸ע
     */
    public function handle($uid, $method,$point, $remark,$note = '',$keyid = '') {
        $point = intval($point);
        if($point<0) {
            return false;
        } elseif($point==0) {
            return true;
        }
        if($method=='+') {
            $this->db->update('member', "`points`=(`points`+$point)",array('uid'=>$uid));
            $j_type = 1;
        } elseif($method=='-') {
            $this->db->update('member', "`points`=(`points`-$point)",array('uid'=>$uid));
            $j_type = 2;
        } else {
            return false;
        }
        $jid = $this->db->insert('credit',array('uid'=>$uid,'remark'=>$remark,'j_type'=>$j_type,'point'=>$point,'addtime'=>SYS_TIME,'keyid'=>$keyid));
        $this->db->insert('credit_data',array('jid'=>$jid,'content'=>$note));
        return $jid;
    }

    /**
     * ����keyid��ȡ��¼
     * @param $keyid
     * @return mixed
     */
    public function get($keyid,$addtime = 0) {
        if($addtime) {
            $r = $this->db->get_one('credit', "`keyid`='$keyid' AND `addtime`='$addtime'");
        } else {
            $r = $this->db->get_one('credit', array('keyid' => $keyid));
        }
        return $r;
    }
}