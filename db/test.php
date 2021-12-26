<?php  

include 'class_db.php';

class Test extends dblib{

function createChildMenu($parentID){
    $idMenu = array();
    $nameMenu = array();
    $sql = "SELECT * FROM category WHERE parent_id = ".$parentID; 
    $result = mysqli_query(parent::connect(),$sql);

    while($row = mysqli_fetch_assoc($result)){ 
            array_push($idMenu,$row['category_id']);
            array_push($nameMenu,$row['name']);  
    }
    if(count($idMenu)>0){
        echo '<ul class="dropdown-menu">';
        for($i = 0;$i<count($idMenu);$i++){
            echo '<li class="nav-item">';
            echo "$nameMenu[$i]";
            $this->createChildMenu($idMenu[$i]);
        }
        echo "</ul>";
    }
    else{
        echo "</li>";
    }
}

function createMenu(){
    $sql = "SELECT * FROM category";
    $result = mysqli_query(parent::connect(),$sql);
    echo '<div class = "dropdown">';
    echo '<nav class="navbar navbar-expand-sm bg-light justify-content-center">';
    echo '<ul class="dropdown-menu">';

    while ($row = mysqli_fetch_assoc($result)) {
        if($row['parent_id']==0){
            echo '<li class="nav-item">';
            echo $row['name'];
            $this->createChildMenu($row['category_id']);
            echo "</li>";
        }
    }
    echo "</ul>";
    echo "</nav>";
    echo "</div>";
}

}


?>

