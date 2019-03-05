<?php
/**
 * Desc:
 * Created by PhpStorm.
 * User: xstnet
 * Date: 19-1-23
 * Time: 下午4:25
 */
namespace apitests\tests\api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

abstract class BaseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var string API服务器地址
     */
    public $apiServer;
    /**
     * @var string API服务器版本
     */
    public $apiVersion;
    /**
     * @var string 测试机User Agent
     */
    public $userAgent;
    /**
     * @var string 测试机App Id
     */
    public $appId;
    /**
     * @var string 测试机App Key
     */
    public $appKey;
    /**
     * @var string 测试用户 API Token
     */
    public $apiToken;
	/**
	 * @var bool 是否验证SSL证书
	 */
	public $verifySSL;
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    protected function setUp()
    {
        $this->client = new Client([
            'base_uri' => sprintf('%s', $this->apiServer),
            'defaults' => [
            ],
			'headers' => ['X-Foo' => 'Bar'],
            'verify' => $this->verifySSL,
        ]);
    }

    protected function getSignature($params = [])
    {
        $rawQuery = [];
        ksort($params);
        foreach ($params as $k => $v) {
            $rawQuery[] = sprintf('%s=%s', $k, $v);
        }
        $rawText = implode('&', $rawQuery);
        $signature = hash_hmac('sha1', $rawText, $this->appKey);
        return $signature;
    }

    /**
     * @param $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function get($url, $params = [])
    {
        $params['app_id'] = $this->appId;
        $params['nonce'] = rand(10000,100000);
        $params['timestamp'] = number_format(microtime(true), 3, '', '');
        $newParams = $params;
        $newParams['useragent'] = $this->userAgent;
        unset($newParams['filedata']);
        $signature = $this->getSignature($newParams);
        $request = new Request('GET', $url, ['User-Agent' => $this->userAgent, 'proxy' => 'http://127.0.0.1:80']);
        $params['signature'] = $signature;
        $ret = $this->client->send($request, ['query' => $params]);
        return $ret->getBody();
    }

    /**
     * @param $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function post($url, $params = [])
    {
        $params['app_id'] = $this->appId;
        $params['nonce'] = rand(10000,100000);
        $params['timestamp'] = number_format(microtime(true), 3, '', '');
        $newParams = $params;
        $newParams['useragent'] = $this->userAgent;
        unset($newParams['filedata']);
        $signature = $this->getSignature($newParams);
        $request = new Request('POST', $url, ['User-Agent' => $this->userAgent]);
        $query  = [];
        $query['signature'] = $signature;
        $ret = $this->client->send($request, ['query' => $query, 'form_params' => $params]);
        return $ret->getBody();
    }

    /**
     * @param $url
     * @param array $params
     * @param array $files
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function postFile($url, $params = [], $files = [])
    {
        $params['app_id'] = $this->appId;
        $params['nonce'] = rand(10000,100000);
        $params['timestamp'] = number_format(microtime(true), 3, '', '');
        $newParams = $params;
        $newParams['useragent'] = $this->userAgent;
        $signature = $this->getSignature($newParams);
        $request = new Request('POST', $url, ['User-Agent' => $this->userAgent]);
        $query  = [];
        $query['signature'] = $signature;
        $multipart = [];
        foreach ($params as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }
        foreach ($files as $name => $file) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($file, 'r'),
            ];
        }
        $ret = $this->client->send($request, ['query' => $query, 'multipart' => $multipart, ]);
        return $ret->getBody();
    }

    /**
     * @param $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function put($url, $params = [])
    {
        $params['app_id'] = $this->appId;
        $params['nonce'] = rand(10000,100000);
        $params['timestamp'] = number_format(microtime(true), 3, '', '');
        $newParams = $params;
        $newParams['useragent'] = $this->userAgent;
        unset($newParams['filedata']);
        $signature = $this->getSignature($newParams);
        $request = new Request('PUT', $url, ['User-Agent' => $this->userAgent]);
        $query  = [];
        $query['signature'] = $signature;
        $ret = $this->client->send($request, ['query' => $query, 'form_params' => $params]);
        return $ret->getBody();
    }

    /**
     * @param $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function patch($url, $params = [])
    {
        $params['app_id'] = $this->appId;
        $params['nonce'] = rand(10000,100000);
        $params['timestamp'] = number_format(microtime(true), 3, '', '');
        $newParams = $params;
        $newParams['useragent'] = $this->userAgent;
        unset($newParams['filedata']);
        $signature = $this->getSignature($newParams);
        $request = new Request('PATCH', $url, ['User-Agent' => $this->userAgent]);
        $query  = [];
        $query['signature'] = $signature;
        $ret = $this->client->send($request, ['query' => $query, 'form_params' => $params]);
        return $ret->getBody();
    }

    /**
     * @param $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function delete($url, $params = [])
    {
        $params['app_id'] = $this->appId;
        $params['nonce'] = rand(10000,100000);
        $params['timestamp'] = number_format(microtime(true), 3, '', '');
        $newParams = $params;
        $newParams['useragent'] = $this->userAgent;
        unset($newParams['filedata']);
        $signature = $this->getSignature($newParams);
        $request = new Request('DELETE', $url, ['User-Agent' => $this->userAgent]);
        $query  = [];
        $query['signature'] = $signature;
        $ret = $this->client->send($request, ['query' => $query, 'form_params' => $params]);
        return $ret->getBody();
    }

}
