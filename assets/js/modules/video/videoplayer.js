/**
* Api : http://gdata.youtube.com/feeds/api/videos/VIDEO_ID
* APi : IFRAME : https://developers.google.com/youtube/iframe_api_reference
*
*/

    // 1. First ID player

    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


    
    $(".linkPlayer").click(function(event){
        event.preventDefault();
        /*image = $(this).children().children().find('img');
        image.remove();*/

        // play video API
        $('#player').removeClass('hide')
        console.log('player',player)
        if (typeof player == 'undefined') {
            console.log("UNDEFINED")

        } else {
            player.playVideo();
            player.setLoop(true);
            $(this).removeClass('zoomer');

            console.log('player.getDuration', player.getDuration())
            console.log('player.getCurrentTime()', player.getCurrentTime())
            
        }        
    });


    // api youtube
      var player;
      function onYouTubeIframeAPIReady() {
        
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: getIdVideo(),//'M7lc1UVf-VE',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange,
            'onError' : onReportError,
            'onPlaybackQualityChange': onQuality,
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
        event.target.pauseVideo();
      }

      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          //setTimeout(stopVideo, 6000);
          done = true;
          console.log("??",done);
        }else if(event.data == YT.PlayerState.ENDED) {
            console.log("EL FINAL__, TERMINO DE VER EL VIDEO");
            console.log("VIDEO VISTO X COMPLETOO");
            $('#myModal').modal({backdrop: true,show: true});

        }else if(event.data == YT.PlayerState.PLAYING) {
            console.log('en : PLAYING')
        }else if(event.data == YT.PlayerState.PAUSED) {
            console.log('en : PAUSED');
        }else if(event.data == YT.PlayerState.BUFFERING) {            
            console.log('en : BUFFERING')
        }else if(event.data == YT.PlayerState.CUED) {
            console.log('en : CUED')
        }

      }

    function onReportError() {
        if (event.data == 2) {
            alert("Error url of video, please report!");
        } else if (event.data == 5) {  
        
        } else if (event.data == 100) {
            alert("Video eliminado please you report!"); 
        }

    } 

    function onQuality() {
        if (event.data == 'small') {
            console.log('en : PAUSED')
        } else if (event.data == 'medium') {
        console.log('en quality : medium')
        } else if (event.data == 'large') {
        console.log('en quality : large')
        } else if (event.data == 'hd720') {            
        console.log('en quality : hd720')
        } else if (event.data == 'hd1080') {
        console.log('en quality : hd1080')
        } else if (event.data == 'highres') {  
        console.log('en quality : highres')

        }
        console.log("llego", event.data);
        console.log("ENVIAR DATA AL PERFIL DEL USUARIO")
        console.log("PROXIMA REPRODUCCION SE DEFINE CALIDAD")
        // player.getPlaybackQuality() // RECUPERA  CALIDAD DEL VIDEO..

        //PARA CARGAR VIA AJAX js 
        // player.destroy();
    }

    /*** helpers ***/

    function getIdVideo() {
        return $('.linkPlayer').attr('dataYoutubeId'); //'KvPEejWTmD8';
    }
  
    /*function getVideoYoutube(idVideo){
        var contenHtml = '<iframe width="100%" height="100%" ';
        contenHtml = contenHtml + 'src="//www.youtube.com/embed/'+ idVideo +'?autoplay=1" ';
        contenHtml += 'frameborder="0" ';
        contenHtml += 'webkitallowfullscreen mozallowfullscreen allowfullscreen> ';
        contenHtml += '</iframe> ';
        return contenHtml;
    }*/
