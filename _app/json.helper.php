<?php

/*
	fPot
	Version: 1.0
	Author: Forms [github.com/LucasFormiga]
	> JSON Helper
*/

class JsonHelper
{

	public function jsonSuccess($data)
	{
		return json_encode(array('success' => 1, 'data' => $data));
	}

	public function jsonErr($data)
	{
		return json_encode(array('success' => 0, 'errMsg' => $errMsg));
	}

}