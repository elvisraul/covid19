<?php
namespace Util;

	class Enigma {
	 
     	private static $Key = "PAMPAYACU";
     	private static $Mode = "aes-256-cbc";
	 
     	function encrypt($data){
		    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(Enigma::$Mode));
		    $encrypted=openssl_encrypt($data, Enigma::$Mode, md5(Enigma::$Key), 0, $iv);

		    return base64_encode($encrypted."::".$iv);

		}
	 
	    function decrypt($data){
		    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		    return openssl_decrypt($encrypted_data, Enigma::$Mode, md5(Enigma::$Key), 0, $iv);
		}
	}


	//$cadena_encriptada = Enigma::encrypt("DATO-IMPORTANTE"); // idV1bVdOUvMR2ogaKBirwdq5J8O2ieOxdqNeXafy8Ds=
 
	//$dato_importante = Enigma::decrypt($cadena_encriptada); // DATO-IMPORTANTE

?>
