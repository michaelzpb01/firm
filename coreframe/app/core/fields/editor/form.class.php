<?php exit();?>
private function editor($config, $value) {
    extract($config,EXTR_SKIP);
    extract($setting,EXTR_SKIP);
    if($toolbar=='textarea') {
        return '<textarea name="form['.$field.']" id="'.$field.'" class="form-control" rows="3" boxid="'.$field.'" datatype="*" nullmsg="请输入'.$name.'" errormsg="'.$name.'不能为空">'.$value.'</textarea>';
    } else {
        return '<textarea name="form['.$field.']" id="'.$field.'" boxid="'.$field.'" datatype="*" nullmsg="请输入'.$name.'" errormsg="'.$name.'不能为空">'.$value.'</textarea>'.$this->form->editor($field,$field,'',$toolbar);
    }
}
