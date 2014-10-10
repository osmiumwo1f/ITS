<?php
    if($state == 'edit')
    {
        $edit_btn = '<input type="button" id="db" value="แก้ไข" onclick="disableForm()" />';
        $disabled = ' disabled="disabled"';
        $btn_text = 'ตกลง';
        $page = 'users/'.$users['id'];
    }
    else
    {
        $edit_btn = '';
        $disabled = '';
        $btn_text = 'เพิ่มผู้ใช้งาน';
        $page = 'users/create';
    }

    echo validation_errors();
    echo form_open($page);
?>
    <table>
    <tr><td colspan="2"><label for="usr" id="test">ชื่อผู้ใช้งาน: </label></td>
    <td colspan="2"><input class="usr_form" type="text" name="usr" value="<?php echo set_value('usr', $users['usr']) ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="pwd">รหัสผ่าน: </label></td>
    <td colspan="2"><input class="usr_form" type="password" name="pwd" value="<?php echo set_value('pwd', $users['pwd']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="cpwd">ยืนยันรหัสผ่าน: </label></td>
    <td colspan="2"><input class="usr_form" type="password" name="cpwd" value="<?php echo set_value('cpwd', $users['pwd']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="f_name">ชื่อ: </label></td>
    <td colspan="2"><input class="usr_form" type="text" name="f_name" value="<?php echo set_value('f_name', $users['f_name']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="l_name">นามสกุล: </label></td>
    <td colspan="2"><input class="usr_form" type="text" name="l_name" value="<?php echo set_value('l_name', $users['l_name']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="rank">ตำแหน่ง: </label></td>
    <td colspan="2"><input class="usr_form" type="text" name="rank" value="<?php echo set_value('rank', $users['rank']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="phone">เบอร์โทรศัพท์: </label></td>
    <td colspan="2"><input class="usr_form" type="text" name="phone" value="<?php echo set_value('phone', $users['phone']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td colspan="2"><label for="email">E-mail: </label></td>
    <td colspan="2"><input class="usr_form" type="text" name="email" value="<?php echo set_value('email', $users['email']); ?>"<?php echo $disabled;?> /></td></tr>
    <tr><td rowspan="3"><label for="email">สิทธิ์เกี่ยวกับการอบรบ </label></td>
    <td><label for="create">สร้าง</label></td><td><input class="usr_form" type="checkbox" name="create" value="1" <?php echo set_checkbox('create', '1', (($users['create'] > 0)? TRUE:FALSE)).$disabled;?> /></td></tr>
    <tr><td><label for="edit">แก้ไข</label></td><td><input class="usr_form" type="checkbox" name="edit" value="1" <?php echo set_checkbox('edit', '1', (($users['edit'] > 0)? TRUE:FALSE)).$disabled;?> /></td></tr>
    <tr><td><label for="delete">ลบ</label></td><td><input class="usr_form" type="checkbox" name="delete" value="1" <?php echo set_checkbox('delete', '1', (($users['delete'] > 0)? TRUE:FALSE)).$disabled;?> /></td></tr>
    <tr><td rowspan="3"><label for="email">สิทธิ์เกี่ยวกับผู้ใช้งาน </label></td>
    <td><label for="create">สร้าง</label></td><td><input class="usr_form" type="checkbox" name="usr_create" value="1" <?php echo set_checkbox('usr_create', '1', (($users['usr_create'] > 0)? TRUE:FALSE)).$disabled;?> /></td></tr>
    <tr><td><label for="edit">แก้ไข</label></td><td><input class="usr_form" type="checkbox" name="usr_edit" value="1" <?php echo set_checkbox('usr_edit', '1', (($users['usr_edit'] > 0)? TRUE:FALSE)).$disabled;?> /></td></tr>
    <tr><td><label for="delete">ลบ</label></td><td><input class="usr_form" type="checkbox" name="usr_delete" value="1" <?php echo set_checkbox('usr_delete', '1', (($users['usr_delete'] > 0)? TRUE:FALSE)).$disabled;?> /></td>
    <tr><td colspan="3"><div><input class="usr_form" type="submit" name="submit" value="<?php echo $btn_text;?>"<?php echo $disabled;?> /><?php echo $edit_btn; ?></div></td></tr>
    </table>
</form>