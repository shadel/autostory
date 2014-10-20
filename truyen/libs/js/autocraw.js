(function() {
	
	var tool = 'http://truyen.com/crawl/';
	
	function fixTarget(tar){
		tar = tar || '';
		tar = tar.replace("http://", '');
		return tar;
	};
	
	function getAllStory(link){
		var story_list = [];
		
		    
		$.post(tool, {url: fixTarget(link)},  function(data){
				// ----------------- < data >
                // clearing CDATA
                data=data.replace(/\<\!\[CDATA\[\/\/\>\<\!\-\-/gi,'');
                data=data.replace(/\/\/\-\-\>\<\!\]\]\>/gi,'');

                // extracting the the head and body tags
                var dataBody = data.match(/<\s*body.*>[\s\S]*<\s*\/body\s*>/ig).join("");


                dataBody  = dataBody.replace(/<\s*body/gi,"<div");
                dataBody  = dataBody.replace(/<\s*\/body/gi,"</div");

                // head - body - title content
                var $dataBody    = $(dataBody);
                $dataBody.find('#kiemhiep li').each(function(inx, value){
                	var category = $(value).find('.story').text();
                	var storyname = $(value).find('.story2').text();
                	var storyUrl = $(value).find('.story2').attr('href');
                	
                	var li = $('<li class="list-group-item">');
                	li.append($('<div class="media-body">' + category + ' - ' + storyname + '</div>'));
                	$('.list-group').append(li);
                	
                	story_list.push({
                		category: category,
                		story: storyname,
                		url: storyUrl
                	});
                });
                
                var next = $dataBody.find('.next a');
                if(next.length){
                	next = next.attr('href');
                } else {
                	next = '';
                }
                
                $.post('http://truyen.com/crawl/set_story',
                		{data: story_list}
                , function(){
                	if(next){
                		getAllStory(next);
                	} else {
                		
                	}
                });
		});
	}
	
	this.getAllStory = getAllStory;
	
	
	function createStory(link, storyUrl){
		$.ajax({
			url: tool,
			method: 'POST',
			data: {url: fixTarget(link)},
//			async: false,
			success: function(data){
				// ----------------- < data >
	            // clearing CDATA
	            data=data.replace(/\<\!\[CDATA\[\/\/\>\<\!\-\-/gi,'');
	            data=data.replace(/\/\/\-\-\>\<\!\]\]\>/gi,'');

	            // extracting the the head and body tags
	            var dataBody = data.match(/<\s*body.*>[\s\S]*<\s*\/body\s*>/ig).join("");


	            dataBody  = dataBody.replace(/<\s*body/gi,"<div");
	            dataBody  = dataBody.replace(/<\s*\/body/gi,"</div");

	            // head - body - title content
	            var $dataBody    = $(dataBody);
	            
	            var desc = $dataBody.find('#truyen_tranh_chi_tiet .desc').html();
	            var chapter_list = [];
	            $dataBody.find('.danh_sach a').each(function(inx, value){
	            	var url = $(value).attr('href');
	            	var name = $(value).text();
	            	
	            	chapter_list.push({
	            		name: name,
	            		url: url, 
	            		storyUrl: storyUrl
	            	});
	            });
	            var img = $dataBody.find('.image img').attr('src');
	            var author = $dataBody.find('.truyen_info .author:first a').text();
	            var status = $dataBody.find('.truyen_info .author:last a').text();
	            
	            var next = $dataBody.find('.next a');
	            if(next.length){
	            	next = next.attr('href');
	            } else {
	            	next = '';
	            }
	            
	            console.log(link);
	            $.ajax({
	    			url: 'http://truyen.com/crawl/create_story',
	    			method: 'POST',
	    			data: {data: chapter_list, desc: desc, url: link, next: next, img: img, author: author, status: status},
//	    			async: false,
	    			success:  function(){
	    				createChapters(chapter_list);
	    				
		            	if(next){
		            		createStory(next, storyUrl);
		            	} else {
		            		$(window).trigger('crawled', storyUrl);
		            	}
		            }});
			}
		});
	}
	
	this.createStory = createStory;
	
	var createChapters = this.createChapters = function(chapterList){
		$.each(chapterList, function(idx, value){
			createChapter(value);
		});
	};
	
	var createChapter = this.createChapter = function(chapter){
		$.ajax({
			url: tool,
			method: 'POST',
			data: {url: fixTarget(chapter.url)},
//			async: false,
			success: function(data){
				// ----------------- < data >
	            // clearing CDATA
	            data=data.replace(/\<\!\[CDATA\[\/\/\>\<\!\-\-/gi,'');
	            data=data.replace(/\/\/\-\-\>\<\!\]\]\>/gi,'');

	            // extracting the the head and body tags
	            var dataBody = data.match(/<\s*body.*>[\s\S]*<\s*\/body\s*>/ig).join("");


	            dataBody  = dataBody.replace(/<\s*body/gi,"<div");
	            dataBody  = dataBody.replace(/<\s*\/body/gi,"</div");

	            // head - body - title content
	            var $dataBody    = $(dataBody);
	            
	            $dataBody.find('#content .chi_tiet div:first').remove();
	            var content = $dataBody.find('#content .chi_tiet').html();
	            
	            var namelist = chapter.name.split('--');
	            var no = namelist[1];
	            console.log(no, chapter.name);
	            $.ajax({
	    			url: 'http://truyen.com/crawl/create_chapter',
	    			method: 'POST',
	    			data: {content: content,  url: chapter.url, no: no},
//	    			async: false,
	    			success:  function(){
//		            	$.trigger('crawledChapter', chapter);
		            }});
			}
		});
	};
}).call(this);