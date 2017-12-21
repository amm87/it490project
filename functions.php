<?php

/** Salts and Hashes password
**/

function hashPassword($password){
        $salt = "paaaadkickxbdgwwqwpwaoiuytrdcfhjkiugfvbnjugfvbnjwnwnwjsjmsjwsmcn";
        
	return sha1($password.$salt);
}


?>