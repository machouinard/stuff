
<?php
$faqs = array(
  'Is this a question?' => 'Yep, that\'s a question.',
    'Is this another question?' => 'Sure the hell is.',
    'Is this going to make this tutorial better?' => 'Hell yes it is.',
);
?>


<div class="grid_14 push_2">

    <div class="faq_container">
        <img src="images/faq/corkboard_heading.jpg"/>

        <?php
        foreach($faqs as $q => $a){
            echo '<div class="faq">
                    <div class="faq_question">'.$q.'</div>
                        <div class="faq_answer_container">
                            <div class="faq_answer">'.$a.'</div>
                        </div>
                 </div>';
        }
        ?>




    </div>


</div>