// setTimeout(function () {


fetch('/api/')
.then(response => response.json())
.then(commits => {

    console.log(commits);
        func(commits.data);
});


function func(data) {
    
    let posts = document.getElementById('posts');
    let wrapper = document.getElementById('wrapper');


    data.forEach(function(item, i, enu) {   // перебираем посты

    let clone = wrapper.cloneNode(true);

    clone.querySelector('#i_clock').textContent = item['created_at'];
    clone.querySelector('#a_channel').href = "http://localhost:3000/channel/" + item['id_user'];
    clone.querySelector('#i_human').textContent = item['user_name'];
    clone.querySelector('#h_name_post').textContent = item['name_post'];
    clone.querySelector('#img_url1').src = item['url_foto'];
    clone.querySelector('#span_text_post').textContent = item['text_post'];
    clone.querySelector('#a_collapse_post').setAttribute('data-bs-target', '#collapseExample' + item['id']);
    clone.querySelector('#div_collapse_post').id = 'collapseExample' + item['id'];
    if (item['url_foto_2'] != null){  
        clone.querySelector('#div_hidden_post').removeAttribute('hidden'); 
        clone.querySelector('#img_url2').src = item['url_foto_2'];
        clone.querySelector('#p_text_post_2').textContent = item['text_post_2'];
    }
    if (item['url_foto_3'] != null){  
        clone.querySelector('#div_hidden_post2').removeAttribute('hidden'); 
        clone.querySelector('#img_url3').src = item['url_foto_3'];
        clone.querySelector('#p_text_post_3').textContent = item['text_post_3'];
    }
    clone.querySelector('#a_collapse_post_end').setAttribute('data-bs-target', '#collapseExample' + item['id']);
    clone.querySelector('#like_post').textContent = "post_like_count";
    clone.querySelector('#like_post').setAttribute('post_id', item['id']);
    // if (item['post_like_active'] == true){clone.querySelector('#like_post').className = "bi bi-hand-thumbs-up-fill";}
    clone.querySelector('#a_collapse_repost').setAttribute('data-bs-target', '#collapse' + item['id']);
    clone.querySelector('#div_repost').id = 'collapse' + item['id'];
    clone.querySelector('#i_repost_post').textContent = " Пост " + item['id'];
    clone.querySelector('#a_collapse_comment').setAttribute('data-bs-target', '#collapseComment' + item['id']);
    clone.querySelector('#div_comment').id = 'collapseComment' + item['id'];
    clone.querySelector('#form').setAttribute('post_id', item['id']);
    clone.querySelector('#text_div_post').id = 'text_div_post' + item['id'];
    clone.querySelector('#i_smile_collapse').setAttribute("href", "#collapse_post_smile" + item['id']);
    var smile = clone.querySelector('#div_smile').querySelectorAll('span');
    smile.forEach(function (item2, i, enu) {  // перебираем смайлики
                                item2.setAttribute('post_id', item['id']);
                            });
    clone.querySelector('#div_smile').id = 'collapse_post_smile' + item['id'];

    
   
    clone.querySelector('#a_collapse_comment_end').setAttribute('data-bs-target', '#collapseComment' + item['id']);
    clone.id = 'one_post';
    posts.appendChild(clone);
    console.log(item.comment_plus);
    comments(item.comment_plus);  // вставляем комментарии
    
    clone = null;
   });
   
}

function comments(data) {
    let comm = document.getElementById('comm');
    let test_comment = document.getElementById('test_comment');

    
        data.forEach(function(item3, i, enu) {   // перебираем комметарии
    let clone_comment = test_comment.cloneNode(true);
    
    clone_comment.querySelector('b').textContent = item3['user_name'] +  item3['post_id'];
    // console.log(clone_comment.querySelector('#comment_text'));
    // clone_comment.querySelector('#comment_text').textContent = item3['comment'];
    
    // clone_comment.querySelector('a').setAttribute('href', "#coment_collapse" + item3['id']);
    // clone_comment.querySelector('#comment_text').id = "comment_text" + item3['id'];
    // console.log(item3);
    clone_comment.id = 'one_comment';

    comm.appendChild(clone_comment);
    comm.id = 'one_commentddd';
    clone_comment = null;
    
     });
     
    
    };

   
// }, 2000);

    // text_div.textContent = null;
    // let clone = test_comment.cloneNode(true);

    // var enu = clone.querySelectorAll('span');
    // enu.forEach(function (item, i, enu) {  // перебираем смайлики
    //     item.setAttribute('comment_id', commits['id']);
    // });

    // clone.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, - 10) + ' ';
    // clone.querySelector('b').textContent = commits['user_name'] + ' ';
    // clone.querySelector('#comment_text').textContent = commits['comment'];
    // clone.querySelector('#comment_text').id = "comment_text" + commits['id'];
    // clone.querySelector('a').setAttribute('href', "#coment_collapse" + commits['id']);
    // clone.querySelector('#coment_reply_collapse').href = "#coment_reply_collapse" + commits['id'];
    // clone.querySelector('#coment_reply_collapse_hidden').id = "coment_reply_collapse" + commits['id'];
    // clone.querySelector('#form_reply_comment').setAttribute('coment_id', commits['id']);
    // clone.querySelector('#text_div_comment').textContent = commits['user_name'] + ' ';
    // clone.querySelector('#text_div_comment').id = 'text_div_comment' + commits['id'];
    // clone.querySelector('#coment_collapse').id = "coment_collapse" + commits['id'];
    // clone.querySelector('#form_coment').setAttribute('coment_id', commits['id']);
    // clone.querySelector('#text_div_comment_edit').textContent = commits['comment'];
    // clone.querySelector('#text_div_comment_edit').id = 'text_div_comment_edit' + commits['id'];
    // clone.querySelector('#form_coment_del').setAttribute('coment_id', commits['id']);
    // clone.querySelector('#input3').value = commits['id'];
    // clone.querySelector('#but2').id = "butw" + post_id;
    // clone.querySelector('#like_comment').setAttribute('comment_id', commits['id']);
    // clone.querySelector('#dislike_comment').setAttribute('comment_id', commits['id']);
    // clone.querySelector('#reply').id = "reply" + commits['id'];
    // clone.id = 'one_comment' + commits['id'];

    // comments.appendChild(clone);








































// let clone_replu = replu_hidden.cloneNode(true);

// var span = clone_replu.querySelectorAll('span');
// span.forEach(function (item, i, span) {  // перебираем смайлики
//     item.setAttribute('reply_id', commits['id']);
// });

// clone_replu.querySelector('b').textContent = commits['user_name'] + ' ';
// clone_replu.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, -10) + ' ';
// clone_replu.querySelector('#reply_text').textContent = commits['reply'];
// clone_replu.querySelector('#form_reply_reply').setAttribute('coment_id', commits['comment_id']);
// clone_replu.querySelector('#form_reply_reply').setAttribute('reply_id', commits['id']);
// clone_replu.querySelector('#form_reply_edit').setAttribute('reply_id', commits['id']);
// clone_replu.querySelector('#reply_text').id = "reply_text" + commits['id'];
// clone_replu.querySelector('#hidden_reply_collapse_edit').href = "#reply_collapse_edit" + commits['id'];
// clone_replu.querySelector('#reply_collapse_edit').id = "reply_collapse_edit" + commits['id'];
// clone_replu.querySelector('#input_name_opponent').value = commits['user_name'];
// clone_replu.querySelector('#like_reply').setAttribute('reply_id', commits['id']);
// clone_replu.querySelector('#dislike_reply').setAttribute('reply_id', commits['id']);
// clone_replu.querySelector('#text_div_reply').textContent = commits['user_name'];
// clone_replu.querySelector('#text_div_reply').id = "text_div_reply" + commits['id'];
// clone_replu.querySelector('#text_div_reply_edit').textContent = commits['reply'];
// clone_replu.querySelector('#text_div_reply_edit').id = "text_div_reply_edit" + commits['id'];
// clone_replu.querySelector('#hidden_reply_collapse').href = "#reply_collapse" + commits['id'];
// clone_replu.querySelector('#reply_collapse').id = "reply_collapse" + commits['id'];
// clone_replu.querySelector('#form_reply_del').setAttribute('reply_id', commits['id']);
// clone_replu.id = 'one_reply' + commits['id'];

// reply.appendChild(clone_replu);
