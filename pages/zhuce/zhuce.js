const app = getApp();
Page({
  data: {
    username: '',
    password: '',
    password_check: '',
  },
  onLoad: function () {

  },
  go: function () {
    let that = this;
    if (that.data.username == '' || that.data.password == '' || that.data.password_check == '') {
      wx.showToast({
        title: '注册信息不能为空',
        icon: 'none',
      });
      return;
    }
    if (that.data.password != that.data.password_check) {
      wx.showToast({
        title: '请保持密码一致',
        icon: 'none',
      });
      return;
    }
    wx.request({
      url: 'http://' + app.globalData.ip_ads + '/news/account/register.php',
      // url: 'http://localhost/news/account/login.php',
      method: 'post',
      header: {
        'content-type': 'application/x-www-form-urlencoded',
        'cookie': 'XDEBUG_SESSION=PHPSTORM'
      },
      data: {
        username: that.data.username,
        password: that.data.password,
      },
      success: function (res) {
        let data = res.data;
        console.log(data);
        wx.showToast({
          title: data.info,
          icon: 'none'

        });
        if (data.status) {
          app.globalData.hasLogin = true;
          app.globalData.username = that.data.username;
          app.globalData.password = that.data.password;
          app.globalData.visit_record = "[]";
          setTimeout(function () {
            wx.switchTab({
              url: '/pages/index/index',
            })
          }, 2000);
        }
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
  input_username: function (e) {
    this.setData({
      username: e.detail.value
    });
  },
  input_password: function (e) {
    this.setData({
      password: e.detail.value
    });
  },
  input_password_check: function (e) {
    this.setData({
      password_check: e.detail.value
    });
  }
})