// pages/zuozhe/zuozhe.js
const app = getApp()
Page({
  data: {
    authorData:[],
    authorNews:[],
    flag:true,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that = this;
    let author_id = options.author_id;
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/author.php',
      // url: 'https://localhost/news/',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded;',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        author_id: author_id,
      },
      success: function (res) {
        that.setData({
          authorData: res.data.data_author,
          authorNews:res.data.data_news
        });
        console.log(res.data);
        
        // console.log(res.data[3]);
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

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

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
  change1:function(){
    let that=this
    this.setData({
      flag:false
    })
  },
  change2:function(){
    let that=this
    this.setData({
      flag:true
    })
  }
})