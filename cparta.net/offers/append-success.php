<?php
	if($result){	
			//id
		require('/var/www/www-root/data/www/cparta.net/utilities/bootstrap.php');	
		$z = Zakaz::getById($result);
		if($z->stream>0){
			$stream = Stream::getById($z->stream);
			if( $stream->facebook!=''){	
					?>
					<script>
					!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
					n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
					document,'script','//connect.facebook.net/en_US/fbevents.js');

					fbq('init', '<?php echo $stream->facebook;?>');
					fbq('track', 'PageView');
                                        fbq('track', 'Lead');
					fbq('track', 'Purchase', { 
						content_type: 'product',
						content_ids: ['<?php echo $stream->offer_id;?>'],
						value: <?php echo $z->comission;?>,
						currency: 'RUB'
					});
					</script>

					<noscript>
					<img height="1" width="1" border="0" alt="" style="display:none" src="https://www.facebook.com/tr?id=<?php echo $stream->facebook;?>&amp;ev=PageView" />
					<img height="1" width="1" border="0" alt="" style="display:none" src="https://www.facebook.com/tr?id=<?php echo $stream->facebook;?>&amp;ev=Purchase&amp;cd[content_type]=product&amp;cd[content_ids]=<?php echo $stream->offer_id;?>&amp;cd[value]=<?php echo $z->comission;?>&amp;cd[currency]=RUB" />
					</noscript>

					<?
			}
			if( $stream->metrika!=''){	
					?>
					<!-- Yandex.Metrika counter -->
					<script type="text/javascript">
						(function (d, w, c) {
							(w[c] = w[c] || []).push(function() {
								try {
									w.yaCounter<?php echo $stream->metrika; ?> = new Ya.Metrika({
										id:<?php echo $stream->metrika; ?>,
										clickmap:true,
										trackLinks:true,
										accurateTrackBounce:true,
										webvisor:true
									});
								} catch(e) { }
							});

							var n = d.getElementsByTagName("script")[0],
								s = d.createElement("script"),
								f = function () { n.parentNode.insertBefore(s, n); };
							s.type = "text/javascript";
							s.async = true;
							s.src = "https://mc.yandex.ru/metrika/watch.js";

							if (w.opera == "[object Opera]") {
								d.addEventListener("DOMContentLoaded", f, false);
							} else { f(); }
						})(document, window, "yandex_metrika_callbacks");
					</script>
					<noscript><div><img src="https://mc.yandex.ru/watch/<?php echo $stream->metrika; ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
					<!-- /Yandex.Metrika counter -->

					<?
			}
			if( $stream->GoogleAnalytics!=''){	
					?>
				<!-- Global site tag (gtag.js) - Google Analytics -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $stream->GoogleAnalytics; ?>"></script>
				<script>
				  window.dataLayer = window.dataLayer || [];
				  function gtag(){dataLayer.push(arguments);}
				  gtag("js", new Date());

				  gtag("config", "<?php echo $stream->GoogleAnalytics; ?>");
				</script>	

					<?
			}	
			if( $stream->mail !=''){	
					?>
						<!-- Rating@Mail.ru counter --> 
						<script type="text/javascript"> 
						var _tmr = _tmr || []; 
						_tmr.push({id: "<?php echo $stream->mail; ?>", type: "pageView", start: (new Date()).getTime()}); 
						(function (d, w) { 
						var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; 
						ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js"; 
						var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);}; 
						if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } 
						})(document, window); 
						</script>
						<!-- //Rating@Mail.ru counter --> 

					<?
			}
			if( $stream->vk !=''){	
					?>
						<script type='text/javascript'>(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=<?php echo $stream->vk; ?>';</script>

					<?
			}	
			if( $stream->directadvert !=''){	
					?>
						<img src="//code.directadvert.ru/track/<?php echo $stream->directadvert; ?>.gif" width="1" height="1" />

					<?
			}			
		}
	}
?>