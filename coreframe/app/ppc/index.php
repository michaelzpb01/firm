<?php
class index{
	function __construct() {
	}

    /**
     *  ����ע��
     */
	function index() {
        $uid = intval($GLOBALS['uid']);
        if(!$uid) {
            header("Location:".WEBURL);
            exit;
        }
        $_uid = get_cookie('_uid');
        if($_uid && is_numeric($_uid)) {
            //�Ѿ���¼���û�����ɹ��ƹ������
            header("Location:".WEBURL);
            exit;
        } else {
            $times = SYS_TIME+86400*7;
            set_cookie('ppc_uid',$uid,$times);
            $db = load_class('db');
            $ip = get_ip();
            $db->insert('ppc',array('uid'=>$uid,'addtime'=>SYS_TIME,'ip'=>$ip));
            //��̨�����ƹ�ҳ����ת��ַ
            $setting = get_cache('setting','ppc');
            if(empty($setting['redirect_url'])) MSG('���ں�̨�����ƹ�ҳ���ַ');
            header("Location:".$setting['redirect_url']);
        }
	}
    public function test() {
        echo 'test';
    }
}
