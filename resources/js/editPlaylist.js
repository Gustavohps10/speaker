const bootstrap = window.bootstrap;

var soundList = [];
var soundCard;

$("li > .delete").on("click", function(){
    let soundId = $(this).attr('id');
    let soundName = $(this).parent("li").parent(".dropdown-menu").parent(".btn-group").siblings(".soundName").text();
    $("#soundNameDeleted").html(soundName);

    soundList.push(soundId);
    soundCard = $(this).closest(".card");
});


$("#deleteSoundModal").on("show.bs.modal", function () {
    soundList = [];
});

$(".confirmDeletion").on("click", function () {
    removeSoundsFromPlaylist(soundList, playlistUrl);
});

var deleteModal = new bootstrap.Modal(document.getElementById('deleteSoundModal'), {
    keyboard: false
})

function removeSoundsFromPlaylist(soundList, playlistUrl) {
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
                toastErrorElement.children[0].children[0].innerText = data.error;
                let toastError = new bootstrap.Toast(toastErrorElement);
                toastError.show();
                return;
            }
            deleteModal.hide();

            let toastSuccessElement = document.querySelector('.toast-success');
            toastSuccessElement.children[0].children[0].innerText = data.success;
            let toastSuccess = new bootstrap.Toast(toastSuccessElement);
            toastSuccess.show();

            soundCard.remove();
        }
    });
}