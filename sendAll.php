<?php

include 'WeChat.php';

$send = new WeChat();

$word = $_POST['word'];

$send->sendInfo($word);