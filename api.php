<?php
// api.php

// 允许跨域
header('Access-Control-Allow-Origin: *');  // 允许所有域访问
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');  // 允许 GET, POST 和 OPTIONS 请求方法
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With, Custom-Client');  // 允许的请求头

// 如果是预检请求（OPTIONS），直接返回
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");  // 返回 200 OK
    // 可以选择记录日志来确认 OPTIONS 请求是否被接收
    error_log('OPTIONS request successful');
    exit();  // 结束后续执行
}

// ---- 配置 ----
$secretKey = 'YourSecretKey123!@#';
$gifPath = __DIR__ . '/payload.gif';  // GIF 文件的路径

// ---- 参数校验 ----
if (!isset($_GET['data']) || empty($_GET['data'])) {
    http_response_code(400);
    echo 'Missing ?data';  // 缺少参数
    exit();
}

// ---- 响应头 ----
header('Content-Type: image/gif');  // 设置返回的内容类型为 GIF
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');  // 禁止缓存
header('Pragma: no-cache');  // 禁止缓存

// ---- 读取并输出 ----
if (file_exists($gifPath)) {
    readfile($gifPath);  // 输出 GIF 文件内容
    exit();
} else {
    http_response_code(404);  // 文件未找到
    echo 'GIF not found';
    exit();
}
