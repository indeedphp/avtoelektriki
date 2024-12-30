
       


            <div id='wrapper'>
  <button id='but1'>
  Button1
  </button>
  <button id='but2'>
  Button2
  </button>
  <button id='but3'>
  Button3
  </button>
  <button id='but4'>
  Button4
  </button>

  <a id='but5' href="#">
  Button4
  </a>

  <a id='but6' href="#">
  Button4
  </a>
  <a id='but7' href="#">
  Button4
  </a>
<i id='but8'>w </i>

<i id='but9'> w</i>
<i id='but10'> w</i>

</div>
<script>
const wrapper = document.getElementById('wrapper');
wrapper.addEventListener('click', (event) => {
  const isButton = event.target.nodeName === 'BUTTON';
  if (!isButton) {
    return;
  }
  console.dir(event.target.id);
})
</script>

<!-- 
function callback(e) {
    var e = window.e || e;
    if (e.target.tagName !== 'A')
        return;
    // Do something
}
if (document.addEventListener)
    document.addEventListener('click', callback, false);
else
    document.attachEvent('onclick', callback); -->