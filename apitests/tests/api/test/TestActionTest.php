<?php
/**
 * PHP File
 * User: chocoboxxf
 * Date: 2016/11/3
 */
namespace apitests\tests\api\test;

use apitests\tests\api\ApiBaseTest;

class TestActionTest extends ApiBaseTest
{

    public function testTest()
    {
		$url = '/index.php';
		$params = [
			'message' => 'this is Tests',
		];
		$ret = $this->get($url, $params);
		$this->printJson($ret);
    }
    
}
