/*
@license

dhtmlxGantt v.4.0.0 dhtmlx.com
This software can be used only as part of dhtmlx.com site.
You are not allowed to use it on any other site

(c) Dinamenta, UAB.
*/
Gantt.plugin(function(t){t.config.highlight_critical_path=!1,t._criticalPathHandler=function(){t.config.highlight_critical_path&&t.render()},t.attachEvent("onAfterLinkAdd",t._criticalPathHandler),t.attachEvent("onAfterLinkUpdate",t._criticalPathHandler),t.attachEvent("onAfterLinkDelete",t._criticalPathHandler),t.attachEvent("onAfterTaskAdd",t._criticalPathHandler),t.attachEvent("onAfterTaskUpdate",t._criticalPathHandler),t.attachEvent("onAfterTaskDelete",t._criticalPathHandler),t.isCriticalTask=function(t){
if(t){var e=arguments[1]||{};if(this._isTask(t)){if(this._isProjectEnd(t))return!0;e[t.id]=!0;for(var i=this._getSuccessors(t),n=0;n<i.length;n++){var a=this.getTask(i[n].task);if(this._getSlack(t,a,i[n].link,i[n].lag)<=0&&!e[a.id]&&this.isCriticalTask(a,e))return!0}}return!1}},t.isCriticalLink=function(e){return this.isCriticalTask(t.getTask(e.source))},t.getSlack=function(t,e){for(var i=[],n={},a=0;a<t.$source.length;a++)n[t.$source[a]]=!0;for(var a=0;a<e.$target.length;a++)n[e.$target[a]]&&i.push(e.$target[a]);
for(var s=[],a=0;a<i.length;a++){var r=this.getLink(i[a]);s.push(this._getSlack(t,e,r.type,r.lag))}return Math.min.apply(Math,s)},t._getSlack=function(t,e,i,n){if(null===i)return 0;var a=null,s=null,r=this.config.links,o=this.config.types;a=i!=r.finish_to_finish&&i!=r.finish_to_start||this._get_safe_type(t.type)==o.milestone?t.start_date:t.end_date,s=i!=r.finish_to_finish&&i!=r.start_to_finish||this._get_safe_type(e.type)==o.milestone?e.start_date:e.end_date;var _=0;return _=+a>+s?-this.calculateDuration(s,a):this.calculateDuration(a,s),
n&&1*n==n&&(_-=n),_},t._getProjectEnd=function(){var e=t.getTaskByTime();return e=e.sort(function(t,e){return+t.end_date>+e.end_date?1:-1}),e.length?e[e.length-1].end_date:null},t._isProjectEnd=function(t){return!this._hasDuration(t.end_date,this._getProjectEnd())},t._formatSuccessors=function(t,e){for(var i=[],n=0;n<t.length;n++)i.push(this._formatSuccessor(t[n],e));return i},t._formatSuccessor=function(t,e){return{task:t,link:e.type,lag:e.lag}},t._getSuccessors=function(e){var i=[];if(t._isProject(e))i=i.concat(t._formatSuccessors(this.getChildren(e.id),null));else for(var n=e.$source,a=0;a<n.length;a++){
var s=this.getLink(n[a]);if(this.isTaskExists(s.target)){var r=this.getTask(s.target);this._isTask(r)?i.push(t._formatSuccessor(s.target,s)):i=i.concat(t._formatSuccessors(this.getChildren(r.id),s))}}return i}});
//# sourceMappingURL=../sources/ext/dhtmlxgantt_critical_path.js.map