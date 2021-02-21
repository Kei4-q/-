// pages/xiangqing/xiangqing.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    index: '',
    detailData: {},
    comContent: false,
    news_item: [],
    comment: [],
    textcontent: '',
    news_id: '',
    content: "",
    username:'',
    startvalue:''
  },
  textcontent: function (e) {
    let that = this
    console.log(e.detail.value)
    that.setData({
      textcontent: e.detail.value,
      comContent: true
    })
  },
  delete_comment:function(e){
    let that=this
    let comment_id=e.target.dataset.comment_id;
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/comment/del.php',
      // url: 'https://localhost/news/',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded;',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        comment_id: comment_id//实际的新闻id
      },
      success: function (res) {
        console.log(res.data);
        that.onLoad();
      },
      fail: function () {
        console.log("查询失败")
        wx.showToast({
          title: '服务器异常',
          duration: 1500,
        })
      },
      complete: function () {
        wx.hideLoading();
      }
    })
  },
  onLoad: function (options) {
    let that = this;
    wx.getStorage({
      key: 'news_item',
      success: function (res) {
        that.setData({
          news_item: res.data,
          news_id: res.data.news_id,
          username:app.globalData.username,
          startvalue:''
        })
        that.getComments(res.data.news_id);
        // console.log(that.data.news_id);
      }
    })
  },
  getComments: function (news_id) {
    let that = this;
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/comment/load.php',
      // url: 'https://localhost/news/',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded;',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        //这里改成实际数据
        news_id: news_id//实际的新闻id
      },
      success: function (res) {
        console.log("评论如下");
        console.log(res.data);
        that.setData({
          comment: res.data
        })
      },
      fail: function () {
        console.log("查询失败")
        wx.showToast({
          title: '服务器异常',
          duration: 1500,
        })
      },
      complete: function () {
        wx.hideLoading();
      }
    })
  },

  zuozheClick: function () {
    let that = this;
    wx.navigateTo({
      url: '/pages/zuozhe/zuozhe?author_id=' + that.data.news_item.at_id,
    })
  },
  preview: function (event) {
    console.log(event.currentTarget.dataset.src)
    let currentUrl = event.currentTarget.dataset.src
    wx.previewImage({
      urls: [currentUrl],
    })
  },
  change1: function () {
    let that = this;
    if (!app.globalData.hasLogin) {
      wx.redirectTo({
        url: '/pages/denglu/denglu',
      })
    } else {
      that.setData({
        comContent: true
      })
    }
  },
  change2: function () {
    let that = this;
    that.setData({
      comContent: false
    })
  },
  comment: function () {
    let that = this
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/comment/add.php',
      // url: 'https://localhost/news/',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded;',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        //这里改成实际数据
        user_name: app.globalData.username,//实际用户名
        content: that.data.textcontent,//实际评论内容
        news_id: that.data.news_id//实际的新闻id
      },
      success: function (res) {
        console.log(res.data);
        that.setData({
          comContent: false,
          
        })
       that.onLoad();
      },
      fail: function () {
        console.log("查询失败")
        wx.showToast({
          title: '服务器异常',
          duration: 1500,
        })
      },
      complete: function () {
        wx.hideLoading();
      }
    })
  
  }
})


