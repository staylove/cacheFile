<?php
  
  function getToken($wechat,$time=7000){ // $wechat is json data
		$token_file = './token.txt';
		$token = '';
		if( !is_file($token_file) ){
			$token = getTokenJson($wechat,$token_file);
		}
		$json = json_decode(file_get_contents($token_file),true);
		if( time() - $json['time'] >= $time ){
			$token = getTokenJson($wechat,$token_file);
		}else{
			$token = $json['token'];
		}
		return $token;
	}
	
	function getTokenJson($wechat,$token_file){
		$token = json_decode($wechat,true);
		$token = $token['access_token'];
		file_put_contents($token_file,json_encode(array('token'=>$token,'time'=>time())));
		return $token;
	}
