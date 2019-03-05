<?php
/**
 * PHP File
 * User: chocoboxxf
 * Date: 2016/11/3
 */
namespace apitests\tests\api\index;


use apitests\tests\api\ApiBaseTest;

class IndexActionTest extends ApiBaseTest
{

    public function testIndex()
    {
        $url = '/index.php';
        $params = [
            'message' => 'this is Index Tests',
        ];
        $ret = $this->get($url, $params);
        $this->printJson($ret);
    }
    
}
