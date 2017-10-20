<?php

function hashPassword($password){
        $salt = "paaaadkickxbdgwwqwpwaoiuytrdcfhjkiugfvbnjugfvbnjwnwnwjsjmsjwsmcn";
        
	return sha1($password.$salt);
}


?>