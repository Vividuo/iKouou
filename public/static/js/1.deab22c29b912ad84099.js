webpackJsonp([1],{"34v0":function(t,e,a){"use strict";e.__esModule=!0;var n,r=a("Edqs"),s=(n=r)&&n.__esModule?n:{default:n};e.default=s.default||function(t){for(var e=1;e<arguments.length;e++){var a=arguments[e];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(t[n]=a[n])}return t}},P4US:function(t,e){},"ik/t":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a("34v0"),r=a.n(n),s=a("EcfS"),o={data:function(){return{breadcrumbs:[{label:"控制台",name:"dashboard"},{label:this.$route.meta.title,name:this.$route.name}]}},computed:r()({},Object(s.b)({user:function(t){return t.user},routes:function(t){return t.routes}})),methods:{handleMenuSelect:function(t){"logout"===t&&(this.$store.commit("userLogout"),t="login"),this.$router.push({name:t})},handleClickUserDropdown:function(){}}},u={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"layout"},[a("Layout",{style:{minHeight:"100vh"}},[a("Header",[a("Menu",{attrs:{mode:"horizontal",theme:"dark","active-name":"1"}},[a("div",{staticClass:"layout-logo"}),t._v(" "),a("div",{staticClass:"layout-nav"},[a("MenuItem",{attrs:{name:"1"}},[a("Icon",{attrs:{type:"ios-navigate"}}),t._v("\n                        Item 1\n                    ")],1),t._v(" "),a("MenuItem",{attrs:{name:"2"}},[a("Icon",{attrs:{type:"ios-keypad"}}),t._v("\n                        Item 2\n                    ")],1),t._v(" "),a("MenuItem",{attrs:{name:"3"}},[a("Icon",{attrs:{type:"ios-analytics"}}),t._v("\n                        Item 3\n                    ")],1),t._v(" "),a("MenuItem",{attrs:{name:"4"}},[a("Avatar",{staticStyle:{background:"#619fe7","margin-left":"10px"},attrs:{src:t.user.avatar}}),t._v("\n                        "+t._s(t.user.name)+"\n                    ")],1)],1)])],1),t._v(" "),a("Layout",[a("Sider",[a("Menu",{attrs:{"active-name":"dashboard",theme:"dark",width:"auto","open-names":[]},on:{"on-select":t.handleMenuSelect}},[a("MenuItem",{attrs:{name:"dashboard"}},[a("Icon",{attrs:{type:"ios-home"}}),t._v("\n                        控制台\n                    ")],1),t._v(" "),a("Submenu",{attrs:{name:"1"}},[a("template",{slot:"title"},[a("Icon",{attrs:{type:"ios-person",size:"24"}}),t._v("\n                            用户管理\n                        ")],1),t._v(" "),a("MenuItem",{attrs:{name:"user.list"}},[t._v("用户列表")]),t._v(" "),a("MenuItem",{attrs:{name:"role.list"}},[t._v("角色列表")]),t._v(" "),a("MenuItem",{attrs:{name:"access.list"}},[t._v("权限列表")]),t._v(" "),a("MenuItem",{attrs:{name:"avatar.list"}},[t._v("头像列表")])],2),t._v(" "),a("Submenu",{attrs:{name:"2"}},[a("template",{slot:"title"},[a("Icon",{attrs:{type:"ios-box"}}),t._v("\n                            项目管理\n                        ")],1),t._v(" "),a("MenuItem",{attrs:{name:"project.create"}},[t._v("新建项目")]),t._v(" "),a("MenuItem",{attrs:{name:"project.list"}},[t._v("项目列表")])],2),t._v(" "),a("MenuItem",{attrs:{name:"logout"}},[a("Icon",{attrs:{type:"log-out"}}),t._v("\n                        注销\n                    ")],1)],1)],1),t._v(" "),a("Layout",{style:{padding:"0 24px"}},[a("Breadcrumb",{staticClass:"layout-breadcrumb"},["dashboard"!==t.$route.name?a("BreadcrumbItem",{attrs:{to:{name:"dashboard"}}},[t._v("控制台")]):t._e(),t._v(" "),a("BreadcrumbItem",[t._v(t._s(t.$route.meta.title))])],1),t._v(" "),a("Content",[a("router-view")],1),t._v(" "),a("Footer",{staticClass:"layout-footer"},[t._v("2017-2018 © iKouOu")])],1)],1)],1)],1)},staticRenderFns:[]};var i=a("Aizv")(o,u,!1,function(t){a("P4US")},null,null);e.default=i.exports}});
//# sourceMappingURL=1.deab22c29b912ad84099.js.map