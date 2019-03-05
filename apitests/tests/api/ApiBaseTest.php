<?php
/**
 * Desc:
 * Created by PhpStorm.
 * User: xstnet
 * Date: 19-1-23
 * Time: 下午4:27
 */
namespace apitests\tests\api;

abstract class ApiBaseTest extends BaseTest
{
    /**
     * 改写接口地址
     * @var string
     */
    public $apiServer = 'http://127.0.0.1';

    public $apiVersion = 'v1';

    public $userAgent = 'a-agent/1.0   os:test os;model:test model;uuid:1234';

    public $appId = '2';

    public $appKey = 'AwfZmc48uUWeTH4d83F6qUp9d88A9ekx';

    public $apiToken = '2bKEP7xjzpzk24bwIQJAX01doUl_Xjnpb0W-KyqMp3PXkvEPtUT4IrKKt2Pe0y7B-_cpDHvJSYYO08NomIKGRS-AOj51uFxWVNde5kJR0Qel-L0_E5ypPt9-WU54KTxP';
    
    public $verifySSL = false;

    protected function setUp()
    {
        $this->apiServer = isset($_ENV['API_SERVER']) ?
            $_ENV['API_SERVER'] :
            $this->apiServer;
        $this->apiToken = isset($_ENV['API_TOKEN']) ?
            $_ENV['API_TOKEN'] :
            $this->apiToken;
        parent::setUp();
    }

    public function printJson($array)
    {
        var_export($this->jsonFormat(json_encode(json_decode($array, true), JSON_UNESCAPED_UNICODE)));
    }

    function jsonFormat($data, $indent = null)
    {
        // 缩进处理
        $ret = '';
        $pos = 0;
        $length = strlen($data);
        $indent = isset($indent) ? $indent : '    ';
        $newline = "\n";
        $prevChar = '';
        $outofquotes = true;
        for ($i = 0; $i <= $length; $i++) {
            $char = substr($data, $i, 1);
            if ($char == '"' && $prevChar != '\\') {
                $outofquotes = !$outofquotes;
            } elseif (($char == '}' || $char == ']') && $outofquotes) {
                $ret .= $newline;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $ret .= $indent;
                }
            }
            $ret .= $char;
            if (($char == ',' || $char == '{' || $char == '[') && $outofquotes) {
                $ret .= $newline;
                if ($char == '{' || $char == '[') {
                    $pos++;
                }
                for ($j = 0; $j < $pos; $j++) {
                    $ret .= $indent;
                }
            }
            $prevChar = $char;
        }
        return $ret;
    }

}