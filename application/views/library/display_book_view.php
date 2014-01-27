<div class="grid_12 push_2">
<?php
// $book comes from books/display_books
    //print_array($book);

if(!isset($book)){

    $book = $this->book_model->find_book_by_id($id);

}

$id = $book['id'];

$location = $book['location'];
$name = $book['name'];
$display_name = $book['display_name'];
$size = format_bytes($book['size']);

$rating = $book['rating'];
$rating = $this->book_model->find_rating_name($rating);

$year_published = $book['year_published'];
if($year_published == 0){
    $year_published = null;
}
$comments = nl2br($book['comments']);
$link = $book['link'];
$forum = $book['forum'];
$image = $book['image'];

$subject_name = $this->book_model->find_subject_name_by_book_id($id);

if($link == ''){
    echo "<h2>$display_name<br /><span class='mini_text'>$year_published</span></h2>\n";
}else{
    echo "<h2><a href='$link' target='_blank'>$display_name</a><br />\n<span class='mini_text'>$year_published</span>";
}

if(!empty($forum)){
    echo "<h3><a href='{$forum}' target='_blank'>Book Forum/Example Code</a></h3>";
}

if($rating !== ''){
    echo "<h3>Rating: $rating</h3>\n";
}

if(isset($size)){
        echo '<span class="mini_text">file size: '.$size.  "</span><br />\n";
    }



if(!empty($comments)){
    echo '<form action="#" method="post" class="library">';
    echo '<fieldset>';
    echo "<p>$comments</p>";
    echo '</fieldset>';
    echo "</form>\n";
}


if(!empty($image)){
    //echo "<div class='grid_10'>";
    echo "<img id='pdfImage' src='http://stuff.chouinard.me/$image'/>";
    //echo "</div>";
}

?>

    <form action="/books/download2" class="library" method="post">

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Download this book">

    </form>
    <?php
    if($this->ion_auth->is_admin()){

    echo '<br /><a href="edit_book/'.$id.'">Back to Edit</a><br />';
}
    ?>
    <a href="/books/list_by_subject/<?php echo $subject_name; ?>">Back to Listings</a>


<?php


?>


</div>