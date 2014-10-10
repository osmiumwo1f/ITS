<?php echo $error;?><br>

<?php echo form_open_multipart('files/upload_file');?>

<label for="name">ชื่อ</label>
<input type="input" name="name" size="20" /><br>
<label for="des">รายละเอียด</label>
<textarea name="des"/></textarea><br>
<label for="userfile">ไฟล์</label>
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>