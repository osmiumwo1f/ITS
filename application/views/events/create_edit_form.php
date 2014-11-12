<?php
    echo validation_errors();
    echo form_open('events/create') ?>

	<label for="name">หัวข้อการอบรม/กำหนดการ</label>
	<input type="text" name="name" value="<?php echo set_value('name'); ?>"/><br />
	<label for="des">รายละเอียด</label>
	<textarea name="des"><?php echo set_value('des'); ?></textarea><br />
    <label for="req">คุณสมบัติผู้เข้าอบรม</label>
	<input type="text" name="req" value="<?php echo set_value('req'); ?>"/><br />
    <label for="fee">ค่าลงทะเบียน</label>
	<input type="text" name="fee" value="<?php echo set_value('fee'); ?>"/><br />
    <label for="date">วัน/เวลา</label>
	<input type="text" name="date" value="<?php echo set_value('date'); ?>"/><br />
    <label for="place">สถานที่อบรม</label>
	<input type="text" name="place" value="<?php echo set_value('place'); ?>"/><br />
    <label for="amount">จำกัดจำนวน</label>
	<input type="text" name="amount" value="<?php echo set_value('amount'); ?>"/><br />
    <label for="note">หมายเหตุ</label>
	<textarea name="note"><?php echo set_value('note'); ?></textarea><br />

	<input type="submit" name="submit" value="ตกลง" />

</form>