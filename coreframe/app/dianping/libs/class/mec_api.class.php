<?php
// +----------------------------------------------------------------------
// | wuzhicms [ ��ָ������վ���ݹ���ϵͳ ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * �������
 */
class WUZHI_mec_api {
	public function __construct() {
        $this->db = load_class('db');
	}

    /**
     * ��ȡmec
     *
     * @param $id ����id
     */
    public function get($id) {
        $r = $this->db->get_one('mec', array('id' => $id));
        return $r;
    }
}