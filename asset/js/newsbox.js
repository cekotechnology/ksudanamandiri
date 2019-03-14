// Copyright (c) 2006 Bravenet Web Services (http://www.bravenet.com)
// 
// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do so, subject to
// the following conditions:
// 
// The above copyright notice and this permission notice shall be
// included in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
// LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
// OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

var newsBox = Class.create();
	
newsBox.prototype = {
 	initialize: function(options)
 	{
 		this.items = document.getElementsByClassName('newsItem');
		this.options = options;
		option = {};
		$H(this.options).each
		(
			function(item)
			{
				option[item.key] = item.value;
			}
		)
		this.bg 	= option['bg'];
		this.fg 	= option['fg'];
		this.link 	= option['link'];
		this.altbg	= option['altbg'];
		this.altfg	= option['altfg'];
		this.altlink= options['altlink'];
		
		for(i=0;i<this.items.length;i++)
		{
			theLink = this.items[i].getElementsByTagName('a');
			theLink = theLink[0];
			theLink.onmouseup = function() {newsBox.show(this);}
			theLink.style.color = (i%2==0) ? this.link:this.altlink;
			this.items[i].style.backgroundColor = (i%2==0) ? this.bg:this.altbg;
			this.items[i].style.color = (i%2==0) ? this.fg:this.altfg;
		}
 	},
	show: function(where)
	{
		var Content = this.getNextSibling(where, 'div');
		new Effect.toggle(Content,'blind', {duration: 0.5});
	},
	checkBrowser: function (string)
	{
		var detect = navigator.userAgent.toLowerCase();
		place = detect.indexOf(string) + 1;
		thestring = string;
		return place;
	},
	getNextSibling: function(node, tagName) 
	{
    	var next = node.nextSibling;
    	while(next && next.nodeName != tagName.toUpperCase()) {
      		next = next.nextSibling;
    	}
		return next;
	}

}