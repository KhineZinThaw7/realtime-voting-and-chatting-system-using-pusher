$(document).ready(function() {
    $('#vote').text(voteCount);
    window.Echo.private(`users.${userId}`)
    .listen('UserVotedEvent', (e) => {
        $('#vote').text(e.user.vote++);
    });
});

$('#voting').click(() => {
    let user = $('#user_id').val();
    axios.get(`/vote/${user}`)
    .then(() => {
    })
})

$('#read').click(() => {
    let notiId = $('#noti_id').val();
    axios.get(`/vote-read/${notiId}`)
    .then(() => {
        location.reload();
    })
})
