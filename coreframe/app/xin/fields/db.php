<?php
defined('IN_ADMIN') or exit('No permission resources.');
if(isset($GLOBALS['field_type'])) {
	$field_type = $GLOBALS['field_type'];
} else {
	$field_type = $config['field_type'];
}
$db_table = $formdata['master_field'] ? $this->db->tablepre.$model_r['master_table'] : $this->db->tablepre.$model_r['attr_table'];
$initialise = isset($GLOBALS['setting']['initialise']) ? $GLOBALS['setting']['initialise'] : '';
$min_value = isset($GLOBALS['setting']['minnumber']) ? intval($GLOBALS['setting']['minnumber']) : 1;
$decimaldigits = isset($GLOBALS['setting']['decimaldigits']) ? $GLOBALS['setting']['decimaldigits'] : '';
//判断是添加字段还是修改字段
if($action=='add') {
	$sqltype = "ADD `$field`";
} else {
	$sqltype = "CHANGE `$oldfield` `$field`";
}

switch($field_type) {
	case 'varchar':
		if(!$maxlength) $maxlength = 255;
		$maxlength = min($maxlength, 255);
		$sql = "ALTER TABLE `$db_table` $sqltype CHAR( $maxlength ) NOT NULL DEFAULT '$initialise'";
		$this->db->query($sql);
	break;

	case 'mediumtext':
		$this->db->query("ALTER TABLE `$db_table` $sqltype MEDIUMTEXT NOT NULL");
	break;
	
	case 'text':
		$this->db->query("ALTER TABLE `$db_table` $sqltype TEXT NOT NULL");
	break;

	case 'tinyint':
		$initialise = intval($initialise);
		$this->db->query("ALTER TABLE `$db_table` $sqltype TINYINT ".($min_value >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$initialise'");
	break;

	case 'smallint':
		$initialise = intval($initialise);
		$this->db->query("ALTER TABLE `$db_table` $sqltype SMALLINT ".($min_value >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$initialise'");
	break;

	case 'mediumint':
		$initialise = intval($initialise);
		$this->db->query("ALTER TABLE `$db_table` $sqltype MEDIUMINT ".($min_value >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$initialise'");
	break;

	case 'int':
		$initialise = intval($initialise);
		$this->db->query("ALTER TABLE `$db_table` $sqltype INT ".($min_value >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$initialise'");
	break;

	case 'number':
		$initialise = $decimaldigits == 0 ? intval($initialise) : floatval($initialise);
		$sql = "ALTER TABLE `$db_table` $sqltype ".($decimaldigits == 0 ? 'INT' : 'FLOAT')." ".($min_value >= 0 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$initialise'";
		$this->db->query($sql);
	break;

	case 'date':
		$this->db->query("ALTER TABLE `$db_table` $sqltype DATE NULL");
	break;
	
	case 'datetime':
		$this->db->query("ALTER TABLE `$db_table` $sqltype DATETIME NULL");
	break;
	
	case 'timestamp':
		$this->db->query("ALTER TABLE `$db_table` $sqltype TIMESTAMP NOT NULL");
	break;
	//金币
	case 'coin':
		$initialise = intval($initialise);
		$this->db->query("ALTER TABLE `$db_table` $sqltype smallint(5) unsigned NOT NULL default '$initialise'");
	break;
    case 'money':
		$this->db->query("ALTER TABLE `$db_table` $sqltype decimal(10,2) NOT NULL default '0.00'");
	break;

    case 'map':
        if($action=='add') {
            $sqltype1 = "ADD `{$field}_zoom`";
            $sqltype2 = "ADD `{$field}_x`";
            $sqltype3 = "ADD `{$field}_y`";
        } else {
            $sqltype1 = "CHANGE `{$oldfield}_zoom` `{$field}_zoom`";
            $sqltype2 = "CHANGE `{$oldfield}_x` `{$field}_x`";
            $sqltype3 = "CHANGE `{$oldfield}_y` `{$field}_y`";
        }

        $sql = "ALTER TABLE `$db_table` $sqltype1 TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '8'";
        $this->db->query($sql);
        $sql = "ALTER TABLE `$db_table` $sqltype2 decimal(10,6) NOT NULL DEFAULT '0'";
        $this->db->query($sql);
        $sql = "ALTER TABLE `$db_table` $sqltype3 decimal(10,6) NOT NULL DEFAULT '0'";
        $this->db->query($sql);
        break;
    case 'price_group':
        if($action=='add') {
            $sqltype1 = "ADD `{$field}`";
            $sqltype2 = "ADD `{$field}_old`";
        } else {
            $sqltype1 = "CHANGE `{$oldfield}` `{$field}_zoom`";
            $sqltype2 = "CHANGE `{$oldfield}_old` `{$field}_old`";
        }

        $sql = "ALTER TABLE `$db_table` $sqltype1 decimal(8,2) NOT NULL DEFAULT '8'";
        $this->db->query($sql);
        $sql = "ALTER TABLE `$db_table` $sqltype2 decimal(8,2) NOT NULL DEFAULT '0'";
        $this->db->query($sql);
        break;
}
?>