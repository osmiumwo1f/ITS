<?php 
	echo validation_errors();
   	echo form_open('users/login'); ?>
	<label for="usr">ชื่อผู้ใช้งาน</label>
	<input type="text" name="usr" id="usr" />
	<label for="pwd">รหัสผ่าน</label>
	<input type="text" name="pwd" id="pwd" />
	<input type="submit" id="submit" value="ลงชื่อเข้าใช้งาน" />
</form>
