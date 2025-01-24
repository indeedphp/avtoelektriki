// setTimeout(function () {
    let tes = 1;
window.addEventListener('scroll', event => {
  if (scrollY + innerHeight - 2 <= document.body.scrollHeight && scrollY + innerHeight + 1 >= document.body.scrollHeight) {
	fetch(tes)
            .then(response => response.json())
            .then(commits => {
                console.dir(commits.last_page);
console.dir(commits);
               
                   
tes = commits.next_page_url;

          
func(commits.data);
                 

              



            });
  }
});




fetch('/')
    .then(response => response.json())
    .then(commits => {
        tes = commits.next_page_url;
        console.log(commits);
        func(commits.data);
    });


function func(data) {

    let posts = document.getElementById('posts');
    let wrapper = document.getElementById('wrapper');


    data.forEach(function (item, i, enu) {   // перебираем посты

        let clone = wrapper.cloneNode(true);

        clone.querySelector('#i_clock').textContent = ' ' + item['time'];
        clone.querySelector('#a_channel').href = "http://localhost:3000/channel/" + item['id_user'];
        clone.querySelector('#i_human').textContent = item['user_name'];
        clone.querySelector('#h_name_post').textContent = item['name_post'];
        clone.querySelector('#img_url1').src = item['url_foto'];
        clone.querySelector('#span_text_post').textContent = item['text_post'];
        clone.querySelector('#a_collapse_post').setAttribute('data-bs-target', '#collapseExample' + item['id']);
        clone.querySelector('#div_collapse_post').id = 'collapseExample' + item['id'];
        if (item['url_foto_2'] != null) {
            clone.querySelector('#div_hidden_post').removeAttribute('hidden');
            clone.querySelector('#img_url2').src = item['url_foto_2'];
            clone.querySelector('#p_text_post_2').textContent = item['text_post_2'];
        }
        if (item['url_foto_3'] != null) {
            clone.querySelector('#div_hidden_post2').removeAttribute('hidden');
            clone.querySelector('#img_url3').src = item['url_foto_3'];
            clone.querySelector('#p_text_post_3').textContent = item['text_post_3'];
        }
        clone.querySelector('#a_collapse_post_end').setAttribute('data-bs-target', '#collapseExample' + item['id']);
        clone.querySelector('#like_post').textContent = ' ' + item['post_like_count'];
        clone.querySelector('#like_post').setAttribute('post_id', item['id']);
        if (item['post_like_active'] == true) clone.querySelector('#like_post').className = "bi bi-hand-thumbs-up-fill"; 
        clone.querySelector('#a_collapse_repost').setAttribute('data-bs-target', '#collapse' + item['id']);
        clone.querySelector('#div_repost').id = 'collapse' + item['id'];
        clone.querySelector('#i_repost_post').textContent = " Пост " + item['id'];
        clone.querySelector('#a_collapse_comment').setAttribute('data-bs-target', '#collapseComment' + item['id']);
        clone.querySelector('#i_comment_count').textContent = item['post_comment_count'];
        clone.querySelector('#i_comment_count').id = 'comm_count' + item['id'];
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


    data.forEach(function (item3, i, enu) {   // перебираем комметарии
        let clone_comment = test_comment.cloneNode(true);

        clone_comment.querySelector('b').textContent = item3['user_name'];

        clone_comment.querySelector('nobr').textContent = item3['time'];

        clone_comment.querySelector('#comment_text').textContent = item3['comment'];
        clone_comment.querySelector('#comment_text').id = "comment_text" + item3['id'];
        
        if (item3['comment_like_active'] == true) clone_comment.querySelector('#like_comment').className = "bi bi-hand-thumbs-up-fill"; 
        if (item3['comment_dislike_active'] == true) clone_comment.querySelector('#dislike_comment').className = "bi bi-hand-thumbs-down-fill"; 
        if (item3['comment_made_user'] == true) clone_comment.querySelector('#a_comment_edit').removeAttribute('hidden');
        clone_comment.querySelector('#i_collapse_smile').setAttribute('href', "#collapse_comment_edit_smile" + item3['id']);
        clone_comment.querySelector('#collapse_comment_edit_smile').id = "collapse_comment_edit_smile" + item3['id'];
        clone_comment.querySelector('#i_collapse_comment_smile_reply').setAttribute('href', "#collapse_comment_smile" + item3['id']);
        clone_comment.querySelector('#collapse_comment_smile').id = "collapse_comment_smile" + item3['id'];
        clone_comment.querySelector('#a_comment_edit').setAttribute('href', "#coment_collapse" + item3['id']);
        clone_comment.querySelector('#coment_reply_collapse').href = "#coment_reply_collapse" + item3['id'];
        clone_comment.querySelector('#coment_reply_collapse_hidden').id = "coment_reply_collapse" + item3['id'];
        clone_comment.querySelector('#form_reply_comment').setAttribute('coment_id', item3['id']);
        clone_comment.querySelector('#text_div_comment').textContent = item3['user_name'] + ' ';
        clone_comment.querySelector('#text_div_comment').id = 'text_div_comment' + item3['id'];
        clone_comment.querySelector('#coment_collapse').id = "coment_collapse" + item3['id'];

        clone_comment.querySelector('#form_coment').setAttribute('coment_id', item3['id']);
        clone_comment.querySelector('#text_div_comment_edit').textContent = item3['comment'];
        clone_comment.querySelector('#text_div_comment_edit').id = 'text_div_comment_edit' + item3['id'];
        clone_comment.querySelector('#form_coment_del').setAttribute('coment_id', item3['id']);
        clone_comment.querySelector('#input3').value = item3['id'];
        // clone_comment.querySelector('#but2').id = "butw" + post_id;  // типа ид пост передается для удаления 

        clone_comment.querySelector('#like_comment').setAttribute('comment_id', item3['id']);
        clone_comment.querySelector('#like_comment').textContent = ' ' + item3['comment_like_count'];
        clone_comment.querySelector('#dislike_comment').setAttribute('comment_id', item3['id']);
        clone_comment.querySelector('#dislike_comment').textContent = ' ' + item3['comment_dislike_count'];
        clone_comment.querySelector('#reply').id = "reply" + item3['id'];
        clone_comment.id = 'one_comment' + item3['id'];

        // console.log(item3);
        clone_comment.id = 'one_comment';

        comm.appendChild(clone_comment);
        comm.id = 'one_commentddd';
        // console.log(item3.reply_comment_plus);
        replys(item3.reply_comment_plus, item3['id']);  // вставляем ответы

        clone_comment = null;

    });


};



function replys(data, id_comment) {
    let reply = document.getElementById('reply' + id_comment);
    let replu_hidden = document.getElementById('replu_hidden');


    data.forEach(function (item4, i, enu) {   // перебираем ответы
        let clone_reply = replu_hidden.cloneNode(true);

        clone_reply.querySelector('b').textContent = item4['user_name'] + ' ';
       

        clone_reply.querySelector('nobr').textContent = item4['time'];
        clone_reply.querySelector('#reply_text').textContent = item4['reply'];
        if (item4['reply_like_active'] == true) clone_reply.querySelector('#like_reply').className = "bi bi-hand-thumbs-up-fill"; 
        if (item4['reply_dislike_active'] == true) clone_reply.querySelector('#dislike_reply').className = "bi bi-hand-thumbs-down-fill"; 
        if (item4['reply_made_user'] == true) clone_reply.querySelector('#hidden_reply_collapse_edit').removeAttribute('hidden');
        clone_reply.querySelector('#i_reply_reply_collapse_smile').setAttribute('href', "#collapse_reply_smile" + item4['id'])
        clone_reply.querySelector('#collapse_reply_smile').id = "collapse_reply_smile" + item4['id'];
        clone_reply.querySelector('#i_reply_edit_collapse_smile').setAttribute('href', "#collapse_reply_edit_smile" + item4['id'])
        clone_reply.querySelector('#collapse_reply_edit_smile').id = "collapse_reply_edit_smile" + item4['id'];
        clone_reply.querySelector('#form_reply_reply').setAttribute('coment_id', item4['comment_id']);
        clone_reply.querySelector('#form_reply_reply').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#form_reply_edit').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#reply_text').id = "reply_text" + item4['id'];
        clone_reply.querySelector('#hidden_reply_collapse_edit').href = "#reply_collapse_edit" + item4['id'];
        clone_reply.querySelector('#reply_collapse_edit').id = "reply_collapse_edit" + item4['id'];

        clone_reply.querySelector('#input_name_opponent').value = item4['user_name'];
        clone_reply.querySelector('#like_reply').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#like_reply').textContent = ' ' + item4['reply_like_count'];
        clone_reply.querySelector('#dislike_reply').setAttribute('reply_id', item4['id']);
        clone_reply.querySelector('#dislike_reply').textContent = ' ' + item4['reply_dislike_count'];
        clone_reply.querySelector('#text_div_reply').textContent = item4['user_name'];
        clone_reply.querySelector('#text_div_reply').id = "text_div_reply" + item4['id'];
        clone_reply.querySelector('#text_div_reply_edit').textContent = item4['reply'];

        clone_reply.querySelector('#text_div_reply_edit').id = "text_div_reply_edit" + item4['id'];
        clone_reply.querySelector('#hidden_reply_collapse').href = "#reply_collapse" + item4['id'];
        clone_reply.querySelector('#reply_collapse').id = "reply_collapse" + item4['id'];
        clone_reply.querySelector('#form_reply_del').setAttribute('reply_id', item4['id']);
        clone_reply.id = 'one_reply' + item4['id'];


        // console.log(item4);
        

        reply.appendChild(clone_reply);




        clone_reply = null;

    });


};






// let clone_reply = replu_hidden.cloneNode(true);

// var span = clone_reply.querySelectorAll('span');
// span.forEach(function (item, i, span) {  // перебираем смайлики
//     item.setAttribute('reply_id', commits['id']);
// });

// clone_reply.querySelector('b').textContent = commits['user_name'] + ' ';
// clone_reply.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, -10) + ' ';
// clone_reply.querySelector('#reply_text').textContent = commits['reply'];
// clone_reply.querySelector('#form_reply_reply').setAttribute('coment_id', commits['comment_id']);
// clone_reply.querySelector('#form_reply_reply').setAttribute('reply_id', commits['id']);
// clone_reply.querySelector('#form_reply_edit').setAttribute('reply_id', commits['id']);
// clone_reply.querySelector('#reply_text').id = "reply_text" + commits['id'];
// clone_reply.querySelector('#hidden_reply_collapse_edit').href = "#reply_collapse_edit" + commits['id'];
// clone_reply.querySelector('#reply_collapse_edit').id = "reply_collapse_edit" + commits['id'];
// clone_reply.querySelector('#input_name_opponent').value = commits['user_name'];
// clone_reply.querySelector('#like_reply').setAttribute('reply_id', commits['id']);
// clone_reply.querySelector('#dislike_reply').setAttribute('reply_id', commits['id']);
// clone_reply.querySelector('#text_div_reply').textContent = commits['user_name'];
// clone_reply.querySelector('#text_div_reply').id = "text_div_reply" + commits['id'];
// clone_reply.querySelector('#text_div_reply_edit').textContent = commits['reply'];
// clone_reply.querySelector('#text_div_reply_edit').id = "text_div_reply_edit" + commits['id'];
// clone_reply.querySelector('#hidden_reply_collapse').href = "#reply_collapse" + commits['id'];
// clone_reply.querySelector('#reply_collapse').id = "reply_collapse" + commits['id'];
// clone_reply.querySelector('#form_reply_del').setAttribute('reply_id', commits['id']);
// clone_reply.id = 'one_reply' + commits['id'];

// reply.appendChild(clone_reply);
