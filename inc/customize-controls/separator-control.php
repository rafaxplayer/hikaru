<?php
class Separator_Custom_control extends WP_Customize_Control{

    public $type = 'separator';
    
    public function render_content(){
        ?>
        <p><hr></p>
        <?php
    }
}
?>