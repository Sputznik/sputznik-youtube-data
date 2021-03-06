jQuery.fn.sp_wp_video = function() {

	return this.each( function() {

		var $el 		= jQuery( this ),
			video_url = $el.data( 'video' );

    // CREATES DYNAMIC VIDEO MODAL
		$el.on( 'click', function() {
			createModal();
		});

		function getVideoURL(){
			return video_url;
		}

    // VIDEO MODAL LAYOUT
		function createModal() {
			var html = '<div id="sp-ytube-modal">';
			html += '<button class="sp-ytube-modal-close-btn">&times;</button>';
			html += '<div class="sp-ytube-modal-body">';

			html += '<video class="sp-wp-video" controls autoplay><source src="';
			html += getVideoURL();
			html += '" type="video/mp4"></video>';

			html +=	'</div></div>';

      jQuery("body").append( html );

			jQuery( '#sp-ytube-modal .sp-ytube-modal-close-btn' ).click( function( ev ){
				ev.preventDefault();
				jQuery( '#sp-ytube-modal' ).remove();
			});

    }

	});

};

jQuery.fn.sp_vimeo_video = function() {

	return this.each(function() {

		var $el = jQuery(this),
				video_id 	= $el.data( 'video' );

    // CREATES DYNAMIC VIDEO MODAL
		$el.on( 'click', function() {
      createModal();
		});

		function getVimeoURL(){
			var vimeo_params = '?autoplay=1"';
			return 'https://player.vimeo.com/video/' + video_id + vimeo_params;
		}

		// VIDEO MODAL LAYOUT
		function createModal() {
			var html = '<div id="sp-ytube-modal">';
					html += '<button class="sp-ytube-modal-close-btn">&times;</button>';
					html += '<div class="sp-ytube-modal-body">';
					html += '<iframe allow="autoplay" src="'+getVimeoURL();
		      html += 'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
		      html +=	'</div></div>';

      jQuery("body").append( html );

			jQuery( '#sp-ytube-modal .sp-ytube-modal-close-btn' ).click( function( ev ){
				ev.preventDefault();
				jQuery( '#sp-ytube-modal' ).remove();
			});

    }

	}); //End each()

};

jQuery.fn.sp_ytube_video = function() {

	return this.each( function() {

		var $el 		= jQuery( this ),
			video_id 	= $el.data( 'video' );

    // CREATES DYNAMIC VIDEO MODAL
		$el.on( 'click', function() {
			createModal();
		});

		function getYoutubeURL(){
			return "https://www.youtube.com/embed/" + video_id + "?autoplay=1&rel=0";
		}

    // VIDEO MODAL LAYOUT
		function createModal() {
			var html = '<div id="sp-ytube-modal">';
			html += '<button class="sp-ytube-modal-close-btn">&times;</button>';
			html += '<div class="sp-ytube-modal-body">';
			html += '<iframe allow="autoplay" src="';
      html += getYoutubeURL();
      html += '"></iframe>'
      html +=	'</div></div>';

      jQuery("body").append( html );

			jQuery( '#sp-ytube-modal .sp-ytube-modal-close-btn' ).click( function( ev ){
				ev.preventDefault();
				jQuery( '#sp-ytube-modal' ).remove();
			});

    }

	});

};

jQuery.fn.sp_ytube_playlist = function() {

	return this.each( function() {

		var $el 		= jQuery( this ),
			$parent			= $el.closest( '.sp-ytube-playlists-row' ),
			url					= $el.data( 'url' ),
			channelId		= $el.data( 'channel' ),
			title				= $el.data( 'title' ),
			playlist 		= $el.data( 'playlist' );

		// CREATES DYNAMIC VIDEO MODAL
		$el.on( 'click', function() {

			$parent.find( '.sp-inner-section' ).remove();

			createModal();

		} );

		function getData(){

			var $el = $parent.find( '.sp-inner-section .sp-playlist-content' ).hide();

			jQuery.ajax({
				url: url,
				data: {
					action: 'sp_ytube_playlist',
					playlist: playlist
				},
				success: function( data ){
					$el.html( data );
					$el.show( 'slow' );
					$el.find( '[data-behaviour~=sp-ytube-video]' ).sp_ytube_video();
				}
			});

		}

		// VIDEO MODAL LAYOUT
		function createModal() {

			var html = '<div class="sp-inner-section arrow_box">';
			html += '<button class="sp-close-btn">&times;</button>';
			html += '<div class="sp-playlist-title">' + title + '</div>';
			html += '<div class="sp-playlist-content"><center>Loading...</center></div>';
			html +=	'</div>';

      $parent.prepend( html );

			var $innerSection = $parent.find('.sp-inner-section');
			$innerSection.hide();
			$innerSection.show('slow', function(){
				jQuery('html, body').animate({
        	scrollTop: $innerSection.offset().top - 100
    		}, 2000 );

				getData();

			});

			$innerSection.find( '.sp-close-btn' ).each( function(){
				var $close_btn = jQuery( this );
				$close_btn.click( function( ev ){
					ev.preventDefault();
					$innerSection.hide('slow', function(){
						$innerSection.remove();
					});
				} );
			} );
		}

	});

};

jQuery(document).ready(function () {
	jQuery('[data-behaviour~=sp-ytube-video]').sp_ytube_video();
	jQuery('[data-behaviour~=sp-wp-video]').sp_wp_video();
	jQuery('[data-behaviour~=sp-vimeo-video]').sp_vimeo_video();
	jQuery('[data-behaviour~=sp-ytube-playlist]').sp_ytube_playlist();


});
