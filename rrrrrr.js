       let clone_post = wrapper.cloneNode(true);

        clone_post.querySelector('#i_clock').textContent = ' ' + item['time'];
        clone_post.querySelector('#a_channel').href = "http://localhost:3000/channel/" + item['id_user'];
        clone_post.querySelector('#i_human').textContent = item['user_name'];
        clone_post.querySelector('#h_name_post').textContent = item['name_post'];
        clone_post.querySelector('#img_url1').src = item['url_foto'];
        clone_post.querySelector('#span_text_post').textContent = item['text_post'];
        clone_post.querySelector('#a_collapse_post').setAttribute('data-bs-target', '#collapseExample' + item['id']);
        clone_post.querySelector('#div_collapse_post').id = 'collapseExample' + item['id'];
        if (item['url_foto_2'] != null) {
            clone_post.querySelector('#div_hidden_post').removeAttribute('hidden');
            clone_post.querySelector('#img_url2').src = item['url_foto_2'];
            clone_post.querySelector('#p_text_post_2').textContent = item['text_post_2'];
        }
        if (item['url_foto_3'] != null) {
            clone_post.querySelector('#div_hidden_post2').removeAttribute('hidden');
            clone_post.querySelector('#img_url3').src = item['url_foto_3'];
            clone_post.querySelector('#p_text_post_3').textContent = item['text_post_3'];
        }
        clone_post.querySelector('#a_collapse_post_end').setAttribute('data-bs-target', '#collapseExample' + item['id']);
        clone_post.querySelector('#like_post').textContent = ' ' + item['post_like_count'];
        clone_post.querySelector('#like_post').setAttribute('post_id', item['id']);
        if (item['post_like_active']) clone_post.querySelector('#like_post').className = "bi bi-hand-thumbs-up-fill";
        clone_post.querySelector('#a_collapse_repost').setAttribute('data-bs-target', '#collapse' + item['id']);
        clone_post.querySelector('#div_repost').id = 'collapse' + item['id'];
        clone_post.querySelector('#i_repost_post').textContent = " Пост " + item['id'];
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
        clone_post.querySelector('#a_collapse_comment_end').setAttribute('data-bs-target', '#collapseComment' + item['id']);
        clone_post.id = 'one_post';
        posts.appendChild(clone_post);
        comments_loading(item.comment_plus);  // вставляем комментарии
        clone_post = null;