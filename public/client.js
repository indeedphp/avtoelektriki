window.addEventListener('click', function (event) {
    // console.log('even');
    if (event.target.classList.contains('smile')) {

        let vall = event.target.getAttribute('vall');

        let text_div_c = document.getElementById('text_div_comm' + vall);

        text_div_c.textContent += event.target.textContent;
    }
});

let user_name_id = document.getElementById("user_name_id").textContent;

// =================================================================== ОТПРАВКА  КОМЕНТАРИЯ  ================================================================================== 
const wrapper = document.getElementById('wrapper');

wrapper.addEventListener('submit', function (event) {
    event.preventDefault();
    if (user_name_id == 0) alert("Зарегистрируйтесь");
    else {
        const formData = new FormData(event.target);
        let form_type = event.target.getAttribute('form_type');
        let test_comment = document.getElementById('test_comment');
        let fff = document.getElementById('fff');
        let csrf_token = document.getElementById("csrf_token").textContent;
        let comment_id = event.target.getAttribute('coment_id');
        let reply_id = event.target.getAttribute('reply_id');
        let text_div = event.target.querySelector('#text_div');

        switch (form_type) {
            case '1':
                let post_id = event.target.getAttribute('post_id');
                let comments = document.getElementById('comments' + post_id);  // блок комментариев под постом
                let comm_count = document.getElementById('comm_count' + post_id);  // счет комментариев в посте
                let button = event.target.querySelector('button');
                button.className = "btn btn-success btn-sm";
                formData.append("comment", text_div.textContent);
                formData.append("post_id", post_id);

                if (text_div.textContent.trim() != '') {
                    fetch('/comments/', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf_token
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(commits => {

                            text_div.textContent = null;
                            let clone = test_comment.cloneNode(true);
                            console.dir(clone);

                            clone.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, - 10) + ' ';
                            clone.querySelector('b').textContent = commits['user_name'] + ' ';
                            clone.querySelector('#comment_text').textContent = commits['comment'];
                            clone.querySelector('#comment_text').id = "comment_text" + commits['id'];
                            clone.querySelector('a').setAttribute('href', "#coment_collapse" + commits['id']);
                            clone.querySelector('#coment_reply_collapse').href = "#coment_reply_collapse" + commits['id'];
                            clone.querySelector('#coment_reply_collapse_hidden').id = "coment_reply_collapse" + commits['id'];
                            clone.querySelector('#form_reply_comment').setAttribute('coment_id', commits['id']);
                            clone.querySelector('#text_div').textContent = commits['user_name'] + ' ';
                            clone.querySelector('#coment_collapse').id = "coment_collapse" + commits['id'];
                            clone.querySelector('#form_coment').setAttribute('coment_id', commits['id']);
                            clone.querySelector('#text_div_comment').textContent = commits['comment'];
                            clone.querySelector('#text_div_comment').id = 'text_div';
                            clone.querySelector('#form_coment_del').setAttribute('coment_id', commits['id']);
                            clone.querySelector('#input3').value = commits['id'];
                            clone.querySelector('#but2').id = "butw" + post_id;
                            clone.querySelector('#like_comment').setAttribute('comment_id', commits['id']);
                            clone.querySelector('#dislike_comment').setAttribute('comment_id', commits['id']);
                            clone.querySelector('#reply').id = "reply" + commits['id'];
                            clone.id = 'one_comment' + commits['id'];

                            comments.appendChild(clone);

                            comm_count.textContent = +comm_count.textContent +
                                1; // прибавляем счет комментариев 
                            clone = null;
                        });
                } else {
                    alert("Напишите коментарий");
                }
                event.target.reset();
                setTimeout(function () {
                    button.className = "btn btn-primary btn-sm"
                }, 1000);

                break;
            // Изменение комментария ======================================================================================================================
            case '2':

                let comment_text = document.getElementById('comment_text' + comment_id);
                let coment_collapse = document.getElementById('coment_collapse' + comment_id);

                formData.append("text_comment", text_div.textContent);
                formData.append("comment_id", comment_id);

                if (text_div.textContent.trim() != '') {
                    fetch('/comments/', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf_token
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(commits => {
                            coment_collapse.className = "collapse";
                            comment_text.textContent = commits['comment'];

                        });
                } else {
                    alert("Напишите комений");
                }

                break;
            // Удаление комментария ======================================================================================================================
            case '3':

                let one_comment = document.getElementById('one_comment' + comment_id);
                let coment_collapse2 = document.getElementById('coment_collapse' + comment_id);

                formData.append("comment_id", comment_id);

                fetch('/comments/', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf_token
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(commits => {
                        coment_collapse2.className = "collapse";
                        one_comment.remove();
                        console.dir(commits);
                    });

                break;

            // Ответ на комментарий ======================================================================================================================
            case '4':

                formData.append("reply_id", reply_id);
                formData.append("comment_id", comment_id);
                formData.append("reply", text_div.textContent);
                let reply = document.getElementById('reply' + comment_id);
                console.dir(comment_id + 'reply');
                let coment_reply_collapse = document.getElementById('coment_reply_collapse' + comment_id);
                if (reply_id != "0") {  // закрываем инпут после отправки ответа на ответ
                    let reply_collapse = document.getElementById('reply_collapse' + reply_id);
                    reply_collapse.className = "collapse";
                }

                if (text_div.textContent.trim() != '') {
                    fetch('/reply_comment/', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf_token
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(commits => {
                            //  console.dir(commits);
                            let clone_replu = replu_hidden.cloneNode(true);
                            clone_replu.querySelector('b').textContent = commits['user_name'] + ' ';
                            clone_replu.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, -10) + ' ';
                            clone_replu.querySelector('#reply_text').textContent = commits['reply'];
                            clone_replu.querySelector('#form_reply_reply').setAttribute('coment_id', commits['comment_id']);
                            clone_replu.querySelector('#form_reply_reply').setAttribute('reply_id', commits['id']);
                            clone_replu.querySelector('#form_reply_edit').setAttribute('reply_id', commits['id']);
                            clone_replu.querySelector('#reply_text').id = "reply_text" + commits['id'];
                            clone_replu.querySelector('#hidden_reply_collapse_edit').href = "#reply_collapse_edit" + commits['id'];
                            clone_replu.querySelector('#reply_collapse_edit').id = "reply_collapse_edit" + commits['id'];
                            clone_replu.querySelector('#input_name_opponent').value = commits['user_name'];
                            clone_replu.querySelector('#like_reply').setAttribute('reply_id', commits['id']);
                            clone_replu.querySelector('#dislike_reply').setAttribute('reply_id', commits['id']);
                            clone_replu.querySelector('#text_div').textContent = commits['user_name'];
                            clone_replu.querySelector('#text_div_reply').textContent = commits['reply'];
                            clone_replu.querySelector('#text_div_reply').id = "text_div";
                            clone_replu.querySelector('#hidden_reply_collapse').href = "#reply_collapse" + commits['id'];
                            clone_replu.querySelector('#reply_collapse').id = "reply_collapse" + commits['id'];
                            clone_replu.querySelector('#form_reply_del').setAttribute('reply_id', commits['id']);
                            clone_replu.id = 'one_reply' + commits['id'];

                            reply.appendChild(clone_replu);

                            coment_reply_collapse.className = "collapse";

                        });
                } else {
                    alert("Напишите что либо");
                }

                break;
            // Изменение ответа ======================================================================================================================
            case '5':

                let reply_text = document.getElementById('reply_text' + reply_id);
                let reply_collapse_edit = document.getElementById('reply_collapse_edit' + reply_id);

                formData.append("reply", text_div.textContent);
                formData.append("reply_id", reply_id);

                if (text_div.textContent.trim() != '') {
                    fetch('/reply_comment/', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf_token
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(commits => {
                            console.dir(commits);
                            reply_collapse_edit.className = "collapse";
                            reply_text.textContent = commits['reply'];

                        });
                } else {
                    alert("Напишите ответ");
                }

                break;

            // Удаление ответа ======================================================================================================================
            case '6':

                let one_reply = document.getElementById('one_reply' + reply_id);
                let reply_collapse_edit2 = document.getElementById('reply_collapse_edit' + reply_id);

                formData.append("reply_id", reply_id);

                fetch('/reply_comment/', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf_token
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(commits => {
                        reply_collapse_edit2.className = "collapse";
                        one_reply.remove();
                        console.dir(commits);
                    });

                break;
        }
    }
});


// ===================================================================   ОТПРАВКА ЛАЙКА  ================================================================================== 

let lik = null;
wrapper.addEventListener('click', (event) => {
    const isButton = event.target.nodeName === 'I';
    let type_element_like = event.target.getAttribute('value');
    let post_id = event.target.getAttribute('post_id');
    let litr = document.getElementById("butlike" + post_id)

    if (isButton && type_element_like != 'www') {
        // console.dir(user_name_id);

        if (user_name_id == 0) alert("Зарегистрируйтесь");
        else {

            if (type_element_like == 1) { // лайк на пост  
                let like = event.target.textContent;

                // console.dir(litr);
                fetch('/likes/?post_id=' + post_id + '&id_user=' + user_name_id)
                    .then(response => response.json())
                    .then(commits => {
                        if (commits == 1) {
                            lik = +like + 1;
                            litr.className = "bi bi-hand-thumbs-up-fill";
                        } else if (commits == 0 && like != 0) {
                            lik = +like - 1;
                            litr.className = "bi bi-hand-thumbs-up";
                        }
                        event.target.textContent = ' ' + lik;

                    });
            }


            if (type_element_like == 3) { // лайки на комментарии
                let like_comment_content = +event.target.textContent;
                let comment_id = event.target.getAttribute('comment_id');
                fetch('/like_comment/?comment_id=' + comment_id + '&id_user=' + user_name_id)
                    .then(response => response.json())
                    .then(commits => {
                        // console.dir(commits);
                        if (commits == 1) {
                            event.target.textContent = ' ' + (like_comment_content + 1);
                            event.target.className = "bi bi-hand-thumbs-up-fill";
                        } else if (commits == 0 && like_comment_content != 0) {
                            event.target.textContent = ' ' + (like_comment_content - 1);
                            event.target.className = "bi bi-hand-thumbs-up";
                        }
                    });
            }

            if (type_element_like == 4) { // дизлайки на коментарии
                let dislike_comment_content = +event.target.textContent;
                let comment_id = event.target.getAttribute('comment_id');
                fetch('/dislike_comment/?comment_id=' + comment_id + '&id_user=' + user_name_id)
                    .then(response => response.json())
                    .then(commits => {
                        // console.dir(commits);
                        if (commits == 1) {
                            event.target.textContent = ' ' + (dislike_comment_content + 1);
                            event.target.className = "bi bi-hand-thumbs-down-fill";
                        } else if (commits == 0 && dislike_comment_content != 0) {
                            event.target.textContent = ' ' + (dislike_comment_content - 1);
                            event.target.className = "bi bi-hand-thumbs-down";
                        }
                    });
            }

            if (type_element_like == 5) { // лайки на ответы
                let like_reply_content = +event.target.textContent;
                let reply_id = event.target.getAttribute('reply_id');
                fetch('/like_reply/?reply_id=' + reply_id + '&id_user=' + user_name_id)
                    .then(response => response.json())
                    .then(commits => {
                        // console.dir(commits);
                        if (commits == 1) {
                            event.target.textContent = ' ' + (like_reply_content + 1);
                            event.target.className = "bi bi-hand-thumbs-up-fill";
                        } else if (commits == 0 && like_reply_content != 0) {
                            event.target.textContent = ' ' + (like_reply_content - 1);
                            event.target.className = "bi bi-hand-thumbs-up";
                        }
                    });
            }



            if (type_element_like == 6) { // дизлайки на ответы
                let dislike_reply_content = +event.target.textContent;
                let reply_id = event.target.getAttribute('reply_id');
                fetch('/dislike_reply/?reply_id=' + reply_id + '&id_user=' + user_name_id)
                    .then(response => response.json())
                    .then(commits => {
                        // console.dir(commits);
                        if (commits == 1) {
                            event.target.textContent = ' ' + (dislike_reply_content + 1);
                            event.target.className = "bi bi-hand-thumbs-down-fill";
                        } else if (commits == 0 && dislike_reply_content != 0) {
                            event.target.textContent = ' ' + (dislike_reply_content - 1);
                            event.target.className = "bi bi-hand-thumbs-down";
                        }
                    });
            }


        }

    }
})