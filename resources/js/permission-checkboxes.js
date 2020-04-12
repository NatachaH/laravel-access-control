/*
|--------------------------------------------------------------------------
| Pemission Checkboxes Script
|--------------------------------------------------------------------------
|
| Plugin: https://quilljs.com/
|
*/

var checkboxes = document.querySelectorAll('.permission-checkbox-all input');
Array.prototype.forEach.call(checkboxes, function(el, i) {

  el.addEventListener('change', (event) => {

      var actionCheckboxes = document.querySelectorAll('.permission-checkbox-'+(event.target.value)+' input');

      if (event.target.checked) {
        toggleAllCheckboxes(actionCheckboxes,true);
      } else {
        toggleAllCheckboxes(actionCheckboxes,false);
      }

  });

});


function toggleAllCheckboxes(checkboxes, value){
  Array.prototype.forEach.call(checkboxes, function(el, i) {
    el.checked = value;
  });
}
