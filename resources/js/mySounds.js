const bootstrap = window.bootstrap;

var soundList = [];
$("li > .delete").on("click", function(){
    let soundId = $(this).attr('id');
    let soundName = $(this).parent("li").parent(".dropdown-menu").parent(".btn-group").siblings(".soundName").text();
    let action = $(this).data("action")
    $("#soundNameDeleted").html(soundName);
    $("#formDeleteSound").attr("action", action)
});

$("#playlistsModal").on("show.bs.modal", function () {
    soundList = [];
});

$("#playlistsModal").on("hidden.bs.modal", function () {
    let playlists = $("#playlistsModal input[data-action]");
    $.map(playlists, function(playlist) {
        playlist.checked = false;
    });
});

$(".addToPlaylist").on("click", function () {
    let soundCard = $(this).parent("li").parent(".dropdown-menu").parent(".btn-group").parent(".card-body").parent(".card");
    let soundId = soundCard.attr('id');
    if(soundList.indexOf(soundId) === -1){
        soundList.push(soundId);
    }
});

$("#playlistsModal .save").on("click", function () {
    let playlists = $("#playlistsModal input[data-action]");
    $.map(playlists, function(playlist) {
        if(playlist.checked){
            addSoundsToPlaylist(soundList, playlist.getAttribute("data-action"));
        }
    });
});

var playlistsModal = new bootstrap.Modal(document.getElementById('playlistsModal'), {
    keyboard: false
})

function addSoundsToPlaylist(soundList, playlistUrl) {
    $.ajax({
        url: playlistUrl,
        type: "POST",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            soundList: soundList
        },
        success(data){
            if(data.error){
                let toastErrorElement = document.querySelector('.toast-error');
                toastErrorElement.children[0].children[0].innerText = data.error.msg;
                let toastError = new bootstrap.Toast(toastErrorElement);
                toastError.show();
                return;
            }
            playlistsModal.hide();

            let toastSuccessElement = document.querySelector('.toast-success');
            toastSuccessElement.children[0].children[0].innerText = data.success;
            let toastSuccess = new bootstrap.Toast(toastSuccessElement);
            toastSuccess.show();
        }
    });
}