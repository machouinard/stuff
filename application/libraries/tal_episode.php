<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Tal_episode{

    public $episode_url;
    public $save_loc;
    public $count;
    public $errors;
    public $page_contents;

    public $title;
    public $airdate;
    public $body;
    public $number;
    public $url;
    public $location;
    public $size;
    public $type = 'audio/mpeg';
    public $comments = NULL;
    public $image;
    public $category = 'This American Life';

    public $CI;
    protected $html;
    protected $img_title;

    function __construct(){
        require_once 'includes/simple_html_dom.php';
            log_message('debug', 'Tal_episode Class Initialized');
            $this->CI =& get_instance();
	}



    function download_episode(){
            $fp = fopen($this->save_loc, 'w');

            $ch = curl_init($this->episode_url);
            curl_setopt($ch, CURLOPT_FILE, $fp);

            if(!($data = curl_exec($ch))){
                echo 'Not Working.'.  "<br />\n";
            }

            curl_close($ch);
            fclose($fp);

            $this->url = 'http://chouinard.me/' . $this->location;


            $this->get_image();
            $this->get_comment();
            $this->get_date();
            $this->get_title();
            $this->size = filesize($this->save_loc);
//            print_array($this->info(), $this->number);
    }

    function get_date(){
        foreach($this->html->find('.top-inner') as $div){
            foreach($div->find('.date') as $date){
                $sql_date = strtotime($date->plaintext);
                $this->airdate = strftime("%Y-%m-%d", $sql_date);
            }
        }
    }

    function get_title(){
        $regex = '~\d{3}:\s([\s\w\d\DäöüÄÖÜß]*)~';
        preg_match($regex, $this->img_title, $matches);
        $this->title = $matches[1];
        $this->body = $this->title."&nbsp;<span class='ep_number'>#".$this->number.'</span>';
    }

    function get_image(){
//        require_once 'includes/simple_html_dom.php';
        $url = "http://www.thisamericanlife.org/radio-archives/episode/".$this->number;
        $this->html = file_get_html($url);
        foreach($this->html->find('.top-inner') as $div){
            foreach($div->find('.image') as $images){
                foreach($images->find('img') as $image){
                    $this->image = $image->src;
                    $this->img_title = $image->title;

                }
            }
        }
    }

    function get_comment(){

        foreach($this->html->find('.description') as $comment){
            $this->comments = htmlentities($comment->plaintext, ENT_QUOTES, "UTF-8");
        }
    }



    function get_episode_info_for_db(){
       //$regex = '~<h4><a\shref="([\s\w\d/-]+)">'.$this->number.':\s([\d\w\s-/]*)</a>\s*<span[\s\d\w="-]+>([\d.]+)</span>~';
       //$regex = "~<h4><a\shref=\"([\s\w\d/-]+)\">$this->number:\s([\d\w\s-/']*)</a>\s*<span[\s\d\w=\"-]+>([\d.]+)</span>~";
       $regex = "~<h4><a\shref=\"([/\d\s\w%-]+)\">$this->number:\s([—()…&#;\d\s\w\.\-,?/!']+)</a>\s*<span\sclass=\"date-display-single\">([\d\.]{1,8})</span></h4>~";
       $base_url = 'http://www.thisamericanlife.org';
       $year = $this->get_year($this->number);
       $url = "http://www.thisamericanlife.org/radio-archives/".$year;

       $this->url = 'http://chouinard.me/archives/thisamericanlife/'.$this->number.'.mp3';
       $this->location = '/home/machoui/public_html/archives/thisamericanlife/'.  $this->number.'.mp3';

       $contents = file_get_contents($url);

       $newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
       $content = str_replace($newlines, "", html_entity_decode($contents));


       preg_match($regex, $content, $matches);

       //print_array($matches, null, 1);
       $episode_loc = $matches[1];
       $raw_title = ($matches[2]);
       $raw_date = $matches[3];

       $this->episode_url = $base_url.$episode_loc;
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

//    function get_episode_info(){
//       $regex = '~<h4><a\shref="([\s\w\d/-]+)">'.$this->number.':\s([\d\w\s-]+)</a>\s*<span[\s\d\w="-]+>([\d.]+)</span>~';
//       $base_url = 'http://www.thisamericanlife.org';
//       $year = $this->get_year($this->number);
//       $url = "http://www.thisamericanlife.org/radio-archives/".$year;
//
//       $contents = file_get_contents($url);
//
//       $newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
//       $content = str_replace($newlines, "", html_entity_decode($contents));
//
//
//       preg_match($regex, $content, $matches);
//
//       //print_array($matches, null, 1);
//       $episode_loc = $matches[1];
//       $raw_title = $matches[2];
//       $raw_date = $matches[3];
//
//       $this->episode_url = $base_url.$episode_loc;
//       $this->title = strtoupper($raw_title);
//       $date = explode('.', $raw_date);
//
//
//       if($date[2] > 90){
//           $year = '19'.$date[2];
//       }else{
//           $year = '20'.$date[2];
//       }
//       if($date[0] < 10){
//           $month = '0'.$date[0];
//       }else{
//           $month = $date[0];
//       }
//       if($date[1] < 10){
//           $day = '0'.$date[1];
//       }else{
//           $day = $date[1];
//       }
//
//       $this->airdate = $year.'-'.$month.'-'.$day;
//       $this->body = $this->number;
//
//       $this->get_image();
//       $this->get_comment();
//
//    }

    function get_image2(){
       $image_regex2 = '~src="(http://www.thisamericanlife.org/sites/default/files/episodes/[\s\d\w.]+)\?~';
       $regex = '~src="(http://www.thisamericanlife.org/sites/default/files/episodes/[\s\d\w.]+)\?|src="(http://www.thisamericanlife.org/sites/default/files/photos/large/[\s\d\w.]+)\?~';

       $contents2 = file_get_contents($this->episode_url);
       $newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
       $this->page_contents = str_replace($newlines, "", html_entity_decode($contents2));



       preg_match($regex, $this->page_contents, $matches2);
       //print_array($matches2, 'image', 1);
       if(!empty($matches2[1])){
           $this->image = $matches2[1];
       }elseif (!empty($matches2[2])) {
           $this->image= $matches2[2];
        }

    }

//    function get_comment(){
//        $regex2 = '~<div\sclass="radio-content">\s*([\s\S]+)</div><!--/radio-content-->~';
//        $regex = '~<meta\s+name="description"\s?content="(.*)">~';
//        preg_match($regex2, $this->page_contents, $matches);
//        if(!empty($matches[1])){
//            $this->comments = $matches[1];
//        }
//    }



    function get_year($num){
        switch ($num) {
            case $num < 8:
                $year = 1995;
                break;
            case ($num > 7 && $num < 48):
                $year = 1996;
                break;
            case $num > 47 && $num < 88;
                $year = 1997;
                break;
            case $num > 87 && $num < 119;
                $year = 1998;
                break;
            case $num > 118 && $num < 149;
                $year = 1999;
                break;
            case $num > 148 && $num < 175;
                $year = 2000;
                break;
            case $num > 174 && $num < 203;
                $year = 2001;
                break;
            case $num > 202 && $num < 228;
                $year = 2002;
                break;
            case $num > 227 && $num < 256;
                $year = 2003;
                break;
            case $num > 255 && $num < 280;
                $year = 2004;
                break;
            case $num > 279 && $num < 306;
                $year = 2005;
                break;
            case $num > 305 && $num < 323;
                $year = 2006;
                break;
            case $num > 322 && $num < 347;
                $year = 2007;
                break;
            case $num > 346 && $num < 372;
                $year = 2008;
                break;
            case $num > 371 && $num < 397;
                $year = 2009;
                break;
            case $num > 396 && $num < 423;
                $year = 2010;
                break;
            case $num > 422 && $num < 454;
                $year = 2011;
                break;
            case $num > 453 && $num < 483;
                $year = 2012;
                break;
            case $num > 482;
                $year = 2013;
                break;
            default:
                break;
        }
        return $year;
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


}