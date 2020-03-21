<?php

function inputElement($icon,$placeholder,$name,$value,$attr){
    $elmt = "
    <div class='input-group mb-3'>
        <div class='input-group-prepend'>
            <span class='input-group-text bg bg-warning' id='basic-addon1'>$icon</span>
        </div>
        <input type='text' name='$name' value='$value' $attr class='form-control' placeholder='$placeholder' aria-describedby='basic-addon1'>
    </div>
    ";

    echo $elmt;
}
function buttonElement($class,$btnid,$icon,$name,$attr){
    $btn = "
    <button class='$class' id='$btnid' type='submit' name='$name' $attr   >
    $icon
    </button>
    ";

    echo $btn;
}





?>