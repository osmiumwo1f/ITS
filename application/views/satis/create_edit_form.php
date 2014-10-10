<div id="shade"></div>
<div id="modal">
    <div id="si_container">
        <?php
            foreach ($satis_groups as $sg)
            {
                echo '<div id="'.$sg['id'].'" class="si">'.$sg['name'].'</div>';
            }
        ?>
    </div>
    <button class="close">ปิด</button>
</div>

<div class="sgph" id="0" data-i="0">
    <button id="add_sgi" class="add">เพิ่มกลุ่ม</button>
</div>
