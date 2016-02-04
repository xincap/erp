define({ "api": [
  {
    "version": "1.0.1",
    "type": "get",
    "url": "/api/login",
    "title": "用户登录",
    "name": "UserLogin",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>登录帐号.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pass",
            "description": "<p>登录密码</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/DefaultController.php",
    "group": "D__www_hy_xincap_com_app_Http_Controllers_Api_DefaultController_php",
    "groupTitle": "D__www_hy_xincap_com_app_Http_Controllers_Api_DefaultController_php"
  }
] });