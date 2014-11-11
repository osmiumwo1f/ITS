<!doctype html>
<html>
<head>
    <script src="<?php echo base_url()?>assets/upload.js"></script>
</head>
<body>
    <form method="post" action="" id="upload_file">
        <label for="name">ชื่อ</label>
        <input type="text" name="name" id="name" value="" />

        <label for="des">คำอธิบาย</label>
        <textarea name="des" id="des"></textarea>
 
        <label for="file">ไฟล์</label>
        <input type="file" name="file" id="file" size="20" />
 
        <input type="submit" name="submit" id="submit" value="เพิ่มไฟล์" />
    </form>
    <h2>Files</h2>
    <div id="files"></div>
</body>
</html>