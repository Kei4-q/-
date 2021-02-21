const app = getApp();
Page({
  data: {
   username:'',
   password:'',
  },
  onLoad: function () {
  
  },
  gerenClick:function(){
    let that=this;
    wx.request({
      url: 'http://'+app.globalData.ip_ads+'/news/account/login.php',
      // url: 'http://localhost/news/account/login.php',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        username:that.data.username,
        password:that.data.password,
      },
      success: function(res) {
        let data=res.data;
        console.log(data)
        if(!data.status){
          wx.showToast({
            title: '账户名或密码错误',
            icon:'none',
            duration:1500,
          })
        }else{
          wx.showToast({
            title: '登录成功',
            icon:'none',
            duration:1500,
          })
          app.globalData.hasLogin=true;
          app.globalData.username=data.username;
          app.globalData.password=that.data.password;
          app.globalData.visit_record=data.visit_record;
          wx.switchTab({
            url: '/pages/geren/geren?username=data.username',
          })  
        }
      },
      fail: function() {
        console.log("查询失败")
        wx.showToast({
          title: '服务器异常',
          duration: 1500,
        })
      },
      complete: function() {
        wx.hideLoading();
      }
    });
  },
  input_username:function(e){
    this.setData({
      username:e.detail.value
    });
  },
  input_password:function(e){
    this.setData({
      password:e.detail.value
    });
  },
  zhuceClick:function(){
   wx.navigateTo({
     url: '/pages/zhuce/zhuce',
   })
  }
})