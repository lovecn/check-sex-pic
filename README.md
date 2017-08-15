# check-sex-pic
[阿里云 php 图片鉴黄](https://help.aliyun.com/document_detail/53417.html?spm=5176.7850179.6.560.9SDFE1)

[如何创建一个自己的 Composer 库](https://laravel-china.org/articles/4982/how-do-i-create-my-own-composer-library)
[提交PHP组件到Packagist 发布自己的Composer包](https://blog.tanteng.me/2016/07/submit-composer-packagist/)
进入[Packagist官网](https://packagist.org)，登录你的账户，点击Submit

填写你提交到GitHub的仓库地址。点击Check,需要注意根目录下需要 composer.json

[Packagist包自动更新](https://packagist.org/about)
```js
Go to your GitHub repository
Click the "Settings" button
Click "Integrations & services" 选择 packagist
Add a "Packagist" service, and configure it with your API token(https://packagist.org/profile/), plus your Packagist username,domain is https://packagist.org
Check the "Active" box and submit the form

```
curl 自动更新
curl -XPOST -H'content-type:application/json' 'https://packagist.org/api/update-package?username=lovecn&apiToken=API_TOKEN' -d'{"repository":{"url":"https://packagist.org/packages/lovecn/check-sex-pic"}}'
