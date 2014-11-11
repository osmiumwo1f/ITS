<script type="text/javascript" src="<?php echo $burl;?>assets/upload.js"></script>
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
<<<<<<< HEAD
echo '<h2>'.$e_item[1]['name'].'</h2><br>';
echo '1: '.$e_item[1]['descriptions'].'<br>';
echo '2: '.$e_item[1]['requirements'].'<br>';
echo '3: '.$e_item[1]['fee'].'<br>';
echo '4: '.$e_item[1]['date'].'<br>';
echo '5: '.$e_item[1]['place'].'<br>';
echo '6: '.$e_item[1]['amount'].'<br>';
echo '7: '.$e_item[1]['note'].'<br>';
?>
<table class="event">
    <th>ชื่อไฟล์</th>
    <th>รายละเอียด</th>
    <?php foreach ($e_item as $f):?>
        <tr>
            <td><?php echo $f['fn']; ?></td>
            <td><?php echo $f['fd']; ?></td>
        </tr>
    <?php endforeach ?>
</table>
<button id="file" class="add">เพิ่มไฟล์</button>
<a href="<?php echo $e_item[1]['id'];?>/satis/create/">สร้างแบบประเมินความพึงพอใจ</a>
=======
    echo '<h2>'.$e_item[1]['name'].'</h2><br>';
    echo '1: '.$e_item[1]['descriptions'].'<br>';
    echo '2: '.$e_item[1]['requirements'].'<br>';
    echo '3: '.$e_item[1]['fee'].'<br>';
    echo '4: '.$e_item[1]['date'].'<br>';
    echo '5: '.$e_item[1]['place'].'<br>';
    echo '6: '.$e_item[1]['amount'].'<br>';
    echo '7: '.$e_item[1]['note'].'<br>';
    ?>
    <table class="event">
        <th>ชื่อไฟล์</th>
        <th>รายละเอียด</th>
        <?php foreach ($e_item as $f):?>
            <tr>
                <td><?php echo $f['fn']; ?></td>
                <td><?php echo $f['fd']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <a href="satis/create/">สร้างแบบประเมินความพึงพอใจ</a>
</div>
>>>>>>> parent of 4a9c1cb... Glue all functions together
