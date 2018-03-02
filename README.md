# mobadmin
移动端后台管理系统

# 写在前面

* '写这个项目想达成两个目的：1.省去通用功能得开发，让开发者直接切入业务逻辑得开发；2.能够真正完美兼容移动端页面',
* '网上虽然有很多后台模板，但仅仅只是大而全的模板并且没有和程序相结合。做为一名开发者我们并不想把大把的时间浪费基础的架构上，希望能快速进入业务逻辑的开发',
* '‘登录’、‘用户’、‘权限’这三大要素是构建后台的基础，有了这三个要素后开发者就可以直接写业务逻辑的代码了',
* '当然这个项目重点是兼容移动端',
* '其他的基础通用功能再努力完善中。。。'

# 技术描述

* '这里主要描述后台都用了技术，以方便开发者在做拓展时能到对应的平台上去找相应的开发文档',
* 'PHP使用的是thinkphp5.0框架:<a target="_blank" href="https://www.kancloud.cn/manual/thinkphp5/">https://www.kancloud.cn/manual/thinkphp5/</a>',
* '前端主题使用的框架是H+:<a target="_blank" href="http://www.zi-han.net/theme/hplus/">http://www.zi-han.net/theme/hplus/</a>',
* '数据列表使用bootstrap-table插件:<a target="_blank" href="http://bootstrap-table.wenzhixin.net.cn/zh-cn/documentation/">http://bootstrap-table.wenzhixin.net.cn/zh-cn/documentation/</a>',
* '前端表达提交验证jquery validate插件:<a target="_blank" href="http://www.runoob.com/jquery/jquery-plugin-validate.html">http://www.runoob.com/jquery/jquery-plugin-validate.html</a>',
* '弹窗插件layer:<a target="_blank" href="http://layer.layui.com/">http://layer.layui.com/</a>',
* '移动端主题使用frozenui框架:<a target="_blank" href="http://frozenui.github.io/">http://frozenui.github.io/</a>',
* '还有一个jquery（pc）,和zepto(mobile)插件，这里就不用说了'

# 技术细节

* '这里主要列举代码实践上的一些细节',
* '虽然H+主题是一个响应式布局，能够兼容不同尺寸的设备，但是由于数据表格的存在具体的数据是非常难以阅读的，失去了兼容移动的价值',
* '此套设计已相对小的代价兼容移动端，让后台数据能够在移动设备上完美展现',
* '并不需要因为要兼容移动端而改变php的写法，只是在你需要兼容移动页面的控制器方法中使用loadtp方法来生产模板页面（即把return $this->fetch() 改成 return $this->loadtp()）',
* '我们可以看到对于兼容移动端在代码管理上仅仅只在对于的view中加了一个已mb_前缀的模板文件，前缀可以在config配置文件中修改view_mobile_prefix',
* '为了能够方便未来可能的其他平台的数据请求，数据尽量已json形式返回给前台，返回的json格式["code"=>"??","data"=>"??"]，其data可以是数据也可以是msg错误信息',
* '后台管理最重要的一个功能权限控制，本系统采用RBAC基于角色的访问控制权限，日后每加一个接口请在node表中添加上此接口，如果此接口不需要控制权限，请将接口加入config文件中的no_check_role配置项中',