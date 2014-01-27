<div class="grid_10 push_3">
<?php
//print_array($book, null, 1);
// $book is array of book details from books/edit_book
$id = $book['id'];
$display_name = $book['display_name'];
$rating = $book['rating'];
$size = format_bytes($book['size']);
$year = $book['year_published'];
$comments = $book['comments'];
$link = $book['link'];
$image = $book['image'];
$forum = $book['forum'];

//$attrib = array('class' => 'library');
//echo form_open('books/save_book_edits', $attrib);
?>

<form action="/books/save_book_edits" class="library" method="post">
    <fieldset>
    <label for="display_name">Title</label>
    <input type="text" name="display_name" value="<?php echo $display_name; ?>" size="75"><br />
    &nbsp;&nbsp;[<?php echo $size; ?>]<br />
    <label for="year">Year</label><br /><br />
    <input type="text" name="year" value="<?php echo $year; ?>" size="5"><br />
    <label for="link">Link</label>
    <input type="text" name="link" value="<?php echo $link; ?>" size="75"><br />
    <label for="forum">Forum</label>
    <input type="text" name="forum" value="<?php echo $forum; ?>" size="75"><br />
    <label for="rating">Rating</label><br /><br />
    <div class="grid_2">
    <?php

        for($i = 1; $i<7; $i++){
            $rating_name = $this->book_model->find_rating_name($i);
            if ($rating == $i){
                echo '<input type="radio" name="rating" value="'.$i.'" checked="checked">'.$rating_name."<br />\n";
            }else{
                echo '<input type="radio" name="rating" value="'.$i.'">'.$rating_name."<br />\n";
            }
        }
        //echo '<input type="radio" name="rating" value="6">none<br />';
    ?>
    </div>
    <div class="grid_7">
        <label for="comments">Comments</label>
    <textarea name="comments" rows="8" cols="35"><?php echo $comments; ?></textarea>
    </div>
    <div class="clear"></div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" value="Update Info">
    </fieldset>
</form>
    <div class="grid10">
        <form action="/books/change_image" class="library" method="post" enctype="multipart/form-data">
            <fieldset>
        <input type="file" name="image"><br />
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="image" value="Update Image">
        </fieldset>
        </form>
    </div>
    <div class="grid_10">
       <img src="<?php echo $image; ?>">
    </div>

</div>