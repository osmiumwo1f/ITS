<!doctype html>
<html>
<head>
    <script src="<?php echo base_url()?>assets/upload.js"></script>
</head>
<body>
    <?php
        echo $error;
        echo form_open_multipart('files/upload_file');?>
 
        <label for="userfile">ไฟล์</label>
        <input type="file" name="userfile" id="userfile" size="20" />
        <br>
        <label for="des">คำอธิบาย</label>
        <textarea name="des" id="des"></textarea>
 
        <input type="submit" name="submit" id="submit" value="เพิ่มไฟล์" />
    </form>
</body>
</html>