let page_url = document.getElementById("page_url").textContent;
let url = '';
let server_url = document.getElementById("server_url").textContent;

let isRequesting = false; // Флаг, чтобы избежать нескольких запросов
window.addEventListener('scroll', function () {  // Код срабатывает при достижении низа страницы
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight && !isRequesting) {
        isRequesting = true;
        fetch(url)
            .then(response => response.json())
            .then(received => {
                url = received.next_page_url;
                posts_loading(received.data);
            })
            .catch(error => {
                console.error('Ошибка:', error);
            })
            .finally(() => {
                isRequesting = false;
            });
    }
});

document.addEventListener('DOMContentLoaded', function () {  // код срабатывает 1 раз при загрузке страницы
    fetch(page_url)
        .then(response => response.json())
        .then(received => {
            url = received.next_page_url;
            console.log(received);
            posts_loading(received.data);
        });
});
// ===================================================================================================
function posts_loading(data) {

    let posts = document.getElementById('posts');
    let post = document.getElementById('post');

    data.forEach(function (item, i, enu) {   // перебираем посты
        let clone_post = post.cloneNode(true);

        clone_post.querySelector('#i_clock').textContent = ' ' + item['time'];
        clone_post.querySelector('#a_channel').href = server_url + '/channel/' + item['id_user'];
        clone_post.querySelector('#a_channel').textContent = item['user_name'];
        clone_post.querySelector('#h_name_post').textContent = item['name_post'];
        clone_post.querySelector('#a_url_post').href = server_url + '/post/' + item['id'];
        clone_post.querySelector('#i_repost_post').href = server_url + '/post/' + item['id'];
        clone_post.querySelector('#img_url1').src = server_url + '/' + item['url_foto'];

        if(item['url_foto_2'] == null){
             clone_post.querySelector('#foto1').className = 'col-lg-12';
             clone_post.querySelector('#foto').remove(); 
        }
       else{
        clone_post.querySelector('#img_url4').src = server_url + '/' + item['url_foto_2'];
        if(item['url_foto_3'] != null){
        clone_post.querySelector('#img_url5').removeAttribute('hidden');   
        clone_post.querySelector('#img_url5').src = server_url + '/' + item['url_foto_3'];
       }}
        clone_post.querySelector('#span_text_post').textContent = item['text_post'];
       if(item['text_post_end'] != '') clone_post.querySelector('#div_text_post_end').textContent = '...' + item['text_post_end'];
        clone_post.querySelector('#a_collapse_post').setAttribute('data-bs-target', '#collapseExample' + item['id']);
        clone_post.querySelector('#a_collapse_post').textContent = item['text_post_link'];
        clone_post.querySelector('#div_collapse_post').id = 'collapseExample' + item['id'];
        if (item['url_foto_2'] != null) {
            clone_post.querySelector('#div_hidden_post').removeAttribute('hidden');
            clone_post.querySelector('#img_url2').src = server_url + '/' + item['url_foto_2'];
            clone_post.querySelector('#p_text_post_2').textContent = item['text_post_2'];
        }
        if (item['url_foto_3'] != null) {
            clone_post.querySelector('#div_hidden_post2').removeAttribute('hidden');
            clone_post.querySelector('#img_url3').src = server_url + '/' + item['url_foto_3'];
            clone_post.querySelector('#p_text_post_3').textContent = item['text_post_3'];
        }
        if (item['url_foto_4'] != null) {
            clone_post.querySelector('#div_hidden_post3').removeAttribute('hidden');
            clone_post.querySelector('#img_url8').src = server_url + '/' + item['url_foto_4'];
            clone_post.querySelector('#p_text_post_4').textContent = item['text_post_4'];
        }
        if (item['url_foto_5'] != null) {
            clone_post.querySelector('#div_hidden_post4').removeAttribute('hidden');
            clone_post.querySelector('#img_url9').src = server_url + '/' + item['url_foto_5'];
            clone_post.querySelector('#p_text_post_5').textContent = item['text_post_5'];
        }
        // clone_post.querySelector('#a_collapse_post_end').setAttribute('data-bs-target', '#collapseExample' + item['id']);
        clone_post.querySelector('#like_post').textContent = ' ' + item['post_like_count'];
        clone_post.querySelector('#like_post').setAttribute('post_id', item['id']);
        if (item['post_like_active']) clone_post.querySelector('#like_post').className = "bi bi-hand-thumbs-up-fill ps-1";
        clone_post.querySelector('#a_collapse_repost').setAttribute('data-bs-target', '#collapse' + item['id']);
        clone_post.querySelector('#div_repost').id = 'collapse' + item['id'];
        clone_post.querySelector('#i_repost_post').textContent = ' ' + item['id'];
        clone_post.querySelector('#a_post_url').setAttribute('post_url', server_url + '/post/' + item['id']);
        clone_post.querySelector('#i_repost_telegram').href = 'https://telegram.me/share/url?url=' + server_url + '/post/' + item['id'];
        clone_post.querySelector('#i_repost_whatsap').href = 'whatsapp://send?text=' + server_url + '/post/' + item['id'];
        clone_post.querySelector('#a_collapse_comment').setAttribute('data-bs-target', '#collapseComment' + item['id']);
        clone_post.querySelector('#i_comment_count').textContent = item['post_comment_count'];
        clone_post.querySelector('#i_comment_count').id = 'comm_count' + item['id'];
        clone_post.querySelector('#div_comment').id = 'collapseComment' + item['id'];
        clone_post.querySelector('#form').setAttribute('post_id', item['id']);
        clone_post.querySelector('#text_div_post').id = 'text_div_post' + item['id'];
        clone_post.querySelector('#i_smile_collapse').setAttribute("href", "#collapse_post_smile" + item['id']);
        var smile = clone_post.querySelector('#div_smile').querySelectorAll('span');
        smile.forEach(function (item2, i, enu) {  // перебираем смайлики
            item2.setAttribute('post_id', item['id']);
        });
        clone_post.querySelector('#div_smile').id = 'collapse_post_smile' + item['id'];
        clone_post.querySelector('#comm').id = 'comm' + item['id'];
        clone_post.querySelector('#a_collapse_comment_end').setAttribute('data-bs-target', '#collapseComment' + item['id']);
        clone_post.querySelector('#button_complaint').setAttribute('onclick', 'complaint('+item['id']+','+item['id_user']+','+item['id']+',1)'); // заполняем кнопку жалобы
        clone_post.id = 'one_post';
        posts.appendChild(clone_post);
        comments_loading(item.comment_plus, item['id'], item['id_user']);  // вставляем комментарии
        clone_post = null;
    });
}
// =================================================================================================
function comments_loading(data, post_id, id_user) {
    let comm = document.getElementById('comm' + post_id);
    let test_comment = document.getElementById('test_comment');

    data.forEach(function (item3, i, enu) {   // перебираем комметарии
        let clone_comment = test_comment.cloneNode(true);
        
      
        clone_comment.querySelector('#a_post_name_user').textContent =  ' ' + item3['user_name'];
        clone_comment.querySelector('#a_post_name_user').href = server_url + '/channel/' + item3['user_id'];
        clone_comment.querySelector('nobr').textContent = item3['time'];
        clone_comment.querySelector('#comment_text').textContent = item3['comment'];
        clone_comment.querySelector('#comment_text').id = "comment_text" + item3['id'];
        if (item3['comment_like_active']) clone_comment.querySelector('#like_comment').className = "bi bi-hand-thumbs-up-fill ps-1";
        if (item3['comment_dislike_active']) clone_comment.querySelector('#dislike_comment').className = "bi bi-hand-thumbs-down-fill";
        if (item3['comment_made_user']) clone_comment.querySelector('#a_comment_edit').removeAttribute('hidden');
        clone_comment.querySelector('#i_collapse_smile').setAttribute('href', "#collapse_comment_edit_smile" + item3['id']);
        var comment_edit_smile = clone_comment.querySelectorAll('span');
        comment_edit_smile.forEach(function (smile, i, enu) {  // перебираем смайлики
            smile.setAttribute('comment_id', item3['id']);
        });
        clone_comment.querySelector('#div_comment_edit_smile').id = "collapse_comment_edit_smile" + item3['id'];
        clone_comment.querySelector('#i_collapse_comment_smile_reply').setAttribute('href', "#collapse_comment_smile" + item3['id']);
        clone_comment.querySelector('#collapse_comment_smile').id = "collapse_comment_smile" + item3['id'];
        clone_comment.querySelector('#a_comment_edit').setAttribute('href', "#coment_collapse" + item3['id']);
        clone_comment.querySelector('#coment_reply_collapse').href = "#coment_reply_collapse" + item3['id'];
        clone_comment.querySelector('#coment_reply_collapse_hidden').id = "coment_reply_collapse" + item3['id'];
        clone_comment.querySelector('#form_reply_comment').setAttribute('coment_id', item3['id']);
        clone_comment.querySelector('#form_reply_comment').setAttribute('post_id', post_id);
        clone_comment.querySelector('#text_div_comment').textContent = item3['user_name'] + " ";
        clone_comment.querySelector('#text_div_comment').id = 'text_div_comment' + item3['id'];
        clone_comment.querySelector('#coment_collapse').id = "coment_collapse" + item3['id'];
        clone_comment.querySelector('#form_coment').setAttribute('coment_id', item3['id']);
        clone_comment.querySelector('#text_div_comment_edit').textContent = item3['comment'];
        clone_comment.querySelector('#text_div_comment_edit').id = 'text_div_comment_edit' + item3['id'];
        clone_comment.querySelector('#form_coment_del').setAttribute('coment_id', item3['id']);
        clone_comment.querySelector('#form_coment_del').setAttribute('post_id', post_id);
        // clone_comment.querySelector('#input3').value = item3['id'];
        clone_comment.querySelector('#like_comment').setAttribute('comment_id', item3['id']);
        clone_comment.querySelector('#like_comment').textContent = ' ' + item3['comment_like_count'];
        clone_comment.querySelector('#dislike_comment').setAttribute('comment_id', item3['id']);
        clone_comment.querySelector('#dislike_comment').textContent = ' ' + item3['comment_dislike_count'];
        clone_comment.querySelector('#reply').id = "reply" + item3['id'];
        clone_comment.querySelector('#button_complaint').setAttribute('onclick', 'complaint('+post_id+','+item3['user_id']+','+item3['id']+',2)'); // заполняем кнопку жалобы
        clone_comment.id = 'one_comment' + item3['id'];
        

        comm.appendChild(clone_comment);
        // comm.id = 'one_commentddd';
        replys_loading(item3.reply_comment_plus, item3['id'], post_id, id_user);  // вставляем ответы
        clone_comment = null;
    });
};
// =====================================================================================================================
function replys_loading(data, id_comment, post_id, id_user) {
    let reply = document.getElementById('reply' + id_comment);
    let replu_hidden = document.getElementById('replu_hidden');

    data.forEach(function (item4, i, enu) {   // перебираем ответы
        let clone_reply = replu_hidden.cloneNode(true);

        clone_reply.querySelector('#a_reply_name_user').textContent =  ' ' + item4['user_name'];
        clone_reply.querySelector('#a_reply_name_user').href = server_url + '/channel/' + item4['user_id'];
        clone_reply.querySelector('nobr').textContent = item4['time'];
        clone_reply.querySelector('#reply_text').textContent = item4['reply'];
        if (item4['reply_like_active']) clone_reply.querySelector('#like_reply').className = "bi bi-hand-thumbs-up-fill ps-1";
        if (item4['reply_dislike_active']) clone_reply.querySelector('#dislike_reply').className = "bi bi-hand-thumbs-down-fill";
        if (item4['reply_made_user']) clone_reply.querySelector('#hidden_reply_collapse_edit').removeAttribute('hidden');
        clone_reply.querySelector('#i_reply_reply_collapse_smile').setAttribute('href', "#collapse_reply_smile" + item4['id'])
        clone_reply.querySelector('#collapse_reply_smile').id = "collapse_reply_smile" + item4['id'];
        clone_reply.querySelector('#i_reply_edit_collapse_smile').setAttribute('href', "#collapse_reply_edit_smile" + item4['id']);
        clone_reply.querySelector('#collapse_reply_edit_smile').id = "collapse_reply_edit_smile" + item4['id'];
        clone_reply.querySelector('#form_reply_reply').setAttribute('coment_id', item4['comment_id']);
        clone_reply.querySelector('#form_reply_reply').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#form_reply_reply').setAttribute('post_id', post_id);
        clone_reply.querySelector('#form_reply_edit').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#reply_text').id = "reply_text" + item4['id'];
        clone_reply.querySelector('#hidden_reply_collapse_edit').href = "#reply_collapse_edit" + item4['id'];
        clone_reply.querySelector('#reply_collapse_edit').id = "reply_collapse_edit" + item4['id'];
        clone_reply.querySelector('#input_name_opponent').value = item4['user_name'];
        clone_reply.querySelector('#like_reply').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#like_reply').textContent = ' ' + item4['reply_like_count'];
        clone_reply.querySelector('#dislike_reply').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#dislike_reply').textContent = ' ' + item4['reply_dislike_count'];
        var reply_smile = clone_reply.querySelectorAll('span');
        reply_smile.forEach(function (smile, i, enu) {  // перебираем смайлики
            smile.setAttribute('reply_id', item4['id']);
        });
        clone_reply.querySelector('#text_div_reply').textContent = item4['user_name'] + ' ';
        clone_reply.querySelector('#text_div_reply').id = "text_div_reply" + item4['id'];
        clone_reply.querySelector('#text_div_reply_edit').textContent = item4['reply'];
        clone_reply.querySelector('#text_div_reply_edit').id = "text_div_reply_edit" + item4['id'];
        clone_reply.querySelector('#hidden_reply_collapse').href = "#reply_collapse" + item4['id'];
        clone_reply.querySelector('#reply_collapse').id = "reply_collapse" + item4['id'];
        clone_reply.querySelector('#form_reply_del').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#form_reply_del').setAttribute('post_id', post_id);
        clone_reply.querySelector('#button_complaint').setAttribute('onclick', 'complaint('+post_id+','+item4['user_id']+','+item4['id']+',3)'); // заполняем кнопку жалобы
        clone_reply.id = 'one_reply' + item4['id'];

        reply.appendChild(clone_reply);
        clone_reply = null;
    });
};

