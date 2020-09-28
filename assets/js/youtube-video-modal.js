jQuery.fn.sp_ytube_video = function() {

	return this.each( function() {

		var $el 		= jQuery( this ),
			video_id 	= $el.data( 'video' );

    // CREATES DYNAMIC VIDEO MODAL
		$el.on( 'click', function() {
			createModal();
		});

		function getYoutubeURL(){
			return "https://www.youtube.com/embed/" + video_id + "?autoplay=1";
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
			url					= $el.data( 'url' ),
			channelId		= $el.data( 'channel' ),
			title				= $el.data( 'title' ),
			playlistId 	= $el.data( 'playlist' );

		// CREATES DYNAMIC VIDEO MODAL
		$el.on( 'click', function() {
			window.location.href = getUrl();
		} );

		function getUrl(){
			var url = window.location.href;
			url = url.split('?')[0];
			url += "?action=playlist&playlistId=" + playlistId + "&channelId=" + channelId + "&title=" + title;
			return url;
		}

	});

};

jQuery(document).ready(function () {
	jQuery('[data-behaviour~=sp-ytube-video]').sp_ytube_video();
	jQuery('[data-behaviour~=sp-ytube-playlist]').sp_ytube_playlist();

	jQuery( '.sp-close-btn' ).each( function(){
		var $close_btn = jQuery( this );

		$close_btn.click( function( ev ){
			ev.preventDefault();

			var section = $close_btn.closest('.sp-inner-section');

			section.hide('slow', function(){
				section.remove();
			});
		} );

	} );
});
