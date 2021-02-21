const app = getApp();
Page({
  data: {
    records: [],
    keyword: "搜索你感兴趣的新闻",
    news:[],
    startValue:''
  },
  onLoad: function (options) {
    let that = this;
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/search/history.php',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        username: app.globalData.username,
      },
      success: function (res) {
        let data = res.data;
        console.log(data);
        that.setData({
          records: data,
          startValue:''
        });
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
    });
  },
  input_keyword: function (e) {
    this.setData({
      keyword: e.detail.value
    });
  },
  go: function () {
    let that = this;
    if (that.data.keyword == "") {
      wx.showToast({
        title: '请输入关键字',
        icon: 'none',
      });
      return;
    }
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/search/go.php',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        username: app.globalData.username,
        keyword: that.data.keyword,
      },
      success: function (res) {
        let data = res.data;
        console.log(data);
        that.setData({
          news:data.data
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
      },
      
    });
  },
  del: function () {
    let that = this;
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/search/del.php',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        username: app.globalData.username,
      },
      success: function (res) {
        let data = res.data;
        console.log(data);
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
    });
  },
  click_record: function (e) {
    let keyword = e.target.dataset.keyword;
    this.setData({keyword:keyword});
    this.go();
    
  },
  xiangqingClick: function (e) {
    let item = e.currentTarget.dataset.news_item;
    wx.setStorage({
      key: 'news_item',
      data: item,
      success: function () {
        wx.navigateTo({
          url: '/pages/xiangqing/xiangqing',
        })
      }
    })
    if (app.globalData.hasLogin) {
      wx.request({
        url: 'http://' + app.globalData.ip_ads + '/news/account/visit_record_add.php',
        method: 'post',
        header: {
          'content-type': 'application/x-www-form-urlencoded',
          'cookie': 'XDEBUG_SESSION=PHPSTORM'
        },
        data: {
          username: app.globalData.username,
          password: app.globalData.password,
          news_id: item.news_id,
        },
        success: function (res) {
          console.log(res.data);
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
  },
})