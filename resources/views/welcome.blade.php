<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <script src="{{ url('bootstrap.bundle.js') }} " integrity="" crossorigin="anonymous"></script>
    <link href="{{ url('bootstrap.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <div id="comments">


    </div>

	<button id="button" type="button" class="btn btn-primary">Primary</button>

    <div hidden>
        <div id="test" class="card m-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"></h6>
                <p class="card-text"></p>
            </div>
        </div>
    </div>

    <script>
	let tes = 1;

        let test = document.getElementById('test');
        let comments = document.getElementById('comments');
let button = document.getElementById('button');






window.addEventListener('scroll', event => {
  if (scrollY + innerHeight - 2 <= document.body.scrollHeight && scrollY + innerHeight + 1 >= document.body.scrollHeight) {
	fetch(tes)
            .then(response => response.json())
            .then(commits => {
                console.dir(commits.last_page);
console.dir(commits);
                commits.data.forEach(function(item, i, enu) { // перебираем смайлики
                    let clone = test.cloneNode(true);
tes = commits.next_page_url;

                    clone.querySelector('h5').textContent = item['user_name'];
                    clone.querySelector('h6').textContent = item['name_post'];
                    clone.querySelector('p').textContent = item['text_post'];
                    clone.id = 'one';
                    comments.appendChild(clone);

                    // console.dir(item);

                });



            });
  }
});



button.addEventListener('click', (event) => {
	fetch(tes)
            .then(response => response.json())
            .then(commits => {
                console.dir(commits.last_page);
console.dir(commits);
                commits.data.forEach(function(item, i, enu) { // перебираем смайлики
                    let clone = test.cloneNode(true);

					tes = commits.next_page_url;
                    clone.querySelector('h5').textContent = item['user_name'];
                    clone.querySelector('h6').textContent = item['name_post'];
                    clone.querySelector('p').textContent = item['text_post'];
                    clone.id = 'one';
                    comments.appendChild(clone);

                    // console.dir(item);

                });



            });



});


        fetch('/api/')
            .then(response => response.json())
            .then(commits => {
                console.dir(commits.last_page);
				tes = commits.next_page_url;
console.dir(commits.next_page_url);
console.dir(commits);
                commits.data.forEach(function(item, i, enu) { // перебираем смайлики
                    // let clone = test.cloneNode(true);


                    // clone.querySelector('h5').textContent = item['user_name'];
                    // clone.querySelector('h6').textContent = item['name_post'];
                    // clone.querySelector('p').textContent = item['text_post'];
                    // clone.id = 'one';
                    // comments.appendChild(clone);

                    // console.dir(prev_page_url);
					func(test, item)
                });



            });

			function func(test, item) {
				let clone = test.cloneNode(true);


clone.querySelector('h5').textContent = item['user_name'];
clone.querySelector('h6').textContent = item['name_post'];
clone.querySelector('p').textContent = item['text_post'];
clone.id = 'one';
comments.appendChild(clone);
}



        // clone.querySelector('nobr').textContent = new Date().toLocaleString().slice(0, - 10) + ' ';
        //         clone.querySelector('b').textContent = commits['user_name'] + ' ';
        //         clone.querySelector('#comment_text').textContent = commits['comment'];
        //         clone.querySelector('#comment_text').id = "comment_text" + commits['id'];
        //         clone.querySelector('a').setAttribute('href', "#coment_collapse" + commits['id']);
        //         clone.querySelector('#coment_reply_collapse').href = "#coment_reply_collapse" + commits['id'];
        //         clone.querySelector('#coment_reply_collapse_hidden').id = "coment_reply_collapse" + commits['id'];
        //         clone.querySelector('#form_reply_comment').setAttribute('coment_id', commits['id']);
        //         clone.querySelector('#text_div_comment').textContent = commits['user_name'] + ' ';
        //         clone.querySelector('#text_div_comment').id = 'text_div_comment' + commits['id'];
        //         clone.querySelector('#coment_collapse').id = "coment_collapse" + commits['id'];
        //         clone.querySelector('#form_coment').setAttribute('coment_id', commits['id']);
        //         clone.querySelector('#text_div_comment_edit').textContent = commits['comment'];
        //         clone.querySelector('#text_div_comment_edit').id = 'text_div_comment_edit' + commits['id'];
        //         clone.querySelector('#form_coment_del').setAttribute('coment_id', commits['id']);
        //         clone.querySelector('#input3').value = commits['id'];
        //         clone.querySelector('#but2').id = "butw" + post_id;
        //         clone.querySelector('#like_comment').setAttribute('comment_id', commits['id']);
        //         clone.querySelector('#dislike_comment').setAttribute('comment_id', commits['id']);
        //         clone.querySelector('#reply').id = "reply" + commits['id'];
        //         clone.id = 'one_comment' + commits['id'];



        // fetch('/api/', {
        // 	method: 'POST',
        // 	headers: {
        // 		'Accept': 'application/json',
        // 		'X-CSRF-TOKEN': '{{ csrf_token() }}'
        // 	},
        // 	body: ''
        // })
        // 	.then(response => response.json())
        // 	.then(commits => {
        // 		console.dir(commits);

        // 	});
    </script>
</body>

</html>
