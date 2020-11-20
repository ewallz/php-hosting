jQuery(document).ready(function($) {	
	if ($(window).width() < 1024) {	

		//wrap div for all tables
			$('#rp_presentation, .dc-header-container table, .short-compare').wrap('<div class=\"wrapper\">');
			$('.wrapper').before('<h3 class="swipe">Swipe left/right to see plans</h3>');

		//only for tables in domain pages
			$(".domain-panes").each(function(){
			        $('#domain-tables').before('<h3 class="swipe">Swipe left/right to see all columns</h3>');
			});

			$(".long-domain-table").first().each(function(){
			        $('.long-domain-table').first().before('<h3 class="swipe">Swipe left/right to see all columns</h3>');
			});

			$("#compare_overlay_tld_details").each(function(){
			        $('#compare_overlay_tld_details table').wrap('<div class=\"wrapper\">');
			        $('.wrapper').first().before('<h3 class="swipe">Swipe left/right to see all columns</h3>');
			});
			$("#compare_overlay_tld_only").each(function(){
			        $('#compare_overlay_tld_only table').wrap('<div class=\"wrapper\">');
			        $('.wrapper').first().before('<h3 class="swipe">Swipe left/right to see all columns</h3>');
			});

			$(".long-domain-table .rp-tld-info, .long-domain-table .rp-tld-price").each(function(){
			        var $table = $(this);
			        var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');

			        $fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();

			        $fixedColumn.find('tr').each(function (i, elem) {
			                $(this).height($table.find('tr:eq(' + i + ')').height());
			        });
			});

		//compare tables
		$('#compare_overlay').each(function(){
			if ( $( "table#rp_presentation" ).length ) {
				$("#compare_overlay").wrapInner( "<div class=' content_modal'></div>");
			}

			if ( $( ".openvz-plan-even" ).length ) {
				$("#compare_overlay").wrapInner( "<div class='content_vps_openvz'></div>");
			}
		});
		
		$('#content > div[class*=" content_"] .wrapper, .content_modal .wrapper').each(function (){
			$(this).find('table').addClass('table');
			$(this).find('tbody').addClass('tbody');
			$(this).find('tr').addClass('tr');
			$(this).find('td').addClass('td');
        	});

		$('#content > div[class*=" content_"] .wrapper').each(function(){
			var getRow = $("table#rp_presentation").find('tr');
			if (typeof getRow == 'undefined')
				return;

			var numCols = getRow[0].cells.length;	
			if(numCols == 7){
				$('div[class*=" content_"] .wrapper table').addClass('six-plans');					
			}else if(numCols == 6){
				$('div[class*=" content_"] .wrapper table').addClass('five-plans');
			}else if(numCols == 5){
				$('div[class*=" content_"] .wrapper table').addClass('four-plans');	
			}else if(numCols == 4){
				$('div[class*=" content_"] .wrapper table').addClass('three-plans');
			}else if(numCols == 3){
				$('div[class*=" content_"] .wrapper table').addClass('two-plans');
			}else if(numCols == 2){
				$('div[class*=" content_"] .wrapper table').addClass('one-plan');
			}
		});	
		$('.content_modal .wrapper').each(function(){
			var getRow = $("table#rp_presentation").find('tr');
			if (typeof getRow == 'undefined')
				return;

			var numCols = getRow[0].cells.length;	
			if(numCols == 6){
				$('.content_modal .wrapper table').addClass('six-col');
			}else if(numCols == 5){
				$('.content_modal .wrapper table').addClass('five-col');	
			}else if(numCols == 4){
				$('.content_modal .wrapper table').addClass('four-col');
			}else if(numCols == 3){
				$('.content_modal .wrapper table').addClass('three-col');
			}else if(numCols == 2){
				$('.content_modal .wrapper table').addClass('two-col');
			}else if(numCols == 1){
				$('.content_modal .wrapper table').addClass('one-col');
			}
		});

		$('.article2-links-area').each(function(){
			$('.article2-links-area').before('<div class="menu-links"><span class="menu-link-icon"></span> Links</div>');
			
			$('.menu-links').on('click', function() {
				$('.article2-links-area').slideToggle('slow');
			});
		});
	}
})
