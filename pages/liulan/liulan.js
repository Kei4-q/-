// pages/liulan/liulan.js
const app=getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    news:[],
  },
  onLoad:function(){
    let that=this;
    wx.request({
      url: 'http://'+app.globalData.ip_ads+'/news/account/visit_record_get.php',
      // url: 'http://localhost/news/account/visit_record_get.php',
      
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        news_ids:app.globalData.visit_record
      },
      success: function(res) {
        let data=res.data;
        // console.log(data);
        that.setData({
          news:data,
        });
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
  xiangqingClick: function (e) {
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
  }
 
})