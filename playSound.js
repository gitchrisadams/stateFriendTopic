<script>
// Play sound file when user enters chat room:
function play_sound() {
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', 'http://statefriendtopic.christopheradams.com/assets/music/newMessage.wav');
    audioElement.setAttribute('autoplay', 'autoplay');
    audioElement.load();
    audioElement.play();
    console.log("Playing play_sound File");
}

// Play sound file when user sends a message:
function play_soundMessage() {
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', 'http://statefriendtopic.christopheradams.com/assets/music/whistle.wav');
    audioElement.setAttribute('autoplay', 'autoplay');
    audioElement.load();
    audioElement.play();
    console.log("Playing play_soundMessage File");
}
</script>