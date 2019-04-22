<?php


include 'WeChat.php';
include 'response.php';

$wechat = new WeChat();

// 链接服务器
// $wechat->check();

// 自动回复的方法
$wechat->responseMessage();


$wechat->subMenu();

// 消息列表
$mess = new Response();
$mess->responseMessage();


// $wechat->add();

// 6_bXyg9YzqRvSrGci_KLzDKDy4lmY8KgLrSZ3E0HxI2fYA8wMzchYUoiZRQ-d9RHSBQFCDRmPPN2Fe6F-8bX75cRQqNgzIXnuHPreWfwNUMP-DrsAQmCWbHP_aUpiIbeE7SWEiMM1Wu3CBEiQNUJEhAIAKZU


