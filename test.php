<?php
/**
 * Desc:
 * Created by PhpStorm.
 * User: xstnet
 * Date: 19-1-23
 * Time: 下午4:01
 */
$ret = [
	'message' => isset($_GET['message']) ? $_GET['message'] : 'No Params.',
	'code' => 0,
];

echo json_encode($ret);