<?php
/**
  * wechat php for 输入交互 
  */

//define your token
define("APPID","wx0983840574919b8a");
define("APPSECRET","1ae7f4386664c3312da9336951a3ac49");
define("TOKEN", "loveqzhi");
file_put_contents("/tmp/wechat.log","Get Data is:".var_export($_GET,true)."\n",FILE_APPEND);
file_put_contents("/tmp/wechat.log","Post xml Data is:".file_get_contents('php://input')."\n",FILE_APPEND);
$wechatObj = new wechatCallbackapiTest();

$fun = $_GET['fun'];
switch($fun) {
    case 'verfied':
        $wechatObj->verfied();
    break;
    case 'goauth':
        $wechatObj->goauth();
    break;
    default:
        $wechatObj->valid();
        //$wechatObj->responseMsg();
    break;
}


class wechatCallbackapiTest
{

    
	public function valid()
    {
        file_put_contents("/tmp/wechat.log","Now Request Uri:".$_SERVER['REQUEST_URI']."\n",FILE_APPEND);
        $echoStr = isset($_GET["echostr"]) ? $_GET["echostr"] : false;

        //valid signature , option
        if($this->checkSignature()){
            if ($echoStr !== false) {
        	    echo $echoStr;
        	    exit;
            }
        } else {
            exit;
        }
    }
    
    public function verfied(){
       $code = $_GET['code'];
       $token = self::getWebToken($code);
       file_put_contents("/tmp/wechat.log","WEB token  is:".var_export($token,true)."\n",FILE_APPEND);
       echo 'ok';
    }
    
    public function goauth(){
        $array = array(
            'redirect_uri' => urlencode('http://www.loveqzhi.cn/wechat.php?fun=verfied'),
            'scope'        => 'snsapi_base',//snsapi_userinfo
            'state'        => 1,
        );
        $url = self::getWebCodeUrl($array);
        file_put_contents("/tmp/wechat.log","Get code url is:".$url."\n",FILE_APPEND);
        header("Location: ".$url);
        exit;
    }
    
    public static function getWebToken($code) {
        static $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?%s';
        $query = array(
            'appid'      => APPID,
            'secret'     => APPSECRET,
            'code'       => $code,
            'grant_type' => 'authorization_code',
        );
        list($header, $body) = self::curl(sprintf($url, http_build_query($query)));
        $json = json_decode($body, true);
        if (!$json || isset($json['errcode'])) {
            throw new Exception('failed to upload file.');
        } else {
            return $json;
        }
    }
    
    public static function getWebCodeUrl($param){
        static $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=%s&scope=%s&state=%s#wechat_redirect';
        $query = array(
            'appid'         => APPID,
            'redirect_uri'  => $param['redirect_uri'],
            'response_type' => 'code',
            'scope'         => $param['scope'],
            'state'         => $param['state'],
        );
        return vsprintf($url, $query);
    }
    
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = file_get_contents('php://input');
      	//extract post data
		if (!empty($postStr)){
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml>";
                $newsTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[news]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            <Articles>";
				if(!empty( $keyword ))
                {
                    $url = "http://www.chayuexin.com/xunsearch.php?q=".$keyword;
                    exec("echo ".$url." >> /tmp/weirequest.log");
                    $json = file_get_contents($url);
                    $data = json_decode($json,true);
                    if (!empty($data)) {
                        foreach ($data as $i => $d) {
                            $img = ($i == '0') ? "http://www.chayuexin.com/img/".rand(1,2).".jpg" : "";
                            $title = $d["position"]." 【￥".$d["salary"]."】\n".$d['company'];
                            $toUrl = "http://www.chayuexin.com/?q=".$keyword."&f=_all";
                            $item = '<item>
                                    <Title><![CDATA['.$title.']]></Title> 
                                    <Description><![CDATA['.$d['company'].']]></Description>
                                    <PicUrl><![CDATA['.$img.']]></PicUrl>
                                    <Url><![CDATA['.$toUrl.']]></Url>
                                    </item>';
                            $newsTpl .= $item;
                            $item = null;
                        }
                        $count = count($data);
                    }
                    $newsTpl .= '</Articles></xml>';
                    exec("echo ".$newsTpl." >> /tmp/weirequest.log");
                	$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $count);
                	echo $resultStr;
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr,SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );     
		file_put_contents("/tmp/wechat.log","runing sha1 is:".$tmpStr."\n",FILE_APPEND);
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
    
    public static function curl($url, $headers = array(), $params = array()) {
        $header = array();
        $headers += array('Expect' => '');
        foreach ($headers as $k => $v) {
            $header[] = $k . ': ' . $v;
        }
        $ch = curl_init();
        $option = array(
            CURLOPT_URL             => $url,
            CURLOPT_HTTPHEADER      => $header,
            CURLOPT_HEADER          => true,
            CURLOPT_FOLLOWLOCATION  => false,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_CONNECTTIMEOUT  => 5,
            CURLOPT_TIMEOUT         => 30,
        );
        if (count($params)) {
            $option[CURLOPT_POST] = true;
            $option[CURLOPT_POSTFIELDS] = $params;
        }
        if (stripos($url, 'https') === 0) {
            $option[CURLOPT_SSL_VERIFYPEER] = false;
            $option[CURLOPT_SSL_VERIFYHOST] = false;
        }
        curl_setopt_array($ch, $option);
        $content = curl_exec($ch);
        if (curl_errno($ch) > 0) {
            $content = "HTTP/1.1 501 ERROR\r\n\r\n";
        }
        curl_close($ch);

        return explode("\r\n\r\n", $content, 2);
    }
}

?>