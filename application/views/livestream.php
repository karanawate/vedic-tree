<iframe src="https://player.vimeo.com/video/76979871" width="640" height="360" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>

<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);

    player.on('play', function() {
        console.log('played the video!');
    

    player.getCurrentTime().then(function(seconds) {
        console.log('seconds:', seconds);
    });

    player.getDuration().then(function(duration) {
    	console.log('duration:',duration);
    // duration = the duration of the video in seconds
	}).catch(function(error) {
    // an error occurred
});


	player.getPaused().then(function(paused) {
    // paused = whether or not the player is paused
    console.log('paused:',paused);

}).catch(function(error) {
    // an error occurred
});

});


</script>