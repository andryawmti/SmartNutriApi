!function(t,e,i){"use strict";var s=".rs.jquery.bootgrid";function n(t){var e=this;return!this.rows.contains(function(i){return e.identifier&&i[e.identifier]===t[e.identifier]})&&(this.rows.push(t),!0)}function o(e){var i=this.footer?this.footer.find(e):t(),s=this.header?this.header.find(e):t();return t.merge(i,s)}function r(e){return e?t.extend({},this.cachedParams,{ctx:e}):this.cachedParams}function l(e){return"."+t.trim(e).replace(/\s+/gm,".")}function a(){this.element.trigger("initialize"+s),function(){var e=this,i=this.element.find("thead > tr").first(),s=!1;i.children().each(function(){var i=t(this),n=i.data(),o={id:n.columnId,identifier:null==e.identifier&&n.identifier||!1,converter:e.options.converters[n.converter||n.type]||e.options.converters.string,text:i.text(),align:n.align||"left",headerAlign:n.headerAlign||"left",cssClass:n.cssClass||"",headerCssClass:n.headerCssClass||"",formatter:e.options.formatters[n.formatter]||null,order:s||"asc"!==n.order&&"desc"!==n.order?null:n.order,searchable:!(!1===n.searchable),sortable:!(!1===n.sortable),visible:!(!1===n.visible),visibleInSelection:!(!1===n.visibleInSelection),width:t.isNumeric(n.width)?n.width+"px":"string"==typeof n.width?n.width:null};e.columns.push(o),null!=o.order&&(e.sortDictionary[o.id]=o.order),o.identifier&&(e.identifier=o.id,e.converter=o.converter),e.options.multiSort||null===o.order||(s=!0)})}.call(this),this.selection=this.options.selection&&null!=this.identifier,function(){if(!this.options.ajax){var e=this,i=this.element.find("tbody > tr");i.each(function(){var i=t(this),s=i.children("td"),o={};t.each(e.columns,function(t,e){o[e.id]=e.converter.from(s.eq(t).text())}),n.call(e,o)}),d.call(this,this.rows.length),m.call(this)}}.call(this),function(){var e=this.options.templates,i=this.element.parent().hasClass(this.options.css.responsiveTable)?this.element.parent():this.element;this.element.addClass(this.options.css.table),0===this.element.children("tbody").length&&this.element.append(e.body);1&this.options.navigation&&(this.header=t(e.header.resolve(r.call(this,{id:this.element._bgId()+"-header"}))),i.before(this.header));2&this.options.navigation&&(this.footer=t(e.footer.resolve(r.call(this,{id:this.element._bgId()+"-footer"}))),i.after(this.footer))}.call(this),g.call(this),function(){if(0!==this.options.navigation){var i=this.options.css,n=l(i.search),a=o.call(this,n);if(a.length>0){var c=this,h=this.options.templates,d=null,u="",p=l(i.searchField),g=t(h.search.resolve(r.call(this))),m=g.is(p)?g:g.find(p);m.on("keyup"+s,function(i){i.stopPropagation();var s=t(this).val();(u!==s||13===i.which&&""!==s)&&(u=s,(13===i.which||0===s.length||s.length>=c.options.searchSettings.characters)&&(e.clearTimeout(d),d=e.setTimeout(function(){f.call(c,s)},c.options.searchSettings.delay)))}),v.call(this,a,g)}}}.call(this),function(){if(0!==this.options.navigation){var e=this.options.css,i=l(e.actions),n=o.call(this,i);if(n.length>0){var a=this,d=this.options.templates,u=t(d.actions.resolve(r.call(this)));if(this.options.ajax){var p=d.icon.resolve(r.call(this,{iconCss:e.iconRefresh})),f=t(d.actionButton.resolve(r.call(this,{content:p,text:this.options.labels.refresh}))).on("click"+s,function(t){t.stopPropagation(),a.current=1,h.call(a)});u.append(f)}(function(e){var i=this,n=this.options.rowCount;function o(t){return-1===t?i.options.labels.all:t}if(t.isArray(n)){var a=this.options.css,c=this.options.templates,d=t(c.actionDropDown.resolve(r.call(this,{content:o(this.rowCount)}))),u=l(a.dropDownMenu),p=l(a.dropDownMenuText),f=l(a.dropDownMenuItems),g=l(a.dropDownItemButton);t.each(n,function(e,n){var l=t(c.actionDropDownItem.resolve(r.call(i,{text:o(n),action:n})))._bgSelectAria(n===i.rowCount).on("click"+s,g,function(e){e.preventDefault();var s=t(this),n=s.data("action");n!==i.rowCount&&(i.current=1,i.rowCount=n,s.parents(f).children().each(function(){var e=t(this),i=e.find(g).data("action");e._bgSelectAria(i===n)}),s.parents(u).find(p).text(o(n)),h.call(i))});d.find(f).append(l)}),e.append(d)}}).call(this,u),function(e){if(this.options.columnSelection&&this.columns.length>1){var i=this,n=this.options.css,o=this.options.templates,a=o.icon.resolve(r.call(this,{iconCss:n.iconColumns})),d=t(o.actionDropDown.resolve(r.call(this,{content:a}))),u=l(n.dropDownItem),p=l(n.dropDownItemCheckbox),f=l(n.dropDownMenuItems);t.each(this.columns,function(e,a){if(a.visibleInSelection){var v=t(o.actionDropDownCheckboxItem.resolve(r.call(i,{name:a.id,label:a.text,checked:a.visible}))).on("click"+s,u,function(e){e.stopPropagation();var s=t(this),n=s.find(p);if(!n.prop("disabled")){a.visible=n.prop("checked");var o=i.columns.where(c).length>1;s.parents(f).find(u+":has("+p+":checked)")._bgEnableAria(o).find(p)._bgEnableField(o),i.element.find("tbody").empty(),g.call(i),h.call(i)}});d.find(l(n.dropDownMenuItems)).append(v)}}),e.append(d)}}.call(this,u),v.call(this,n,u)}}}.call(this),h.call(this),this.element.trigger("initialized"+s)}function c(t){return t.visible}function h(){var i=this;function n(e,n){i.currentRows=e,d.call(i,n),i.options.keepSelection||(i.selectedRows=[]),function(e){if(e.length>0){var i=this,n=this.options.css,o=this.options.templates,a=this.element.children("tbody").first(),c=!0,h="";t.each(e,function(e,s){var l="",a=' data-row-id="'+(null==i.identifier?e:s[i.identifier])+'"',d="";if(i.selection){var u=-1!==t.inArray(s[i.identifier],i.selectedRows),p=o.select.resolve(r.call(i,{type:"checkbox",value:s[i.identifier],checked:u}));l+=o.cell.resolve(r.call(i,{content:p,css:n.selectCell})),c=c&&u,u&&(d+=n.selected,a+=' aria-selected="true"')}var f=null!=s.status&&i.options.statusMapping[s.status];f&&(d+=f),t.each(i.columns,function(e,a){if(a.visible){var c=t.isFunction(a.formatter)?a.formatter.call(i,a,s):a.converter.to(s[a.id]),h=a.cssClass.length>0?" "+a.cssClass:"";l+=o.cell.resolve(r.call(i,{content:null==c||""===c?"&nbsp;":c,css:("right"===a.align?n.right:"center"===a.align?n.center:n.left)+h,style:null==a.width?"":"width:"+a.width+";"}))}}),d.length>0&&(a+=' class="'+d+'"'),h+=o.row.resolve(r.call(i,{attr:a,cells:l}))}),i.element.find("thead "+l(i.options.css.selectBox)).prop("checked",c),a.html(h),function(e){var i=this,n=l(this.options.css.selectBox);this.selection&&e.off("click"+s,n).on("click"+s,n,function(e){e.stopPropagation();var s=t(this),n=i.converter.from(s.val());s.prop("checked")?i.select([n]):i.deselect([n])});e.off("click"+s,"> tr").on("click"+s,"> tr",function(e){e.stopPropagation();var n=t(this),o=null==i.identifier?n.data("row-id"):i.converter.from(n.data("row-id")+""),r=null==i.identifier?i.currentRows[o]:i.currentRows.first(function(t){return t[i.identifier]===o});i.selection&&i.options.rowSelect&&(n.hasClass(i.options.css.selected)?i.deselect([o]):i.select([o])),i.element.trigger("click"+s,[i.columns,r])})}.call(this,a)}else u.call(this)}.call(i,e),function(){if(0!==this.options.navigation){var e=l(this.options.css.infos),i=o.call(this,e);if(i.length>0){var s=this.current*this.rowCount,n=t(this.options.templates.infos.resolve(r.call(this,{end:0===this.total||-1===s||s>this.total?this.total:s,start:0===this.total?0:s-this.rowCount+1,total:this.total})));v.call(this,i,n)}}}.call(i),function(){if(0!==this.options.navigation){var e=l(this.options.css.pagination),i=o.call(this,e)._bgShowAria(-1!==this.rowCount);if(-1!==this.rowCount&&i.length>0){var s=this.options.templates,n=this.current,a=this.totalPages,c=t(s.pagination.resolve(r.call(this))),h=a-n,d=-1*(this.options.padding-n),u=h>=this.options.padding?Math.max(d,1):Math.max(d-this.options.padding+h,1),f=2*this.options.padding+1,g=a>=f?f:a;p.call(this,c,"first","&laquo;","first")._bgEnableAria(n>1),p.call(this,c,"prev","&lt;","prev")._bgEnableAria(n>1);for(var m=0;m<g;m++){var b=m+u;p.call(this,c,b,b,"page-"+b)._bgEnableAria()._bgSelectAria(b===n)}0===g&&p.call(this,c,1,1,"page-1")._bgEnableAria(!1)._bgSelectAria(),p.call(this,c,"next","&gt;","next")._bgEnableAria(a>n),p.call(this,c,"last","&raquo;","last")._bgEnableAria(a>n),v.call(this,i,c)}}}.call(i),i.element._bgBusyAria(!1).trigger("loaded"+s)}if(this.element._bgBusyAria(!0).trigger("load"+s),function(){var t=this;e.setTimeout(function(){if("true"===t.element._bgAria("busy")){var e=t.options.templates,i=t.element.children("thead").first(),s=t.element.children("tbody").first(),n=s.find("tr > td").first(),o=t.element.height()-i.height()-(n.height()+20),l=t.columns.where(c).length;t.selection&&(l+=1),s.html(e.loading.resolve(r.call(t,{columns:l}))),-1!==t.rowCount&&o>0&&s.find("tr > td").css("padding","20px 0 "+o+"px")}},250)}.call(this),this.options.ajax){var a=function(){var e={current:this.current,rowCount:this.rowCount,sort:this.sortDictionary,searchPhrase:this.searchPhrase},i=this.options.post;return i=t.isFunction(i)?i():i,this.options.requestHandler(t.extend(!0,e,i))}.call(this),h=function(){var e=this.options.url;return t.isFunction(e)?e():e}.call(this);if(null==h||"string"!=typeof h||0===h.length)throw new Error("Url setting must be a none empty string or a function that returns one.");this.xqr&&this.xqr.abort();var f={url:h,data:a,success:function(e){i.xqr=null,"string"==typeof e&&(e=t.parseJSON(e)),e=i.options.responseHandler(e),i.current=e.current,n(e.rows,e.total)},error:function(t,e,n){i.xqr=null,"abort"!==e&&(u.call(i),i.element._bgBusyAria(!1).trigger("loaded"+s))}};f=t.extend(this.options.ajaxSettings,f),this.xqr=t.ajax(f)}else{var g=this.searchPhrase.length>0?this.rows.where(function(t){for(var e,s=new RegExp(i.searchPhrase,i.options.caseSensitive?"g":"gi"),n=0;n<i.columns.length;n++)if((e=i.columns[n]).searchable&&e.visible&&e.converter.to(t[e.id]).search(s)>-1)return!0;return!1}):this.rows,m=g.length;-1!==this.rowCount&&(g=g.page(this.current,this.rowCount)),e.setTimeout(function(){n(g,m)},10)}}function d(t){this.total=t,this.totalPages=-1===this.rowCount?1:Math.ceil(this.total/this.rowCount)}function u(){var t=this.element.children("tbody").first(),e=this.options.templates,i=this.columns.where(c).length;this.selection&&(i+=1),t.html(e.noResults.resolve(r.call(this,{columns:i})))}function p(e,i,n,o){var a=this,c=this.options.templates,d=this.options.css,u=r.call(this,{css:o,text:n,page:i}),p=t(c.paginationItem.resolve(u)).on("click"+s,l(d.paginationButton),function(e){e.stopPropagation(),e.preventDefault();var i=t(this),s=i.parent();if(!s.hasClass("active")&&!s.hasClass("disabled")){var n={first:1,prev:a.current-1,next:a.current+1,last:a.totalPages},o=i.data("page");a.current=n[o]||o,h.call(a)}i.trigger("blur")});return e.append(p),p}function f(t){this.searchPhrase!==t&&(this.current=1,this.searchPhrase=t,h.call(this))}function g(){var e=this,i=this.element.find("thead > tr"),n=this.options.css,o=this.options.templates,a="",c=this.options.sorting;if(this.selection){var d=this.options.multiSelect?o.select.resolve(r.call(e,{type:"checkbox",value:"all"})):"";a+=o.rawHeaderCell.resolve(r.call(e,{content:d,css:n.selectCell}))}if(t.each(this.columns,function(t,i){if(i.visible){var s=e.sortDictionary[i.id],l=c&&s&&"asc"===s?n.iconUp:c&&s&&"desc"===s?n.iconDown:"",h=o.icon.resolve(r.call(e,{iconCss:l})),d=i.headerAlign,u=i.headerCssClass.length>0?" "+i.headerCssClass:"";a+=o.headerCell.resolve(r.call(e,{column:i,icon:h,sortable:c&&i.sortable&&n.sortable||"",css:("right"===d?n.right:"center"===d?n.center:n.left)+u,style:null==i.width?"":"width:"+i.width+";"}))}}),i.html(a),c){var u=l(n.sortable);i.off("click"+s,u).on("click"+s,u,function(i){i.preventDefault(),function(t){var e=this.options.css,i=l(e.icon),s=t.data("column-id")||t.parents("th").first().data("column-id"),n=this.sortDictionary[s],o=t.find(i);this.options.multiSort||(t.parents("tr").first().find(i).removeClass(e.iconDown+" "+e.iconUp),this.sortDictionary={});if(n&&"asc"===n)this.sortDictionary[s]="desc",o.removeClass(e.iconUp).addClass(e.iconDown);else if(n&&"desc"===n)if(this.options.multiSort){var r={};for(var a in this.sortDictionary)a!==s&&(r[a]=this.sortDictionary[a]);this.sortDictionary=r,o.removeClass(e.iconDown)}else this.sortDictionary[s]="asc",o.removeClass(e.iconDown).addClass(e.iconUp);else this.sortDictionary[s]="asc",o.addClass(e.iconUp)}.call(e,t(this)),m.call(e),h.call(e)})}if(this.selection&&this.options.multiSelect){var p=l(n.selectBox);i.off("click"+s,p).on("click"+s,p,function(i){i.stopPropagation(),t(this).prop("checked")?e.select():e.deselect()})}}function v(e,i){e.each(function(e,s){t(s).before(i.clone(!0)).remove()})}function m(){var t=[];if(!this.options.ajax){for(var e in this.sortDictionary)(this.options.multiSort||0===t.length)&&t.push({id:e,order:this.sortDictionary[e]});t.length>0&&this.rows.sort(function e(i,s,n){var o=(n=n||0)+1,r=t[n];function l(t){return"asc"===r.order?t:-1*t}return i[r.id]>s[r.id]?l(1):i[r.id]<s[r.id]?l(-1):t.length>o?e(i,s,o):0})}}var b=function(e,i){this.element=t(e),this.origin=this.element.clone(),this.options=t.extend(!0,{},b.defaults,this.element.data(),i);var s=this.options.rowCount=this.element.data().rowCount||i.rowCount||this.options.rowCount;this.columns=[],this.current=1,this.currentRows=[],this.identifier=null,this.selection=!1,this.converter=null,this.rowCount=t.isArray(s)?s[0]:s,this.rows=[],this.searchPhrase="",this.selectedRows=[],this.sortDictionary={},this.total=0,this.totalPages=0,this.cachedParams={lbl:this.options.labels,css:this.options.css,ctx:{}},this.header=null,this.footer=null,this.xqr=null};if(b.defaults={navigation:3,padding:2,columnSelection:!0,rowCount:[10,25,50,-1],selection:!1,multiSelect:!1,rowSelect:!1,keepSelection:!1,highlightRows:!1,sorting:!0,multiSort:!1,searchSettings:{delay:250,characters:1},ajax:!1,ajaxSettings:{method:"POST"},post:{},url:"",caseSensitive:!0,requestHandler:function(t){return t},responseHandler:function(t){return t},converters:{numeric:{from:function(t){return+t},to:function(t){return t+""}},string:{from:function(t){return t},to:function(t){return t}}},css:{actions:"actions btn-group",center:"text-center",columnHeaderAnchor:"column-header-anchor",columnHeaderText:"text",dropDownItem:"dropdown-item",dropDownItemButton:"dropdown-item-button",dropDownItemCheckbox:"dropdown-item-checkbox",dropDownMenu:"dropdown btn-group",dropDownMenuItems:"dropdown-menu pull-right",dropDownMenuText:"dropdown-text",footer:"bootgrid-footer container-fluid",header:"bootgrid-header container-fluid",icon:"icon glyphicon",iconColumns:"glyphicon-th-list",iconDown:"glyphicon-chevron-down",iconRefresh:"glyphicon-refresh",iconSearch:"glyphicon-search",iconUp:"glyphicon-chevron-up",infos:"infos",left:"text-left",pagination:"pagination",paginationButton:"button",responsiveTable:"table-responsive",right:"text-right",search:"search form-group",searchField:"search-field form-control",selectBox:"select-box",selectCell:"select-cell",selected:"active",sortable:"sortable",table:"bootgrid-table table"},formatters:{},labels:{all:"All",infos:"Showing {{ctx.start}} to {{ctx.end}} of {{ctx.total}} entries",loading:"Loading...",noResults:"No results found!",refresh:"Refresh",search:"Search"},statusMapping:{0:"success",1:"info",2:"warning",3:"danger"},templates:{actionButton:'<button class="btn btn-default" type="button" title="{{ctx.text}}">{{ctx.content}}</button>',actionDropDown:'<div class="{{css.dropDownMenu}}"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><span class="{{css.dropDownMenuText}}">{{ctx.content}}</span> <span class="caret"></span></button><ul class="{{css.dropDownMenuItems}}" role="menu"></ul></div>',actionDropDownItem:'<li><a data-action="{{ctx.action}}" class="{{css.dropDownItem}} {{css.dropDownItemButton}}">{{ctx.text}}</a></li>',actionDropDownCheckboxItem:'<li><label class="{{css.dropDownItem}}"><input name="{{ctx.name}}" type="checkbox" value="1" class="{{css.dropDownItemCheckbox}}" {{ctx.checked}} /> {{ctx.label}}</label></li>',actions:'<div class="{{css.actions}}"></div>',body:"<tbody></tbody>",cell:'<td class="{{ctx.css}}" style="{{ctx.style}}">{{ctx.content}}</td>',footer:'<div id="{{ctx.id}}" class="{{css.footer}}"><div class="row"><div class="col-sm-6"><p class="{{css.pagination}}"></p></div><div class="col-sm-6 infoBar"><p class="{{css.infos}}"></p></div></div></div>',header:'<div id="{{ctx.id}}" class="{{css.header}}"><div class="row"><div class="col-sm-12 actionBar"><p class="{{css.search}}"></p><p class="{{css.actions}}"></p></div></div></div>',headerCell:'<th data-column-id="{{ctx.column.id}}" class="{{ctx.css}}" style="{{ctx.style}}"><a href="javascript:void(0);" class="{{css.columnHeaderAnchor}} {{ctx.sortable}}"><span class="{{css.columnHeaderText}}">{{ctx.column.text}}</span>{{ctx.icon}}</a></th>',icon:'<span class="{{css.icon}} {{ctx.iconCss}}"></span>',infos:'<div class="{{css.infos}}">{{lbl.infos}}</div>',loading:'<tr><td colspan="{{ctx.columns}}" class="loading">{{lbl.loading}}</td></tr>',noResults:'<tr><td colspan="{{ctx.columns}}" class="no-results">{{lbl.noResults}}</td></tr>',pagination:'<ul class="{{css.pagination}}"></ul>',paginationItem:'<li class="{{ctx.css}}"><a data-page="{{ctx.page}}" class="{{css.paginationButton}}">{{ctx.text}}</a></li>',rawHeaderCell:'<th class="{{ctx.css}}">{{ctx.content}}</th>',row:"<tr{{ctx.attr}}>{{ctx.cells}}</tr>",search:'<div class="{{css.search}}"><div class="input-group"><span class="{{css.icon}} input-group-addon {{css.iconSearch}}"></span> <input type="text" class="{{css.searchField}}" placeholder="{{lbl.search}}" /></div></div>',select:'<input name="select" type="{{ctx.type}}" class="{{css.selectBox}}" value="{{ctx.value}}" {{ctx.checked}} />'}},b.prototype.append=function(t){if(this.options.ajax);else{for(var e=[],i=0;i<t.length;i++)n.call(this,t[i])&&e.push(t[i]);m.call(this),function(t){this.options.highlightRows}.call(this,e),h.call(this),this.element.trigger("appended"+s,[e])}return this},b.prototype.clear=function(){if(this.options.ajax);else{var e=t.extend([],this.rows);this.rows=[],this.current=1,this.total=0,h.call(this),this.element.trigger("cleared"+s,[e])}return this},b.prototype.destroy=function(){return t(e).off(s),1&this.options.navigation&&this.header.remove(),2&this.options.navigation&&this.footer.remove(),this.element.before(this.origin).remove(),this},b.prototype.reload=function(){return this.current=1,h.call(this),this},b.prototype.remove=function(t){if(null!=this.identifier){if(this.options.ajax);else{t=t||this.selectedRows;for(var e,i=[],n=0;n<t.length;n++){e=t[n];for(var o=0;o<this.rows.length;o++)if(this.rows[o][this.identifier]===e){i.push(this.rows[o]),this.rows.splice(o,1);break}}this.current=1,h.call(this),this.element.trigger("removed"+s,[i])}}return this},b.prototype.search=function(t){if(t=t||"",this.searchPhrase!==t){var e=l(this.options.css.searchField);o.call(this,e).val(t)}return f.call(this,t),this},b.prototype.select=function(e){if(this.selection){e=e||this.currentRows.propValues(this.identifier);for(var i,n,o=[];e.length>0&&(this.options.multiSelect||1!==o.length);)if(i=e.pop(),-1===t.inArray(i,this.selectedRows))for(n=0;n<this.currentRows.length;n++)if(this.currentRows[n][this.identifier]===i){o.push(this.currentRows[n]),this.selectedRows.push(i);break}if(o.length>0){var r=l(this.options.css.selectBox),a=this.selectedRows.length>=this.currentRows.length;for(n=0;!this.options.keepSelection&&a&&n<this.currentRows.length;)a=-1!==t.inArray(this.currentRows[n++][this.identifier],this.selectedRows);for(this.element.find("thead "+r).prop("checked",a),this.options.multiSelect||this.element.find("tbody > tr "+r+":checked").trigger("click"+s),n=0;n<this.selectedRows.length;n++)this.element.find('tbody > tr[data-row-id="'+this.selectedRows[n]+'"]').addClass(this.options.css.selected)._bgAria("selected","true").find(r).prop("checked",!0);this.element.trigger("selected"+s,[o])}}return this},b.prototype.deselect=function(e){if(this.selection){e=e||this.currentRows.propValues(this.identifier);for(var i,n,o,r=[];e.length>0;)if(i=e.pop(),-1!==(o=t.inArray(i,this.selectedRows)))for(n=0;n<this.currentRows.length;n++)if(this.currentRows[n][this.identifier]===i){r.push(this.currentRows[n]),this.selectedRows.splice(o,1);break}if(r.length>0){var a=l(this.options.css.selectBox);for(this.element.find("thead "+a).prop("checked",!1),n=0;n<r.length;n++)this.element.find('tbody > tr[data-row-id="'+r[n][this.identifier]+'"]').removeClass(this.options.css.selected)._bgAria("selected","false").find(a).prop("checked",!1);this.element.trigger("deselected"+s,[r])}}return this},b.prototype.sort=function(e){var i=e?t.extend({},e):{};return i===this.sortDictionary?this:(this.sortDictionary=i,g.call(this),m.call(this),h.call(this),this)},b.prototype.getColumnSettings=function(){return t.merge([],this.columns)},b.prototype.getCurrentPage=function(){return this.current},b.prototype.getCurrentRows=function(){return t.merge([],this.currentRows)},b.prototype.getRowCount=function(){return this.rowCount},b.prototype.getSearchPhrase=function(){return this.searchPhrase},b.prototype.getSelectedRows=function(){return t.merge([],this.selectedRows)},b.prototype.getSortDictionary=function(){return t.extend({},this.sortDictionary)},b.prototype.getTotalPageCount=function(){return this.totalPages},b.prototype.getTotalRowCount=function(){return this.total},t.fn.extend({_bgAria:function(t,e){return e?this.attr("aria-"+t,e):this.attr("aria-"+t)},_bgBusyAria:function(t){return null==t||t?this._bgAria("busy","true"):this._bgAria("busy","false")},_bgRemoveAria:function(t){return this.removeAttr("aria-"+t)},_bgEnableAria:function(t){return null==t||t?this.removeClass("disabled")._bgAria("disabled","false"):this.addClass("disabled")._bgAria("disabled","true")},_bgEnableField:function(t){return null==t||t?this.removeAttr("disabled"):this.attr("disabled","disable")},_bgShowAria:function(t){return null==t||t?this.show()._bgAria("hidden","false"):this.hide()._bgAria("hidden","true")},_bgSelectAria:function(t){return null==t||t?this.addClass("active")._bgAria("selected","true"):this.removeClass("active")._bgAria("selected","false")},_bgId:function(t){return t?this.attr("id",t):this.attr("id")}}),!String.prototype.resolve){var w={checked:function(t){return"boolean"==typeof t?t?'checked="checked"':"":t}};String.prototype.resolve=function(e,i){var s=this;return t.each(e,function(e,n){if(null!=n&&"function"!=typeof n)if("object"==typeof n){var o=i?t.extend([],i):[];o.push(e),s=s.resolve(n,o)+""}else{w&&w[e]&&"function"==typeof w[e]&&(n=w[e](n)),e=i?i.join(".")+"."+e:e;var r=new RegExp("\\{\\{"+e+"\\}\\}","gm");s=s.replace(r,n.replace?n.replace(/\$/gi,"&#36;"):n)}}),s}}Array.prototype.first||(Array.prototype.first=function(t){for(var e=0;e<this.length;e++){var i=this[e];if(t(i))return i}return null}),Array.prototype.contains||(Array.prototype.contains=function(t){for(var e=0;e<this.length;e++){if(t(this[e]))return!0}return!1}),Array.prototype.page||(Array.prototype.page=function(t,e){var i=(t-1)*e,s=i+e;return this.length>i?this.length>s?this.slice(i,s):this.slice(i):[]}),Array.prototype.where||(Array.prototype.where=function(t){for(var e=[],i=0;i<this.length;i++){var s=this[i];t(s)&&e.push(s)}return e}),Array.prototype.propValues||(Array.prototype.propValues=function(t){for(var e=[],i=0;i<this.length;i++)e.push(this[i][t]);return e});var y=t.fn.bootgrid;t.fn.bootgrid=function(e){var i=Array.prototype.slice.call(arguments,1),n=null,o=this.each(function(o){var r=t(this),l=r.data(s),c="object"==typeof e&&e;if((l||"destroy"!==e)&&(l||(r.data(s,l=new b(this,c)),a.call(l)),"string"==typeof e))if(0===e.indexOf("get")&&0===o)n=l[e].apply(l,i);else if(0!==e.indexOf("get"))return l[e].apply(l,i)});return"string"==typeof e&&0===e.indexOf("get")?n:o},t.fn.bootgrid.Constructor=b,t.fn.bootgrid.noConflict=function(){return t.fn.bootgrid=y,this},t('[data-toggle="bootgrid"]').bootgrid()}(jQuery,window);