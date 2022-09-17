import{u as c,o as p,c as f,w as m,d as i,m as s,U as b,a as e,K as w,E as l,Q as n,n as x}from"./app.3ce61da7.js";import{B as _}from"./Guest.ed188457.js";import{_ as h}from"./ValidationErrors.c3753af6.js";import"./_plugin-vue_export-helper.cdc0426e.js";const g={class:"p-3"},y={class:"mt-2 w-11/12 mx-auto"},v=["onSubmit"],k={class:"flex flex-col mb-5"},P=e("label",{class:"block ubuntu text-2xs text-dark font-bold mb-2",for:"grid-password"},"Your email address",-1),z={class:"relative flex w-full flex-wrap items-stretch mb-3"},B=e("span",{class:"z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"},[e("i",{class:"fas fa-envelope text-gray-500"})],-1),V=e("label",{class:"block ubuntu text-2xs text-dark font-bold mb-2",for:"grid-password"},"Password",-1),j={class:"relative flex w-full flex-wrap items-stretch mb-3"},C=e("span",{class:"z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"},[e("i",{class:"fas fa-lock text-gray-500"})],-1),S=e("label",{class:"block ubuntu text-2xs text-dark font-bold mb-2",for:"grid-password"},"Confirm Password",-1),U={class:"relative flex w-full flex-wrap items-stretch mb-3"},q=e("span",{class:"z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"},[e("i",{class:"fas fa-lock text-gray-500"})],-1),R={class:"flex"},E={class:"flex w-full mx-auto"},F=["disabled"],M=e("span",{class:"mr-2 uppercase"},"Reset Password",-1),N=[M],Q={__name:"ResetPassword",props:{email:String,token:String},setup(d){const r=d,t=c({token:r.token,email:r.email,password:"",password_confirmation:""}),u=()=>{t.post(route("password.update"),{onFinish:()=>t.reset("password","password_confirmation")})};return(D,o)=>(p(),f(_,null,{default:m(()=>[i(s(b),{title:"Reset Password"}),e("div",g,[e("div",y,[e("form",{onSubmit:w(u,["prevent"])},[e("div",k,[i(h,{class:"mb-4"})]),P,e("div",z,[B,l(e("input",{placeholder:"Email","onUpdate:modelValue":o[0]||(o[0]=a=>s(t).email=a),required:"",autofocus:"",autocomplete:"username",type:"text",class:"px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"},null,512),[[n,s(t).email]])]),V,e("div",j,[C,l(e("input",{placeholder:"Password","onUpdate:modelValue":o[1]||(o[1]=a=>s(t).password=a),required:"",autofocus:"",autocomplete:"password",type:"password",class:"px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"},null,512),[[n,s(t).password]])]),S,e("div",U,[q,l(e("input",{placeholder:"Confirm Password","onUpdate:modelValue":o[2]||(o[2]=a=>s(t).password_confirmation=a),required:"",autofocus:"",autocomplete:"password",type:"password",class:"px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"},null,512),[[n,s(t).password_confirmation]])]),e("div",R,[e("div",E,[e("button",{type:"submit",class:x([{"opacity-25":s(t).processing},"flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in"]),disabled:s(t).processing},N,10,F)])])],40,v)])])]),_:1}))}};export{Q as default};
//# sourceMappingURL=ResetPassword.a408e5c2.js.map