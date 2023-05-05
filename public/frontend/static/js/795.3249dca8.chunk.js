"use strict";(self.webpackChunkcomisionesweb=self.webpackChunkcomisionesweb||[]).push([[795],{9622:function(t,e,n){n.d(e,{q:function(){return u}});var r=n(88588),a=n(22492),o=n(1867),i=n(64554),s=n(4567),c=n(80184),u=function(t){var e=t.imagen,n=t.descripcion,u=t.detalle,l=t.rango,p=t.color,d=t.onClick;return(0,c.jsx)(r.Z,{sx:{minWidth:"100%"},style:{alignItems:"center",background:p?"linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 12%, rgba(0,212,255,1) 100%)":"#FFFFFF"},children:(0,c.jsxs)(a.Z,{sx:{display:"flex"},style:{padding:0},children:[(0,c.jsx)(o.Z,{component:"img",sx:{width:96,alignItems:"center"},image:"".concat("http://10.2.10.77:3000/").concat(e),alt:l,loading:"lazy"}),(0,c.jsx)(i.Z,{style:{width:"100%"},children:(0,c.jsxs)(a.Z,{style:{padding:10},children:[(0,c.jsx)(s.Z,{variant:"body2",sx:{m:0},align:"center",children:n}),(0,c.jsx)(s.Z,{variant:"body2",sx:{m:0,"&:hover":{background:"linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(197,197,197,1) 100%)"}},align:"center",style:{fontWeight:"bold",cursor:"pointer"},onClick:d,children:l}),(0,c.jsx)("hr",{style:{margin:0,textAlign:"center"}}),(0,c.jsx)(s.Z,{component:"div",variant:"body2",align:"center",children:u})]})})]})})}},77970:function(t,e,n){n.d(e,{P:function(){return o}});var r=n(6349),a=n(80184),o=function(t){var e=t.descripcion,n=t.tipoValor,o=t.max,i=t.min,s=t.value,c=t.porcentaje,u={series:[{type:"gauge",center:["50%","60%"],startAngle:200,endAngle:-20,min:i,max:o,splitNumber:4,itemStyle:{color:"#7264FF"},progress:{show:!0,width:15},pointer:{show:!1},axisLine:{lineStyle:{width:30}},axisTick:{distance:-45,splitNumber:5,lineStyle:{width:2,color:"#C6C6C6"}},splitLine:{distance:-50,length:14,lineStyle:{width:3,color:"#C6C6C6"}},axisLabel:{distance:-30,color:"#000000",fontSize:11,formatter:function(t){return"".concat(t," ").concat(n)}},anchor:{show:!1},title:{show:!1},detail:{valueAnimation:!0,width:"60%",lineHeight:40,borderRadius:8,offsetCenter:[0,"-15%"],fontSize:20,fontWeight:"bolder",formatter:"".concat(c,"%"),color:"inherit"},data:[{value:s,name:e}]},{type:"gauge",center:["50%","60%"],startAngle:200,endAngle:-20,min:0,max:60,itemStyle:{color:"#B6B6B6"},progress:{show:!0,width:9},pointer:{show:!1},axisLine:{show:!1},axisTick:{show:!1},splitLine:{show:!1},axisLabel:{show:!1},detail:{show:!1},data:[{value:s,name:e}]}]};return(0,a.jsx)(r.Z,{option:u,className:"echarts-for-echarts",style:{height:"320px",width:"100%"},opts:{renderer:"svg"}})}},32623:function(t,e,n){n.d(e,{Z:function(){return v}});var r=n(74165),a=n(15861),o=n(29439),i=n(72791),s=n(43236),c=n(52411),u=n(76278),l=n(65661),p=n(5574),d=n(9622),m=n(4567),f=n(4899),h=n(57689),x=n(80184),g=function(t){var e=(0,h.s0)(),n=i.useState("paper"),r=(0,o.Z)(n,2),a=r[0],g=(r[1],t.onClose),Z=t.selectedValue,v=t.open;return(0,x.jsxs)(p.Z,{onClose:function(){g(Z)},open:v,scroll:a,"aria-labelledby":"scroll-dialog-title","aria-describedby":"scroll-dialog-description",children:[(0,x.jsxs)(l.Z,{component:"div",variant:"subtitle1",align:"center",children:["Todos los rangos",(0,x.jsx)(m.Z,{variant:"subtitle2",children:"Comisiones de cuerdo a las ventas registradas durante el mes en monte Sion"})]}),(0,x.jsx)(f.Z,{children:(0,x.jsx)(s.Z,{children:t.listRangos.map((function(t,n){return(0,x.jsx)(c.ZP,{disableGutters:!0,children:(0,x.jsx)(u.Z,{onClick:function(){t.enUso?e("/monte-sion"):g(t)},children:(0,x.jsx)(d.q,{rango:t.subtitulo,descripcion:t.titulo,detalle:t.descripcion,imagen:t.imagen,color:t.enUso,onClick:function(){}})},n)},n)}))})})]})},Z=n(93939),v=function(t){var e=t.open,n=t.onClose,s=(0,i.useState)([]),c=(0,o.Z)(s,2),u=c[0],l=c[1],p=(0,i.useState)(!0),d=(0,o.Z)(p,2),m=(d[0],d[1]),f=function(){var t=(0,a.Z)((0,r.Z)().mark((function t(){var e,n;return(0,r.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,(0,Z.co)();case 3:e=t.sent,1==(n=e.data).status&&(l(n.data.todosRangos),m(!1)),t.next=11;break;case 8:t.prev=8,t.t0=t.catch(0),console.log(t.t0);case 11:case"end":return t.stop()}}),t,null,[[0,8]])})));return function(){return t.apply(this,arguments)}}(),h=(0,i.useState)({descripcion:"",enUso:!1,imagen:"",subtitulo:"",titulo:""}),v=(0,o.Z)(h,2),j=v[0];v[1];return(0,i.useEffect)((function(){f()}),[]),(0,x.jsx)(x.Fragment,{children:(0,x.jsx)(g,{listRangos:u,selectedValue:j,open:e,onClose:function(t){n(t)}})})}},89136:function(t,e,n){n.r(e),n.d(e,{default:function(){return M}});var r=n(4567),a=n(81153),o=n(43065),i=n(74165),s=n(15861),c=n(1413),u=n(29439),l=n(51303),p=n(54474),d=n(4841),m=n(72791),f=n(34585),h=n(63263),x=n(76138);function g(){return Z.apply(this,arguments)}function Z(){return(Z=(0,s.Z)((0,i.Z)().mark((function t(){return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,h.Z.get("".concat("http://10.2.10.77:3000/","api/monte-sion/data-grid"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function v(){return j.apply(this,arguments)}function j(){return(j=(0,s.Z)((0,i.Z)().mark((function t(){return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,h.Z.get("".concat("http://10.2.10.77:3000/","api/monte-sion/resumen-card"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function y(){return w.apply(this,arguments)}function w(){return(w=(0,s.Z)((0,i.Z)().mark((function t(){return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,h.Z.get("".concat("http://10.2.10.77:3000/","api/monte-sion/rangos"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function b(){return S.apply(this,arguments)}function S(){return(S=(0,s.Z)((0,i.Z)().mark((function t(){return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,h.Z.get("".concat("http://10.2.10.77:3000/","api/monte-sion/chart-gauge"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function k(){return C.apply(this,arguments)}function C(){return(C=(0,s.Z)((0,i.Z)().mark((function t(){return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,h.Z.get("".concat("http://10.2.10.77:3000/","api/monte-sion/chart-lineal"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}(0,x.O)(),(0,x.r)();var N=n(80184),P=function(){var t=(0,m.useState)(!1),e=(0,u.Z)(t,2),n=e[0],r=e[1],a=(0,m.useState)([{columnName:"Num",width:100},{columnName:"nombreCompleto"},{columnName:"generacion"},{columnName:"ventas",width:200},{columnName:"cantidad",width:150}]),o=(0,u.Z)(a,1)[0],h=(0,m.useState)([{name:"Num",title:"#"},{name:"nombreCompleto",title:"Nombre Completo"},{name:"generacion",title:"Generacion"},{name:"ventas",title:"Total Vendido $US"},{name:"cantidad",title:"Cantidad"}]),x=(0,u.Z)(h,1)[0],Z=(0,m.useState)([]),v=(0,u.Z)(Z,2),j=v[0],y=v[1],w=(0,m.useState)([{columnName:"Num",direction:"asc"}]),b=(0,u.Z)(w,2),S=b[0],k=b[1],C=(0,m.useState)(["ventas"]),P=(0,u.Z)(C,1)[0],F=function(t){var e=t.value;return"".concat(e.toLocaleString("es-MX")," $US")},L=function(t){return(0,N.jsx)(l.zl,(0,c.Z)({formatterComponent:F},t))},A=function(){var t=(0,s.Z)((0,i.Z)().mark((function t(){var e,n,a;return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,g();case 3:e=t.sent,n=e.data,a=[],n.data.map((function(t,e){a.push({cantidad:t.cantidad,nombreCompleto:t.nombreCompleto,generacion:t.generacion,Num:e+1,ventas:t.precio})})),y(a),r(!1),t.next=14;break;case 11:t.prev=11,t.t0=t.catch(0),r(!1);case 14:case"end":return t.stop()}}),t,null,[[0,11]])})));return function(){return t.apply(this,arguments)}}();return(0,m.useEffect)((function(){return r(!0),A(),function(){}}),[]),(0,N.jsx)(N.Fragment,{children:(0,N.jsxs)(d.Z,{style:{position:"relative"},children:[(0,N.jsxs)(p.rj,{rows:j,columns:x,children:[(0,N.jsx)(l.po,{}),(0,N.jsx)(l.Eb,{}),(0,N.jsx)(p.o8,{}),(0,N.jsx)(p.EG,{}),(0,N.jsx)(L,{for:P}),(0,N.jsx)(l.tU,{sorting:S,onSortingChange:k}),(0,N.jsx)(l.qf,{}),(0,N.jsx)(p.dV,{columnExtensions:o}),(0,N.jsx)(p.KA,{showSortingControls:!0}),(0,N.jsx)(p.a$,{})]}),n&&(0,N.jsx)(f.g,{})]})})},F=n(9622),L=n(32623),A={allRangos:{descripcion:"",detalle:"",imagen:"",rango:""},rangoActual:{descripcion:"",detalle:"",imagen:"",rango:""},siguenteRango:{descripcion:"",detalle:"",imagen:"",rango:""}},R=function(){var t=(0,m.useState)(!1),e=(0,u.Z)(t,2),n=e[0],r=e[1],o=(0,m.useState)(A),c=(0,u.Z)(o,2),l=c[0],p=l.rangoActual,d=l.siguenteRango,f=c[1],h=function(){var t=(0,s.Z)((0,i.Z)().mark((function t(){var e,n;return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,y();case 2:e=t.sent,n=e.data,f(n.data);case 5:case"end":return t.stop()}}),t)})));return function(){return t.apply(this,arguments)}}();return(0,m.useEffect)((function(){return h(),function(){}}),[]),(0,N.jsxs)(N.Fragment,{children:[(0,N.jsxs)(a.ZP,{container:!0,spacing:3,children:[(0,N.jsx)(a.ZP,{item:!0,xs:12,sm:12,children:(0,N.jsx)(F.q,{rango:p.rango,descripcion:p.descripcion,detalle:p.detalle,imagen:p.imagen,color:!0,onClick:function(){}})}),(0,N.jsx)(a.ZP,{item:!0,xs:12,sm:12,children:(0,N.jsx)(F.q,{rango:d.rango,descripcion:d.descripcion,detalle:d.detalle,imagen:d.imagen,onClick:function(){}})}),(0,N.jsx)(a.ZP,{item:!0,xs:12,sm:12,children:(0,N.jsx)(F.q,{rango:"Ver todos",descripcion:"Rangos",detalle:"Vista general de todos los rango",imagen:"assest/achievments/rangos.png",onClick:function(t){r(!0)}})})]}),(0,N.jsx)(L.Z,{open:n,onClose:function(t){r(!1)}})]})},T=n(59434),V=n(57689),E=n(47022),z=n(72185),I=n(76641),U=function(t){t.previewLoad;var e=(0,V.s0)(),n=(0,T.I0)(),r=(0,m.useState)([]),a=(0,u.Z)(r,2),o=a[0],c=a[1],l=(0,m.useState)(!0),p=(0,u.Z)(l,2),d=p[0],f=p[1],h=function(){var t=(0,s.Z)((0,i.Z)().mark((function t(){var r,a,o,s,u;return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,v();case 3:r=t.sent,a=r.data,console.log(a),1==a.status&&(c(a.data),f(!1)),t.next=15;break;case 9:t.prev=9,t.t0=t.catch(0),s=t.t0,u=(0,z.b)(null===(o=s.response)||void 0===o?void 0:o.status),i=u.statusToken,n((0,E.o4)({token:i})),e(u.route);case 15:case"end":return t.stop()}var i}),t,null,[[0,9]])})));return function(){return t.apply(this,arguments)}}();return(0,m.useEffect)((function(){h()}),[]),(0,N.jsx)(N.Fragment,{children:o.map((function(t,e){return(0,N.jsx)(I.Z,{icon:t.icon,color:t.color,descripcion:t.titulo,monto:t.valor,route:t.routeApp,textToolip:"",estado:d},e)}))})},_=n(88588),W=n(22492),D=n(77970),X={descripcion:"",max:0,min:0,tipoValor:"$US",value:0,porcentaje:0,titulo:""},Y=function(){var t=(0,m.useState)(X),e=(0,u.Z)(t,2),n=e[0],a=n.descripcion,o=n.max,c=n.min,l=n.tipoValor,p=n.value,d=n.porcentaje,f=n.titulo,h=e[1],x=(0,V.s0)(),g=(0,T.I0)(),Z=function(){var t=(0,s.Z)((0,i.Z)().mark((function t(){var e,n,r,a,o;return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,b();case 3:e=t.sent,n=e.data,e.headers,h(n.data),t.next=15;break;case 9:t.prev=9,t.t0=t.catch(0),a=t.t0,o=(0,z.b)(null===(r=a.response)||void 0===r?void 0:r.status),i=o.statusToken,g((0,E.o4)({token:i})),x(o.route);case 15:case"end":return t.stop()}var i}),t,null,[[0,9]])})));return function(){return t.apply(this,arguments)}}();return(0,m.useEffect)((function(){return Z(),function(){}}),[h]),(0,N.jsx)(_.Z,{sx:{minWidth:"100%",m:0},children:(0,N.jsx)(m.Fragment,{children:(0,N.jsxs)(W.Z,{children:[(0,N.jsx)(r.Z,{variant:"caption",component:"h6",style:{fontWeight:"bold"},align:"center",children:f}),(0,N.jsx)(D.P,{descripcion:a,min:c,max:o,tipoValor:l,value:p,porcentaje:d})]})})})},q=n(32338),$=n(6349),B=function(t){var e=t.titulo,n=t.tituloX,r=t.tituloY,a={responsive:!1,scale:!0,scaleSize:20,grid:[{top:"20%"}],dataset:[{id:"dataset_raw",source:t.data},{id:"dataset_since_1950_of_germany",fromDatasetId:"dataset_raw",transform:{type:"filter",config:{and:[{dimension:"Dia",gte:1}]}}}],title:{text:e,textStyle:{fontSize:14,fontFamily:"Arial"}},tooltip:{trigger:"axis"},xAxis:{name:n,type:"category",nameLocation:"middle",nameTextStyle:{align:"center",verticalAlign:"top",fontSize:12,color:"#000000",padding:20}},yAxis:{name:r,axisLabel:{distance:-30,fontSize:12,formatter:function(t){return"".concat(t," $US")}},nameLocation:"end",nameGap:0,nameTextStyle:{align:"right",verticalAlign:"top",fontSize:12,color:"#000000",padding:[-40,0,0,0]}},series:[{name:"Venta",type:"line",datasetId:"dataset_since_1950_of_germany",showSymbol:!1,tooltip:{valueFormatter:function(t,e){return t+" $US"}},encode:{x:"Dia",y:"PrecioTotal",itemName:"Dia",tooltip:["Precio Total"]}}]};return(0,N.jsx)($.Z,{option:a,className:"echarts-for-echarts",style:{height:"550px",width:"100%"},opts:{renderer:"svg"}})},G=function(t){var e=t.title,n=(0,m.useState)({graficoLineal:[["PrecioTotal","Nombre completo","Precio","Nombre completo","Dia"]],titulo:"",tituloX:"",tituloY:""}),a=(0,u.Z)(n,2),o=a[0],c=o.graficoLineal,l=o.titulo,p=o.tituloX,d=o.tituloY,f=a[1],h=function(){var t=(0,s.Z)((0,i.Z)().mark((function t(){var e,n;return(0,i.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,k();case 2:e=t.sent,n=e.data,f({graficoLineal:n.data.graficoLineal,titulo:n.data.titulo,tituloX:n.data.tituloX,tituloY:n.data.tituloY}),console.log("Data entrante ",n.data);case 6:case"end":return t.stop()}}),t)})));return function(){return t.apply(this,arguments)}}();return(0,m.useEffect)((function(){return h(),function(){}}),[]),(0,N.jsx)(_.Z,{sx:{minWidth:"100%",m:0},children:(0,N.jsx)(m.Fragment,{children:(0,N.jsxs)(W.Z,{children:[(0,N.jsx)(r.Z,{variant:"caption",component:"h6",style:{fontWeight:"bold"},align:"center",children:e}),(0,N.jsx)(B,{titulo:l,tituloX:p,tituloY:d,data:c})]})})})},M=function(){return(0,N.jsxs)(N.Fragment,{children:[(0,N.jsx)(o.d,{icon:(0,N.jsx)(q.Z,{}),nombreRoute:"Tablero",route:"/inicio",nombresRoutes:["monte sion"],routes:["#"]}),(0,N.jsx)(r.Z,{variant:"subtitle1",component:"h6",style:{fontWeight:"bold"},sx:{pl:1,pr:1},children:"Monte Sion"}),(0,N.jsx)(r.Z,{variant:"body2",gutterBottom:!0,sx:{pl:1,pr:1},children:"Resumen de ventas en grupo durante el mes"}),(0,N.jsx)(a.ZP,{container:!0,item:!0,xs:12,alignItems:"center",justifyContent:"center",children:(0,N.jsx)(U,{previewLoad:4})}),(0,N.jsxs)(a.ZP,{container:!0,spacing:3,alignItems:"center",justifyContent:"center",sx:{p:1},children:[(0,N.jsx)(a.ZP,{item:!0,xs:12,sm:6,children:(0,N.jsx)(Y,{})}),(0,N.jsx)(a.ZP,{item:!0,xs:12,sm:6,children:(0,N.jsx)(R,{})})]}),(0,N.jsx)(a.ZP,{container:!0,spacing:3,alignItems:"center",justifyContent:"center",sx:{p:1},children:(0,N.jsx)(a.ZP,{item:!0,xs:12,sm:12,children:(0,N.jsx)(G,{title:"RESUMEN"})})}),(0,N.jsx)(a.ZP,{container:!0,spacing:3,alignItems:"center",justifyContent:"center",sx:{p:1},children:(0,N.jsxs)(a.ZP,{item:!0,xs:12,sm:12,children:[(0,N.jsx)(r.Z,{variant:"body2",gutterBottom:!0,sx:{pl:1,pr:1},children:"Ventas realizadas"}),(0,N.jsx)(P,{})]})})]})}},93939:function(t,e,n){n.d(e,{NW:function(){return u},YD:function(){return p},co:function(){return m},yR:function(){return s}});var r=n(74165),a=n(15861),o=n(63263),i=n(76138);function s(){return c.apply(this,arguments)}function c(){return(c=(0,a.Z)((0,r.Z)().mark((function t(){return(0,r.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,o.Z.get("".concat("http://10.2.10.77:3000/","api/home/tarjeta"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function u(){return l.apply(this,arguments)}function l(){return(l=(0,a.Z)((0,r.Z)().mark((function t(){return(0,r.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,o.Z.get("".concat("http://10.2.10.77:3000/","api/home/novedades"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function p(){return d.apply(this,arguments)}function d(){return(d=(0,a.Z)((0,r.Z)().mark((function t(){return(0,r.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,o.Z.get("".concat("http://10.2.10.77:3000/","api/home"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function m(){return f.apply(this,arguments)}function f(){return(f=(0,a.Z)((0,r.Z)().mark((function t(){return(0,r.Z)().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,o.Z.get("".concat("http://10.2.10.77:3000/","api/home/todos-rangos"));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}(0,i.O)(),(0,i.r)()}}]);
//# sourceMappingURL=795.3249dca8.chunk.js.map