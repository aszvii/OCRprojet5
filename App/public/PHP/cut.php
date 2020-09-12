<?php

        

function cutComment($comment, $id, $commentId){
        
        $max_caracteres=250;
        
        if (strlen($comment)>$max_caracteres)
        {   
            
            $comment = substr($comment, 0, $max_caracteres);
            
            $position_space = strrpos($comment, " ");   
            $comment = substr($comment, 0, $position_space); 

            $comment= $comment. " <a class='readMore' href='index.php?action=event&id=".$id."#".$commentId."'>[Lire la suite]</a>";
        }
        
        return $comment;
    }