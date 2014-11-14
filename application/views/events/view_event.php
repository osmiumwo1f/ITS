<script type="text/javascript" src="<?php echo base_url();?>assets/upload.js"></script>
<div id="shade"></div>
<!--<iframe id="modal" src="<?php echo base_url();?>events/<?php echo $e_item[0]['id'];?>/upload">-->

<div id="modal">
    <?php
        //echo $error;
        echo form_open_multipart('files/upload_file');?>
        <input type="hidden" name="e_id" id="e_id" value="<?php echo $e_item[0]['id'];?>" />
        <label for="userfile">ไฟล์</label>
        <input type="file" name="userfile" id="userfile" size="20" />
        <br>
        <label for="des">คำอธิบาย</label>
        <textarea name="des" id="des"></textarea>
     
        <input type="submit" name="submit" id="submit" value="เพิ่มไฟล์" />
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
            <td><a href="<?php echo base_url().'uploads/'.$f['path'];?>"><?php echo $f['name']; ?></a></td>
            <td><?php echo $f['descriptions']; ?></td>
        </tr>
    <?php endforeach ?>
</table>
<button id="file" class="add">เพิ่มไฟล์</button>
<a href="<?php echo $e_item[0]['id'];?>/satis/create/">สร้างแบบประเมินความพึงพอใจ</a>