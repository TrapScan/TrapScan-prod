import{A as c}from"./AdminLayout.28d54cb0.js";import{L as p,r as s,o,c as _,w as r,a as e,b as f,d as n,g as h,h as a}from"./app.3ce61da7.js";import{_ as m}from"./_plugin-vue_export-helper.cdc0426e.js";const u={name:"Index",components:{AdminLayout:c,Link:p}},w={class:"flex bg-white rounded-2xl shadow-xl justify-between w-auto dark:bg-mirage-500 p-4 m-4 items-center"},x={class:"flex w-full flex-wrap justify-start"},g=e("span",{class:"w-full text-2xl dark:text-white"}," Scrape Trap Data ",-1),k=e("span",{class:"w-full mt-3 dark:text-white"}," This is a dangerous button. ",-1),y=e("p",{class:"w-full mt-3 dark:text-white"}," This will trigger a scrape of TrapNZ data for all projects we have access to. It will create any Traps it does not recognise It will not update data for any Traps it does not recognise Trapline and note data are missing, the CSV has this data for all traps ",-1),b=e("p",{class:"w-full mt-3 dark:text-white font-bold"}," No data is modified. Traps are created ",-1),T={key:0,class:"alert w-full mt-3 dark:text-white font-bold"},L=a("                    "),N=a(`
               `),v={class:"flex w-full justify-end"},$=a(" Scape TrapNZ Data ");function V(t,j,A,B,C,S){const l=s("el-alert"),i=s("Link"),d=s("AdminLayout");return o(),_(d,null,{default:r(()=>[e("div",w,[e("div",x,[g,k,y,b,t.$page.props.flash.message?(o(),f("pre",T,[L,n(l,{title:t.$page.props.flash.message,type:"success","show-icon":""},null,8,["title"]),N])):h("",!0)]),e("div",v,[n(i,{href:t.route("admin.start_scrap"),class:"bg-red-500 py-2 font-bold rounded-full px-4 hover:bg-red-800 text-white"},{default:r(()=>[$]),_:1},8,["href"])])])]),_:1})}const E=m(u,[["render",V]]);export{E as default};
//# sourceMappingURL=Scrap.4c064dc6.js.map