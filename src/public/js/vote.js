$(document).ready(function() {
    $('#vote').text(voteCount);
    $(`#message_count`).text(noti);

    window.Echo.private(`sent-message.${userId}`)
    .listen('MessageSent', (e) => {
        $(`#message_count`).text(e.noti);
        $('#messenger').append(`
        <div class="row mt-2">
        <span class="bg-primary rounded-md text-white" style="width: 30%">${e.message}</span>
        </div>`);
    });
});

$('#read').click(() => {
    let notiId = $('#noti_id').val();
    axios.get(`/message-read/${notiId}`)
    .then(() => {
        location.reload();
    })
})

function postVoting (postId) {
    axios.get(`/post-vote/${postId}`)
    .then((response) => {
        window.Echo.private(`posts.${postId}`)
        .listen('PostVoting', (e) => {
            $(`#post_vote_count_${postId}`).text(e.post.vote);
        });
    })
};

function sentMessage() {
    let receiver = $('#user_id').val();
    data = {
        message : $('#message').val(),
    }

    axios.post(`/sent-message/${receiver}`, data)
    .then( (response) => {
        $('#message').val('');
        $('#messenger').append(`
        <div class="row mt-2">
        <span class="bg-primary rounded-md text-white" style="width: 30%">${data.message}</span>
        </div>`);
    });
}

