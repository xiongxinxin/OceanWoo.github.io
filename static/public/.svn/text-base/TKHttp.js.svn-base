import axios from 'axios'
var keys = ['token', 'data']
var storage = {}
keys.forEach(function (item, index, arr) {
  storage[item] = ''
})
// 回调拦截器
axios.interceptors.response.use(function(response) {
  // 调试时，在控制台展示返回数据
  console.info('本次请求为：', response.config)
  console.log('后台返回数据：', response)
  return response
}, function(error) {
  console.log('请求失败！')
  return Promise.reject(error)
})
export default {
  storage: storage,
  isLogin: false,
  getQuery: function(hrefStr) {
    var index = hrefStr.lastIndexOf('?')
    var queryStr = hrefStr.substring(index + 1, hrefStr.length - 2)
    var querys = queryStr.split('&')
    var query
    for (query in querys) {
      var queryItem = querys[query]
      keys.forEach(function (item, index, arr) {
        if (queryItem.indexOf(item) !== -1) {
          storage[item] = queryItem.substring(item.length + 1, queryItem.length)
        }
      })
    }
  },
  /*
   * config一般包含5项：type方法, url, data, headers, param
   */
  getData: function(config, callback, callbackparam, failcallback) {
    var type = config.type
    var url = config.url
    var data = config.data || {}
    var headers = config.headers || {}
    var param = config.param || {}
    var key
    if (!type) {
      console.error('请设置请求的方法（get或者post）')
      return
    }
    if (!url) {
      console.error('请设置请求的 url')
      return
    }
    for (key in storage) {
      if (key !== 'data') {
        headers[key] = storage[key]
      }
    }
    return axios({
      method: type,
      url: url,
      data: data,
      headers: headers,
      params: param
    }).then(function(response) {
      if (response.data.errorCode !== undefined && response.data.errorCode !== null && response.data.errorCode !== '') {
        // 成功回调
        if (response.data.errorCode === 0 && (response.data.status === 'success' || response.data.status === 'ok')) {
          callback(response, callbackparam)
        }
        // 失败回调
        else {
          console.log('服务器繁忙:\r\n' + response.data.errorMessage)
          failcallback && failcallback(response, callbackparam)
        }
      }
      else {
        callback(response, callbackparam)
        console.error('此接口非正规接口，请在TKHttp.js中添加响应的格式识别判断！')
        console.log('在此添加判断')
      }
    }).catch(function(error) {
      console.log('fail!')
      console.error(error)
      failcallback && failcallback(error, callbackparam)
    })// 失败回调都在拦截器中执行
  }
}
// function appendQuery(url) {
//   var str = url
//   keys.forEach(function (item, index, arr) {
//     if (index === 0) {
//       str = str + '?'
//     }
//     if (storage[item]) {
//       str = str + item + '=' + storage[item] + '&'
//     }
//   })
//   return str.substring(0, str.length - 1)
// }
