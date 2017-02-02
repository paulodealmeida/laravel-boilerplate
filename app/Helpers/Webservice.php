<?php

namespace App\Helpers;

use Illuminate\Encryption\Encrypter;

class WebService
{

    protected $_useragent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1';
    protected $_url;
    protected $_followlocation = true;
    protected $_timeout = 30;
    protected $_maxRedirects = 0;
    protected $_post;
    protected $_postFields;
    protected $_referer = "http://www.google.com";
    protected $_session;
    protected $_response;
    protected $_includeHeader = false;
    protected $_noBody;
    protected $_status;
    protected $_binaryTransfer;
    protected $separator = '#';
    protected $_debug = false;

    /**
     * 
     * @param boolean $_debug Ativa o modo de depuração quando for true
     */
    public function __construct($_debug = false)
    {
        $this->_url = 'http://' . config('app.api_url') . '/';
        $this->_debug = $_debug;
        if (isset($_SERVER['HTTP_HOST']))
            $this->_referer = 'http://' . $_SERVER['HTTP_HOST'];
        else
            $this->_referer = 'http://localhost';
    }

    public function setReferer($referer)
    {
        $this->_referer = $referer;
    }

    public function setCookiFileLocation($path)
    {
        $this->_cookieFileLocation = $path;
    }

    public function setUserAgent($userAgent)
    {
        $this->_useragent = $userAgent;
    }

    public function compileUrl($_params)
    {
        $url = $_params[0];
        preg_match_all('#\{\w+\}#', $url, $tokens, PREG_SET_ORDER);
        foreach ($tokens as $key => $token) {
            $url = str_replace($token[0], $_params[$key + 1], $url);
        }

        return $url;
    }

    public function call($_method = 'GET', $_url = null, $_params = [])
    {
        if (!is_array($_url)) {
            if ($_url) {
                $this->_url .= $_url;
            }
        } else {
            $this->_url .= $this->compileUrl($_url);
        }

        $s = curl_init();
        curl_setopt($s, CURLOPT_URL, $this->_url);
        curl_setopt($s, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($s, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($s, CURLOPT_MAXREDIRS, $this->_maxRedirects);
        curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($s, CURLOPT_FOLLOWLOCATION, $this->_followlocation);

        $token = $this->crypt($_url, $_method);

        curl_setopt($s, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        if ($token) {
            curl_setopt($s, CURLOPT_USERPWD, '[sgi]:[' . $token . ']');
            $apiToken = 'apitoken: ' . $token;
        } else {
            $apiToken = null;
        }

        curl_setopt($s, CURLOPT_CUSTOMREQUEST, strtoupper($_method));
        switch ($_method) {
            case "POST":
                curl_setopt($s, CURLOPT_HTTPHEADER, array($apiToken));
                curl_setopt($s, CURLOPT_POST, true);
                curl_setopt($s, CURLOPT_POSTFIELDS, http_build_query($_params));
                $this->_postFields = $_params;
                break;

            case "PUT":
                curl_setopt($s, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT', $apiToken));
                curl_setopt($s, CURLOPT_POSTFIELDS, http_build_query($_params, '', '&'));
                $this->_postFields = $_params;
                break;

            default:
                curl_setopt($s, CURLOPT_HTTPHEADER, array($apiToken));
                break;
        }


        if ($this->_includeHeader) {
            curl_setopt($s, CURLOPT_HEADER, true);
        }

        if ($this->_noBody) {
            curl_setopt($s, CURLOPT_NOBODY, true);
        }

        curl_setopt($s, CURLOPT_USERAGENT, $this->_useragent);
        curl_setopt($s, CURLOPT_REFERER, $this->_referer);

        $this->_response = curl_exec($s);

        if ($this->_debug) {
            echo '----------- <span style="color:red">DEBUG</span> -----------<br />';
            echo 'Response: ' . $this->_response . '<br />';
            echo 'Informações: Erro ["' . curl_error($s) . '"] / Code [' . curl_errno($s) . ']<br />';
            echo "-----------------------------------------------------------------------------<br /><br />";
        }

        $this->_status = curl_getinfo($s, CURLINFO_HTTP_CODE);

        curl_close($s);

        if ($this->getHttpStatus() === 200) {
            return json_decode($this->_response);
        } elseif ($this->getHttpStatus() === 0) {
            return $this->_response;
        } else {
            if ($this->_status === 401) {
                return redirect('auth/login');
            } else {
                return json_decode($this->_response);
            }
        }
    }

    /**
     * Gerar o token de criptografia
     * @param type $_url
     * @param type $_method
     */
    private function crypt($_url, $_method)
    {
        return false;
    }

    private function cleanQueryStringInTheUrl($_url)
    {
        $haveQueryString = strpos($_url, '?');
        if ($haveQueryString)
            return substr($_url, 0, strpos($_url, '?'));
        else {
            return $_url;
        }
    }

    public function getHttpStatus()
    {
        return $this->_status;
    }

    public function getResponse()
    {
        return $this->_response;
    }

}
