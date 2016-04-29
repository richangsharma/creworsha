<?php
/*
 * Include this file wherever require.
 * 
 * NOTE: This file is needed to be explicitly included in every view file or wherever 
 * it is intented to be used.
 * 
 * NOTE2SELF:Create a library of a common function to prevent redundency.
 */
$id = $this->session->userdata('id');
if(isset($id) && $id != ''){// || MAIN || everything should be in this
    $user = TRUE;
    $name = $this->session->userdata('name');
    $fullname = $this->session->userdata('fullname');
    $id = $this->session->userdata('id');
    $email =$this->session->userdata('email');
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }// END MAIN