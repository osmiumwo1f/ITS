<script type="text/javascript" src="<?php echo base_url();?>assets/upload.js"></script>
<div id="shade"></div>
<div id="modal">
    <?php echo form_open_multipart('events/upload_file');?>

    <label for="name">ชื่อ</label>
    <input type="input" name="name" size="20" id="name" value=""/><br>
    <label for="des">รายละเอียด</label>
    <textarea name="des" id="des"></textarea><br>
    <label for="userfile">ไฟล์</label>
    <input type="file" name="userfile" size="20" id="file" value=""/>

    <br /><br />

    <button type="submit" class="upload">เพิ่มไฟล์</button>

    </form>
    <button class="close">ปิด</button>
</div>
<?php
    echo '<h2>'.$e_item[0]['name'].'</h2><br>';
    echo 'des: '.$e_item[0]['descriptions'].'<br>';
    echo 'req: '.$e_item[0]['requirements'].'<br>';
    echo 'fee: '.$e_item[0]['fee'].'<br>';
    echo 'date: '.$e_item[0]['date'].'<br>';
    echo 'plc: '.$e_item[0]['place'].'<br>';
    echo 'amnt: '.$e_item[0]['amount'].'<br>';
    echo 'note: '.$e_item[0]['note'].'<br>';
?>
ไฟล์ที่ใช้ประกอบในการอบรม
<table class="event">
    <th>ชื่อไฟล์</th>
    <th>รายละเอียด</th>
    <?php foreach ($f_item as $f):?>
        <tr>
            <td><?php echo $f['name']; ?></td>
            <td><?php echo $f['descriptions']; ?></td>
        </tr>
    <?php endforeach ?>
</table>
<button id="file" class="add">เพิ่มไฟล์</button>
<a href="<?php echo $e_item[0]['id'];?>/satis/create/">สร้างแบบประเมินความพึงพอใจ</a>