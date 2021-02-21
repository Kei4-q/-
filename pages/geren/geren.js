// pages/geren/geren.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    username:''
  },
  onLoad:function(){
    let that=this
    this.setData({
      username:app.globalData.username  
    })
    console.log(app.globalData.username)
  },
  onShow:function(){
    let that=this;
    if(!app.globalData.hasLogin){
      wx.redirectTo({
        url: '/pages/denglu/denglu',
      })
    }else{
      that.renewInfo();
    }
  },
liulanClick:function(){
  wx.navigateTo({
    url: '/pages/liulan/liulan',
  })
},
renewInfo:function(){
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
      username:app.globalData.username,
      password:app.globalData.password,
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
        app.globalData.visit_record=data.visit_record;
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
quitClick:function(){
  let that=this
    app.globalData.username=""
    app.globalData.hasLogin=false
    app.globalData.userInfo=null
    app.globalData.password="",
    app.globalData.visit_record=""
    that.onLoad();
    that.onShow();
}
})