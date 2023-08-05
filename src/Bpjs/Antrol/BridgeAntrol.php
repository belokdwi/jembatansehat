<?php

namespace Bpjs\Bridging\Antrol;

use Bpjs\Bridging\Bridge;
use Bpjs\Bridging\Antrol\ConfigAntrol;
use Bpjs\Bridging\Antrol\ResponseAntrol;
use Bpjs\Bridging\CurlFactory;

class BridgeAntrol extends CurlFactory
{
    protected $config;
    protected $response;
    protected $header;
    protected $headers;

    public function __construct()
    {
        // parent::__construct();
        $this->config = new ConfigAntrol;
        $this->response = new ResponseAntrol;
        $this->header = $this->config->setHeader();
    }

    public function getRequest($endpoint)
    {
        $result = $this->request($this->config->setUrl().$endpoint, $this->header);
        $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function postRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl().$endpoint, $this->header, "POST", $data);
        $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function putRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl().$endpoint, $this->header, "PUT", $data);
        $result = $this->response->responseAntrol($result,  $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function deleteRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl().$endpoint, $this->header, "DELETE", $data);
        $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function deleteResponseNoDecrypt($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl().$endpoint, $this->header, "DELETE", $data);
        return $result;
    }

    // public function getRequest($endpoint)
    // {
    //     $result = $this->httpGet($this->config->setUrl().$endpoint, $this->header);
    //     $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
    //     return $result;
    // }

    // public function postRequest($endpoint, $data)
    // {
    //     $result = $this->httpPost($this->config->setUrl().$endpoint, $this->config->setHeaders($this->header), $data);
    //     $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
    //     return $result;
    // }

    // public function putRequest($endpoint, $data)
    // {
    //     $result = $this->httpPut($this->config->setUrl().$endpoint, $this->config->setHeaders($this->header), $data);
    //     $result = $this->response->responseAntrol($result,  $this->config->keyDecrypt($this->header['X-timestamp']));
    //     return $result;
    // }

    // public function deleteRequest($endpoint, $data)
    // {
    //     $result = $this->httpDelete($this->config->setUrl().$endpoint, $this->config->setHeaders($this->header), $data);
    //     $result = $this->response->responseAntrol($result, $this->config->keyDecrypt($this->header['X-timestamp']));
    //     return $result;
    // }

    // public function deleteResponseNoDecrypt($endpoint, $data)
    // {
    //     $result = $this->httpDelete($this->config->setUrl().$endpoint, $this->config->setHeaders($this->header), $data);
    //     return $result;
    // }
}