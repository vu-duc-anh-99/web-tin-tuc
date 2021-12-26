<?php

$dblib = new dblib();

$sql = "SELECT * FROM posts ORDER BY view DESC LIMIT 2";
$data = $dblib->get_list($sql);


?>
<div class="container_fluid right_side">

    <div class="row">
        <h4>Bài viết được xem nhiều</h4>
        <br>
        <div>
            <?php
            for($i = 0; $i < count($data); $i ++) {
                $id = $data[$i]["post_id"];
                $title = $data[$i]["title"];
                $image = $data[$i]["image"];
                $summary = $data[$i]["summary"];;
                ?>
                <div>
                    <a href="post_detail.php?id=<?php echo $id ?>&<?php echo $title ?>"><h6><?php echo $title ?></h6></a>
                </div>
                <div id="img">
                    <img src="images/<?php echo $image ?>" width="275px" height="160px">
                </div>
                <div id = "content">
                    <?php echo $summary; ?>   
                </div>

            <?php } ?>
        </div>
    </div>
</div>
