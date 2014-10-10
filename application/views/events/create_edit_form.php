<?php
    echo validation_errors();
    echo form_open('events/create') ?>

	<label for="name">หัวข้อการอบรม/กำหนดการ</label>
	<input type="text" name="name" /><br />
	<label for="des">รายละเอียด</label>
	<textarea name="des"></textarea><br />
    <label for="req">คุณสมบัติผู้เข้าอบรม</label>
	<input type="text" name="req" /><br />
    <label for="fee">ค่าลงทะเบียน</label>
	<input type="text" name="fee" /><br />
    <label for="date">วัน/เวลา</label>
	<input type="text" name="date" /><br />
    <label for="place">สถานที่อบรม</label>
	<input type="text" name="place" /><br />
    <label for="amount">จำกัดจำนวน</label>
	<input type="text" name="amount" /><br />
    <label for="note">หมายเหตุ</label>
	<textarea name="note"></textarea><br />

	<input type="submit" name="submit" value="ตกลง" />

</form>