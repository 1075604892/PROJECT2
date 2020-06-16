<?php
$search = $_POST['search'];
echo $search;
if($search == "srhtitle"){
    $title = $_POST['title'];
    echo $title;
    header('location:search.php?title='.$title);
}else if($search == "srhcontent"){
    $content = $_POST['content'];
    echo $content;
    header('location:search.php?content='.$content);
}
?>