define(["Util"],function(t){return{createList:function(e){[].forEach.call(document.querySelectorAll(e),function(e,l,s){e.classList.add("custom-select__list--hidden");var i,c,n,a,r={},u='<ul class="custom-select__list custom-select__list--'+l+'">',o=e.getElementsByTagName("option");for(i=1;i<o.length;++i){r={},c=o[i],n=c.getAttribute("value"),a=c.text,r.text=a;var d=t.generate_id(10);o[i].setAttribute("id",d);var _='<li class="custom-select__item" id="'+d+'">'+r.text+"</li>";u+=_}u+="</ul>",e.insertAdjacentHTML("afterend",u)})}}});