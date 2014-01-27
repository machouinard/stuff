<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Audio_episode{


    public $title;
    public $airdate = '2012-08-10';
    public $body = NULL;
    public $number;
    public $url;
    public $location;
    public $size;
    public $type = 'audio/mpeg';
    public $comments = NULL;
    public $image = 'http://chouinard.me/archives/cartalk/cartalk.jpg';
    public $category;



    function __construct(){
            log_message('debug', 'Audio_episode Class Initialized');

	}



        public function build_episode($names, $dir, $category = null){

            $match = array();
            sort($names);
            foreach($names as $name){
                if($name !== 'cartalk.jpg'){
                $podcast = new Audio_episode();
                preg_match('~-+([\d]{1,4})_+-+([!,\'\d\s\w-]*).mp3~', $name, $matches);
//                preg_match('~[\d\s\w-]+#?([\d]{1,4})[_\s]*([!\',\d\s\w-]+).mp3~', $name, $matches);
                //print_array($matches);
                $podcast->category = $category;
                $podcast->number = $matches[1];
                $podcast->title = preg_replace('~-{1}~', ' ',$matches[2]);
                $podcast->title = preg_replace('~-{2}~', '-', $podcast->title);
                $original_location = '/home/machoui/public_html/'.$dir.$name;

                $name = preg_replace('~[\s#,]~', '-', $name);

                $podcast->url = 'http://chouinard.me/'.$dir.$name;
                $podcast->location = '/home/machoui/public_html/'.$dir.$name;
                $podcast->size = filesize($podcast->location);

                $podcast->body = 'Episode #'.$podcast->number;
                //rename($original_location, $location);
                //echo 'Original location: '.$original_location.  "<br />\n";
                //echo 'Name: '.$name.  "<br />\n";
//                echo 'Title: '.$this->title.  "<br />\n";
//                echo 'Airdate: '.$this->airdate.  "<br />\n";
//                echo 'Body: '.$this->body.  "<br />\n";
//                echo 'Number: '.$this->number.  "<br />\n";
//                echo 'URL: '.$this->url.  "<br />\n";
//                echo 'Location: '.$this->location.  "<br />\n";
//                echo 'Size: '.$this->size.  "<br />\n";
//                echo 'Type: '.$this->type.  "<br />\n";
//                echo 'Comments: '.$this->comments.  "<br />\n";
//                echo 'Image: '.$this->image.  "<br />\n";
//                echo 'Category: '.$this->category.  "<br /><br />\n";
                print_array($podcast);
                $this->_insert_into_db($podcast);
            }
            }
        }


        private function _insert_into_db($podcast){
            $CI =& get_instance();
            $DB2 = $CI->load->database('podcast', TRUE);
            $DB2->insert('podcasts', $podcast);
        }

        function get_episode_info_for_db(){
       //$regex = '~<h4><a\shref="([\s\w\d/-]+)">'.$this->number.':\s([\d\w\s-/]*)</a>\s*<span[\s\d\w="-]+>([\d.]+)</span>~';
       //$regex = "~<h4><a\shref=\"([\s\w\d/-]+)\">$this->number:\s([\d\w\s-/']*)</a>\s*<span[\s\d\w=\"-]+>([\d.]+)</span>~";
       $regex = "~<h4><a\shref=\"([/\d\s\w%-]+)\">$this->number:\s([—()…&#;\d\s\w\.\-,?/!']+)</a>\s*<span\sclass=\"date-display-single\">([\d\.]{1,8})</span></h4>~";
       $base_url = 'http://www.thisamericanlife.org';
       $year = $this->get_year($this->number);
       $url = "http://www.thisamericanlife.org/radio-archives/".$year;



       $contents = file_get_contents($url);

       $newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
       $content = str_replace($newlines, "", html_entity_decode($contents));


       preg_match($regex, $content, $matches);

       //print_array($matches, null, 1);
       $episode_loc = $matches[1];
       $raw_title = ($matches[2]);
       $raw_date = $matches[3];

       $this->_url = $base_url.$episode_loc;
       $this->title = strtoupper($raw_title);
       $date = explode('.', $raw_date);


       if($date[2] > 90){
           $year = '19'.$date[2];
       }else{
           $year = '20'.$date[2];
       }
       if($date[0] < 10){
           $month = '0'.$date[0];
       }else{
           $month = $date[0];
       }
       if($date[1] < 10){
           $day = '0'.$date[1];
       }else{
           $day = $date[1];
       }

       $this->airdate = $year.'-'.$month.'-'.$day;
       $this->body = $this->title.' <span class="ep_number">#'.$this->number.'</span>';

       $this->get_image();
       $this->get_comment();
       $this->size = $this->get_size();

    }

    function get_size(){
        return filesize($this->location);
    }






    function info(){
        $data = array(
                'title' => $this->title,
                'airdate' => $this->airdate,
                'body' => $this->body,
                'number' => $this->number,
                'url' => $this->url,
                'location' => $this->location,
                'size' => $this->size,
                'type' => $this->type,
                'comments' => $this->comments.'<br /><span class="ep_number">#'.$this->number.'</span>',
                'image' => $this->image,
                'category' => $this->category,
        );
        return $data;
    }

    public function __destruct() {
        echo 'Audio Episode Object Destroyed'.  "<br />\n";
    }


}