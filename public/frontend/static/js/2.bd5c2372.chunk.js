"use strict";(self.webpackChunkcomisionesweb=self.webpackChunkcomisionesweb||[]).push([[2],{29524:function(e,t,n){n.d(t,{R:function(){return m}});var r=n(29439),i=n(88588),s=n(1867),o=n(22492),c=n(4567),a=n(77234),u=n(5849),l=n(72791),d=n(57689),p=n(11087),h=n(80184),x={wrap:!0,text:"Leer mas."},m=function(e){var t=e.imagen,n=e.descripcion,m=e.subtitulo,f=e.router,v=(0,d.s0)(),Z=(0,l.useState)(x),g=(0,r.Z)(Z,2),j=g[0],w=j.text,b=j.wrap,y=g[1];return(0,h.jsx)(i.Z,{sx:{minWidth:"100%"},children:(0,h.jsxs)(l.Fragment,{children:[(0,h.jsx)(s.Z,{component:"img",alt:n,height:"240",image:"".concat("http://10.2.10.77:3000/").concat(t,"?w=248&fit=crop&auto=format"),style:{cursor:"pointer"},onClick:function(){""!=f&&v(f)}}),(0,h.jsxs)(o.Z,{children:[(0,h.jsx)(c.Z,{gutterBottom:!0,variant:"subtitle2",component:"div",children:m}),(0,h.jsx)(c.Z,{variant:"body2",color:"text.secondary",noWrap:b,children:n}),(0,h.jsx)(p.rU,{to:"#",style:{fontSize:13},onClick:function(){y(b?{wrap:!1,text:"Leer menos."}:x)},children:w})]}),(0,h.jsx)(a.Z,{children:(0,h.jsx)(u.Z,{size:"small",component:p.rU,to:f,children:"Ver condiciones incentivos"})})]})})}},77970:function(e,t,n){n.d(t,{P:function(){return s}});var r=n(6349),i=n(80184),s=function(e){var t=e.descripcion,n=e.tipoValor,s=e.max,o=e.min,c=e.value,a=e.porcentaje,u={series:[{type:"gauge",center:["50%","60%"],startAngle:200,endAngle:-20,min:o,max:s,splitNumber:4,itemStyle:{color:"#7264FF"},progress:{show:!0,width:15},pointer:{show:!1},axisLine:{lineStyle:{width:30}},axisTick:{distance:-45,splitNumber:5,lineStyle:{width:2,color:"#C6C6C6"}},splitLine:{distance:-50,length:14,lineStyle:{width:3,color:"#C6C6C6"}},axisLabel:{distance:-30,color:"#000000",fontSize:11,formatter:function(e){return"".concat(e," ").concat(n)}},anchor:{show:!1},title:{show:!1},detail:{valueAnimation:!0,width:"60%",lineHeight:40,borderRadius:8,offsetCenter:[0,"-15%"],fontSize:20,fontWeight:"bolder",formatter:"".concat(a,"%"),color:"inherit"},data:[{value:c,name:t}]},{type:"gauge",center:["50%","60%"],startAngle:200,endAngle:-20,min:0,max:60,itemStyle:{color:"#B6B6B6"},progress:{show:!0,width:9},pointer:{show:!1},axisLine:{show:!1},axisTick:{show:!1},splitLine:{show:!1},axisLabel:{show:!1},detail:{show:!1},data:[{value:c,name:t}]}]};return(0,i.jsx)(r.Z,{option:u,className:"echarts-for-echarts",style:{height:"320px",width:"100%"},opts:{renderer:"svg"}})}},82111:function(e,t,n){n.d(t,{H:function(){return o}});var r=n(53767),i=n(85239),s=n(80184),o=function(e){var t=e.previewLoad,n=e.height,o=function(e){for(var t=[],n=0;n<e;)t.push(n),n++;return t}(t);return(0,s.jsx)(s.Fragment,{children:o.map((function(e,t){return(0,s.jsx)(r.Z,{spacing:1,sx:{minWidth:"100%"},style:{alignItems:"center"},children:(0,s.jsx)(i.Z,{variant:"rounded",sx:{width:"100%"},height:n})},t)}))})}},34002:function(e,t,n){n.r(t),n.d(t,{default:function(){return T}});var r=n(74165),i=n(15861),s=n(29439),o=n(72791),c=n(43065),a=n(32338),u=n(4567),l=n(81153),d=n(11968),p=n.n(d),h=n(40260),x=n(93385),m=n(80184),f=function(e){var t=e.descripcion,n=e.imagen;return(0,m.jsx)("div",{style:{textAlign:"center",height:500},children:(0,m.jsx)("img",{width:500,src:"".concat("http://10.2.10.77:3000/").concat(n,"?w=248&fit=crop&auto=format"),alt:t,loading:"lazy"})})},v=function(e){var t=e.imagenes;return(0,m.jsx)(p(),{NextIcon:(0,m.jsx)(x.Z,{}),PrevIcon:(0,m.jsx)(h.Z,{}),children:t.map((function(e,t){return(0,m.jsx)(f,{descripcion:e.descripcion,imagen:e.imagen},t)}))})},Z=n(59434),g=n(57689),j=n(29524),w=n(82111),b=n(47022),y=n(86743),k=n(72185),S=[],C=function(){var e=(0,g.s0)(),t=(0,Z.I0)(),n=(0,o.useState)(S),c=(0,s.Z)(n,2),a=c[0],u=c[1],d=(0,o.useState)(!0),p=(0,s.Z)(d,2),h=p[0],x=p[1],f=function(){var n=(0,i.Z)((0,r.Z)().mark((function n(){var i,s,o,c,a;return(0,r.Z)().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,(0,y.xD)();case 3:i=n.sent,s=i.data,i.headers,u(s.data),x(!1),n.next=17;break;case 10:n.prev=10,n.t0=n.catch(0),c=n.t0,a=(0,k.b)(null===(o=c.response)||void 0===o?void 0:o.status),r=a.statusToken,t((0,b.o4)({token:r})),e(a.route),x(!1);case 17:case"end":return n.stop()}var r}),n,null,[[0,10]])})));return function(){return n.apply(this,arguments)}}();return(0,o.useEffect)((function(){return f(),function(){}}),[u]),(0,m.jsx)(l.ZP,{container:!0,item:!0,xs:12,alignItems:"center",justifyContent:"center",children:a.map((function(e,t){return(0,m.jsx)(l.ZP,{item:!0,xs:12,sm:4,sx:{p:1},children:h?(0,m.jsx)(w.H,{previewLoad:1,height:350}):(0,m.jsx)(j.R,{descripcion:e.descripcion,subtitulo:e.titulo,imagen:e.imagen,router:""},t)},t)}))})},I=n(88588),P=n(22492),L=n(77970),F=[],W=function(){var e=(0,o.useState)(F),t=(0,s.Z)(e,2),n=t[0],c=t[1],a=(0,o.useState)(!0),d=(0,s.Z)(a,2),p=d[0],h=d[1],x=(0,g.s0)(),f=(0,Z.I0)(),v=function(){var e=(0,i.Z)((0,r.Z)().mark((function e(){var t,n,i,s,o;return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,(0,y.cF)();case 3:t=e.sent,n=t.data,t.headers,c(n.data),h(!1),e.next=17;break;case 10:e.prev=10,e.t0=e.catch(0),s=e.t0,o=(0,k.b)(null===(i=s.response)||void 0===i?void 0:i.status),r=o.statusToken,f((0,b.o4)({token:r})),x(o.route),h(!1);case 17:case"end":return e.stop()}var r}),e,null,[[0,10]])})));return function(){return e.apply(this,arguments)}}();return(0,o.useEffect)((function(){return v(),function(){}}),[c]),(0,m.jsx)(l.ZP,{container:!0,item:!0,xs:12,alignItems:"center",justifyContent:"center",children:n.map((function(e,t){return(0,m.jsx)(l.ZP,{item:!0,xs:12,sm:12/n.length,sx:{p:1},children:p?(0,m.jsx)(w.H,{previewLoad:1,height:350}):(0,m.jsx)(I.Z,{sx:{minWidth:"100%"},children:(0,m.jsx)(o.Fragment,{children:(0,m.jsxs)(P.Z,{children:[(0,m.jsx)(u.Z,{variant:"body2",component:"h6",style:{fontWeight:"bold"},align:"center",children:e.titulo}),(0,m.jsx)(L.P,{descripcion:e.descripcion,min:e.min,max:e.max,tipoValor:e.tipoValor,value:e.value,porcentaje:e.porcentaje})]})})},t)},t)}))})},A=n(64554),B=n(5849),z=function(e){var t=e.descripcion,n=e.titulo,r=e.nombreBonton;return(0,m.jsx)(I.Z,{sx:{minWidth:"100%"},children:(0,m.jsx)(o.Fragment,{children:(0,m.jsxs)(P.Z,{children:[(0,m.jsx)(A.Z,{alignItems:"center",children:(0,m.jsx)(u.Z,{component:"div",variant:"subtitle1",align:"center",children:n})}),(0,m.jsx)(u.Z,{component:"div",variant:"subtitle2",align:"center"}),(0,m.jsx)(u.Z,{variant:"body2",color:"text.secondary",component:"div",align:"center",children:t}),(0,m.jsx)("div",{style:{textAlign:"center"},children:(0,m.jsx)(B.Z,{size:"small",children:r?"Ver condiciones incentivos":r})})]})})})},H={descripcion:"Error al obtener Incentivos",imagenes:[],titulo:"Incentivos"},T=function(){var e=(0,o.useState)(H),t=(0,s.Z)(e,2),n=t[0],d=n.descripcion,p=n.imagenes,h=n.titulo,x=t[1],f=(0,o.useState)(!0),j=(0,s.Z)(f,2),S=j[0],I=j[1],P=(0,g.s0)(),L=(0,Z.I0)(),F=function(){var e=(0,i.Z)((0,r.Z)().mark((function e(){var t,n,i,s,o;return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,(0,y.Zw)();case 3:t=e.sent,n=t.data,t.headers,x(n.data),I(!1),e.next=17;break;case 10:e.prev=10,e.t0=e.catch(0),s=e.t0,o=(0,k.b)(null===(i=s.response)||void 0===i?void 0:i.status),r=o.statusToken,L((0,b.o4)({token:r})),P(o.route),I(!1);case 17:case"end":return e.stop()}var r}),e,null,[[0,10]])})));return function(){return e.apply(this,arguments)}}();return(0,o.useEffect)((function(){return F(),function(){}}),[x]),(0,m.jsxs)(m.Fragment,{children:[(0,m.jsx)(c.d,{icon:(0,m.jsx)(a.Z,{}),nombreRoute:"Tablero",route:"/inicio",nombresRoutes:["incentivos"],routes:["#"]}),(0,m.jsx)(u.Z,{variant:"subtitle1",component:"h6",style:{fontWeight:"bold"},sx:{pl:1,pr:1},children:"Incentivos"}),(0,m.jsx)(u.Z,{variant:"body2",gutterBottom:!0,sx:{pl:1,pr:1},children:"Promociones y eventos"}),(0,m.jsxs)(l.ZP,{container:!0,item:!0,xs:12,alignItems:"center",justifyContent:"center",children:[(0,m.jsx)(l.ZP,{item:!0,xs:12,sm:12,sx:{p:1},children:S?(0,m.jsx)(w.H,{previewLoad:1,height:350}):(0,m.jsx)(v,{imagenes:p})}),(0,m.jsx)(l.ZP,{item:!0,xs:12,sm:12,sx:{p:1},children:S?(0,m.jsx)(w.H,{previewLoad:1,height:120}):(0,m.jsx)(z,{descripcion:d,titulo:h})}),(0,m.jsx)(l.ZP,{item:!0,xs:12,sm:6,sx:{p:1}}),(0,m.jsx)(l.ZP,{item:!0,xs:12,sm:12,sx:{p:1},children:(0,m.jsx)(W,{})}),(0,m.jsxs)(l.ZP,{item:!0,xs:12,sm:12,children:[(0,m.jsx)(u.Z,{variant:"body2",gutterBottom:!0,sx:{pl:1,pr:1},children:"Incentivos anteriores"}),(0,m.jsx)(C,{})]})]})]})}},86743:function(e,t,n){n.d(t,{Zw:function(){return c},cF:function(){return d},xD:function(){return u}});var r=n(74165),i=n(15861),s=n(63263),o=n(76138);function c(){return a.apply(this,arguments)}function a(){return(a=(0,i.Z)((0,r.Z)().mark((function e(){return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.Z.get("".concat("http://10.2.10.77:3000/","api/incentivo"));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})))).apply(this,arguments)}function u(){return l.apply(this,arguments)}function l(){return(l=(0,i.Z)((0,r.Z)().mark((function e(){return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.Z.get("".concat("http://10.2.10.77:3000/","api/incentivo/list"));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})))).apply(this,arguments)}function d(){return p.apply(this,arguments)}function p(){return(p=(0,i.Z)((0,r.Z)().mark((function e(){return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.Z.get("".concat("http://10.2.10.77:3000/","api/incentivo/chart-gauge"));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})))).apply(this,arguments)}(0,o.O)(),(0,o.r)()}}]);
//# sourceMappingURL=2.bd5c2372.chunk.js.map