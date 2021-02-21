//index.js
//获取应用实例
const app = getApp();
app.globalData;

Page({
  data: {
    
    xinwen:app.globalData.xinwen,
    news:[]
  },
  searchClick:function(){
    wx.navigateTo({
      url: '/pages/search/search',
    })
  },
  
  onLoad: function () {
    let that=this;
    wx.request({
      url: 'http://'+app.globalData.ip_ads+'/news/',
      // url: 'https://10.201.145.77/news/',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        filter:'足球'
        //注释去掉上面一行，则加载全部数据；否则按输入的类别如[篮球][足球][网球]进行筛选
      },
      success: function(res) {
        that.setData({
          news:res.data
        });
        console.log(res.data);
        // console.log(res.data[3]);
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
    })
  },
  
  xiangqingClick:function (e){
    let item=e.currentTarget.dataset.news_item;
    wx.setStorage({
      key: 'news_item',
      data: item,
      success: function() {
        wx.navigateTo({
          url: '/pages/xiangqing/xiangqing',
        })
      }
    })
      if(app.globalData.hasLogin){
        wx.request({
          url: 'http://'+app.globalData.ip_ads+'/news/account/visit_record_add.php',
          method: 'post',
          header: {
            'content-type': 'application/x-www-form-urlencoded',
            'cookie': 'XDEBUG_SESSION=PHPSTORM'
          },
          data: {
            username:app.globalData.username,
            password:app.globalData.password,
            news_id:item.news_id,
          },
          success: function(res) {
            console.log(res.data);
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
        })
      }
  },
shouyeClick: function(){
  wx.switchTab({
    url: '/pages/index/index',
  })  
},
zuqiuClick: function(){
 wx.redirectTo({
   url: '/pages/zuqiu/zuqiu',
 })
},
lanqiuClick: function(){
  wx.redirectTo({
    url: '/pages/lanqiu/lanqiu',
  })  
},
wangqiuClick: function(){
  wx.redirectTo({
    url: '/pages/wangqiu/wangqiu',
  })
 }

})