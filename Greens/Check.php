<?php 

namespace Greens;

include_once 'aliyun-php-sdk-core/Config.php';
use Green\Request\V20170112 as Green;
date_default_timezone_set("PRC");
//https://help.aliyun.com/knowledge_list/50179.html?spm=5176.doc53417.6.572.rvuh4t
// test
// $check = new Check('xxx','xxx');
// 可以使用 sm.ms 上传本地图片到图床 curl https://sm.ms/api/upload
/*
$ curl -X POST -F 'smfile=@test.png' -F 'format=xml' https://sm.ms/api/uplo
ad
<?xml version="1.0" encoding="ISO-8859-1"?>
<array>
        <code>success</code>
        <width>1012</width>
        <height>1024</height>
        <filename>tony_src.png</filename>
        <storename>598d8062d549b.png</storename>
        <size>336671</size>
        <path>/2017/08/11/598d8062d549b.png</path>
        <hash>aeMmOto6fNqxLsC</hash>
        <timestamp>1502445666</timestamp>
        <ip>1.119.193.36</ip>
        <url>https://i.loli.net/2017/08/11/598d8062d549b.png</url>
        <delete>https://sm.ms/delete/aeMmOto6fNqxLsC</delete>
</array>
 */
// $res = $check->checkUrl('http://mm.howkuai.com/wp-content/uploads/2017a/06/11/01.jpg');
// echo '<pre>';print_r($res);

class Check{

	private $client;
	public function __construct($key,$secret){
		$iClientProfile = \DefaultProfile::getProfile("cn-shanghai",$key,$secret); 
		\DefaultProfile::addEndpoint("cn-shanghai", "cn-shanghai", "Green", "green.cn-shanghai.aliyuncs.com");
		$this->client = new \DefaultAcsClient($iClientProfile);
	}

	public function checkUrl($url){
		// meizitu.com http://mm.howkuai.com/wp-content/uploads/2017a/06/11/01.jpg
		$request = new Green\ImageSyncScanRequest();
		$request->setMethod("POST");
		$request->setAcceptFormat("JSON");
		$task1 = array('dataId' =>  uniqid(),
		    'url' => $url,
		    'time' => round(microtime(true)*1000)
		);
		/**https://help.aliyun.com/document_detail/53417.html?spm=5176.7850179.6.560.d16XJm
		 * porn: 色情
		 * terrorism: 暴恐
		 * qrcode: 二维码
		 * ad: 图片广告
		 * ocr: 文字识别
		*/
		$request->setContent(json_encode(array("tasks" => array($task1),
		                              "scenes" => array("porn"))));
		try {
		    $response = $this->client->getAcsResponse($request);
		    // echo '<pre>';print_r($response);
		    return $response;
		    // 自行判断
		    /*if(200 == $response->code){
		        $taskResults = $response->data;
		        foreach ($taskResults as $taskResult) {
		            if(200 == $taskResult->code){
		                $sceneResults = $taskResult->results;
		                foreach ($sceneResults as $sceneResult) {
		                    $scene = $sceneResult->scene;
		                    $suggestion = $sceneResult->suggestion;
		                    //根据scene和suggetion做相关的处理
		                    //该文本的分类 porn
		                    print_r($scene);
		                    // 建议用户处理，取值范围：[“pass”, “review”, “block”], pass:图片正常，review：需要人工审核，block：图片违规，可以直接删除或者做限制处理
		                    print_r($suggestion);
		                }
		            }else{
		                print_r("task process fail:" + $response->code);
		            }
		        }
		    }else{
		        print_r("detect not success. code:" + $response->code);
		    }*/
		} catch (Exception $e) {
		    print_r($e);
		}
	}
}


/*
stdClass Object
(
    [code] => 200
    [data] => Array
        (
            [0] => stdClass Object
                (
                    [code] => 200
                    [dataId] => 598d531b09f04
                    [msg] => OK
                    [results] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [label] => normal
                                    [rate] => 98.1
                                    [scene] => porn
                                    [suggestion] => pass
                                )

                        )

                    [taskId] => img7MeYlSsqHjR4C8D$veKQ8A-1nt0cB
                    [url] => https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1502444116792&di=81335bb297fc3c6d7004c61d1872b4fa&imgtype=0&src=http%3A%2F%2Fimgcc.12584.cn%2F2017080310291927.jpg
                )

        )

    [msg] => OK
    [requestId] => 52480F5F-D607-4350-9D37-788F9EE41E21
)

stdClass Object
(
    [code] => 200
    [data] => Array
        (
            [0] => stdClass Object
                (
                    [code] => 200
                    [dataId] => 598d537cd2477
                    [msg] => OK
                    [results] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [label] => sexy
                                    [rate] => 100
                                    [scene] => porn
                                    [suggestion] => block
                                )

                        )

                    [taskId] => img1OvbJGVu4wG67H@8hEUHJp-1nt0e5
                    [url] => http://mm.howkuai.com/wp-content/uploads/2017a/06/11/01.jpg
                )

        )

    [msg] => OK
    [requestId] => 330262E1-AA46-4C4E-82BF-C3C1B13D66DF
)
pornblock
 */
