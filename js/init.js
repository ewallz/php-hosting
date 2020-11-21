jQuery(document).ready(function($) {
	$(function(){
		$('.rpwp-tabs-header').click(function(e){e.preventDefault();
			$('.rpwp-tabs-header,.rpwp-tabs-content').removeClass('on');
			$('.rpwp-tabs-headers').removeClass('on1 on2 on3').addClass('on'+$(this).attr('data-cnt'))
			$('.rpwp-tabs-header[data-cnt="'+$(this).attr('data-cnt')+'"], .rpwp-tabs-content[data-cnt="'+$(this).attr('data-cnt')+'"]').addClass('on');
			// Slide the content of the content 
		})

		$('.pr_rp_desc_info_test').hide()
		$('a.pr_rp_desc_info').hover(function(){$(this).parent().find('.pr_rp_desc_info_test').show();}, function(){$(this).parent().find('.pr_rp_desc_info_test').hide();});
				
		$('#rpwp-login-form').submit(function(e){
			$('.rpwp-login-form-input').each(function(){
				if($(this).val() == '')
					$(this).addClass('error')
				else $(this).removeClass('error')
			})
			if($('.rpwp-login-form-input.error').size() != 0){
				e.preventDefault()
				alert('Please fill all of the fields')
			}
		})
		
		$("div[id^=fvideo]").each(function() {
			$(this).html( '<video width="640" controls style="max-width:100%">' +
				'<source src="' + $(this).attr('data-video-src') + '" type="video/mp4"></source>' +
				'</video>');
			$(this).attr('data-video-src','');
		});
		
		$('div.personal-feedback').quovolver();
		
		// Expand / Collapse
		$('a[rel=expand]').click(function() {
			$('#vps_features_short_'+$(this).attr('plan_id')).hide();
			$('#vps_features_long_'+$(this).attr('plan_id')).show('blind', {}, 500);
			$(this).hide();
			$('[rel=collapse][plan_id='+$(this).attr('plan_id')+']').show();
			return false;
		});
		$('a[rel=collapse]').click(function() {
			$('#vps_features_short_'+$(this).attr('plan_id')).show();
			$('#vps_features_long_'+$(this).attr('plan_id')).hide();
			$(this).hide();
			$('[rel=expand][plan_id='+$(this).attr('plan_id')+']').show();
			return false;
		});
		$('a[rel=expand_all]').click(function() {
			$('a[rel=expand]').each(function() { 
				$(this).click();
			});
			$(this).hide();
			$('[rel=collapse_all]').show();
			return false;
		});
		$('a[rel=collapse_all]').click(function() {
			$('a[rel=collapse]').each(function() { 
				$(this).click();
			});
			$(this).hide();
			$('[rel=expand_all]').show();
			return false;
		});
		
		$(".inline_compare").colorbox({inline:true, width:"90%", height:"90%"});
		$(".inline_video").colorbox({
			inline:true,
			width:"710px",
			height:"450px",
			className:"video-modal",
			onOpen:function(){ $("div[data-vid]").html('<video src="'+$('div[data-vid]').attr('data-video-src')+'" height="360px" width="640px" style="max-width:100%" controls autoplay>') },
			onClosed:function(){$('video').trigger('pause');},
		});

		if (typeof checkforstock != 'undefined' && checkforstock) {
			$.post('stockcheck.php', {}, function(data) {
				if (data.status) {
					$.each(data.stocks, function(k,v) {
						$('.checkstock[data-id="' + v['rp_product_id'] + '"]').hide();

						if (v['stock'] != '0')
						$('.instock[data-id="' + v['rp_product_id'] + '"]').show();
						else
						$('.outofstock[data-id="' + v['rp_product_id'] + '"]').show();
					});

					$('.checkstock:visible').html('Not available');
				} else {
					$('.checkstock:visible').html('Not available');
				}
			}, 'json');
		}
	})

	$('.dediperiod').on('change', function() {
		var group = $(this).attr('data-grp');
		var period = $(this).val();
	
		$('.dedicated-plan-price.' + group).each(function(){
			var period_price = $(this).attr('data-price-' + period);
	
			if (period != '1') {
				$(this).find('.price').html(period_price + '<small>/mo</small>');
				$(this).find('.old-price').hide();
				$(this).parent().find('.discount').hide();
			} else {
				$(this).find('.price').html(period_price + '<small>/mo</small>');
				$(this).find('.old-price').show().find('.old-price strong').html($(this).data('price-'+period+'-old'));
				$(this).parent().find('.discount').show();
			}
		});
	
		$('.period_' + group).attr('value', period);
	});
	
});