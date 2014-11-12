<!doctype html>
<html>
<head>
    <script src="<?php echo base_url()?>assets/upload.js"></script>
</head>
<body>
    <?php
        echo $error;
        echo form_open_multipart('files/upload_file');?>
        <label for="name">ชื่อ</label>
        <input type="text" name="name" id="name" value="" />

        <label for="des">คำอธิบาย</label>
        <textarea name="des" id="des"></textarea>
 
        <label for="userfile">ไฟล์</label>
        <input type="file" name="userfile" id="file" size="20" />
 
        <input type="submit" name="submit" id="submit" value="เพิ่มไฟล์" />
    </form>
    <h2>Files</h2>
    <div id="files"></div>
</body>
</html>