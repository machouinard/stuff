<div class="grid_14 push_1">

    <?php
    $url = 'http://audio.thisamericanlife.org/jomamashouse/ismymamashouse/';
    // get last episode number from database
    $this->db->select_max('number');
    $result = $this->db->get('podcasts');

    $last_episode = $result->row()->number;
    $last_episode++;
    $new_url = $url.$last_episode.'.mp3';
    //

    // check to see if next episode is available from tal
    $episode_list = array();
    while(FALSE !== url_exists($new_url)){

        // build options for download select list
        $episode_list[$last_episode] = $last_episode;
        //
        $last_episode++;
        $new_url = $url.$last_episode.'.mp3';
    }
    //

    // download and process next available episode
    $next_episode = $last_episode.'.mp3';
    $save_loc = 'test/'.$next_episode;

    echo form_open('/tal/get_episode');
    echo form_fieldset('New Episodes');

    if(!empty($episode_list)){
        foreach($episode_list as $episode){
            echo '<h3>'.$episode.'</h3>'.  "<br />\n";
        }
        echo form_hidden('episodes', $episode_list);
        echo form_submit('submit', 'Download');
    }else{
        echo "<h2>There are no new episodes</h2>\n";
    }

    echo form_fieldset_close();
    echo form_close();



function url_exists($url) {
    $ch = @curl_init($url);
    @curl_setopt($ch, CURLOPT_HEADER, TRUE);
    @curl_setopt($ch, CURLOPT_NOBODY, TRUE);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $status = array();
    preg_match('/HTTP\/.* ([0-9]+) .*/', @curl_exec($ch) , $status);
    return ($status[1] == 200);
}



    ?>





</div>