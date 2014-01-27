<div class="grid_10 push_3">

    <form class="library" action="/books/save_new_book" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="file">Book</label>
            <input type="file" name="file" id="file" /><br />
            <label for="subjects">Subject</label>
            <?php echo $this->book_model->get_subjects_dropdown(); ?><br /><br />
            <label for="new_subject">New Subject</label>
            <input type="text" name="new_subject" size="50"><br />
            <label for="display_name">Display Name</label>
            <input name="display_name" type="text" size="50" /><br />
            <label for="year-published">Year</label>
            <input type="text" name="year_published" size="5" maxlength="4" /><br />

            <label fo="link">Book Link</label>
            <input type="text" name="link" size="65" /><br />
            <label for="forum">Forum Link</label>
            <input type="text" name="forum" size="65" /><br />
            <label for="rating">Rating</label>
            <?php echo $this->book_model->get_ratings_dropdown(); ?><br />
            <label for="comments">Comments</label><br />

            <textarea name="comments" rows="5" cols="35"></textarea><br /><br />
            <label for="picture">Image</label>
            <input type="file" name="image" id="file" /><br />
            <input type="submit" value="Add" />
        </fieldset>
    </form>
</div>