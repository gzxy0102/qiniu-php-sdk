# Qiniu Cloud SDK for PHP
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://github.com/gzxy0102/qiniu-php-sdk/actions/workflows/test-ci.yml/badge.svg)](https://github.com/gzxy0102/qiniu-php-sdk/actions/workflows/test-ci.yml)
[![GitHub release](https://img.shields.io/github/v/tag/gzxy0102/qiniu-php-sdk.svg?label=release)](https://github.com/gzxy0102/qiniu-php-sdk/releases)
[![Latest Stable Version](https://img.shields.io/packagist/v/gzxy/qiniu-php-sdk.svg)](https://packagist.org/packages/gzxy/qiniu-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/gzxy/qiniu-php-sdk.svg)](https://packagist.org/packages/gzxy/qiniu-php-sdk)


## 安装

推荐使用 `composer` 进行安装。可以使用 composer.json 声明依赖，或者运行下面的命令。SDK 包已经放到这里 [`gzxy/qiniu-php-sdk`][install-packagist] 。

**版本说明：** 7.14.x 及更早版本请使用上层仓库的 [`qiniu/php-sdk`](https://packagist.org/packages/qiniu/php-sdk) 安装包；本仓库从 7.15.0 开始发布，请使用 `gzxy/qiniu-php-sdk`。

```bash
$ composer require gzxy/qiniu-php-sdk
```

## 运行环境

| Qiniu SDK版本 |                     PHP 版本                      |
|:--------------------:|:-----------------------------------------------:|
|        7.15.x        |      cURL extension,   7.1 - 7.4, 8.0 - 8.5     |

## 使用方法

### 上传
```php
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
...
    $uploadMgr = new UploadManager();
    $auth = new Auth($accessKey, $secretKey);
    $token = $auth->uploadToken($bucket);
    list($ret, $error) = $uploadMgr->putFile($token, 'key', 'filePath');
...
```

## 测试

``` bash
$ ./vendor/bin/phpunit tests/Qiniu/Tests/
```

## 常见问题

- `$error` 保留了请求响应的信息，失败情况下 `ret` 为 `none`, 将 `$error` 可以打印出来，提交给我们。
- API 的使用 demo 可以参考 [examples](https://github.com/gzxy0102/qiniu-php-sdk/tree/master/examples)。

## 代码贡献

详情参考[代码提交指南](https://github.com/gzxy0102/qiniu-php-sdk/blob/master/CONTRIBUTING.md)。

## 贡献记录

- [所有贡献者](https://github.com/gzxy0102/qiniu-php-sdk/contributors)

## 联系我们

- 如需帮助、报告问题或提出功能需求，请提交 [GitHub Issue](https://github.com/gzxy0102/qiniu-php-sdk/issues)。

## 代码许可

The MIT License (MIT).详情见 [License文件](https://github.com/gzxy0102/qiniu-php-sdk/blob/master/LICENSE).

[packagist]: http://packagist.org
[install-packagist]: https://packagist.org/packages/gzxy/qiniu-php-sdk
